<?php
namespace App\Http\Controllers\Site;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\BlogPost;
use App\Models\Category;
use App\Mail\ContactMail;
use App\Mail\RegisterMail;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\CourseCalendar;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
	public function switchlocale(Request $request, $locale)
    {
        session(['APP_LOCALE' => $locale]);		
        return redirect()->back();     
    }

	public function index()
	{
		$blogs=BlogPost::where('status',1)->orderby('id','DESC')->limit(2)->get();        
		return view('site.home',compact('blogs'));
	}	
	
	public function courseCount($date)
	{
		return CourseCalendar::where('date',$date)->where('status',1)->count();
	}
	public function calendar($month="",$year="")
	{
		if($month==""){$month=date('m');}
		if($year==""){$year=date('Y');}
		$date = mktime( 0, 0, 0, $month, 1, $year );
		$ndate=strftime( '%m %Y', strtotime( '+1 month', $date ) ); list($nm,$ny)=explode(" ",$ndate); 
		$pdate=strftime( '%m %Y', strtotime( '-1 month', $date ) ); list($pm,$py)=explode(" ",$pdate);
		$dt=date('d');$dm=date('m');
		$cl="";
		/* draw table */
		$calendar = '<table cellpadding="0" cellspacing="0" class="table mb-0" >';
		$calendar.= '<tr class="calendar-head">
		<td class="col-1">
		<a href="https://safetyfirstmed.ae/course/calendar/'.$pm.'/'.$py.'" class="prvnxt"><i class="fa fa-angle-left"></i></a> 
		</td>
		<td class="col-10" colspan="5">
		<h2 style=" text-align:center">'.strftime('%B',strtotime('0 month',$date)).' '.$year.'</h2>
		</td>
		<td class="col-3">
		<a href="https://safetyfirstmed.ae/course/calendar/'.$nm.'/'.$ny.'" class="prvnxt"><i class="fa fa-angle-right" style="text-align:right"></i></a>
		</td>
		</tr></table>';	
		$calendar.= '<table cellpadding="0" cellspacing="0" class="table calendar-table">';
		/* table headings */
		$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
		$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
		/* days and weeks vars now ... */
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();
		/* row for week one */
		$calendar.= '<tr class="calendar-row">';
		/* print "blank" days until the first of the current week */
		for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
		endfor;
		/* keep going with days.... */
		for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$cdate=$year.'-'.$month.'-'.$list_day;
		$link='';
		$corsCount=$this->courseCount($cdate);
		if($corsCount>0) { $link=$corsCount.' Course'; }
		$calendar.= '<td class="calendar-day">';
		/* add in the day number */
		if($list_day==$dt && $month==$dm) { $cl="act_day";} else { $cl="";} 
		$calendar.= '<div class="day-number '.$cl.'">'.$list_day.'</div>';
		$calendar.= '<a href="javascript:void(0)" class="courseLink" data-date="'.$cdate.'">'.$link.'</a>';			
		$calendar.= '</td>';
		if($running_day == 6):
		$calendar.= '</tr>';
		if(($day_counter+1) != $days_in_month):
		$calendar.= '<tr class="calendar-row">';
		endif;
		$running_day = -1;
		$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
		endfor;
		/* finish the rest of the days in the week */
		if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
		endif;
		/* final row */
		$calendar.= '</tr>';
		/* end the table */
		$calendar.= '</table>';
		return view('site.calendar',compact('calendar'));
	}   
	public function findCourse(Request $request)
	{
		$date=Carbon::createFromFormat('Y-m-d',$request->date)->format('d F Y');
		$html='<h4 class="text-center mb-3">'.$date.'</h4>';
		$results=CourseCalendar::where('status',1)->where('date',$request->date)->get(); 
		if(count($results)>0)
		{
		foreach($results as $res)
		{
		$html.='<div class="cal-cors-sect"><a href="https://safetyfirstmed.ae/course/course/'.$res->course->slug.'"><h5>'.$res->course->name.'</h5></a><p>Duration : '.$res->course->duration.'</p></div>';
		}
		}
		else
		{
		$html.="<p>Sorry!.. No Courses found.</p>";
		}
		return response()->json(['html' => $html]);
	}
	public function courses($slug)
	{
		$result=Category::where('slug',$slug)->first();
		if(count($result->children)>0)
		{
		return view('site.course-categories',compact('result'));
		}
		else
		{
			if(app()->getLocale()=='en'){	
				$category=$result->name;
			} else {
				$category=$result->ar_name;
			}
		$courses=Course::where('status',1)
		->where('category_id',$result->id)
		->get(); 
		return view('site.courses',compact('courses','category'));
		}
	}		
	public function findRootCat($id)
	{
		$rootId="";
		$res=Category::where('id',$id)->first();
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
		$result=Course::where('slug',$slug)->first();   
		$root=$this->findRootCat($result->category_id); 
		$rootCat=Category::where('id',$root)->first();
		return view('site.course-single',compact('result','root','rootCat'));
	}
	public function blogs()
	{
		$blogs=BlogPost::where('status',1)->get();      
		$cats=BlogCategory::where('status',1)->get(); 
		
		foreach($blogs as $blog)
		{
			if(app()->getLocale()=='en'){
				$tags = explode(",", $blog->tags);
			}
			else{
				$tags = explode(",", $blog->ar_tags);
			}
		}
		$tags = array_unique($tags);
		return view('site.blogs',compact('blogs','cats','tags'));
	}
	public function blog($slug)
	{
		$blog=BlogPost::where('slug',$slug)->first();  
		//dd($blog);
		$blogs=BlogPost::where('status',1)->get();      
		$cats=BlogCategory::where('status',1)->get(); 
		
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
		return view('site.blog-single',compact('blog','blogs','cats','tags'));
	}
	public function gallery()
	{
		$results=Image::where('status',1)->get();
		return view('site.gallery',compact('results'));
	}
	 
	public function paynow()
	{
		return view('site.paynow');
	}  
	public function terms()
	{
		return view('site.terms');
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
		return view('site.contact');
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
		Mail::to('training@safetyfirstmed.ae')->cc(['adil@safetyfirstmed.ae','sarith@safetyfirstmed.ae','sinatra@safetyfirstmed.ae'])->send(new ContactMail($data));
		return redirect()->back()->with('mailmsg', 'Mail sent successfully');       
	}
	
	public function registerMail(Request $request)
	{   
		$data2="";  
		Validator::make($request->all(),[
			'name' => 'required',
			'email' => 'required',
			'mobile' => 'required',
			'date' => 'required',
			'address' => 'required',
			'work' => 'required',
			'profession' => 'required',
			'card' => 'mimes:pdf|max:2048',
		]);
		$data = [
			'corsId' => $request->corsId,
			'corsName' => $request->corsName,
			'corsBy' => $request->corsBy,
			'name' => $request->name,
			'email' => $request->email,
			'mobile' => $request->mobile,
			'address' => $request->address,
			'work' => $request->work,
			'profession' => $request->profession,
			'date' => $request->date,
		];
		if($request->corsId==8 || $request->corsId==9)
		{
			$fileName="";
       		if ($request->hasFile('card')) {
        		$fileName = time().'.'.$request->file('card')->extension();  
        		$request->file('card')->move(storage_path('app/public/pdf'), $fileName);
   			}
			$data2 = [
				'blssts' => $request->blssts,
				'doe' => $request->doe,
				'card' => $fileName,
				'comment' => $request->comment,
			];  
		}           
		Mail::to('training@safetyfirstmed.ae')->cc(['adil@safetyfirstmed.ae','sarith@safetyfirstmed.ae','sinatra@safetyfirstmed.ae'])->send(new RegisterMail($data,$data2));
		return redirect()->back()->with('mailmsg', 'Mail sent successfully');        
	}
	
	
	
}

