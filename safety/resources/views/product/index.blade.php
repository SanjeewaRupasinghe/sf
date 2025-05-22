@extends('product.template')
@section('content')



<style>

	.quotes2 {

		display: none;

	}

</style>


<section id="slide1" class="slider-section1 pt85">

	<div class="container">



			<div class="quotes2">

				<div class="slider-area slider-bg-1 relative-position">

					<div class="slide-content">

						<h2 id="index_hero_silde2_h1" class="hero-h2-1">@lang('product/home.silde1h21')</h2>

						<h2 id="index_hero_silde2_h1Span" class="hero-h2-2">@lang('product/home.silde1h22')</h2>

						<div class="button-wrap">

							<div class="genius-btn">

								<a  href="https://bnhealthy.ae/" target="_blank" id="index_hero_silde2_button">@lang('product/home.silde1h21')</a>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="quotes2">

				<div class="slider-area slider-bg-2 relative-position">

					<div class="slide-content">

						<h2 id="index_hero_silde3_h1" class="hero-h2-1">@lang('product/home.silde2h21')</h2>

						<h2 id="index_hero_silde3_h1Span" class="hero-h2-2">@lang('product/home.silde2h22')</h2>

						<div class="button-wrap">

							<div class="genius-btn">

								<a href="{{ asset('appraisal/j-tip')}}" id="index_hero_silde3_button">@lang('product/home.silde1h21')</a>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="quotes2">

				<div class="slider-area slider-bg-3 relative-position">

					<div class="slide-content">

						<h2 id="index_hero_silde3_h1" class="hero-h2-1">@lang('product/home.silde3h21')</h2>

					<!--	<h2 id="index_hero_silde3_h1Span" class="hero-h2-2">@lang('product/home.silde3h22')</h2> -->

						<div class="button-wrap">

							<div class="genius-btn">

								<a href="{{ asset('appraisal/victor')}}" id="index_hero_silde3_button">@lang('product/home.silde3a1')</a>

							</div>

						</div>

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

							<p style="color: #ffffff;">@lang('product/home.count1')</p>

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

							<p style="color: #ffffff;">@lang('product/home.count2')</p>

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

								<p style="color: #ffffff;">@lang('product/home.count3')</p>

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

							<h2>@lang('product/home.sponSlide1h')</h2>

						</div>

						<p>
							@lang('product/home.sponSlide1p')
						</p>

						<div class="genius-btn mt20 text-center text-uppercase ul-li-block bold-font  text-center">

							<a href="{{ asset('products/img/SafetyFirstCompanyProfile.pdf')}}" target="_blank" >@lang('product/home.Download')</a>

						</div>

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

