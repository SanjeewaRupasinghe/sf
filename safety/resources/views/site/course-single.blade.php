@extends('site.template')
@section('content')
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
		<div class="row">
			<div class="col" style="max-width: 60px;">
				<img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 60px;">
			</div>
			<div class="col ps-0 ms-0"  style="max-width:200px;">
				<h1>@lang('course/innerpage.Courses')</h1>
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
						<h1 class="course-details-title">
							@if(app()->getLocale()=='en'){{$result->name}} @else {{$result->ar_name}} @endif
						</h1>
						<div class="course-details-info">
							<div>@lang('course/innerpage.Category'): <a href="#">
								@if(app()->getLocale()=='en'){{$result->Category->name}} @else {{$result->Category->ar_name}} @endif
								</a></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="course-details-actions">
							<div class="genius-btn" style="float: right;">
								<a href="#registerForm"> @lang('course/innerpage.Register')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="course-details-body">
				<div class="row">
					<div class="col-sm-8">
						<div class="course-thumbnail">
							<img src="{{asset('storage/course/thumb_'.$result->image)}}" class="img-fluid" />
						</div>
						<div class="course-details-tab">
							<h4 style="color:#f00">@lang('course/innerpage.AboutCourse')</h4>
							@if(app()->getLocale()=='en'){!!$result->description!!} @else {!!$result->ar_description!!} @endif
							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-course-sidebar">
							<div class="course-sidebar-card" style="background-color:#0063a7;">
								<div class="course-card-head">
									<ul class="course-ul">
										<li style="color:#fff;"><i class="fa fa-clock"></i>
											@if(app()->getLocale()=='en'){{$result->duration}} @else {{$result->ar_duration}} @endif
											</li>
										<li style="color:#fff;"><i class="fa fa-allergies "></i>{{$result->lastupdate}} @lang('course/innerpage.LastUpdated') </li>
									</ul>
								</div>
							</div>
							<div class="course-sidebar-card">
								<div class="course-details-instructors">
									<h5 class="text-light">@lang('course/innerpage.Acourseby')</h5>
									<a href="#">
										<i class="fas fa-graduation-cap"></i>
										<span>
											@if(app()->getLocale()=='en'){{$rootCat->name}} @else {{$rootCat->ar_name}} @endif											
										</span>
									</a>
								</div>
								<div class="course-details-widget">
									<h5>@lang('course/innerpage.Requirements')</h5>
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
						<h4 class="mb-3">@lang('course/innerpage.Registration')</h4>
                            @if(session()->has('mailmsg'))<div class="alert alert-success"> {{session('mailmsg')}}</div> @endif
						<form method="post" name="form" action="/course/register" class="form" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="rootId" value="{{$root}}">
							<input type="hidden" name="corsId" value="{{$result->id}}">
							<input type="hidden" name="corsName" value="{{$result->name}}">
							<input type="hidden" name="corsBy" value="{{$rootCat->name}}">

							<div class="row">
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.UrName')</label><span class="text-danger">*</span>
									<input type="text" name="name" class="form-control" />
									<span class="text-danger">@error('name'){{$message}}@enderror</span>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.UrEmail') </label><span class="text-danger">*</span>
									<input type="email" name="email" class="form-control" />
									<span class="text-danger">@error('email'){{$message}}@enderror</span>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.UrMobile') </label><span class="text-danger">*</span>
									<input type="text" name="mobile" class="form-control" />
									<span class="text-danger">@error('mobile'){{$message}}@enderror</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 form-group">
									<label>@lang('course/innerpage.Address')</label><span class="text-danger">*</span>
									<textarea name="address" class="form-control" rows="2"></textarea>
									<span class="text-danger">@error('address'){{$message}}@enderror</span>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.Placeofwork')</label><span class="text-danger">*</span>
									<input type="text" name="work" class="form-control" />
									<span class="text-danger">@error('work'){{$message}}@enderror</span>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.Profession')</label><span class="text-danger">*</span>
									<input type="text" name="profession" class="form-control" />
									<span class="text-danger">@error('profession'){{$message}}@enderror</span>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.DateofCourse')</label><span class="text-danger">*</span>
									<input type="date" name="date" class="form-control" />
									<span class="text-danger">@error('date'){{$message}}@enderror</span>
								</div>
							</div>

							@if($result->id==8 || $result->id==9)

							<p class="mb-3">@lang('course/innerpage.Smallhead')
								
							</p>

							<div class="row">
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.AHABLS')</label>
									<select class="form-control" name="blssts">
										<option value="">@lang('course/innerpage.Select')</option>
										<option value="YES">@lang('course/innerpage.YES')</option>
										<option value="NO">@lang('course/innerpage.NO')</option>
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.DateofExpiry')</label>
									<input type="date" name="doe" class="form-control" />
								</div>
								<div class="col-sm-4 form-group">
									<label>@lang('course/innerpage.BLSCard')</label>
									<input type="file" name="card" class="form-control" />
								</div>

								<div class="col-sm-12 form-group">
									<label>@lang('course/innerpage.Comment')</label>
									<textarea name="comment" class="form-control" rows="2"></textarea>
								</div>
							</div>
							@endif
								
								<div class="row">
									<div class="col-sm-12 form-group">
									<div class="genius-btn mt20">
										<button type="submit" name="submit">@lang('course/innerpage.Submit')</button>
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