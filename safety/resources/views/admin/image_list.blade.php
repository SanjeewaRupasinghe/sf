@extends('admin.layout')

@section('content')
@if(session()->has('msg'))<div class="alert alert-success"> {{session('msg')}}</div>@endif
    <h1 class="h3 mb-4 text-gray-800">Gallery Images 
        <a href="{{route('image.create')}}" class="btn btn-info float-right">New Image</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <div class="table-responsive1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Image</th>
                        <th></th>                        
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($results as $result)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('storage/gallery/thumb_'.$result->image)}}" style="height: 50px"></td>
                       ndif
                        </td>
                        <td>
                            <form method="post" action="{{route('image.destroy',$result->id)}}" class="form-inline d-inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" name="delete" class=""><i class="fa fa-trash"></i></button>
                            </form>
                        </td>                 
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>

@endsection
