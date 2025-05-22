@extends('admin.layout')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">New Course <a href="{{route('course.index')}}" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="{{route('course.store')}}" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Course Name</label>
                             <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control  @error('name'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Course Arabic Name</label>
                             <input type="text" id="ar_name" name="ar_name" value="{{old('ar_name')}}" class="form-control  @error('ar_name'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('ar_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Slug</label>
                            <input type="text" id="slug" name="slug" value="{{old('slug')}}" class="form-control  @error('slug'){{'is-invalid'}}@enderror" >
                            <span class="text-danger">@error('slug'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="form-phone">Category </label>
                            <div class="tree-container">                                    
                                @foreach($categories as $cat)                             
                                <div class="tree-item active  {{ ($cat->children)?'has-children':''   }}">
                                    <i class="expand-icon"></i><i class="icon folder-icon"></i>
                                    <span class="checkbox2">
                                        @if(count($cat->children)>0)
                                        <span for="1">{{$cat->name}}</span>
                                        @else
                                        <input type="radio" id="{{$cat->id}}" name="parent" value="{{$cat->id}}"> 
                                        <label for="1" class="checkbox-view"></label> 
                                        <span for="1">{{$cat->name}}</span>
                                        @endif
                                    </span>    
                                    @if(count($cat->children))
                                        @include('admin.courseChild',['children' => $cat->children])
                                    @endif                                
                                    </div>
                                @endforeach
                            </div>
                                <span class="text-danger">@error('parent'){{$message}}@enderror</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone"> Image (Better size is 850px X 400px)</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image'){{'is-invalid'}}@enderror">
                                    <span class="text-danger">@error('image'){{$message}}@enderror</span>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Course Duration</label>
                                    <input type="text" id="duration" name="duration" value="{{old('duration')}}" class="form-control  @error('duration'){{'is-invalid'}}@enderror" >
                                    <span class="text-danger">@error('duration'){{$message}}@enderror</span>    
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Course Duration Arabic</label>
                                    <input type="text" id="ar_duration" name="ar_duration" value="{{old('ar_duration')}}" class="form-control  @error('ar_duration'){{'is-invalid'}}@enderror" >
                                    <span class="text-danger">@error('ar_duration'){{$message}}@enderror</span>    
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Last Updated Date (yyyy-mm-dd)</label>
                                    <input type="text" id="lastupdate" name="lastupdate" value="{{old('lastupdate')}}" class="form-control" >
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Requirements <i>(each one separated by comma ',')</i></label>
                            <textarea id="requirements" name="requirements" class="form-control" >{{old('requirements')}}</textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Requirements Arabic<i>(each one separated by comma ',')</i></label>
                            <textarea id="ar_requirements" name="ar_requirements" class="form-control" >{{old('ar_requirements')}}</textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Description</label>
                            <textarea id="description" name="description" class="form-control">{{old('description')}}</textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Description Arabic</label>
                            <textarea id="ar_description" name="ar_description" class="form-control">{{old('ar_description')}}</textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" value="{{old('meta_title')}}" class="form-control" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Keywords</label>
                            <input type="text" id="meta_key" name="meta_key" value="{{old('meta_key')}}" class="form-control" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Description</label>
                            <textarea id="meta_des" name="meta_des" value="{{old('meta_des')}}" class="form-control" ></textarea>
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
<script src="https://cdn.tiny.cloud/1/3gohpdj545uh92bo8uzpjsophp1pkgtfkn9k0o25ue2f6fji/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  
  <script type="text/javascript">
     var editor_config = {
  path_absolute : "/",
  selector: '#description,#ar_description',
  relative_urls: false,
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
</script>
<script>   
    $(function() {
         $('#lastupdate').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd',
           });
        $('#name,#slug').blur(function () {
            $.ajax({
                method: "GET",
                url: "{{route('course.checkSlug4')}}",
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

