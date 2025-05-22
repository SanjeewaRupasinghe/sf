@extends('admin.layout')

@section('content')
@if(session()->has('msg'))<div class="alert alert-success"> {{session('msg')}}</div>@endif
    <h1 class="h3 mb-4 text-gray-800">Courses Calendar List 
        <a href="{{route('courseCalendar.create')}}" class="btn btn-info float-right">New Date</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <div class="table-responsive1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Course Name</th>
                        <th>Date</th>
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
                        <td>{{$result->course->name}}</td>
                        <td>{{$result->date}}</td>
                        <td>@if($result->status==1) <button class="btn btn-success">Active</button> 
                            @else 
                            <button class="btn btn-danger ">InActive</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('courseCalendar.edit', $result->id )}}" class=""><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{route('courseCalendar.destroy',$result->id)}}" class="form-inline d-inline">
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
