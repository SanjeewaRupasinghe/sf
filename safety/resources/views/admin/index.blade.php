<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AngeloRemedios - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admins/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admins/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9  mt-5 pt-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Hello admin!</h1>
                                </div>
                                <form class="user" action="{{route('admin.store')}}" method="post">
                                    @csrf
                                    <span class="text-danger" id="error">{{session('msg')}}</span>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" id="username"  placeholder="Username">
                                        <span class="text-danger" data-placeholder="">@error('username'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <span class="text-danger" data-placeholder="">@error('password'){{$message}}@enderror</span>
                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admins/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admins/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('admins/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admins/js/sb-admin-2.min.js')}}'"></script>

</body>

</html>
