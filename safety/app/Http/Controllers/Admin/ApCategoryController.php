<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApCategory;
use App\Http\Requests\Admin\StoreApCategoryRequest;
use App\Http\Requests\Admin\UpdateApCategoryRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=ApCategory::orderby('id','asc')
                         ->get();    
        return view('admin.ap.category_list', compact('results'));
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
        return view('admin.ap.category_add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApCategoryRequest $request)
    {
        $category=new ApCategory();        
        $category->parent_id = $request->parent;
        $category->slug = $request->slug;    
        $category->name = $request->name;
        $category->ar_name = $request->ar_name;
        $category->meta_title = $request->meta_title;
        $category->meta_key = $request->meta_key;
        $category->meta_des = $request->meta_des;

        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(550, 350, function ($const) {       });
            $image_resize->save(storage_path('app/public/category/thumb_' .$fileName));
            Storage::putFileAs("public/category", $image,$fileName);
            $category->image = $fileName;
        }
            
        $result=$category->save();

        
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('apCategory.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('apCategory.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(ApCategory $apCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ApCategory $apCategory)
    {
        $categories=ApCategory::where('parent_id',null)
                             ->where('status',1)
                            ->orderby('id','asc')
                            ->get();      
       $category=$apCategory;
        return view('admin.ap.category_edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApCategoryRequest $request, ApCategory $apCategory)
    {
        $apCategory->parent_id = $request->parent;
        $apCategory->slug = $request->slug;
        $apCategory->name = $request->name;
        $apCategory->ar_name = $request->ar_name;
        $apCategory->meta_title = $request->meta_title;
        $apCategory->meta_key = $request->meta_key;
        $apCategory->meta_des = $request->meta_des;
        $apCategory->status = $request->status;    
        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(550, 350, function ($const) {       });
            $image_resize->save(storage_path('app/public/category/thumb_' .$fileName));
            Storage::putFileAs("public/category", $image,$fileName);
            $apCategory->image = $fileName;
        }    
        $result=$apCategory->save();

                
        if($result)
        {
            $request->session()->flash('msg','Saved successfully');
            return redirect()->route('apCategory.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('apCategory.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApCategory $apCategory)
    {
        Storage::delete('public/category/'.$apCategory->image);
        Storage::delete('public/category/thumb_'.$apCategory->image);
        $apCategory->delete();
        session()->flash('msg','Deleted successfully');
        return redirect()->route('category.index');
    }

    public function checkSlug7(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!ApCategory::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!ApCategory::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
