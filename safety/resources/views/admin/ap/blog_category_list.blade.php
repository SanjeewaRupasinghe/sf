@extends('admin.layout')

@section('content')
@if(session()->has('msg'))<div class="alert alert-success"> {{session('msg')}}</div>@endif
    <h1 class="h3 mb-4 text-gray-800">Manage Blog Categories 
        <a href="{{route('apBlogCategory.create')}}" class="btn btn-info float-right">New Category</a>
    </h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <div class="table-responsive1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Arabic Name</th>
                        <th>Status</th>
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
                        <td>{{$result->name}}</td>
                        <td>{{$result->ar_name}}</td>
                        <td>@if($result->status==1) <button class="btn btn-success">Active</button> 
                            @else 
                            <button class="btn btn-danger ">InActive</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('apBlogCategory.edit', $result->id )}}" class=""><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{route('apBlogCategory.destroy',$result->id)}}" class="form-inline d-inline">
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
