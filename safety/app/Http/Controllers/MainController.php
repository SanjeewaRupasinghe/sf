<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Mail;


class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    } 

    public function paynowPost(Request $request)
	{
	
		$data = [
			'payfrom' => $request->type,
			'package' => $request->package,
			'amount' => $request->amount,
			'name' => $request->name,
			'email' => $request->email,
			'mobile' => $request->mobile,
			'address' => $request->address,
			'country' => $request->country,
			'city' => $request->city,
			'remarks' => $request->remarks,
		];
		
		//Card pay
		$requestParams = array(
		 	'command' => 'PURCHASE',
		 	'access_code' => 'xbmtPp9Q4KEhfEfJUSUG',
		 	'merchant_identifier' => 'xyKdBdwl',
		 	'merchant_reference' => time(),
		 	'amount' => $request->amount*100,
		 	'currency' => 'AED',
		 	'language' => 'en',
		 	'customer_email' => $request->email,
		 	'order_description' => 'Course',
		 	'return_url' => 'http://safetyfirstmed.ae/response',
		 ); 


		 //Apple pay
		// $requestParams = array(
		// 	'command' => 'PURCHASE',
		// 	'access_code' => '5QPetxvrJ79qoH4F23nL',
		// 	'merchant_identifier' => 'xyKdBdwl',
		// 	'merchant_reference' => time(),
		// 	'amount' => $request->amount*100,
		// 	'currency' => 'AED',
		// 	'language' => 'en',
		// 	'customer_email' => $request->email,
		// 	'order_description' => 'Course',
		// 	'return_url' => 'http://safetyfirstmed.ae/response',
		// ); 

		
		$shaString="";

		ksort($requestParams);
		foreach ($requestParams as $key => $value) {
			$shaString .= "$key=$value";
		}

		//Card pay
		$shaString = '$2y$10$A80vhiZm/' . $shaString . '$2y$10$A80vhiZm/'; 

		//Apple pay
		//$shaString = '518CfOMyr26Oc9qILV1Y2R@[' . $shaString . '518CfOMyr26Oc9qILV1Y2R@['; 
		
		$signature = hash("sha256", $shaString);
		$requestParams['signature']=$signature;		


        if($request->type=="Course") {$to='training@safetyfirstmed.ae';}
        if($request->type=="Appraisal") {$to='appraisal@safetyfirstmed.ae';}
        if($request->type=="Product") {$to='info@safetyfirstmed.ae';}
		Mail::to($to)->cc('adil@safetyfirstmed.ae')->send(new PaymentMail($data));

		
		return view('main.paynow', compact('requestParams'));
	} 
	
	public function response()
	{
		return view('main.response');
	}
	
}
