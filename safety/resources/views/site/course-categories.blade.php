@extends('site.template')
@section('content')

<section class="inerHeader">
<div class="container">
	<marquee behavior="" direction="">
		<div class="row">
			<div class="col ps-0 ms-0"  style="max-width:200px;">
				<h1>@lang('course/innerpage.Courses')</h1>
			</div>			
			<div class="col">
				<img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 200px;height: 30px;">
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
			<h2>@if(app()->getLocale()=='en'){{$result->name}} @else {{$result->ar_name}} @endif</h2>
	</div>
</div>
<div class="col-sm-3">

</div>
</div>
<div class="row">
@foreach ($result->children as $cat)
<div class="col-md-3">
	<div class="tutor-card">
		<div class="tutor-course-thumbnail">
			<a href="{{ asset('/course/courses/'.$cat->slug)}}" class="tutor-d-block">
				<img src="{{asset('storage/category/thumb_'.$cat->image)}}" class="img-fluid" />
			</a>
		</div>
		<div class="tutor-card-body">
			<h3 class="tutor-course-name" title="@if(app()->getLocale()=='en'){{$cat->name}} @else {{$cat->ar_name}} @endif">
				<a href="{{ asset('/course/courses/'.$cat->slug)}}">@if(app()->getLocale()=='en'){{$cat->name}} @else {{$cat->ar_name}} @endif</a>
			</h3>
		</div>
	</div>
</div>
@endforeach    

</div>
</div>
</section>

@endsection