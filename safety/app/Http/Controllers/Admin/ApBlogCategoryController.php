<?php

namespace App\Http\Controllers\Admin;
Use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\ApBlogCategory;
use App\Http\Requests\Admin\StoreApBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateApBlogCategoryRequest;

class ApBlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=ApBlogCategory::all(); 
       // dd($results);
        return view('admin.ap.blog_category_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ap.blog_category_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApBlogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApBlogCategoryRequest $request)
    {
        $apBlogCategory = new ApBlogCategory();
        $apBlogCategory->name = $request->name;
        $apBlogCategory->ar_name = $request->ar_name;
        $apBlogCategory->slug = $request->slug;
        $res=$apBlogCategory->save();
        if($res)
        {
            return redirect()->route('apBlogCategory.index')->with('msg','Saved successfully');
        }
        else
        {
            return back()->with('msg','Not saved successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApBlogCategory  $ApBlogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ApBlogCategory $apBlogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApBlogCategory  $ApBlogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ApBlogCategory $apBlogCategory)
    {
        return view('admin.ap.blog_category_edit', compact('apBlogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApBlogCategoryRequest  $request
     * @param  \App\Models\ApBlogCategory  $ApBlogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApBlogCategoryRequest $request, ApBlogCategory $apBlogCategory)
    {
        $apBlogCategory->name = $request->name;
        $apBlogCategory->ar_name = $request->ar_name;
        $apBlogCategory->slug = $request->slug;
        $res=$apBlogCategory->save();
        if($res)
        {
            return redirect()->route('apBlogCategory.index')->with('msg','Saved successfully');
        }
        else
        {
            return back()->with('msg','Not saved successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApBlogCategory  $ApBlogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApBlogCategory $apBlogCategory)
    {
        $result=$apBlogCategory->delete();
        if($result)
        {
             return redirect()->back()->with('msg', 'Deleted successfully');
         }
         else
         {
             return redirect()->back()->with('msg', 'Image not deleted');   
         }
    }


    public function checkSlug5(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!apBlogCategory::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!apBlogCategory::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
