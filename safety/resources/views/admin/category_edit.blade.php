@extends('admin.layout')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Category <a href="{{route('category.index')}}" class="btn btn-info float-right">Back</a></h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <form action="{{route('category.update',$category->id)}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">                        
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="form-phone">Category Name</label>
                                <input type="text" id="name" name="name" value="{{$category->name}}" class="form-control  @error('name'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('name'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="form-phone">Category Arabic Name</label>
                                <input type="text" id="ar_name" name="ar_name" value="{{$category->ar_name}}" class="form-control  @error('ar_name'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('ar_name'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="form-phone">Slug</label>
                                <input type="text" id="slug" name="slug" value="{{$category->slug}}" class="form-control  @error('slug'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('slug'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="form-phone">Parent Category </label>
                                <div class="tree-container">                                     
                                    @foreach($categories as $cat)                             
                                    <div class="tree-item active  {{ ($cat->children)?'has-children':''   }}">
                                        <i class="expand-icon"></i><i class="icon folder-icon"></i>
                                        <span class="checkbox2">
                                            <input type="radio" id="{{$cat->id}}" name="parent" value="{{$cat->id}}" {{($cat->id==$category->parent_id)?'checked':''}}> 
                                            <label for="1" class="checkbox-view"></label> 
                                            <span for="1">{{$cat->name}}</span>
                                        </span>    
                                        @if(count($cat->children))
                                            @include('admin.categoryChild_edit',['children' => $cat->children])
                                        @endif                                
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">                                
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <img src="{{asset('storage/category/thumb_'.$category->image)}}" style="height: 70px"><br>

                                <label for="form-phone"> Image (Better size is 550px X 350px)</label>
                                <input type="file" name="image" id="image" class="form-control @error('image'){{'is-invalid'}}@enderror">
                                <span class="text-danger">@error('image'){{$message}}@enderror</span>
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="form-phone">Status</label><br>
                                <input type="radio" name="status" value="1" @if($category->status==1) checked="checked" @endif > Active  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="0" @if($category->status==0) checked="checked" @endif > In Active  
                            </div>

                           
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" value="{{$category->meta_title}}" class="form-control" >
                                </div>

                            <div class="form-group col-sm-12">
                                <label for="form-phone">Meta Keywords</label>
                                <input type="text" id="meta_key" name="meta_key" value="{{$category->meta_key}}" class="form-control" >
                            </div>
    
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Meta Description</label>
                                <textarea id="meta_des" name="meta_des" class="form-control" >{{$category->meta_des}}</textarea>
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
                url: "{{route('category.checkSlug3')}}",
                data: {"name": $(this).val()}
            }).done(function (data) {
                $('#slug').val(data.slug);
            });
        });
        $(".expand-icon").click( function (){
            $(this).parent().toggleClass("active");
        });
    });
</script>
@endsection

