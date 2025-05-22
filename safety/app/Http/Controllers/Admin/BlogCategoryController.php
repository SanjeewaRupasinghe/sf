<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateBlogCategoryRequest;

Use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=BlogCategory::all(); 
       // dd($results);
        return view('admin.blog_category_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog_category_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $blogCategory = new BlogCategory();
        $blogCategory->name = $request->name;
        $blogCategory->ar_name = $request->ar_name;
        $blogCategory->slug = $request->slug;
        $res=$blogCategory->save();
        if($res)
        {
            return redirect()->route('blogCategory.index')->with('msg','Saved successfully');
        }
        else
        {
            return back()->with('msg','Not saved successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog_category_edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogCategoryRequest  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->name = $request->name;
        $blogCategory->ar_name = $request->ar_name;
        $blogCategory->slug = $request->slug;
        $res=$blogCategory->save();
        if($res)
        {
            return redirect()->route('blogCategory.index')->with('msg','Saved successfully');
        }
        else
        {
            return back()->with('msg','Not saved successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $result=$blogCategory->delete();
        if($result)
        {
             return redirect()->back()->with('msg', 'Deleted successfully');
         }
         else
         {
             return redirect()->back()->with('msg', 'Image not deleted');   
         }
    }


    public function checkSlug(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!BlogCategory::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!BlogCategory::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
