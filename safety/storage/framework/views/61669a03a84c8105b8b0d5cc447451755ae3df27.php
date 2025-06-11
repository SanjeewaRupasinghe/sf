

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
<div class="col-md-8">
    <div class="row">

   
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Courses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($cors); ?></div>
                    </div>
                    <div class="col-auto">
                        <a href=""> <i class="fas fa-arrow-circle-right fa-2x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Course Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($corcats); ?></div>
                    </div>
                    <div class="col-auto">
                        <a href=""> <i class="fas fa-arrow-circle-right fa-2x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Blogs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($blogs); ?></div>
                    </div>
                    <div class="col-auto">
                        <a href=""> <i class="fas fa-arrow-circle-right fa-2x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Blog Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($cats); ?></div>
                    </div>
                    <div class="col-auto">
                        <a href=""> <i class="fas fa-arrow-circle-right fa-2x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


   


 
    <!-- Earnings (Monthly) Card Example -->
   

    
</div>
</div>
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notifications Panel </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="list-group">

                

            </div> 
        </div>
    </div>
</div>

</div>

    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>