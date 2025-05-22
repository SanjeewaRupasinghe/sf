<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Category;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Category::orderby('id','asc')
                         ->get();    
        return view('admin.category_list', compact('results'));
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
        return view('admin.category_add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category=new Category();        
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
            return redirect()->route('category.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('category.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories=Category::where('parent_id',null)
                             ->where('status',1)
                            ->orderby('id','asc')
                            ->get();      
       
        return view('admin.category_edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->parent_id = $request->parent;
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->ar_name = $request->ar_name;
        $category->meta_title = $request->meta_title;
        $category->meta_key = $request->meta_key;
        $category->meta_des = $request->meta_des;
        $category->status = $request->status;    
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
            return redirect()->route('category.index');
        }
        else
        {
            $request->session()->flash('msg','Not saved successfully');
            return redirect()->route('category.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/category/'.$category->image);
        Storage::delete('public/category/thumb_'.$category->image);
        $category->delete();
        session()->flash('msg','Deleted successfully');
        return redirect()->route('category.index');
    }

    public function checkSlug3(Request $request)
    {
        $slug=Str::slug($request->name);
        $i=2;
        if(!Category::all()->where('slug',$slug)->isEmpty())
        {
            $newslug  = $slug.'-'.$i;
            while(!Category::all()->where('slug',$newslug)->isEmpty())
            {
                $i++;
                $newslug  = $slug.'-'.$i;
            }
            $slug =  $newslug;
        }
        return response()->json(['slug' => $slug]);
    }
}
