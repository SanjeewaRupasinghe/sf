<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Course::orderby('id','asc')
                         ->get();    
        return view('admin.course_list', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('parent_id',null)
                         ->where('status',1)
                         ->orderby('id','asc')
                         ->get();
        return view('admin.course_add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $course=new Course();        
        $course->category_id = $request->parent;
        $course->slug = $request->slug;    
        $course->name = $request->name;
        $course->duration = $request->duration;
        $course->lastupdate = $request->lastupdate;
        $course->requirements = $request->requirements;
        $course->description = $request->description;
        $course->meta_title = $request->meta_title;
        $course->meta_key = $request->meta_key;
        $course->meta_des = $request->meta_des;
        $course->ar_name = $request->ar_name;
        $course->ar_duration = $request->ar_duration;
        $course->ar_requirements = $request->ar_requirements;
        $course->ar_description = $request->ar_description;

        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(850, 400, function ($const) {       });
            $image_resize->save(storage_path('app/public/course/thumb_' .$fileName));
            Storage::putFileAs("public/course", $image,$fileName);
            $course->image = $fileName;
        }
            
        $result=$course->save();

        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('course.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('course.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories=Category::where('parent_id',null)
                         ->where('status',1)
                         ->orderby('id','asc')
                         ->get();
        return view('admin.course_edit', compact('categories','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->category_id = $request->parent;
        $course->slug = $request->slug;    
        $course->name = $request->name;
        $course->duration = $request->duration;
        $course->lastupdate = $request->lastupdate;
        $course->requirements = $request->requirements;
        $course->description = $request->description;
        $course->status = $request->status;
        $course->meta_title = $request->meta_title;
        $course->meta_key = $request->meta_key;
        $course->meta_des = $request->meta_des;
        $course->ar_name = $request->ar_name;
        $course->ar_duration = $request->ar_duration;
        $course->ar_requirements = $request->ar_requirements;
        $course->ar_description = $request->ar_description;

        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(850, 400, function ($const) {       });
            $image_resize->save(storage_path('app/public/course/thumb_' .$fileName));
            Storage::putFileAs("public/course", $image,$fileName);
            $course->image = $fileName;
        }            
        $result=$course->save();        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('course.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('course.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Storage::delete('public/course/'.$course->image);
        Storage::delete('public/course/thumb_'.$course->image);
        $course->delete();
        session()->flash('msg','Deleted successfully');
        return redirect()->route('course.index');
    }

    public function checkSlug4(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!Course::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!Course::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
