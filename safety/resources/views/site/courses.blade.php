@extends('site.template')
@section('content')
<section class="inerHeader">
<div class="container">
	 <marquee behavior="" direction="">
            <div class="row">
                <div class="col" style="max-width: 60px;">
                    <img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 60px;">
                </div>
                <div class="col ps-0 ms-0" style="max-width:200px;">
                    <h1>@lang('course/innerpage.Courses')</h1>
                </div>
            </div>
        </marquee>
</div>
</section>
<section class="courseSection pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="section-title-2 mb65 headline text-left">
					<h2>{{$category}}</h2>
				</div>
			</div>
			<div class="col-sm-3">
				<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search Here...." />
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			@foreach($courses as $cors)
			<div class="col-md-3">
				<div class="tutor-card">
					<div class="tutor-course-thumbnail">
						<a href="{{ asset('/course/course/'.$cors->slug)}}" class="tutor-d-block">
							<img src="{{asset('storage/course/thumb_'.$cors->image)}}" class="img-fluid" />
						</a>
					</div>
					<div class="tutor-card-body">
						<h3 class="tutor-course-name">
							<a href="{{ asset('/course/course/'.$cors->slug)}}">
								@if(app()->getLocale()=='en'){{$cors->name}} @else {{$cors->ar_name}} @endif
							</a>
						</h3>
						<div class="tutor-meta">
							<div>
								<!--<i class="fa fa-user" area-hidden="true"></i>
								<span class="tutor-meta-value">93</span>-->
							</div>
							<div>
								<i class="fa fa-clock" area-hidden="true"></i>
								<span class="tutor-meta-value">
									@if(app()->getLocale()=='en'){{$cors->duration}} @else {{$cors->ar_duration}} @endif
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach 
		</div>
	</div>
</section>

@endsection