<?php

namespace App\Http\Controllers;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    } 
    
    public function faq()
    {
        return view('product.faq');
    } 

    public function terms()
    {
        return view('product.terms');
    } 

    public function paynow()
    {
        return view('product.paynow');
    }
	public function about()
	{
		return view('site.about');
	}
	public function privacy()
	{
		return view('site.privacy');
	}
	public function shipping()
	{
		return view('site.shipping');
	}
	public function refund()
	{
		return view('site.refund');
	}
	public function career()
	{
		return view('site.career');
	}

    public function jtip()
    {
        return view('product.j-tip');
    }
    public function victor()
    {
        return view('product.victor');
    }
    

    public function contact()
    {
        return view('product.contact');
    } 
	
	public function contactMail(Request $request)
	{       
		Validator::make($request->all(),[
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'company' => 'required',
			'designation' => 'required',
			'message' => 'required',
		])->validate();
		$data = [
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'company' => $request->company,
			'designation' => $request->designation,
			'message' => $request->message,
		];
		Mail::to('supplies@safetyfirstmed.ae')->cc('adil@safetyfirstmed.ae')->send(new ContactMail($data));
		return redirect()->back()->with('mailmsg', 'Mail sent successfully');       
	}

}
