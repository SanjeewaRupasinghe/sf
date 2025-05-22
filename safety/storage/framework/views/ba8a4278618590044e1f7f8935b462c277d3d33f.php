

<?php $__env->startSection('content'); ?>

<section class="inerHeader">

	<div class="container">

		<marquee behavior="" direction="">

		<div class="row">

			<div class="col" style="max-width: 60px;">

				<img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">

			</div>

			<div class="col ps-0 ms-0"  style="max-width:200px;">

				<h1><?php echo app('translator')->get('common.Feedback'); ?></h1>

			</div>			

		</div>

	</marquee>

	</div>

</section>



<section class="courseSection pt-5 pb-5">

	<div class="container">

		<h4 class="mb-3"><?php echo app('translator')->get('common.SendMessage'); ?></h4>
                            <?php if(session()->has('mailmsg')): ?><div class="alert alert-success"> <?php echo e(session('mailmsg')); ?></div> <?php endif; ?>

		<form method="post" name="form" action="<?php echo e(asset('/course/contact')); ?>" class="form">
            <?php echo csrf_field(); ?>
		<div class="row">				
			<div class="col-md-6 mt-4" id="registerForm">
				<div class="row">
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrName'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="name"  class="form-control" />
						<span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrEmail'); ?></label>
						<span class="text-danger">*</span>
						<input type="email" name="email"  class="form-control" />

					<span class="text-danger"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrMobile'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="phone" class="form-control" />

					<span class="text-danger"><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>				
					<div class="col-sm-12 form-group">
						<div class="genius-btn mt20">
							<button type="submit" name="submit"><?php echo app('translator')->get('common.Submit'); ?></button>
						</div>
					</div>				
				</div>						
			</div>
				
			<div class="col-md-6 mt-4" id="registerForm">
				<div class="row">						
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrDesig'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="designation"  class="form-control" />
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrCompany'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="company" class="form-control" />
					</div>					
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.Message'); ?></label>
						<span class="text-danger">*</span>
						<textarea name="message" class="form-control" rows="4"></textarea>
						<span class="text-danger"><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>

					</div>						
				</div>
			</div>
		</div>
		</form>

	</div>

</section>


<section class="courseSection testimonial-area">

	<div class="container">

		<div class="testimonial-content">

			<div class="row">

				<div class="col=xxl-6 col-md-6 col-sm-12">

					<div class="quotes1">
						<div class="single-testimonial single-testimonial-red">
							<div class="round-1 round round-red"></div>
							<div class="round-2 round round-red"></div>
							<p>Just finished the First Aid Training, it was very educational and informative. The trainers were very interactive to the trainees. It’s a pleasure learning first aid basics and hoping to learn more.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Eloisa Santayana</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes1">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-blue">
							<div class="round-1 round round-blue"></div>
							<div class="round-2 round round-blue"></div>
							<p>Great instructor, Farhad - made the first aid training interesting and interactive. Very helpful administrator, Zoya. Thank you very much to you both. We will definitely use Safety First Medical Services again.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Madeleine Greene</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes1">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-red">
							<div class="round-1 round round-red"></div>
							<div class="round-2 round round-red"></div>
							<p>Safety First Med in Al Reem offers quality BLS training. I just attended today with Mr. Farhan as the instructor. It was very informative and realistic. The facility is also well maintained, clean  and organized. Staff is very accommodating as well.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Irishz</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes1">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-blue">
							<div class="round-1 round round-blue"></div>
							<div class="round-2 round round-blue"></div>
							<p>Staffs are Great, very accommodating and the Instructor was very knowledgeable and clearly explaining things easy to grasp. Very much well recommended Training Center. Thank you 🙏</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Bhotsky Saki</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="quotes1">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-red">
							<div class="round-1 round round-red"></div>
							<div class="round-2 round round-red"></div>
							<p>Its a great experience again with them specially to Mr.farhan for a well detailed learning. Overall ambiance is good and excellent people.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Lo</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="col=xxl-6 col-md-6 mobile-visible-false">
<div class="quotes2">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-blue">
							<div class="round-1 round round-blue"></div>
							<div class="round-2 round round-blue"></div>
							<p>The lesson was presented and discussed well by the instructor. It was clear and made easy to remember all the steps therefore I enjoyed the training. More power to the training team. Thankyou.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Joean April Mora</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes2">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-red">
							<div class="round-1 round round-red"></div>
							<div class="round-2 round round-red"></div>
							<p>I did the BLS course today with Mr. Farhan in our facility. The content and the lecture was very clear and easy to understand. I will highly recomend BLS with Safety first medical service.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Rafia Mustafa</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes2">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-blue">
							<div class="round-1 round round-blue"></div>
							<div class="round-2 round round-blue"></div>
							<p>Farhan is an amazing Instructor! Explain the course in very simple way.
Best place to take your BLS!</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>jwaher hamad</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="quotes2">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-red">
							<div class="round-1 round round-red"></div>
							<div class="round-2 round round-red"></div>
							<p>Very impressed the instructor and teams,
The courses are easy to conduct and very informative for students to learn. Program covers all the information that a student needs, easy to understand.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>Goff W</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>
						<div class="quotes2">
						<!-- Single Testimonial -->
						<div class="single-testimonial single-testimonial-blue">
							<div class="round-1 round round-blue"></div>
							<div class="round-2 round round-blue"></div>
							<p>It is a great place to have your bls training! The staffs are kind, considerate and very accomodating. I'd like to give special mention to Sir Farhan for being a considerate and has competence in the subject.</p>
							<div class="client-info">
								<div class="client-details">
									<div>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
									</div>
									<h6>CHRISTINE JOY DOLLETON</h6>
									<span></span>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>

</section>



<section id="contact-area" class="contact-area-section backgroud-style">
		<div class="container">
			<div class="contact-area-content">
				<div class="row">
					<!--<div class="col-md-6">
						<div class="contact-left-content">
							<div class="section-title  mb20 headline text-left">
								<span class="subtitle ml42  text-uppercase">CONTACT US</span>
								<h2><span>Get in Touch</span></h2>								
							</div>
							<div class="contact-address">
								<div class="contact-address-details">
									<div class="address-icon relative-position text-center float-left">
										<i class="fas fa-map-marker-alt"></i>
									</div>
									<div class="address-details ul-li-block">
										<ul>
											<li><span>Address: </span>Addax Office Tower Office 1105 - Al Reem Island - Abu Dhabi - UAE</li>
										</ul>
									</div>
								</div>
								<div class="contact-address-details">
									<div class="address-icon relative-position text-center float-left">
										<i class="fas fa-phone"></i>
									</div>
									<div class="address-details ul-li-block">
										<ul>
											<li><span>Call: </span><a href="tel:+971564435940">+971 56 443 5940</a></li>
										</ul>
									</div>
								</div>
								<div class="contact-address-details">
									<div class="address-icon relative-position text-center float-left">
										<i class="fas fa-envelope"></i>
									</div>
									<div class="address-details ul-li-block">
										<ul>
											<li><span>Mail: </span><a href="mailto:traning@safetyfirstmed.ae">traning@safetyfirstmed.ae</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<div class="social-footer">
						<a href="#" style="margin-right:35px" class="f"><i class="fab fa-facebook"></i></a> 
						<a href="#" style="margin-right:35px" class="l"><i class="fab fa-linkedin"></i></a>
						<a href="#" style="" class="i"><i class="fab fa-instagram"></i></a>
						</div>
					</div>-->
					<div class="col-md-12">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.6134367065865!2d54.40050847412759!3d
								24.498847259634413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e427edac00001%3A0x49a645ccff439f21!
								2sSafety%20First%20Medical%20Services%20(SFMS)!5e0!3m2!1sen!2sin!4v1698654153167!5m2!1sen!2sin"  style="border:0; width:100%; height:300px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

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



	let showNextQuote2FunIntervel = setInterval(Function("showNextQuote2Fun();"), 1500);

	setInterval(Function("clearIntervel();"), 2500);



	function clearIntervel() {

		clearInterval(showNextQuote2FunIntervel);

	}



	function showNextQuote2Fun() {

		(function() {



			var quotes2 = $(".quotes2");

			var quoteIndex2 = -1;



			function showNextQuote2() {

				++quoteIndex2;

				quotes2.eq(quoteIndex2 % quotes2.length)

					.fadeIn(2000)

					.delay(2000)

					.fadeOut(2000, showNextQuote2);

			}



			showNextQuote2();



		})();

	}

</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/contact.blade.php ENDPATH**/ ?>