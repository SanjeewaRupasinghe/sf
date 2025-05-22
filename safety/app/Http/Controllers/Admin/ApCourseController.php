<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ApCourse;
use App\Http\Requests\Admin\StoreApCourseRequest;
use App\Http\Requests\Admin\UpdateApCourseRequest;
use App\Models\ApCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ApCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=ApCourse::orderby('id','asc')
                         ->get();    
        return view('admin.ap.course_list', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=ApCategory::where('parent_id',null)
                         ->where('status',1)
                         ->orderby('id','asc')
                         ->get();
        return view('admin.ap.course_add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApCourseRequest $request)
    {
        $course=new ApCourse();        
        $course->ap_category_id = $request->parent;
        $course->slug = $request->slug;    
        $course->name = $request->name;
        $course->extras = $request->extras;
        $course->price = $request->price;
        $course->requirements = $request->requirements;
        $course->description = $request->description;
        $course->meta_title = $request->meta_title;
        $course->meta_key = $request->meta_key;
        $course->meta_des = $request->meta_des;
        $course->ar_name = $request->ar_name;
        $course->ar_extras = $request->ar_extras;
        $course->ar_requirements = $request->ar_requirements;
        $course->ar_description = $request->ar_description;

        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(850, 400, function ($const) {       });
            $image_resize->save(storage_path('app/public/service/thumb_' .$fileName));
            Storage::putFileAs("public/service", $image,$fileName);
            $course->image = $fileName;
        }
            
        $result=$course->save();

        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('apCourse.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('apCourse.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(ApCourse $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(ApCourse $apCourse)
    {
        $categories=ApCategory::where('parent_id',null)
                         ->where('status',1)
                         ->orderby('id','asc')
                         ->get();
        $course=$apCourse;
        return view('admin.ap.course_edit', compact('categories','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApCourseRequest $request, ApCourse $apCourse)
    {
        $apCourse->ap_category_id = $request->parent;
        $apCourse->slug = $request->slug;    
        $apCourse->name = $request->name;
        $apCourse->extras = $request->extras;
        $apCourse->price = $request->price;
        $apCourse->requirements = $request->requirements;
        $apCourse->description = $request->description;
        $apCourse->status = $request->status;
        $apCourse->meta_title = $request->meta_title;
        $apCourse->meta_key = $request->meta_key;
        $apCourse->meta_des = $request->meta_des;
        $apCourse->ar_name = $request->ar_name;
        $apCourse->ar_extras = $request->ar_extras;
        $apCourse->ar_requirements = $request->ar_requirements;
        $apCourse->ar_description = $request->ar_description;

        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(850, 400, function ($const) {       });
            $image_resize->save(storage_path('app/public/service/thumb_' .$fileName));
            Storage::putFileAs("public/service", $image,$fileName);
            $apCourse->image = $fileName;
        }            
        $result=$apCourse->save();        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('apCourse.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('apCourse.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApCourse $apCourse)
    {
        Storage::delete('public/service/'.$apCourse->image);
        Storage::delete('public/service/thumb_'.$apCourse->image);
        $apCourse->delete();
        session()->flash('msg','Deleted successfully');
        return redirect()->route('apCourse.index');
    }

    public function checkSlug8(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!ApCourse::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!ApCourse::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
