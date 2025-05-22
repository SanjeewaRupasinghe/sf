@extends('admin.layout')

@section('content')

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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cors}}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$corcats}}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$blogs}}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cats}}</div>
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

                {{-- <a href="#" class="list-group-item">
                    <i class="fa fa-users fa-fw"></i> 
                    <span class="pull-right text-muted small"><em></em>
                    </span>
                </a>                --}}

            </div> 
        </div>
    </div>
</div>

</div>

    

@endsection
