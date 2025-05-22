@extends('admin.layout')



@section('content')

<h1 class="h3 mb-4 text-gray-800">Edit Appraisal Blog Post <a href="{{route('apBlogPost.index')}}" class="btn btn-info float-right">Back</a></h1>

   <div class="card shadow mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-sm-12" >

                    <form action="{{route('apBlogPost.update',$blogPost->id)}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">

                        @csrf

                        <input type="hidden" name="_method" value="PATCH">

                        

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label for="form-phone">Blog Head</label>

                                <input type="text" id="name" name="name" value="{{$blogPost->name}}" class="form-control  @error('name'){{'is-invalid'}}@enderror" >

                                <span class="text-danger">@error('name'){{$message}}@enderror</span>

                            </div>

                            <div class="form-group col-sm-6">
                                <label for="form-phone">Blog Arabic Head</label>
                                <input type="text" id="ar_name" name="ar_name" value="{{$blogPost->ar_name}}" class="form-control  @error('ar_name'){{'is-invalid'}}@enderror" >
                                <span class="text-danger">@error('ar_name'){{$message}}@enderror</span>
                            </div>

                            <div class="form-group col-sm-6">

                                <label for="form-phone">Slug</label>

                                <input type="text" id="slug" name="slug" value="{{$blogPost->slug}}" class="form-control  @error('slug'){{'is-invalid'}}@enderror" >

                                <span class="text-danger">@error('slug'){{$message}}@enderror</span>

                            </div>

                            <div class="col-sm-6 form-group">                           

                                <label for="form-phone"> Blog Category</label>

                                <select name="category" id="category" class="form-control @error('category'){{'is-invalid'}}@enderror">

                                    @foreach($categories as $category)  

                                    <option value="{{$category->id}}" {{($category->id==$blogPost->blog_category_id)?'selected':''}}>{{$category->name}}</option>

                                    @endforeach

                                </select>

                                <span class="text-danger">@error('category'){{$message}}@enderror</span>

    

                            </div>



                           <div class="col-sm-2 form-group"> 

                             <img src="{{asset('storage/blog/thumb_'.$blogPost->image)}}" style="height: 70px"><br>

                            </div>

                            <div class="col-sm-4 form-group">               

                                <label for="form-phone"> Image (Better size is 600px X 400px)</label>

                                <input type="file" name="image" id="image" class="form-control @error('image'){{'is-invalid'}}@enderror">

                                <span class="text-danger">@error('image'){{$message}}@enderror</span>

                                   

                            </div>



                            <div class="form-group col-sm-3">

                                <label for="form-phone">Publish Date</label>

                                <input type="text" id="publish" name="publish" value="{{Carbon\Carbon::parse($blogPost->publish)->format('d-m-Y')}}" class="form-control" >

                                <span class="text-danger">@error('publish'){{$message}}@enderror</span>

                            </div>

                            <div class="form-group col-sm-9">

                                <label for="form-phone">Tags <span style="font-size: 12px">(Separated by comma)</span></label>

                                <input type="text" id="tags" name="tags" value="{{$blogPost->tags}}" class="form-control" >

                            </div>

                            <div class="form-group col-sm-6">
                                <label for="form-phone">Arabic Tags <span style="font-size: 12px">(Separated by comma)</span></label>
                                <input type="text" id="ar_tags" name="ar_tags" value="{{$blogPost->ar_tags}}" class="form-control" >
                            </div>

                            <div class="form-group col-sm-12">

                                <label for="form-phone">Blog Content</label>

                                <textarea id="description" name="description" class="form-control" >{{$blogPost->description}}</textarea>

                                <span class="text-danger">@error('description'){{$message}}@enderror</span>

                            </div>

                            <div class="form-group col-sm-12">
                                <label for="form-phone">Blog Arabic Content</label>
                                <textarea id="ar_description" name="ar_description" class="form-control" >{{$blogPost->ar_description}}</textarea>
                                <span class="text-danger">@error('ar_description'){{$message}}@enderror</span>
                            </div>

                            <div class="form-group col-sm-6">

                                <label for="form-phone">Status</label><br>

                                <input type="radio" name="status" value="1" @if($blogPost->status==1) checked="checked" @endif > Active  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="radio" name="status" value="0" @if($blogPost->status==0) checked="checked" @endif > In Active  

                            </div>                           

                            <div class="form-group col-sm-12">

                                <label for="form-phone">Meta Title</label>

                                <input type="text" id="meta_title" name="meta_title" value="{{$blogPost->meta_title}}" class="form-control" >

                            </div>

                           <div class="form-group col-sm-12">

                                <label for="form-phone">Meta Keywords</label>

                                <input type="text" id="meta_key" name="meta_key" value="{{$blogPost->meta_key}}" class="form-control" >

                            </div>

                            <div class="form-group col-sm-12">

                                <label for="form-phone">Meta Description</label>

                                <textarea id="meta_des" name="meta_des" class="form-control" >{{$blogPost->meta_des}}</textarea>

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

<script src="https://cdn.tiny.cloud/1/3gohpdj545uh92bo8uzpjsophp1pkgtfkn9k0o25ue2f6fji/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

 

<script type="text/javascript">        

    var editor_config = {

    path_absolute : "/",

    selector: '#description,#ar_description',

    relative_urls: false,

    height:"400px",

    plugins: [

      "advlist autolink lists link image charmap print preview hr anchor pagebreak",

      "searchreplace wordcount visualblocks visualchars code fullscreen",

      "insertdatetime media nonbreaking save table directionality",

      "emoticons template paste textpattern"

    ],

    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

    file_picker_callback : function(callback, value, meta) {

      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;

      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;



      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;

      if (meta.filetype == 'image') {

        cmsURL = cmsURL + "&type=Images";

      } else {

        cmsURL = cmsURL + "&type=Files";

      }



      tinyMCE.activeEditor.windowManager.openUrl({

        url : cmsURL,

        title : 'Filemanager',

        width : x * 0.8,

        height : y * 0.8,

        resizable : "yes",

        close_previous : "no",

        onMessage: (api, message) => {

          callback(message.content);

        }

      });



    }

  };

  tinymce.init(editor_config);

   

        $(function() {

            $('#name,#slug').blur(function () {            

                $.ajax({

                    method: "GET",

                    url: "{{route('apBlogPost.checkSlug6')}}",

                    data: {"name": $(this).val()}

                }).done(function (data) {                    

                    $('#slug').val(data.slug);

                });

            });



            $('#publish').datepicker({

            autoclose: true,

            format:'dd-mm-yyyy'

            });

        });



    </script>



@endsection







