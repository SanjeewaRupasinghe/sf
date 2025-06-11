

<?php $__env->startSection('content'); ?>

    <h1 class="h3 mb-4 text-gray-800">New Appraisal Category <a href="<?php echo e(route('apCategory.index')); ?>" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="<?php echo e(route('apCategory.store')); ?>" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Category Name</label>
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
                            <label for="form-phone">Category Arabic Name</label>
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
                            <label for="form-phone">Parent Category </label>
                            <div class="tree-container">    
                                <div class="tree-item active  <?php echo e(($categories)?'has-children':''); ?>">
                                    <i class="expand-icon"></i><i class="icon folder-icon"></i>
                                    <span class="checkbox2">
                                        <input type="radio" id="" name="parent" value="" checked> 
                                        <label for="1" class="checkbox-view"></label> 
                                        <span for="1">Root</span>
                                    </span>                                
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                             
                                <div class="tree-item active  <?php echo e(($cat->children)?'has-children':''); ?>">
                                    <i class="expand-icon"></i><i class="icon folder-icon"></i>
                                    <span class="checkbox2">
                                        <input type="radio" id="<?php echo e($cat->id); ?>" name="parent" value="<?php echo e($cat->id); ?>"> 
                                        <label for="1" class="checkbox-view"></label> 
                                        <span for="1"><?php echo e($cat->name); ?></span>
                                    </span>    
                                    <?php if(count($cat->children)): ?>
                                        <?php echo $__env->make('admin.ap.categoryChild',['children' => $cat->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>                                
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
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
                            <label for="form-phone"> Image (Better size is 550px X 350px)</label>
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
                            </div>
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
<script>
    $(function() {
        $('#name,#slug').blur(function () {
            $.ajax({
                method: "GET",
                url: "<?php echo e(route('apCategory.checkSlug7')); ?>",
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


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/admin/ap/category_add.blade.php ENDPATH**/ ?>