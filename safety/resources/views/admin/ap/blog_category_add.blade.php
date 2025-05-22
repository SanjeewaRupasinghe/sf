@extends('admin.layout')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">New Blog Category 
        <a href="{{route('apBlogCategory.index')}}" class="btn btn-info float-right">Back</a>
    </h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="{{route('apBlogCategory.store')}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="form-phone">Category Name</label>
                             <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control  @error('name'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="form-phone">Category Arabic Name</label>
                             <input type="text" id="ar_name" name="ar_name" value="{{old('ar_name')}}" class="form-control  @error('ar_name'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('ar_name'){{$message}}@enderror</span>
                        </div>

                         <div class="form-group col-sm-12">
                            <label for="form-phone">Slug</label>
                            <input type="text" id="slug" name="slug" value="{{old('slug')}}" class="form-control  @error('slug'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('slug'){{$message}}@enderror</span>
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


