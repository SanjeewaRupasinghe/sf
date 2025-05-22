<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Course;
use App\Models\BlogPost;

use App\Models\Category;
use App\Models\WorkProject;
use App\Models\BlogCategory;
use App\Models\WorkCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corcats=Category::where('status',1)->count();  
        $cors=Course::where('status',1)->count();  
        $cats=BlogCategory::where('status',1)->count();  
        $blogs=BlogPost::where('status',1)->count();  

        return view('admin.dashboard',compact('cats','blogs','corcats','cors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        $admin = Admin::where('username',$username)->where('status',1)->first();

        if($admin)
        {
            if(Hash::check($password,$admin->password))
            {
                $request->session()->put('LOGID',$admin->id);
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return back()->with('msg','Wrong Password');
            }
        }
        else
        {
            return back()->with('msg','Wrong Username');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $admin=Admin::where('id',session()->get('LOGID'))->first();
        return view('admin.change_password',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin=Admin::where('id',session()->get('LOGID'))->first();
        if(Hash::check($request->old_password,$admin->password))
        {
            $admin->password=Hash::make($request->new_paasword);
            $admin->save();
            return back()->with('msg','Password changed successfully');
        }
        else{
            return back()->with('msg','Old password is incorrect');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if(session()->has('LOGID'))
       {
           session()->flush();
           return redirect()->route('admin.index');
       }
    }
}
