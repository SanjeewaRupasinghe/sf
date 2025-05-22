@extends('admin.layout')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Change Password </h1>    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <form action="{{route('admin.update',$admin->id)}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">                      
                        <div class="row"> 
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Old Password</label>
                                <input type="text" id="old_password" name="old_password" class="form-control" >
                                <span class="text-danger">@error('old_password'){{$message}}@enderror</span>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="form-phone">New Password</label>
                                <input type="text" id="new_password" name="new_password" class="form-control" >
                                <span class="text-danger">@error('new_password'){{$message}}@enderror</span>
                            </div>
    
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Confirm Password</label>
                                <input type="text" id="con_password" name="confirm_password" class="form-control" >
                                <span class="text-danger">@error('confirm_password'){{$message}}@enderror</span>
                            </div>


                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-info" value="UPDATE" name="add" id="button">
                            </div>
                        </div>
                    </form>
                    @if(session()->has('msg'))<div class="alert alert-danger"> {{session('msg')}}</div>@endif

                </div>
            </div>
        </div>
    </div>
   
@endsection