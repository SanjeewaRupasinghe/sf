@extends('appraisal.template')
@section('content')
<section class="inerHeader">
	<div class="container">
	<marquee behavior="" direction="">
            <div class="row">
                <div class="col" style="max-width: 60px;">
                    <img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 60px;">
                </div>
                <div class="col ps-0 ms-0" style="max-width:200px;">
                    <h1>Services</h1>
                </div>
            </div>
        </marquee>
	</div>
</section>

<section class="courseSection pt-5 pb-5">
	<div class="container">
		<div class="course-details-page">
			<div class="course-details-header">
				<div class="row">
					<div class="col-sm-10">
						<h1 class="course-details-title">@if(app()->getLocale()=='en'){{$result->name}} @else {{$result->ar_name}} @endif</h1>
						<div class="course-details-info">
							<div>Category: <a href="#">
								@if(app()->getLocale()=='en'){{$result->ApCategory->name}} @else {{$result->ApCategory->ar_name}} @endif
							</a></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="course-details-actions">
							<div class="genius-btn" style="float: right;">
								<a href="#registerForm"> Inquire Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="course-details-body">
				<div class="row">
					<div class="col-sm-8">
						<div class="course-thumbnail">
							<img src="{{asset('storage/service/thumb_'.$result->image)}}" class="img-fluid" />
						</div>
						<div class="course-details-tab">
							@if(app()->getLocale()=='en'){!!$result->description!!} @else {!!$result->ar_description!!} @endif
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-course-sidebar">
							<div class="course-sidebar-card" style="background-color:#0063a7;">
								<div class="course-card-head">
									<ul class="course-ul">
										@php 
										if(app()->getLocale()=='en')
										{
											$reqs=explode(',',$result->extras);
										}
										else
										{
											$reqs=explode(',',$result->ar_extras);
										}
										@endphp
										@foreach ($reqs as $req)
											<li style="color:#fff;"><i class="fa fa-arrow-right"></i>{{$req}}</li>
											@endforeach
									</ul>
								</div>
							</div>
							<div class="course-sidebar-card">
								<div class="course-details-instructors">
									<h5 class="text-light">Price</h5>
									<a href="#">
										<i class="fas fa-graduation-cap"></i>
										<span>AED {{$result->price}}</span>
									</a>
								</div>
								<div class="course-details-widget">
									<h5>Requirements</h5>
									<ul>
										@php 
										if(app()->getLocale()=='en')
										{
											$reqs=explode(',',$result->requirements);
										}
										else
										{
											$reqs=explode(',',$result->ar_requirements);
										}
										@endphp
										@foreach ($reqs as $req)
											<li>{{$req}}</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 mt-4" id="registerForm">
						<h4 class="mb-3">Registration</h4>
                            @if(session()->has('mailmsg'))<div class="alert alert-success"> {{session('mailmsg')}}</div> @endif
						<form method="post" name="form" action="{{ asset('/appraisal/register')}}" class="form">
							@csrf
							<input type="hidden" name="rootId" value="{{$root}}">
							<input type="hidden" name="corsId" value="{{$result->id}}">
							<input type="hidden" name="corsName" value="{{$result->name}}">
							<div class="row">
								<div class="col-sm-8 form-group">
									<label>Your full name<span class="text-danger">*</span></label>
									<input type="text" name="name" placeholder="Your full name" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Your Email<span class="text-danger">*</span></label>
									<input type="email" name="email" placeholder="Your Email" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Your Mobile<span class="text-danger">*</span></label>
									<input type="text" name="mobile" placeholder="Your Mobile" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>GMC Number<span class="text-danger">*</span></label>
									<input type="text" name="gmc" placeholder="GMC Number" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Profession<span class="text-danger">*</span></label>
									<input type="text" name="profession" placeholder="Profession " class="form-control" required/>
								</div>								
							
								<div class="col-sm-12 form-group">
									<div class="genius-btn mt20">
										<button type="submit" name="submit">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection