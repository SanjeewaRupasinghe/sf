<?php  
header('Content-Type: text/html; charset=utf-8');  

$data = json_decode(file_get_contents('php://input'), true);

include('./selffunction.php');  
global $access_token_path, $zoho_apis_com;

check_access_token();  
$access_token = read_token($access_token_path);
$header_data = array("Authorization: Zoho-oauthtoken ".$access_token, 'Content-Type: application/json');
$str_arr = array(")", "(", "[", "]");

//contact info
$fname = $data['billing']['first_name'];	
$lname = $data['billing']['last_name'];
$email = $data['billing']['email'];
$phone = $data['billing']['phone'];
$companyname = $data['billing']['company'];

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
$leadsource = "Online Store";



if ($companyname == null) {
//create or check customer in contacts
			$companyname2 = $fname." ".$lname;
			$acttdata = [
			"data"             => [
			"0"                => [
			"Account_Name" => $companyname2,
			"Billing_Street" => $billingstreet,
			"Billing_City" => $city,
			"Billing_State" => $statecode,
			"Billing_Code" => $postalcode,
			"Billing_Country" => $country,
			"Shipping_Street" => $shipstreet,
			"Shipping_City" => $shipcity,
			"Shipping_State" => $shipstate,
			"Shipping_Code" => $shipzip,
			"Shipping_Country" => $shipcountry
			],
			],
			];
			$postactdata = json_encode($acttdata);

			$act_id = getActId( $companyname, $header_data, $postactdata );
			$account_Name = getActName( $act_id, $header_data );
	
	
		$custdata = [
			"data"             => [
			"0"                => [
			"First_Name" => $fname,
			"Last_Name" => $lname,
			"Email" => $email,
			"Phone" => $phone,
			"Mailing_Street" => $billingstreet,
			"Mailing_City" => $city,
			"Mailing_State" => $statecode,
			"Mailing_Zip" => $postalcode,
			"Mailing_Country" => $country,
			"Other_Street"	=> $shipstreet,
			"Other_City"	=> $shipcity,
			"Other_State"	=> $shipstate,
			"Other_Zip"		=> $shipzip,
			"Lead_Source"	=> $leadsource,
			"Other_Country"	=> $shipcountry,
			"Account_Name" => [
			"name" => $account_Name,
			"id" => $act_id
			]
			],
		],
		];

} else {
	
	$acttdata = [
    "data"             => [
	"0"                => [
    "Account_Name" => $companyname,
	"Billing_Street" => $billingstreet,
	"Billing_City" => $city,
	"Billing_State" => $statecode,
	"Billing_Code" => $postalcode,
	"Billing_Country" => $country,
	"Shipping_Street" => $shipstreet,
	"Shipping_City" => $shipcity,
	"Shipping_State" => $shipstate,
	"Shipping_Code" => $shipzip,
	"Shipping_Country" => $shipcountry	
    ],
	],
	];
	$postactdata = json_encode($acttdata);

	$act_id = getActId( $companyname, $header_data, $postactdata );
	$account_Name = getActName( $act_id, $header_data );
	
	$custdata = [
    "data"             => [
	"0"                => [
    "First_Name" => $fname,
    "Last_Name" => $lname,
	"Email" => $email,
	"Phone" => $phone,
	"Mailing_Street" => $billingstreet,
	"Mailing_City" => $city,
	"Mailing_State" => $statecode,
	"Mailing_Zip" => $postalcode,
	"Mailing_Country" => $country,
	"Other_Street"	=> $shipstreet,
	"Other_City"	=> $shipcity,
	"Other_State"	=> $shipstate,
	"Other_Zip"		=> $shipzip,
	"Lead_Source"	=> $leadsource,
	"Other_Country"	=> $shipcountry,
	"Account_Name" => [
		"name" => $account_Name,
		"id" => $act_id
		]
    ],
],
];
	
}

	$postcustdata = json_encode($custdata);


	$url_data = $zoho_apis_com."/crm/v2/Contacts/upsert";
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postcustdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true); 
	$customer_id = $response_arr['data'][0]['details']['id'];
	$datasynstat = $response_arr['data'][0]['status'];
	if ($datasynstat = 'success') {
		return $customer_id;
	} else {
		
		$to = 'nasirsohail3@gmail.com';
		$subject = 'Data Sync Failure Reported';
		$msg = 'First Name: '.$fname.' <br />';
		$msg .= 'Last Name: '.$lname.' <br />';
		$msg .= 'Email: '.$email.' <br />';
		$msg .= 'Phone: '.$phone.' <br />';
		$msg .= 'City: '.$city.'<br />';
		$msg .= 'State: '.$statecode.' <br />';
		$msg .= 'ZipCode: '.$postalcode.' <br />';
		$msg .= 'Country: '.$country.' <br />';
		$msg .= 'Response error Contact Creation: '.$result.' <br />';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: support <support@safetyfirstmed.ae>' . "\r\n";
		//$headers .= 'CC: info@safetyfirstmed.ae' . "\r\n";

		//$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
		 mail($to, $subject, $msg, $headers);
	}

 ?>  
