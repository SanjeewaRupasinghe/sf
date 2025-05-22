<?php  
   
     // set header  
     header('Content-Type: text/html; charset=utf-8');  
   
     // include global functions  
     include('./selffunction.php');  
 ?>  
 <!doctype html>  
 <html>  
     <head>  
         <title>Zoho OAuth Script</title>  
     </head>  
     <body>  
 <?php  
     // check access token, regenerate if expired (1 hour)  
     check_access_token();  
   
     // determine minutes left  
     $access_token_time_remaining = get_time_remaining($access_token_path);  
   
     // generate another token if about to expire  
     if($access_token_time_remaining<5){  
         echo '<h1>Oops! Something went wrong.</h1>';  
         generate_access_token();  
         echo '<p><b><u>Access</u></b> Token has been regenerated.  Please reload this page.</p><pre>';  
   
         // get access token from file  
         $access_token = base64_decode( file_get_contents( $access_token_path ) );  
   
         // display access token  
         echo "\t".$access_token;  
         echo '</pre>';  
     }else{  
         echo '<h1>Yay! All went well.</h1>';  
         echo '<p>Stored <b><u>Access</u></b> Token is valid for another '.$access_token_time_remaining.' minute'.($access_token_time_remaining==1?'':'s').'.</p><pre>';  
   
         // get access token from file  
         $access_token = base64_decode( file_get_contents( $access_token_path ) );  
   
         // display access token  
         echo "\t".$access_token;  
         echo '</pre>';  
     }  
   
     // if refresh token is being generated  
     if(isset($_GET['code'])){  
   
         // read get vars (code) generate refresh and access token.  Store refresh token in file.  
         $this_response_arr = generate_refresh_token();  
   
         // get refresh token from file  
         $refresh_token = base64_decode( file_get_contents( $refresh_token_path ) );  
   
         // check refresh token exists and is of expected length  
         if(strlen($refresh_token)==70){  
             echo '<h1>Yay! All went well.</h1>';  
             echo '<p><b>Refresh</b> Token successfully generated and stored.</p><pre>';  
             print_r($this_response_arr);  
             echo '</pre>';  
         }else{  
             echo '<h1>Oops! Something went wrong.</h1>';  
             echo '<p><b>Refresh</b> token was not regenerated.</p><pre>';  
             print_r($this_response_arr);  
             echo '</pre>';  
         }  
   
     }  
   
 ?>  
         <br />  
         PHP Code to get all <b><u>Leads</u></b>:<br />  
         <pre>  
         $all_lead_records = get_records("Leads");  
         print_r( $all_lead_records );  
 <?php  
 //        $all_lead_records = get_records("Leads");  
 //        print_r( $all_lead_records['data'][0] );  
 ?>  
         </pre>  
         <br />  
         PHP Code to get a specific <b><u>Lead</u></b>:<br />  
         <pre>  
         $this_lead_record = get_records("Leads", "78290000004647043");  
         print_r( $this_lead_record );  
 <?php  
         // if no lead exists with this ID then this will return blank  
 //        $this_lead_record = get_records("Leads", "78290000004647043");  
 //        print_r($this_lead_record);  
 ?>  
         </pre>  
         <br />  
         PHP Code to update or insert a <b><u>Lead</u></b> record in ZohoCRM:<br />  
         <pre>  
         // set lead name  
         $data_array['data'][0]['First_Name']                = json_encode("John");  
         $data_array['data'][0]['Last_Name']                 = json_encode("Smith");  
   
         // build JSON post request  
         $data_array['data'][0]['Email']                     = json_encode("me@company.com");  
         $data_array['data'][0]['Mobile']                    = json_encode("+44 1234 567 890");  
   
         // merge to a JSON array to post  
         $data_json          = json_encode($data_array);  
   
         // prepare cURL variables  
         $access_token       = base64_decode( file_get_contents( $access_token_path ) );  
         $zoho_target_url    = $zoho_apis_eu . '/crm/v2/Leads/upsert';  
         $zoho_header        = array('Authorization: Zoho-oauthtoken '.$access_token, 'Content-Type: application/json');  
   
         // just do it  
         $response_json      = abZohoApi($zoho_target_url, $data_json, $zoho_header, 'POST');  
   
         // output response (optional)  
         echo $response_json;  
         </pre>  
     </body>  
 </html> 