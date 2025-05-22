@extends('admin.layout')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Calendar Date 
        <a href="{{route('courseCalendar.index')}}" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="{{route('courseCalendar.update',$courseCalendar->id)}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">                        
                    <input type="hidden" name="id" value="{{$courseCalendar->id}}">                        

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Select Course </label>
                             <select id="course" name="course" class="form-control @error('course'){{'is-invalid'}}@enderror" >
                                @foreach ($courses as $cors)
                                <option value="{{$cors->id}}">{{$cors->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('course'){{$message}}@enderror</span>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="form-phone">Select Date (yyyy-mm-dd)</label>
                            <input type="text" id="date" name="date" value="{{$courseCalendar->date}}" class="form-control @error('date'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('date'){{$message}}@enderror</span>
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

@section('script')
<script>   
    $(function() {
         $('#date').datepicker({
            format:'yyyy-mm-dd', 
            autoclose:true,
            startDate: new Date(),
            todayHighlight:true
           });      
    });
</script>
@endsection

