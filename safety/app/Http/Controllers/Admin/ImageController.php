<?php

namespace App\Http\Controllers\Admin;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreImageRequest;
use App\Http\Requests\Admin\UpdateImageRequest;
use Intervention\Image\Facades\Image as Image2;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Image::all();
        return view('admin.image_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        $image = New Image();
        $photo = $request->file('image');
        $fileName = time().'.'.$photo->getClientOriginalExtension();
        $image_resize = Image2::make($photo->getRealPath());
        $image_resize->resize(600, 400);
        $image_resize->save(storage_path('app/public/gallery/thumb_' .$fileName));
        Storage::putFileAs("public/gallery", $photo,$fileName);
        $image->image = $fileName;

        $result=$image->save();
        if($result)
        {
            return redirect()->route('image.index')->with('msg','Saved successfully');
        }
        else
        {
            return redirect()->route('image.create')->with('msg','Not saved successfully'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $result=$image->delete();
        if($result)
        {
             Storage::delete('public/gallery/'.$image->image);
             Storage::delete('public/gallery/thumb_'.$image->image);
             return redirect()->back()->with('msg', 'Deleted successfully');
         }
         else
         {
             return redirect()->back()->with('msg', 'Image not deleted');   
         }
    }
}
