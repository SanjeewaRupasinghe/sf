<?php  
/*------- Zoho Authorization via oAuth2.0 for REST API v2 -- Zoho API v2:  https://accounts.zoho.com/developerconsole  
Documentation:    https://www.zoho.com/crm/help/api/v2/   
*/  
 // Global vars for Zoho API  
     $zoho_apis_com = "https://www.zohoapis.com";  
     $refresh_access_token_url = "https://accounts.zoho.com/oauth/v2/token";  
   
     // Global vars to be used by below functions specific to this app  
     $zoho_client_id = "1000.AY59KPJ30FXVENWHZT2MUHL8C20CJH";  
     $zoho_client_secret = "b6b64754442fbc16303752866b7dd7ea3dce7b4ab3";  
     $access_token_path = "self_access_token.dat";  
     $refresh_token_path = "self_refresh_token.dat";
   
     // function to use Zoho API v2  
 //    function abZohoApi( $post_url, $post_fields, $post_header=false, $post_type='GET' ) 
function abZohoApi( $post_url, $post_fields, $post_header, $post_type ) 
     {  
         // setup cURL request  
         $ch=curl_init();  
   
         // do not return header information  
         curl_setopt($ch, CURLOPT_HEADER, 0);  
   
         // submit data in header if specified  
         if(is_array($post_header)){  
             curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);  
         }  
   
         // do not return status info  
         curl_setopt($ch, CURLOPT_VERBOSE, 0);  
   
         // return data  
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
   
         // cancel ssl checks  
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
   
         // if using GET, POST or PUT  
         if($post_type=='POST'){  
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			 /* set POST method */
			 curl_setopt($ch, CURLOPT_POST, 1);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			
				
         } else if($post_type=='PUT'){  
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');  
             curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));  
         } else if($post_type=='DELETE'){  
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');  
         }else{  
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');  
             if($post_fields){  
                 $post_url.='?'.http_build_query($post_fields);  
             }  
         }  
   
         // specified endpoint  
         curl_setopt($ch, CURLOPT_URL, $post_url);  
   
         // execute cURL request  
         $response=curl_exec($ch);  
   
         // return errors if any  
         if (curl_exec($ch) === false) {  
             $output = curl_error($ch);  
         } else {  
             $output = $response;  
         }  
   
         // close cURL handle  
         curl_close($ch);  
   
         // output  
         return $output;  
     }

	 
function postZohoData( $post_url, $post_fields, $post_header, $post_type ) 
     {  
         // setup cURL request  
         $ch=curl_init();  
		// do not return header information  
         curl_setopt($ch, CURLOPT_HEADER, 0);  
   
         // submit data in header if specified  
         if(is_array($post_header)){  
             curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);  
         }  
   
         // do not return status info  
         curl_setopt($ch, CURLOPT_VERBOSE, 0);  
            // return data  
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
   
         // cancel ssl checks  
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		 
   
         // specified endpoint  
         curl_setopt($ch, CURLOPT_URL, $post_url);  
   
         // execute cURL request  
         $response=curl_exec($ch);  
   
         // return errors if any  
         if (curl_exec($ch) === false) {  
             $output = curl_error($ch);  
         } else {  
             $output = $response;  
         }  
  
         // close cURL handle  
         curl_close($ch);  
   
         // output  
        return $output;  
     }	 
	 
function getProductId( $Product_Code, $header_data, $post_proddata ) 
     { 
    global $access_token_path, $zoho_apis_com;
    
    $url_data = $zoho_apis_com."/crm/v2/Products/search?criteria=(Product_Code:equals:".$Product_Code.")";
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
    $product_id= $response_arr['data'][0]['id'];
    	
	if(isset($product_id)){
		return $product_id;
	} else {
	
	$url_data=$zoho_apis_com."/crm/v2/Products/upsert"; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_proddata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true); 
	$datasynstat= $response_arr['data'][0]['status']; 
	$product_id = $response_arr['data'][0]['details']['id'];
    return $product_id;
    }	
}


function updateOptIn( $customerid, $postcustdata2, $header_data ) 
     { 
    global $access_token_path, $zoho_apis_com;
    
	$modulename = "Contacts";
    $url_data=$zoho_apis_com."/crm/v2/".$modulename."/".$customerid;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postcustdata2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true); 
	$datasynstat= $response_arr['data'][0]['status'];
	$productprint = print_r($productsdata);
}


	
function getProductName( $Product_Code, $header_data ) 
     { 
	global $access_token_path, $zoho_apis_com;
	
	$url_data = $zoho_apis_com."/crm/v2/Products/search?criteria=(Product_Code:equals:".$Product_Code.")";
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
	$Product_Name= $response_arr['data'][0]['Product_Name'];
    return $Product_Name;  
    	
	}
	
function getContactName( $email, $header_data ) 
     { 
	global $access_token_path, $zoho_apis_com;
	
	$url_data = $zoho_apis_com."/crm/v2/Contacts/search?email=".$email;
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
	$contactName = $response_arr['data'][0]['Full_Name'];
    return $contactName;  
    	
	}

function getActId( $companyname, $header_data, $post_actdata ) 
     { 
    global $access_token_path, $zoho_apis_com;
    
    $url_data = $zoho_apis_com."/crm/v2/Accounts/search?criteria=(Account_Name:equals:".$companyname.")";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
    curl_close($ch);
    $response_arr = json_decode($result, true);  
    $act_id = $response_arr['data'][0]['id'];
    	
	if(isset($act_id)){
		return $act_id;
	} else {
	
	$url_data=$zoho_apis_com."/crm/v2/Accounts/upsert"; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_actdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	$response_arr = json_decode($result, true); 
	$datasynstat= $response_arr['data'][0]['status']; 
	$act_id = $response_arr['data'][0]['details']['id'];
    return $act_id;
    }	
}

function getActName( $act_id, $header_data ) 
     { 
	global $access_token_path, $zoho_apis_com;
	
	$url_data = $zoho_apis_com."/crm/v2/Accounts/".$act_id;
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
	$account_Name = $response_arr['data'][0]['Account_Name'];
    return $account_Name;  
    }



	
	
function getCustomerId( $customer_email, $header_data, $postcustdata ) 
     { 
	global $access_token_path, $zoho_apis_com;
	
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
		$headers .= 'From: support <support@statefortyeight.com>' . "\r\n";
		//$headers .= 'CC: info@statefortyeight.com' . "\r\n";

		//$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
		 mail($to, $subject, $msg, $headers);
		}
	
	
}	

function DelLeadId( $email, $header_data ) 
     { 
	global $access_token_path, $zoho_apis_com;
	
	$url_data = $zoho_apis_com."/crm/v2/Leads/search?email=".$email;
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
	$LeadId = $response_arr['data'][0]['id'];
	
	if(isset($LeadId)){
	$url_data = $zoho_apis_com."/crm/v2/Leads?ids=".$LeadId;
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    $result = curl_exec($ch);
	curl_close($ch);
	}
    	
	}	
	
   
   
     // function to generate refresh token from Zoho authorization code  
     function generate_refresh_token(){  
   
         // use vars declared at beginning of script  
         global $zoho_client_id, $zoho_client_secret, $zoho_redirect_uri, $access_token_path, $refresh_token_path;  
   
         // Generate Access Token and Refresh Token - Read url GET values  
         $zoho_grant_token = $_GET['code'];  
         $zoho_location = $_GET['location'];  
         $zoho_accounts_server = $_GET['accounts-server'];  
   
         // Generate Access Token and Refresh Token  
         $url_auth=urldecode($zoho_accounts_server)."/oauth/v2/token";  
   
         // Build fields to post  
         $fields_token=array("code"=>$zoho_grant_token, "redirect_uri"=>$zoho_redirect_uri, "client_id"=>$zoho_client_id, "client_secret"=>$zoho_client_secret, "grant_type"=>"authorization_code", "prompt"=>"consent");  
   
         // Generate Access Token and Refresh Token - post via cURL  
         $response_json = abZohoApi($url_auth, $fields_token, false, 'POST');  
   
         // Generate Access Token and Refresh Token - format output (convert JSON to Object)  
         $refresh_token_arr = json_decode($response_json, true);  
   
         // store in var  
         $refresh_token = isset($refresh_token_arr['refresh_token']) ? $refresh_token_arr['refresh_token'] : 0;  
   
         // encode value to base64  
         $refresh_token_base64 = base64_encode($refresh_token);  
   
         // store encoded value to file  
         file_put_contents($refresh_token_path, $refresh_token_base64);  
   
         // -- do access token while we're here  
         // store in access token  
         $access_token = isset($refresh_token_arr['access_token']) ? $refresh_token_arr['access_token'] : 0;  
   
         // encode value to base64  
         $access_token_base64 = base64_encode($access_token);  
   
         // store encoded value to file  
         file_put_contents($access_token_path, $access_token_base64);  
   
         // return array of json objects  
         return $refresh_token_arr;  
     }  
   
   
     // function to generate access token from refresh token  
     // returns minutes remaining of valid token  
     function generate_access_token(){  
   
         // use vars declared at beginning of script  
         global $zoho_client_id, $zoho_client_secret, $access_token_path, $refresh_token_path, $refresh_access_token_url;  
   
         // get refresh token from file  
         $refresh_token = base64_decode( file_get_contents( $refresh_token_path ) );  
   
         // build fields to post  
         $refresh_fields = array("refresh_token" => $refresh_token, "client_id" => $zoho_client_id, "client_secret" => $zoho_client_secret, "grant_type" => "refresh_token");  
   
         // send to Zoho API  
         $this_access_token_json = abZohoApi($refresh_access_token_url, $refresh_fields, false, 'POST');  
   
         // convert JSON response to array  
         $access_token_arr = json_decode($this_access_token_json, true);  
   
         // store in var  
         $returned_token = $access_token_arr['access_token'];  
   
         // encode value to base64  
         $access_token_base64 = base64_encode($returned_token);  
   
         // store encoded value to file  
         file_put_contents($access_token_path, $access_token_base64);  
     }  
   
     // function to decode and read access token from file  
     function read_token($file){  
   
         // get access token from file  
         $token_base64 = file_get_contents($file);  
   
         // decode value to token  
         $token = base64_decode($token_base64);  
   
         // output  
         return $token;  
     }  
   
     // function to sort our returned data (multidimensional array)  
     function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {  
         $sort_col = array();  
         foreach ($arr as $key=> $row) {  
             $sort_col[$key] = strtolower($row[$col]); // strtolower to make it case insensitive  
         }  
         array_multisort($sort_col, $dir, $arr);  
     }  
   
     // function to get minutes left on a generated file  
     // defaults to an hour expiry time  
     // usage: get_time_remaining( 'access.dat', 3600)  
     function get_time_remaining($file, $expiry_in_seconds=3600){  
   
         // get file modified time  
         $file_modified_time = filemtime($file);  
   
         // add 1 hour  
         $file_expiry_time = $file_modified_time + $expiry_in_seconds;  
   
         // calculate seconds left  
         $diff = $file_expiry_time - time();  
   
         // round to minutes  
         $minutes = floor($diff/60);  
   
         // output  
         return $minutes;  
     }  
   
   
     // function to check access token and regenerate if necessary  
     function check_access_token(){  
   
         global $access_token_path;  
   
         // get time remaining on access token (1 hour max)  
         $access_token_time_remaining = get_time_remaining($access_token_path);  
   
         // if less than 5 minutes left, regenerate token  
         if($access_token_time_remaining<=5){  
   
             // Generate Access Token from Refresh Token  
             generate_access_token();  
   
             // update time remaining on access token (again)  
             $access_token_time_remaining = get_time_remaining($access_token_path);  
         }  
   
         // return time remaining (in minutes)  
         return $access_token_time_remaining;  
   
     }  
   
   
     // get data: returns PHP Array (for functional sorting: PHP & JS)  
     // usage: Leads: get_records("Leads")  
     // usage: Lead: get_records("Leads", 98304820934029840)  
     // usage: User: get_records("users", 10825000000119017)  // note that users has to be lowercase  
     function get_records($zoho_category, $zoho_id=0, $fields_data=array()){  
   
         global $access_token_path, $zoho_apis_com;  
   
         // get access token  
         $access_token = read_token($access_token_path);  
   
         // endpoint  
         $url_data=$zoho_apis_com."/crm/v2/".$zoho_category;  
   
         // if array (eg. Related Records), accept ID and related_list_apiname  
         if(is_array($zoho_id)){  
             $url_data.= $zoho_id[0]>0 ? '/'.$zoho_id[0].'/'.$zoho_id[1] : '';  
         }else{  
             // add id if exists  
             $url_data.= $zoho_id!=0 && $zoho_id!="" ? '/'.$zoho_id : '';  
         }  
   
         // add access token to header  
         $header_data = array("Authorization: Zoho-oauthtoken ".$access_token);  
   
         // send to Zoho API  
         $response_json = abZohoApi($url_data, $fields_data, $header_data, GET);  
   
         // convert response to PHP array (for sorting)  
         $response_arr = json_decode($response_json, true);  
   
         // output  
         return $response_arr;  
     }  
   
     // get data: returns PHP Array (for functional sorting: PHP & JS)  
     // usage: Leads: search_records("Leads", array('Last_Name:starts_with:G', 'Email:equals:someone@company.com'))  
     function search_records($zoho_category, $criteria=array()){  
   
         global $access_token_path, $zoho_apis_com;  
   
         // get access token  
         $access_token = read_token($access_token_path);  
   
         // endpoint  
         $url_data=$zoho_apis_com."/crm/v2/".$zoho_category."/search?criteria=";  
   
         // join the criteria  
         if(count($criteria)==1){  
             $url_data.= '('.$criteria[0].')';  
         }elseif(count($criteria)>1){  
             $url_data.= '(('.implode($criteria, ') and (').'))';  
         }  
   
         // add access token to header  
         $header_data=array("Authorization: Zoho-oauthtoken ".$access_token);  
   
         // send to Zoho API  
         $response_json = abZohoApi($url_data, false, $header_data);  
   
         // convert response to PHP array (for sorting)  
         $response_arr = json_decode($response_json, true);  
   
         // output  
         return $response_arr;  
     }  
   
     // function to retrieve current user record  
     // accepts User ID as parameter  
     // returns array( authorized{ok,fail}, name, email, profile, role )  
     function authenticate_user($user_id){  
   
         global $access_token_path;  
   
         // get access token  
         $token = read_token($access_token_path);  
   
         // pass parameter requesting only active users who are also confirmed  
         $user_fields = array("type"=>"ActiveConfirmedUsers");  
   
         // authenticate user (id was stored in cookie from GET var when this app was initially loaded)  
         $zoho_user_record = get_records("users", $user_id, $user_fields);  
   
         // failed by default  
         $user_authorized = 'fail';  
         $zoho_user_name=$zoho_user_email=$zoho_user_profile=$zoho_user_role="";  
         if(isset($zoho_user_record['users'])){  
   
             // record is readable  
             $zoho_user_isactive = $zoho_user_record['users'][0]['status'];  
   
             // if status is active  
             if($zoho_user_isactive=='active'){  
                 $user_authorized = 'ok';  
                 $zoho_user_name = $zoho_user_record['users'][0]['full_name'];  
   
                 // user email  
                 $zoho_user_email = $zoho_user_record['users'][0]['email'];  
   
                 // user profile  
                 $zoho_user_profile = $zoho_user_record['users'][0]['profile']['name'];  
   
                 // user role  
                 $zoho_user_role = $zoho_user_record['users'][0]['role']['name'];  
             }  
         }  
   
         // return vars  
         return array("authorized"=>$user_authorized, "name"=>$zoho_user_name, "email"=>$zoho_user_email, "profile"=>$zoho_user_profile, "role"=>$zoho_user_role);  
     }  
   
   
     // function to ensure data was transferred  
     // accepts array (JSON Response)  
     // returns boolean  
     function check_data_is_valid($data){  
         $is_valid = false;  
         if(isset($data['data'])){  
             $is_valid = true;  
         }  
         return $is_valid;  
     } 