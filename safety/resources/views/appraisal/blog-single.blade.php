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
					<h1>@lang('course/innerpage.Insights')</h1>
				</div>
			</div>
		</marquee>
	</div>
</section>
<section id="blog-item" class="blog-item-post">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="blog-details-content">
					<div class="post-content-details mb-5">
						<div class="blog-detail-thumbnile mb35">
                            <img src="{{ asset('storage/blog/thumb_'.$blog->image)}}" alt="">
						</div>
						<h2>@if(app()->getLocale()=='en'){{$blog->name}} @else {{$blog->ar_name}} @endif</h2>
						<div class="row">
							<div class="col">
								<div class="date-meta text-uppercase">
									<span><i class="fas fa-calendar-alt"></i> {{Carbon\Carbon::parse($blog->publish)->format('l d Y')}}</span>
									<span><i class="fas fa-user"></i> 
										@if(app()->getLocale()=='en'){{$blog->apBlogCategory->name}} @else {{$blog->apBlogCategory->ar_name}} @endif
										</span>
								</div>
							</div>
							<div class="col text-right">
								<div class="date-meta text-uppercase share-on">
									<span>
										<a href="https://www.facebook.com" target="_blank">
											<i class="fab fa-facebook"></i>
										</a>
									</span>
									<span>
										<a href="https://www.instagram.com" target="_blank">
											<i class="fab fa-instagram"></i>
										</a>
									</span>
									<span>
										<a href="https://www.linkedin.com/" target="_blank">
											<i class="fab fa-linkedin"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
						@if(app()->getLocale()=='en')
						{!! $blog->description!!}
						@else
						{!! $blog->ar_description!!}
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				@include('site.blogright')
			</div>
		</div>
	</div>
</section>
@endsection