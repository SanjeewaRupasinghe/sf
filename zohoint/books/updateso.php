<?php  
header('Content-Type: text/html; charset=utf-8'); 
$data = json_decode(file_get_contents('php://input'), true); 
include('./selffunction.php');  
global $access_token_path, $zoho_apis_com, $organization_id;

check_access_token();  
$access_token = read_token($access_token_path);
$header_data = array("Authorization: Zoho-oauthtoken ".$access_token, "Content-Type: application/x-www-form-urlencoded;charset=UTF-8");
$str_arr = array(")", "(", "[", "]", "<", ">", "<\/a>", "\/", "/a>");

$Transaction_No = $data['transaction_id'];
$totalamtpd = $data['total'];
$refundamnt = $data['refunds'][0]['total'];
$effectiveamnt = $totalamtpd+$refundamnt;
$currency = $data['currency'];
$amtpd = $currency." ".$effectiveamnt;
$payment_method = $data['payment_method'];	
$description = 'Payment Reported from WooCommerce : Order Status - '.$orderstat.', Transaction ID - '.$Transaction_No. ', Amount -'.$amtpd.', Order Notes(if any) - '.$order_note;

$orderstat = $data['status'];
$ordernum = "Order#".$data['number'];
$orderno = urlencode($ordernum);

$salesorder_id = getSalesOrddByRef( $orderno, $header_data );



if ($orderstat == "completed" || $orderstat == "processing") {
//Create Invoice from Sales Order	
	
	$salesorderstat = confirmSo( $salesorder_id, $header_data );

	$url_data = $zoho_apis_com."invoices/fromsalesorder/?organization_id=".$organization_id."&authtoken=".$access_token."&salesorder_id=".$salesorder_id; 

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true);   
	$invoice_id = $response_arr['invoice']['invoice_id'];
	$invoice_number = $response_arr['invoice']['invoice_number'];
	$invoice_date = $response_arr['invoice']['date'];
	$customer_id = $response_arr['invoice']['customer_id'];
	
	$approveinv = markInvoiceApprove( $invoice_id, $header_data );


	if ($effectiveamnt == 0) {
	
	// Mark invoice Sent
		
	$invoicesentstat = markInvoiceSent( $invoice_id, $header_data );
	
	} else {
// Create Customer Payment
	
	$invoicesentstat = markInvoiceSent( $invoice_id, $header_data );

	$invdet[0] = array(
	  "invoice_id" => $invoice_id,
	  "amount_applied" => $effectiveamnt,
	  );
	$jsoninvdet     = json_encode($invdet);
	
	$invoicedt = array(
	  "customer_id" => $customer_id,
	  "payment_mode" => "Online",
	  "reference_number" => $ordernum,
	  "amount" => $effectiveamnt,
	  "date" => $invoice_date,
	  "description" => $description,
	  "invoices" => $jsoninvdet
	  );
	$invoicedata     = json_encode($invoicedt); 
	
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://books.zoho.com/api/v3/customerpayments?organization_id=".$organization_id,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('JSONString' => $invoicedata),
	  CURLOPT_HTTPHEADER => array(
			"Authorization: Zoho-oauthtoken ".$access_token
		  ),
	));

	$response2 = curl_exec($curl);
	curl_close($curl);
	$response_arr2 = json_decode($response2, true);
	$datasynstat = $response_arr2['message'];

	
	
	
		$to = 'nasirsohail3@gmail.com';
		$subject = 'Invoice Status From Updateso';
		$msg = 'Amount: '.$amtpd.' <br />';
		$msg .= 'Order No.: '.$ordernum.' <br />';
		$msg .= 'Response Sales Order To Invoice: '.$result.' <br />';
		$msg .= 'Response payment: '.$response2.' <br />';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: support <support@safetyfirstmed.ae>' . "\r\n";
		 
		
		if ($datasynstat != "The invoice has been created.") 
			{
			 mail($to, $subject, $msg, $headers);
			}

	}

}


?>