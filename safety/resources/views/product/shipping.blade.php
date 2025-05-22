@extends('appraisal.template')

@section('content')
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
                    <img src="{{ asset('appraisal/img/giphy.webp')}}" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1>		@lang('common.Shipping')						</h1>
				</div>
			</div>
		</marquee>
	</div>
</section>

<section id="" class="about-page-section" style="padding-top: 10px;">
	<div class="container">
		@lang('common.ShippingP')	

	</div>
</section>
@endsection