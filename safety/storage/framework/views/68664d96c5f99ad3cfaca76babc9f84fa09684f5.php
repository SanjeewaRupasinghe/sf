<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Safety First - Admin</title>
    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('admins/vendor/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admins/vendor/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('admins/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admins/vendor/datatables/dataTables.bootstrap4.min.css')); ?> " rel="stylesheet">
    <link href="<?php echo e(asset('admins/css/bootstrap-datepicker.css')); ?> " rel="stylesheet">
    

    <script src="<?php echo e(asset('admins/vendor/jquery/jquery.min.js')); ?>"></script>

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="" target="_blank">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"> Safety First - Admin </div>
        </a>
        <hr class="sidebar-divider my-0">

        <?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, Admin</span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('admin.edit')); ?>">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Change Password
                            </a>

                            
                          

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>" >
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Safety First <?php echo e(date('Y')); ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset('admins/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo e(asset('admins/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo e(asset('admins/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admins/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo e(asset('admins/js/bootstrap-datepicker.js')); ?>"></script>




<!-- Custom scripts for all pages-->
<script src="<?php echo e(asset('admins/js/sb-admin-2.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>
</body>

</html>


<?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/admin/layout.blade.php ENDPATH**/ ?>