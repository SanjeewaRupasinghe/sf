<?php

namespace App\Http\Controllers;

use App\Models\ApCourse;
use App\Models\ApBlogPost;
use App\Models\ApCategory;
use Illuminate\Http\Request;
use App\Models\ApBlogCategory;
use App\Mail\ContactMail;
use App\Mail\RegisterMail2;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppraisalController extends Controller
{
    public function index()
    {
        $blogs=ApBlogPost::where('status',1)->orderby('id','DESC')->limit(2)->get();        
        return view('appraisal.index',compact('blogs'));
    } 
    
    public function faq()
    {
        return view('appraisal.faq');
    } 

    public function terms()
    {
        return view('appraisal.terms');
    } 

    public function paynow()
    {
        return view('appraisal.paynow');
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

    public function contact()
    {
        return view('appraisal.contact');
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
            'g-recaptcha-response' => 'required',
		])->validate();

        $secretKey     = '6Lf79yoqAAAAABvAN17RWg_QXXhH8UK6lthR3I-o'; 
        if($request->get('g-recaptcha-response'))
        { 
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$request->get('g-recaptcha-response');

            $c = curl_init();
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_URL, $url);
            $verifyResponse = curl_exec($c);
            curl_close($c);

            $responseData = json_decode($verifyResponse); 
            if($responseData->success)
            {
                $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'designation' => $request->designation,
                'message' => $request->message,
                ];
                Mail::to('appraisals@safetyfirstmed.ae')->cc('adil@safetyfirstmed.ae')->send(new ContactMail($data));
                return redirect()->back()->with('mailmsg', 'Mail sent successfully');  
            }   
            else
            {
                return redirect()->back()->with('mailmsg', 'Invalid Captcha'); 
            }      
	    } 
    }
	
	public function registerMail(Request $request)
	{    
		$data2=""; 
		Validator::make($request->all(),[
			'name' => 'required',
			'email' => 'required',
			'mobile' => 'required',
			'gmc' => 'required',
			'profession' => 'required',
		]);
		$data = [
			'corsName' => $request->corsName,
			'name' => $request->name,
			'email' => $request->email,
			'mobile' => $request->mobile,
			'gmc' => $request->gmc,
			'profession' => $request->profession,
		];
		         
		Mail::to('appraisals@safetyfirstmed.ae')->cc('adil@safetyfirstmed.ae')->send(new RegisterMail2($data));
		return redirect()->back()->with('mailmsg', 'Mail sent successfully');    
    }   
	

    public function blogs()
    {
		$tags[]="";
        $blogs=ApBlogPost::where('status',1)->get();      
        $cats=ApBlogCategory::where('status',1)->get();        
        foreach($blogs as $blog)
        {
            if(app()->getLocale()=='en'){
				$tags = explode(",", $blog->tags);
			}
			else{
				$tags = explode(",", $blog->ar_tags);
			}
        }
		if(count($tags)>0)
		{
        $tags = array_unique($tags);
		}
        return view('appraisal.blogs',compact('blogs','cats','tags'));
    }

    public function blog($slug)
    {
        $blog=ApBlogPost::where('slug',$slug)->first();  
        $blogs=ApBlogPost::where('status',1)->get();      
        $cats=ApBlogCategory::where('status',1)->get(); 
        
        foreach($blogs as $blog2)
        {
            if(app()->getLocale()=='en'){
				$tags = explode(",", $blog2->tags);
			}
			else{
				$tags = explode(",", $blog2->ar_tags);
			}
        }
        $tags = array_unique($tags);
        return view('appraisal.blog-single',compact('blog','blogs','cats','tags'));
    }

    public function courses($slug)
    {
        $result=ApCategory::where('slug',$slug)->first();
        if(count($result->children)>0)
        {
            return view('appraisal.course-categories',compact('result'));
        }
        else
        {
            if(app()->getLocale()=='en'){	
				$category=$result->name;
			} else {
				$category=$result->ar_name;
			}
            $courses=ApCourse::where('status',1)
                            ->where('ap_category_id',$result->id)
                            ->get(); 
            return view('appraisal.courses',compact('courses','category'));
        }
    }

    public function findRootCat($id)
    {
        $rootId="";
        $res=ApCategory::where('id',$id)->first();
        if($res->parent_id=="")
        {
            return $res->id;
        }
        else
        {
            return $this->findRootCat($res->parent_id);
        }
    }


    public function course($slug)
    {
        $result=ApCourse::where('slug',$slug)->first();   
        $root=$this->findRootCat($result->ap_category_id); 
        $rootCat=ApCategory::where('id',$root)->first();
        return view('appraisal.course-single',compact('result','root','rootCat'));
    }
}
