<?php  
header('Content-Type: text/html; charset=utf-8'); 
$data = json_decode(file_get_contents('php://input'), true); 
include('./selffunction.php');  
global $access_token_path, $zoho_apis_com, $organization_id;

check_access_token();  
$access_token = read_token($access_token_path);
$header_data = array("Authorization: Zoho-oauthtoken ".$access_token, "Content-Type: application/x-www-form-urlencoded;charset=UTF-8");
$str_arr = array(")", "(", "[", "]", "<", ">", "<\/a>", "\/", "/a>");

$orderstat = $data['status'];

//if ($orderstat == "completed" || $orderstat == "processing") {
//contact info
$fname = $data['billing']['first_name'];	
$lname = $data['billing']['last_name'];
$fullname = $fname." ".$lname;
$email = $data['billing']['email'];
$phone = $data['billing']['phone'];
$companyname = $data['billing']['company'];

if ($companyname == null) {
	$company_name = $fullname;
} else {
	$company_name = $companyname;
}

//billing address
$addline1 = $data['billing']['address_1'];
$addline2 = $data['billing']['address_2'];
$billingstreet = $addline1.", ".$addline2;
$city = $data['billing']['city'];
$statecode = $data['billing']['state'];
$postalcode = $data['billing']['postcode'];
$country = $data['billing']['country'];

//Shipping Address
$shipadd1 = $data['shipping']['address_1'];
$shipadd2 = $data['shipping']['address_2'];
$shipstreet = $shipadd1." ".$shipadd2;
$shipcity = $data['shipping']['city'];
$shipstate = $data['shipping']['state'];
$shipzip = $data['shipping']['postcode'];
$shipcountry = $data['shipping']['country'];

$contact_name_contains = urlencode($fullname);
$contact_id = getSalesContactId( $contact_name_contains, $header_data );


	if(!empty(($contact_id))){
		$contact_personsId = getContactPersId( $contact_id, $header_data );
	} else {
		
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://books.zoho.com/api/v3/contacts?organization_id=717628836",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('JSONString' => '{"contact_name":"'.$fullname.'","company_name":"'.$company_name.'","billing_address":{"address":"'.$billingstreet.'","city":"'.$city.'","state":"'.$statecode.'","zip":"'.$postalcode.'","country":"'.$country.'","phone":"'.$phone.'"},"shipping_address":{"address":"'.$shipstreet.'","city":"'.$shipcity.'","state":"'.$shipstate.'","zip":"'.$shipzip.'","country":"'.$shipcountry.'"},"contact_persons":[{"first_name":"'.$fname.'","last_name":"'.$lname.'","phone":"'.$phone.'","email":"'.$email.'"}]}'),
	  CURLOPT_HTTPHEADER => array(
		"Authorization: Zoho-oauthtoken ".$access_token
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$response_arr = json_decode($response, true);  
   
	$contact_id = $response_arr['contact']['contact_id'];
	$datasynstatc = $response_arr['message'];
	$contact_personsId = $response_arr['contact']['contact_persons'][0]['contact_person_id'];
	}
	
// ***********************Customer Account Creation Ends here************************	
// ***********************Sales Order Creation Starts here************************	
//order & Payment info
$orderno = "Order#".$data['number'];
$datepaid = $data['date_paid'];
$Transaction_No = $data['transaction_id'];
$totalamtpd = $data['total'];
$refundamnt = $data['refunds'][0]['total'];
$effectiveamnt = $totalamtpd+$refundamnt;
$currency = $data['currency'];

$amtpd = $currency." ".$effectiveamnt;
$order_note = $data['customer_note'];
$payment_method = $data['payment_method'];
/*$couponcode = $data['coupon_lines'][0]['code'];
if($couponcode == null){
		$cpcode = 'NA';
	} else {
		$cpcode = $couponcode;
	}
*/
$description = 'Data Reported from WooCommerce : Order Status - '.$orderstat.', Transaction ID - '.$Transaction_No. ', Amount -'.$amtpd.', Order Notes(if any) - '.$order_note;
$taxrates = $data['tax_lines'][0]['rate_percent'];
//$taxrate1 = round($taxrates,2);
//$taxamnt1 = $data['tax_lines'][0]['tax_total'];
if ($taxrates == 5) {
	$tax_id = "2290844000000105019";
} elseif ($taxrates == null){
	$tax_id = "2290844000000105023";
} else {
	$tax_id = "2290844000000105023";
}

$discount = $data['discount_total'];
$discount_tax = $data['discount_tax'];
//$adjustment = $data['shipping_lines'][0]['total']+$data['shipping_lines'][0]['total_tax'];

$product = $data['line_items'];

$i=0;
   foreach($product as $c) {
	   
	$pdctname = $data['line_items'][$i]['name'];
	$arr = explode("<br", $pdctname);
	$realname = $arr[0];
	$itemname = urlencode($realname);
	//$itemname = str_replace($str_arr, '', $realname);
	
	if($i ==0){
		$itemdiscount = $discount;
	} else {
		$itemdiscount = 0;
	}
	$subtotal = $data['line_items'][$i]['subtotal'];
	$qty = $data['line_items'][$i]['quantity'];
	if($subtotal == 0){
		$listprice = 0;
	} else {
		$listprice = $subtotal/$qty;
	}
	
	$itemd = array(
	  "rate" => $listprice,
	  "name" => $realname,
	  );
	$itemdata     = json_encode($itemd);

	$item_ID = getitemId( $itemname, $header_data, $itemdata, $access_token );

	
	$products[$i] = array(
	  "item_order" => $i,
	  "rate" => $listprice,
	  "item_id" => $item_ID,
	  "quantity" => $qty,
	  "tax_id" => $tax_id,
	  "discount" => $itemdiscount
	  );
	$productsdata     = json_encode($products);

	 $i++;
    }

	$curl2 = curl_init();

	curl_setopt_array($curl2, array(
	  CURLOPT_URL => "https://books.zoho.com/api/v3/salesorders?organization_id=717628836",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('JSONString' => '{"customer_id":"'.$contact_id.'","contact_persons": ["'.$contact_personsId.'"],"reference_number" : "'.$orderno.'","line_items": '.$productsdata.',"notes": "Looking forward for your business."}'),
	  CURLOPT_HTTPHEADER => array(
		"Authorization: Zoho-oauthtoken ".$access_token
	  ),
	));

	$response2 = curl_exec($curl2);

	curl_close($curl2);
	
	$response_arr2 = json_decode($response2, true);  
	$salesOrderID = $response_arr2['salesorder']['salesorder_id'];
	$datasynstat = $response_arr2['message'];
	$productprint = print_r($response_arr2);
	
	if($datasynstat == "Sales Order has been created."){
	
	$curl3 = curl_init();
	curl_setopt_array($curl3, array(
	  CURLOPT_URL => "https://books.zoho.com/api/v3/salesorders/".$salesOrderID."/comments?organization_id=717628836",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('JSONString' => '{"description":"'.$description.'"}'),
	  CURLOPT_HTTPHEADER => array(
			"Authorization: Zoho-oauthtoken ".$access_token
		  ),
	));

	$responsecom = curl_exec($curl3);

	curl_close($curl3);
}

	/* Creating invoices
	
	$curl4 = curl_init();

	curl_setopt_array($curl4, array(
	  CURLOPT_URL => "https://books.zoho.com/api/v3/invoices?organization_id=717628836",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('JSONString' => '{"customer_id":"'.$contact_id.'","salesorder_id":"'.$salesOrderID.'","contact_persons": ["'.$contact_personsId.'"],"reference_number" : "'.$orderno.'","line_items": '.$productsdata.',"notes": "Looking forward for your business."}'),
	  CURLOPT_HTTPHEADER => array(
			"Authorization: Zoho-oauthtoken ".$access_token
		  ),
	));

	$responseinv = curl_exec($curl4);
	curl_close($curl4);
	*/
	
$to = 'nasirsohail3@gmail.com';
$subject = 'Data Sync Failure Reported during Sales order Creation';
$msg = 'Product Data: <pre>'.$productsdata.'</pre> <br />';
$msg .= 'Name: '.$contactname.' <br />';
$msg .= 'Prod1: '.$arr1[0].' <br />';
$msg .= 'taxrate1: '.$taxrate1.' <br />';
$msg .= 'WC Order No.: '.$orderno.' <br />';
$msg .= 'Error Message(Creating Customer): '.$datasynstatc.' <br />';
$msg .= 'Error Message(Creating Sales order): '.$response_arr2.' <br />';
$msg .= 'Sales Order Status: '.$datasynstat.' <br />';
$msg .= 'Comment Status: '.$responsecom.' <br />';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: support <support@safetyfirstmed.ae>' . "\r\n";
//$headers .= 'CC: info@example.com' . "\r\n";

//$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);

if ($datasynstat != "Sales Order has been created.") 
{
 mail($to, $subject, $msg, $headers);
}



 ?>  
