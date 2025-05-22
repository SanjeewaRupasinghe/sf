@extends('site.template')

@section('content')

<section id="slide1" class="slider-section1 pt85">
	<div class="container">
		<div id="slider-item1" class="slider-item-details">
			<div class="quotes2">
				<div class="slider-area slider-bg-1 relative-position">
					<div class="slide-content">
						<h2 id="index_hero_silde1_h1" class="hero-h2-1">@lang('course/home.silde1h21')</h2>
						<h2 id="index_hero_silde1_h1Span" class="hero-h2-2">@lang('course/home.silde1h22')</h2>
						<div class="genius-btn">
						<a href="http://safetyfirstmed.ae/course/course/basic-life-support-provider-ashi" id="index_hero_silde1_button">@lang('course/home.silde1a1')</a>
						</div>
						<div class="genius-btn">
						<a href="{{ asset('course/calendar')}}" id="index_hero_silde1_button">Upcoming Courses</a>
						</div>
					</div>
				</div>
			</div>

			<div class="quotes2">
				<div class="slider-area slider-bg-2 relative-position">
					<div class="slide-content">
						<h2 id="index_hero_silde1_h1" class="hero-h2-1">@lang('course/home.silde2h21')</h2>
						<h2 id="index_hero_silde1_h1Span" class="hero-h2-2">@lang('course/home.silde2h22')</h2>
						<div class="genius-btn">
							<a href="http://safetyfirstmed.ae/course/course/aha-advanced-cardiac-life-support-provider-acls" id="index_hero_silde1_button">@lang('course/home.silde2a1')</a>
						</div>
						<div class="genius-btn">
						<a href="{{ asset('course/calendar')}}" id="index_hero_silde1_button">Upcoming Courses</a>
						</div>
					</div>
				</div>
			</div>

			<div class="quotes2">
				<div class="slider-area slider-bg-3 relative-position">
					<div class="slide-content">
						<h2 id="index_hero_silde1_h1" class="hero-h2-1">@lang('course/home.silde3h21')</h2>
						<h2 id="index_hero_silde1_h1Span" class="hero-h2-2">@lang('course/home.silde3h22')</h2>
						<div class="genius-btn">
							<a href="https://safetyfirstmed.ae/course/course/aha-heartsaver-first-aid-only" id="index_hero_silde1_button">@lang('course/home.silde3a1')</a>
						</div>
						<div class="genius-btn">
						<a href="{{ asset('course/calendar')}}" id="index_hero_silde1_button">Upcoming Courses</a>
						</div>
					</div>
				</div>
			</div>

			<div class="quotes2">
				<div class="slider-area slider-bg-4 relative-position">
					<div class="slide-content">
						<h2 id="index_hero_silde1_h1" class="hero-h2-1">@lang('course/home.silde4h21')</h2>
						<h2 id="index_hero_silde1_h1Span" class="hero-h2-2">@lang('course/home.silde4h22')</h2>
						<div class="genius-btn">
							<a href="#" id="index_hero_silde1_button">@lang('course/home.silde4a1')</a>
						</div>
						<div class="genius-btn">
						<a href="{{ asset('course/calendar')}}" id="index_hero_silde1_button">Upcoming Courses</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<section id="search-course" class="search-course-section search-course-secound">
	<div class="container">
		<div class="search-counter-up">
			<div class="row">
				<div class="col-md-4">
				<div class="counter-icon-number ">
					<div class="counter-icon">
						<i class="text-black flaticon-graduation-hat"></i>
						</div>
						<div class="counter-number">
							<span class="counter-count bold-font">2012 </span>
							<p style="color: #ffffff;">@lang('course/home.count1')</p>
						</div>
					</div>
				</div>
				<!-- /counter -->
				
				<div class="col-md-4">
					<div class="counter-icon-number ">
						<div class="counter-icon">
							<i class="text-black flaticon-book"></i>
						</div>
						<div class="counter-number">
							<span class="counter-count bold-font">100</span><span>000+</span>
							<p style="color: #ffffff;">@lang('course/home.count2')</p>
						</div>
					</div>
				</div>
				<!-- /counter -->
			<!-- /counter -->
				<div class="col-md-4">
					<div class="counter-icon-number ">
						<div class="counter-icon">
							<i class="text-black flaticon-group"></i>
						</div>
						<div class="counter-number">
							<span class="counter-count bold-font">4</span><span>.9 <span>
								<i class="fas fa-star" style="color: #F2BB13;font-size: 18px;"></i>
								<i class="fas fa-star" style="color: #F2BB13;font-size: 18px;"></i>
								<i class="fas fa-star" style="color: #F2BB13;font-size: 18px;"></i>
								<i class="fas fa-star" style="color: #F2BB13;font-size: 18px;"></i>
							 	<i class="fas fa-star" style="color: #F2BB13;font-size: 18px;"></i>
							</span></span>
							<p style="color: #ffffff;">@lang('course/home.count3')</p>
						</div>
					</div>
				</div>

			<!-- /counter -->
			</div>
		</div>
	</div>
</section>

<section id="sponsor" class="sponsor-section">
	<div>
		<div class="container">
			<div class="quotes1">
				<div class="row">
					<div class="col-md-7 col-sm-12 course-sec">
						<h2 class="course-sec-header">@lang('course/home.sponSlide1h')</h2>
						<p class="text-justify 	course-sec-text">@lang('course/home.sponSlide1p')</p>
						<div class="genius-btn course-sec-btn">
							<a href="https://safetyfirstmed.ae/course/courses/american-heart-association">@lang('course/home.sponSlide1a')</a>
						</div>
					</div>
					<div class="col-md-5 col-sm-12 text-center pt-5">
						<img src="{{ asset('site/img/brand1.jpg')}}" class="img-fluid">
					</div>
				</div>
			</div>
			<div class="quotes1">
				<div class="row">
					<div class="col-md-7 col-sm-12 course-sec">
						<h2 class="course-sec-header">@lang('course/home.sponSlide2h')</h2>
						<p class="text-justify 	course-sec-text">@lang('course/home.sponSlide2p')</p>

						<div class="genius-btn course-sec-btn">
							<a href="https://safetyfirstmed.ae/course/courses/highfield">@lang('course/home.sponSlide1a')</a>
						</div>
					</div>
					<div class="col-md-5 col-sm-12 text-center pt-5">
						<img src="{{ asset('site/img/brand2.jpg')}}" class="img-fluid">

					</div>
				</div>
			</div>
			<div class="quotes1">
				<div class="row">
					<div class="col-md-7 col-sm-12 course-sec">
						<h2 class="course-sec-header">@lang('course/home.sponSlide3h')</h2>
						<p class="text-justify 	course-sec-text">@lang('course/home.sponSlide3p')</p>

						<div class="genius-btn course-sec-btn">
							<a href="https://safetyfirstmed.ae/course/courses/continuing-medical-association">@lang('course/home.sponSlide1a')</a>
						</div>
					</div>
					<div class="col-md-5 col-sm-12 text-center pt-5">
						<img src="{{ asset('site/img/brand3.jpg')}}" class="img-fluid">
					</div>
				</div>
			</div>
			<div class="quotes1">
				<div class="row">
					<div class="col-md-7 col-sm-12 course-sec">
						<h2 class="course-sec-header">@lang('course/home.sponSlide4h')</h2>
						<p class="text-justify 	course-sec-text">@lang('course/home.sponSlide4p')</p>

						<div class="genius-btn course-sec-btn">
							<a href="https://safetyfirstmed.ae/course/courses/american-safety-health-institute">@lang('course/home.sponSlide1a')</a>
						</div>
					</div>
					<div class="col-md-5 col-sm-12 text-center pt-5">
						<img src="{{ asset('site/img/brand4.jpg')}}" class="img-fluid">

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="about-page" class="about-page-section pb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="about-us-content-item">
					<div class="about-text-item">
						<div class="section-title-2  headline text-left">
							<h2>@lang('course/home.abouth2')</h2>
						</div>
						<p>@lang('course/home.aboutp')						</p>
					</div>
					<!-- /about-text -->
				</div>
			</div>

			<div class="col-md-5">
				<iframe title="vimeo-player" src="https://player.vimeo.com/video/556836952?h=833e07f847" frameborder="0" allowfullscreen style="width:100%; height:450px"></iframe>
		</div>
		</div>
	</div>
</section>

<section id="about-page" class="about-page-section">
	<div class="container">
		<div class="section-title-2  headline text-left">
			<h2>@lang('course/home.Insights')</span></h2>
		</div>
		<div class="row" style="margin-top: 50px;">

			@foreach ($blogs as $blog)
			<div class="col-md-6 col-sm-12">
				<div class="blog-post-img-content">
					<div class="blog-img-date relative-position">
						<div class="blog-thumnile">
							<img src="{{ asset('storage/blog/thumb_'.$blog->image)}}" alt="">
						</div>
						<div class="course-price text-center genius-btn">
							<span>{{Carbon\Carbon::parse($blog->publish)->format('l d Y')}}</span>
						</div>
					</div>
					<div class="blog-title-content headline">
						<h3><a href="{{ asset('/course/blog/'.$blog->slug)}}">{{$blog->name}}</a></h3>
						<div class="blog-content">
							@php $short= substr(strip_tags($blog->description),0,100); @endphp
							{{$short}}...
						</div>
						<div class="view-all-btn bold-font">
							<a href="{{ asset('/course/blog/'.$blog->slug)}}">Read More <i class="fas fa-chevron-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>	
			@endforeach			
		</div>
	</div>
</section>
@endsection

@section('scripts')

<script>

	(function() {

		var quotes1 = $(".quotes1");

		var quoteIndex = -1;

		function showNextQuote() {

			++quoteIndex;

			quotes1.eq(quoteIndex % quotes1.length)

				.fadeIn(2000)

				.delay(2000)

				.fadeOut(2000, showNextQuote);

		}

		showNextQuote();

	

		var quotes2 = $(".quotes2");

		var quoteIndex = -1;



		function showNextQuote2() {

			++quoteIndex;

			quotes2.eq(quoteIndex % quotes2.length)

				.fadeIn(3000)

				.delay(3000)

				.fadeOut(3000, showNextQuote2);

		}

		showNextQuote2();

	})();

</script>

@endsection