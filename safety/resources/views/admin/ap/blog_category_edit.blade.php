@extends('admin.layout')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Blog Category 
    <a href="{{route('apBlogCategory.index')}}" class="btn btn-info float-right">Back</a>
</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <form action="{{route('apBlogCategory.update',$apBlogCategory->id)}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Blog Name</label>
                                <input type="text" id="name" name="name" value="{{$apBlogCategory->name}}" class="form-control  @error('name'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('name'){{$message}}@enderror</span>
                            </div>  
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Category Arabic Name</label>
                                <input type="text" id="ar_name" name="ar_name" value="{{$apBlogCategory->ar_name}}" class="form-control  @error('ar_name'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('ar_name'){{$message}}@enderror</span>
                            </div> 
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Slug</label>
                                <input type="text" id="slug" name="slug" value="{{$apBlogCategory->slug}}" class="form-control  @error('slug'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('slug'){{$message}}@enderror</span>
                            </div> 

                            <div class="form-group col-sm-6">
                                <label for="form-phone">Status</label><br>
                                <input type="radio" name="status" value="1" @if($apBlogCategory->status==1) checked="checked" @endif > Active  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="0" @if($apBlogCategory->status==0) checked="checked" @endif > In Active  
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

@section('script')
   <script>
        $(function() {
            $('#name,#slug').blur(function () {            
                $.ajax({
                    method: "GET",
                    url: "{{route('apBlogCategory.checkSlug5')}}",
                    data: {"name": $(this).val()}
                }).done(function (data) {                    
                    $('#slug').val(data.slug);
                });
            });
        });
    </script>
@endsection

