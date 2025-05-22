<?php  
 
header('Content-Type: text/html; charset=utf-8');  

include('./selffunction.php');  

global $access_token_path, $zoho_apis_com;

check_access_token();  
$access_token = read_token($access_token_path);

$modulename = "Contacts";

//$modulename = "Accounts";
//$modulename = "Products";
//$modulename = "Purchase_Orders";
//$modulename = "Sales_Orders";
//$record_id = "4390624000000603011"; //Purchase order Recprd id
$record_id = "4549690000002731043";
//$record_id = "4390624000000482009";
$relatedListApi = "Products";
$header_data = array("Authorization: Zoho-oauthtoken ".$access_token);
$url_data=$zoho_apis_com."/crm/v2/".$modulename."/".$record_id; 
//$url_data=$zoho_apis_com."/crm/v2/".$modulename; 

//to view Settings and Meta Data
//$url_data=$zoho_apis_com."/crm/v2/settings/modules/".$modulename;

//To get the related list data of a particular module.
//$url_data=$zoho_apis_com."/crm/v2/settings/related_lists?module=".$modulename;

//to view Settings and Meta Data of a related List
//$url_data=$zoho_apis_com."/crm/v2/".$modulename."/".$record_id."/".$relatedListApi; 


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true);  
   
         // output  
 //return $response_arr;  
	echo "<pre>";
	print_r	($response_arr);
	echo "</pre>";

 ?>  
