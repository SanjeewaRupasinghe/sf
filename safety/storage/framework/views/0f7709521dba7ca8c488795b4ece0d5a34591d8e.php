<!doctype html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php if(app()->getLocale()=='en'): ?><?php echo e('ltr'); ?><?php else: ?><?php echo e('rtl'); ?><?php endif; ?>">

<head>

	<meta charset="UTF-8">

	<title></title>

	<!-- Mobile Specific Meta -->

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/owl.carousel.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/fontawesome-all.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/flaticon.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/meanmenu.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/bootstrap.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/video.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/lightbox.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/animate.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/progess.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/style.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/responsive.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('appraisals/css/custom.css')); ?>">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.14.0/css/flag-icons.min.css"/>



</head>

<body>

	<div id="preloader"></div>

	<header>

		<div id="main-menu" class="main-menu-container header-style-2">

			<div class="main-menu">

				<div class="container">

					<nav class="navbar navbar-expand-lg navbar-light bg-none">

						<a class="navbar-brand" href="http://safetyfirstmed.ae/"><img class="brand-logo" src="<?php echo e(asset('appraisals/img/safetyfirstmed.png')); ?>" alt="logo"></a>

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

							<span class="navbar-toggler-icon"></span>

						</button>

						<div class="collapse navbar-collapse" id="navbarNavDropdown">

							<ul class="navbar-nav ml-auto">

								<li class="nav-item active">

									<a class="nav-link" href="<?php echo e(asset('appraisal/')); ?>"><?php echo app('translator')->get('appraisal/template.Home'); ?> </a>

								</li>

								<li class="nav-item dropdown">

									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>

									<div class="dropdown-menu" aria-labelledby="navbarDropdown">

										<?php $__currentLoopData = $menuApCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<a class="dropdown-item" href="<?php echo e(asset('/appraisal/services/'.$menu->slug)); ?>"><?php echo e($menu->name); ?></a>

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>										

									</div>

								</li>

								<li class="nav-item">

									<a class="nav-link" href="<?php echo e(asset('/appraisal/faq')); ?>"><?php echo app('translator')->get('appraisal/template.FAQ'); ?></a>

								</li>								

								<li class="nav-item">

									<a class="nav-link" href="<?php echo e(asset('/appraisal/blogs')); ?>"><?php echo app('translator')->get('appraisal/template.Insights'); ?></a>

								</li> 

								<li class="nav-item">

									<a class="nav-link" href="<?php echo e(asset('/appraisal/contact')); ?>"><?php echo app('translator')->get('appraisal/template.Feedback'); ?></a>

								</li>

							<!--	<li class="nav-item">

									<a class="nav-link" href="<?php echo e(asset('/appraisal/paynow')); ?>"><?php echo app('translator')->get('appraisal/template.PayNow'); ?></a>

								</li>

								<li class="nav-item">

									<a class="nav-link" href="#" title="Arabic"><span class="fi fi-sa" style="font-size:28px"></span></a>

								</li> -->

							</ul>

						</div>

					</nav>

				</div>

			</div>

		</div>

	</header>

	<?php echo $__env->yieldContent('content'); ?>
<!--<p style="text-align: center">
		<a href="javascript:void(0)" id="viewConct" class="btn btn-primary">View Contact</a>
	</p>-->
	<section>
	<div class="container">
	<div class="row">
	<div class="col-sm-4">
	<a class="navbar-brand" href="#"><img class="brand-logo" src="<?php echo e(asset('site/img/safetyfirstmed.png')); ?>" alt="logo"></a>
		<div class="contact-address">
			<div class="contact-address-details">
				<div class="address-icon relative-position text-center float-left">
					<i class="fas fa-map-marker-alt"></i>
				</div>
				<div class="address-details ul-li-block">
					<ul>
						<li><span><?php echo e(__('appraisal/template.Address')); ?>: </span><?php echo e(__('appraisal/template.Fulladres')); ?></li>
					</ul>
				</div>
			</div>
			<div class="contact-address-details">
				<div class="address-icon relative-position text-center float-left">
					<i class="fas fa-phone"></i>
				</div>
				<div class="address-details ul-li-block">
					<ul>
						<li><span><?php echo e(__('appraisal/template.Call')); ?>: </span><a href="tel:+971501021511">+971 50 102 1511</a></li>
					</ul>
				</div>
			</div>
			<div class="contact-address-details">
				<div class="address-icon relative-position text-center float-left">
					<i class="fas fa-envelope"></i>
				</div>
				<div class="address-details ul-li-block">
					<ul>
						<li><span><?php echo e(__('appraisal/template.Mail')); ?>: </span><a href="mailto:appraisals@safetyfirstmed.ae">appraisals@safetyfirstmed.ae</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 pl-5">
	<div class="widget-info-footer">
	<h4>Information</h4>
	<ul>
		<li><a href="/appraisal/about"><i class="fa fa-angle-right"></i>	<?php echo e(__('appraisal/template.AboutUs')); ?></a></li>
		<li><a href="/appraisal/terms"><i class="fa fa-angle-right"></i>	<?php echo e(__('appraisal/template.Terms')); ?></a></li>
		<li><a href="/appraisal/privacy"><i class="fa fa-angle-right"></i> <?php echo e(__('appraisal/template.Privacy')); ?>	 </a></li>
		<li><a href="/appraisal/shipping"><i class="fa fa-angle-right"></i> <?php echo e(__('appraisal/template.Shipping')); ?>	</a></li>
		<li><a href="/appraisal/refund"><i class="fa fa-angle-right"></i>	<?php echo e(__('appraisal/template.Refund')); ?></a></li>
		<!--<li><a href=""><i class="fa fa-angle-right"></i>	Careers</a></li>-->
		<li><a href="/appraisal/contact"><i class="fa fa-angle-right"></i>  <?php echo e(__('appraisal/template.ContactUs')); ?></a></li>
		<li><a href="<?php echo e(route('appraisal.user.login')); ?>"><i class="fa fa-angle-right"></i> Login </a></li>
		<li><a href="<?php echo e(route('appraisal.user.register')); ?>"><i class="fa fa-angle-right"></i> Register</a></li>
								
</ul>
	</div>
	</div>
	<div class="col-sm-4">
	<div class="widget-social-footer">
		<h4><?php echo e(__('appraisal/template.SocialMedia')); ?></h4>
		
		<ul>
			<li><a href="https://www.facebook.com/safetyfirstmed.auh/"><i aria-hidden="true" class="fab fa-facebook-square"></i></a></li>
			<li><a href="https://www.twitter.com/safetyfirstmed_"><i aria-hidden="true" class="fab fa-twitter-square"></i></a></li>
			<li><a href="https://www.linkedin.com/company/safetyfirstmedicalservices/"><i aria-hidden="true" class="fab fa-linkedin"></i></a></li>
			<li><a href="https://www.instagram.com/sfms.ae"><i aria-hidden="true" class="fab fa-instagram"></i></a></li>
		</ul>
		
		<div class="row mb-4">
		<div class="col-6">
		<img alt="Member of Dubai SME" src="<?php echo e(asset('site/img/logo_SME.png')); ?>">
		</div>
		
		<div class="col-6">
		<img alt="" src="<?php echo e(asset('site/img/khalifa-fund-member-320x126.png')); ?>">
		</div>
		</div>
		
		<img width="112" height="28" alt="" src="<?php echo e(asset('site/img/payment-e1596309739970.png')); ?>">
</div>
	</div>
	
	</div>
	
	
	</div>
	
	</section>

	<footer>
		<section id="footer-area" class="footer-area-section p-0">
			<div class="container">
				<div class="copy-right-menu">
					<div class="row">
						<div class="col-md-10">
							<div class="copy-right-text">
								<p>© 2023 - <?php echo e(__('appraisal/template.Copy1')); ?> <a href="#" title=""> AngeloRemedios</a>. <?php echo e(__('appraisal/template.Copy2')); ?></p>
							</div>
						</div> 							
					</div>
				</div>
			</div>
		</section>
	</footer>

		<script src="<?php echo e(asset('appraisals/js/jquery-2.1.4.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/owl.carousel.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/jarallax.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/jquery.magnific-popup.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/lightbox.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/jquery.meanmenu.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/scrollreveal.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/jquery.counterup.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/waypoints.min.js')); ?>"></script>
		<script src="<?php echo e(asset('appraisals/js/jquery-ui.js')); ?>"></script>		
		<script src="<?php echo e(asset('appraisals/js/script.js')); ?>"></script>
		<script>
		$(document).ready(function() { 
			$('#viewConct').click(function() {
				$('#contact-area').slideToggle("slow");
			});
		});
		</script>
<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?';
    var s = document.createElement('script');
    s.typ = 'text/javascript';
    s.asyn = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#0066a7;",
      "ctaText":"",
      "borderRadius":"25",
      "marginRight":"0",
      "marginBottom":"20",
      "marginRight":"30",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"Safety First",
      "brandSubTitle":"Typically replies within a day",
      "brandImg":"http://safetyfirstmed.ae/site/img/safetyfirstmed.png",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"",
      "backgroundColor":"#0066a7;",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"+971504973663"
  }
};
s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
<?php echo $__env->yieldContent('scripts'); ?>		



	</body>



	</html><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/template.blade.php ENDPATH**/ ?>