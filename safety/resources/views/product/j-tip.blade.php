@extends('product.template')
@section('content')

<section id="slide1" class="slider-section1 pt85">
	<div class="container">
		<div id="slider-item1" class="slider-item-details">
			<!-- <div class="container"> -->
			<div class="quotes2">
				<div class="slider-area slider-bg-1 slider-bg-11 relative-position">
					<div class="slide-content">
						<h2 id="index_hero_silde1_h1" class="hero-h2-1">@lang('product/innerpage.jSlider1h1')</h2>
						<h2 id="index_hero_silde1_h1Span" class="hero-h2-2">@lang('product/innerpage.jSlider1span')</h2>
					</div>
				</div>
			</div>
			<!-- </div> -->
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
							<span class="counter-count bold-font">2020 </span><span></span>
							<p style="color: #ffffff;">@lang('product/innerpage.count1')</p>
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
							<span class="counter-count bold-font">2,000</span><span>+</span>
							<p style="color: #ffffff;">@lang('product/innerpage.count2')</p>
						</div>
					</div>
				</div>
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
							<p style="color: #ffffff;">@lang('product/innerpage.count3')</p>
						</div>
					</div>
				</div>
				<!-- /counter -->
			</div>
		</div>
	</div>

</section>

<section id="about-page" class="about-page-section">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="about-us-content-item">
					<div class="about-text-item">
						<div class="section-title-2  headline text-left">
							<h2>@lang('product/innerpage.jAbt1h1')</h2>
						</div>
						@lang('product/innerpage.jAbt1p')
					</div>
					<!-- /about-text -->
				</div>
			</div>
			<div class="col-md-5">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/doc-smile.png')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="text-center">

			<h2>@lang('product/innerpage.JTip')</h2>

			<p style="font-size: 20px;">
				@lang('product/innerpage.JTipp')
			</p>

		</div>

	</div>

</section>



<section id="about-page" class="about-page-section">

	<div class="container">

		<h2 class="text-center pt-3 pb-3">@lang('product/innerpage.Benefits')</h2>

		<div class="row">

			<div class="col-xxl-3 col-md-3 col-sm-6 benifits-wrap">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/safety1.jpg')}}" alt="">
						</div>
					</div>
				</div>
			</div>

			<div class="col-xxl-3 col-md-3 col-sm-6 benifits-wrap">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/safety2.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>
			<div class="col-xxl-3 col-md-3 col-sm-6 benifits-wrap">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/safety3.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>

			<div class="col-xxl-3 col-md-3 col-sm-6 benifits-wrap">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/safety4.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>


		</div>
	</div>
</section>



<section id="about-page" class="about-page-section">

	<div class="container">

		<div class="row">

			<div class="col-md-7">
				<div class="about-us-content-item">
					<div class="about-text-item">
						<div class="section-title-2  headline text-left">
							<h2>@lang('product/innerpage.jAbt2h1')</h2>
						</div>
						@lang('product/innerpage.jAbt2p')
	
					</div>
					<!-- /about-text -->
				</div>
			</div>

			<div class="col-md-5">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/how-it-works-diagram.png')}}" alt="">
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<section id="about-page" class="about-page-section">

	<div class="container">

		<h2 class="text-center pt-3 pb-3">@lang('product/innerpage.Easy')</h2>

		<div class="row">

			<div class="col-xxl-6 col-md-6 col-sm-6">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/step1.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>

			<div class="col-xxl-6 col-md-6 col-sm-6">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/step2.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>
			<div class="col-xxl-6 col-md-6 col-sm-6">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/step3.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>
			<div class="col-xxl-6 col-md-6 col-sm-6">
				<div class="about-us-content-item">
					<div class="about-gallery">
						<div class="about-gallery-img col-md-12">
							<img src="{{ asset('products/img/step4.jpg')}}" alt="">
						</div>

					</div>
				</div>
			</div>
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



	})();



	(function() {



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