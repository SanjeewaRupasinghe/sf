@extends('admin.layout')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">New Image <a href="{{route('image.index')}}" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="{{route('image.store')}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    @csrf
                    <div class="row">                       

                        <div class="col-sm-6 form-group">                            
                            <label for="form-phone"> Image <span style="font-size: 12px">(Better size is 600px X 400px)</span></label>
                            <input type="file" name="image" id="image" class="form-control @error('image'){{'is-invalid'}}@enderror">
                            <span class="text-danger">@error('image'){{$message}}@enderror</span>
                        </div>                       
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-info" value="SUBMIT" name="add" id="button">
                        </div>
                    </div>
                </form>
                @if(session()->has('msg'))<div class="alert alert-danger"> {{session('msg')}}</div>@endif

            </div>
        </div>
        </div>
    </div>

@endsection


