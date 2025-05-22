

<?php $__env->startSection('content'); ?>

    <h1 class="h3 mb-4 text-gray-800">New Course <a href="<?php echo e(route('course.index')); ?>" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="<?php echo e(route('course.store')); ?>" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Course Name</label>
                             <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="form-control  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                            <span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Course Arabic Name</label>
                             <input type="text" id="ar_name" name="ar_name" value="<?php echo e(old('ar_name')); ?>" class="form-control  <?php $__errorArgs = ['ar_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                            <span class="text-danger"><?php $__errorArgs = ['ar_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Slug</label>
                            <input type="text" id="slug" name="slug" value="<?php echo e(old('slug')); ?>" class="form-control  <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                            <span class="text-danger"><?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="form-phone">Category </label>
                            <div class="tree-container">                                    
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                             
                                <div class="tree-item active  <?php echo e(($cat->children)?'has-children':''); ?>">
                                    <i class="expand-icon"></i><i class="icon folder-icon"></i>
                                    <span class="checkbox2">
                                        <?php if(count($cat->children)>0): ?>
                                        <span for="1"><?php echo e($cat->name); ?></span>
                                        <?php else: ?>
                                        <input type="radio" id="<?php echo e($cat->id); ?>" name="parent" value="<?php echo e($cat->id); ?>"> 
                                        <label for="1" class="checkbox-view"></label> 
                                        <span for="1"><?php echo e($cat->name); ?></span>
                                        <?php endif; ?>
                                    </span>    
                                    <?php if(count($cat->children)): ?>
                                        <?php echo $__env->make('admin.courseChild',['children' => $cat->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>                                
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                                <span class="text-danger"><?php $__errorArgs = ['parent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone"> Image (Better size is 850px X 400px)</label>
                                    <input type="file" name="image" id="image" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <span class="text-danger"><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Course Duration</label>
                                    <input type="text" id="duration" name="duration" value="<?php echo e(old('duration')); ?>" class="form-control  <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                    <span class="text-danger"><?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>    
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Course Duration Arabic</label>
                                    <input type="text" id="ar_duration" name="ar_duration" value="<?php echo e(old('ar_duration')); ?>" class="form-control  <?php $__errorArgs = ['ar_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                    <span class="text-danger"><?php $__errorArgs = ['ar_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>    
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="form-phone">Last Updated Date (yyyy-mm-dd)</label>
                                    <input type="text" id="lastupdate" name="lastupdate" value="<?php echo e(old('lastupdate')); ?>" class="form-control" >
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Requirements <i>(each one separated by comma ',')</i></label>
                            <textarea id="requirements" name="requirements" class="form-control" ><?php echo e(old('requirements')); ?></textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Requirements Arabic<i>(each one separated by comma ',')</i></label>
                            <textarea id="ar_requirements" name="ar_requirements" class="form-control" ><?php echo e(old('ar_requirements')); ?></textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Description</label>
                            <textarea id="description" name="description" class="form-control"><?php echo e(old('description')); ?></textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Description Arabic</label>
                            <textarea id="ar_description" name="ar_description" class="form-control"><?php echo e(old('ar_description')); ?></textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" value="<?php echo e(old('meta_title')); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Keywords</label>
                            <input type="text" id="meta_key" name="meta_key" value="<?php echo e(old('meta_key')); ?>" class="form-control" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="form-phone">Meta Description</label>
                            <textarea id="meta_des" name="meta_des" value="<?php echo e(old('meta_des')); ?>" class="form-control" ></textarea>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-info" value="SUBMIT" name="add" id="button">
                        </div>
                    </div>
                </form>
                <?php if(session()->has('msg')): ?><div class="alert alert-danger"> <?php echo e(session('msg')); ?></div><?php endif; ?>

            </div>
        </div>
        </div>
    </div>

    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
                url: "<?php echo e(route('course.checkSlug4')); ?>",
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/admin/course_add.blade.php ENDPATH**/ ?>