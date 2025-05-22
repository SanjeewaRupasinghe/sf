<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\ApBlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Models\ApBlogPost;
use App\Http\Requests\Admin\StoreApBlogPostRequest;
use App\Http\Requests\Admin\UpdateApBlogPostRequest;

class ApBlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=ApBlogPost::all();
        return view('admin.ap.blog_post_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=ApBlogCategory::where('status',1)->get();
        return view('admin.ap.blog_post_add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApBlogPostRequest $request)
    {
        $post = New ApBlogPost();

        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->ap_blog_category_id = $request->category;
        $post->publish = Carbon::createFromFormat('d-m-Y',$request->publish)->format('Y-m-d');
        $post->tags = $request->tags;
        $post->description = $request->description;
        $post->meta_title = $request->meta_title;
        $post->meta_key = $request->meta_key;
        $post->meta_des = $request->meta_des;
        $post->ar_name = $request->ar_name;
        $post->ar_tags = $request->ar_tags;
        $post->ar_description = $request->ar_description;

        $image = $request->file('image');
        $fileName = time().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(850, 400);
        $image_resize->save(storage_path('app/public/blog/thumb_' .$fileName));
        Storage::putFileAs("public/blog", $image,$fileName);
        $post->image = $fileName;

        $result=$post->save();
        if($result)
        {
            return redirect()->route('apBlogPost.index')->with('msg','Saved successfully');
        }
        else
        {
            return redirect()->route('apBlogPost.create')->with('msg','Not saved successfully'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(ApBlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(ApBlogPost $blogPost)
    {
        $categories=ApBlogCategory::where('status',1)->get();

        return view('admin.ap.blog_post_edit',compact('categories','blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogPostRequest  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApBlogPostRequest $request, ApBlogPost $blogPost)
    {
        $blogPost->name = $request->name;
        $blogPost->slug = $request->slug;
        $blogPost->ap_blog_category_id = $request->category;
        $blogPost->publish = Carbon::createFromFormat('d-m-Y',$request->publish)->format('Y-m-d');
        $blogPost->tags = $request->tags;
        $blogPost->description = $request->description;
        $blogPost->meta_title = $request->meta_title;
        $blogPost->meta_key = $request->meta_key;
        $blogPost->meta_des = $request->meta_des;
        $blogPost->ar_name = $request->ar_name;
        $blogPost->ar_tags = $request->ar_tags;
        $blogPost->ar_description = $request->ar_description;

        if($request->has('image'))
        {
            $image = $request->file('image');
            $fileName = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(850, 400);
            $image_resize->save(storage_path('app/public/blog/thumb_' .$fileName));
            Storage::putFileAs("public/blog", $image,$fileName);
            $blogPost->image = $fileName;
        }

        $result=$blogPost->save();

        if($result)
        {
            return redirect()->route('apBlogPost.index')->with('msg','Saved successfully');
        }
        else
        {
            return redirect()->back()->with('msg','Not saved successfully'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApBlogPost $blogPost)
    {
        $result=$blogPost->delete();
        if($result)
        {
             Storage::delete('public/blog/'.$blogPost->image);
             Storage::delete('public/blog/thumb_'.$blogPost->image);
             return redirect()->back()->with('msg', 'Deleted successfully');
         }
         else
         {
             return redirect()->back()->with('msg', 'Image not deleted');   
         }
    }

    public function checkSlug6(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!ApBlogPost::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!ApBlogPost::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
