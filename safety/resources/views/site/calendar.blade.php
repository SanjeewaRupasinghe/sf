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


				<h1>@lang('course/innerpage.CourseCalendar')</h1>


			</div>			


		</div>


	</marquee>


	</div>


</section>





<section class="courseSection pb-5">


	<div class="container">


					<h4 class="mb-3"></h4>


		<div class="row">


				


				<div class="col-md-9">


				{!!$calendar!!}


				</div>


				


				<div class="col-md-3">


				


				<div class="cal-side-iner" id="cal-side-iner">


					

				</div>


				


				</div>





				


			</div>


	</div>


</section>


@endsection





@section('scripts')


<script>


	$(function() {


            $('.courseLink').click(function () {            


                $.ajax({


                    method: "GET",


                    url: "{{route('home.findCourse')}}",


                    data: {"date": $(this).data('date')}


                }).done(function (data) {               


                    $('#cal-side-iner').html(data.html);


                });


            });


        });


</script>


@endsection