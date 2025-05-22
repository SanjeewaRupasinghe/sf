<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=CourseCalendar::orderby('id','asc')
                                ->get(); 
        return view('admin.calendar_list', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses=Course::where('status',1)->get();
        return view('admin.calendar_add', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'course' => 'required',
            'date' => 'required',
        ])->validate();
        $result=false;
        $dates=explode(',',$request->date);
        foreach($dates as $date)
        {
            $count=CourseCalendar::where('course_id',$request->course)
                                ->where('date',$date)
                                ->count();
            if($count==0)
            {
                $courseCalendar = new CourseCalendar();
                $courseCalendar->course_id = $request->course;
                $courseCalendar->date = $date;
                $result=$courseCalendar->save();  
            }
        }
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('courseCalendar.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully, date may be already exist.');
            return redirect()->route('courseCalendar.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseCalendar  $courseCalendar
     * @return \Illuminate\Http\Response
     */
    public function show(CourseCalendar $courseCalendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseCalendar  $courseCalendar
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseCalendar $courseCalendar)
    {

        $courses=Course::where('status',1)->get();
        return view('admin.calendar_edit', compact('courses','courseCalendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseCalendar  $courseCalendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseCalendar $courseCalendar)
    {
        Validator::make($request->all(),[
            'date' => 'required',
        ])->validate();
        
        $result=false;
        $count=CourseCalendar::where('course_id',$request->course)
                            ->where('date',$request->date)
                            ->count();
        if($count==0)
        {
            $courseCalendar->course_id = $request->course;
            $courseCalendar->date = $request->date;
            $result=$courseCalendar->save();  
        }        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('courseCalendar.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully, date may be already exist.');
            return redirect()->route('courseCalendar.update',$request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCalendar  $courseCalendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseCalendar $courseCalendar)
    {
        $result=$courseCalendar->delete();
        if($result)
        {
            session()->flash('msg','Deleted successfully');
            return redirect()->route('courseCalendar.index');
        }
        else
        {
            session()->flash('msg','Not deleted ');
            return redirect()->route('courseCalendar.index');
        }

    }
}
