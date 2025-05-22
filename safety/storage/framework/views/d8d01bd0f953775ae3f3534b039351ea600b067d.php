<?php $__env->startSection('content'); ?>


<section class="inerHeader">


	<div class="container">


		<marquee behavior="" direction="">


		<div class="row">


			<div class="col" style="max-width: 60px;">


				<img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">


			</div>


			<div class="col ps-0 ms-0"  style="max-width:200px;">


				<h1><?php echo app('translator')->get('course/innerpage.CourseCalendar'); ?></h1>


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


				<?php echo $calendar; ?>



				</div>


				


				<div class="col-md-3">


				


				<div class="cal-side-iner" id="cal-side-iner">


					

				</div>


				


				</div>





				


			</div>


	</div>


</section>


<?php $__env->stopSection(); ?>





<?php $__env->startSection('scripts'); ?>


<script>


	$(function() {


            $('.courseLink').click(function () {            


                $.ajax({


                    method: "GET",


                    url: "<?php echo e(route('home.findCourse')); ?>",


                    data: {"date": $(this).data('date')}


                }).done(function (data) {               


                    $('#cal-side-iner').html(data.html);


                });


            });


        });


</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/calendar.blade.php ENDPATH**/ ?>