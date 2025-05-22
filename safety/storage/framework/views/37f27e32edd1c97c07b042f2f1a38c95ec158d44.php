<!doctype html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php if(app()->getLocale()=='en'): ?><?php echo e('ltr'); ?><?php else: ?><?php echo e('rtl'); ?><?php endif; ?>">



<head>

	<meta charset="UTF-8">

	<title></title>



	<!-- Mobile Specific Meta -->

	<meta name="viewport" content="width=device-width, initial-scale=1">



	<link rel="stylesheet" href="<?php echo e(asset('products/css/owl.carousel.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/fontawesome-all.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/flaticon.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/meanmenu.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/bootstrap.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/video.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/lightbox.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/animate.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/progess.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/style.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/responsive.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('products/css/custom.css')); ?>">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.14.0/css/flag-icons.min.css"/>





	<style>

		.brand-logo {

			width: 250px;

		}



		@media  only screen and (max-width: 700px) {

			.brand-logo {

				width: 150px;

			}

		}

	</style>



</head>



<body>



	<div id="preloader"></div>



	<!-- Start of Header section

		============================================= -->

	<header>

		<div id="main-menu" class="main-menu-container header-style-2">

			<div class="main-menu">

				<div class="container">

					<nav class="navbar navbar-expand-lg navbar-light bg-none">

						<a class="navbar-brand" href="http://safetyfirstmed.ae/">
							<img class="brand-logo" src="<?php echo e(asset('products/img/safetyfirstmed.png')); ?>" alt="logo">
						</a>

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

							<span class="navbar-toggler-icon"></span>

						</button>

						<div class="collapse navbar-collapse" id="navbarNavDropdown">

							<ul class="navbar-nav ml-auto">

								<li class="nav-item active">

									<a class="nav-link" href="<?php echo e(asset('product/')); ?>"><?php echo app('translator')->get('product/template.Home'); ?> </a>

								</li>

								<li class="nav-item dropdown">

									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>

									<div class="dropdown-menu" aria-labelledby="navbarDropdown">

										<a class="dropdown-item" href="https://bnhealthy.ae/" target="_blank"><?php echo app('translator')->get('product/template.BNHealthy'); ?></a>

										<a class="dropdown-item" href="<?php echo e(asset('product/j-tip')); ?>"><?php echo app('translator')->get('product/template.Jtip'); ?></a>

										<a class="dropdown-item" href="<?php echo e(asset('product/victor')); ?>"><?php echo app('translator')->get('product/template.Victor'); ?></a>
										
										<a class="dropdown-item" href="#"><?php echo app('translator')->get('product/template.Pharma'); ?></a>


									</div>

								</li>

								

								<li class="nav-item">

									<a class="nav-link" href="<?php echo e(asset('product/contact')); ?>"><?php echo app('translator')->get('product/template.Inquire'); ?></a>

								</li>

							<!--<li class="nav-item">

									<a href="<?php echo e(asset('product/paynow')); ?>" class="nav-link"><?php echo app('translator')->get('product/template.PayNow'); ?></a>

								</li>

								<li class="nav-item">

									<a class="nav-link" href="#" title="Arabic"><span class="fi fi-sa" style="font-size:28px"></span></a>
									
								</li> 		-->						

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
						<li><span><?php echo e(__('product/template.Address')); ?>: </span><?php echo e(__('product/template.Fulladres')); ?></li>
					</ul>
				</div>
			</div>
			<div class="contact-address-details">
				<div class="address-icon relative-position text-center float-left">
					<i class="fas fa-phone"></i>
				</div>
				<div class="address-details ul-li-block">
					<ul>
						<li><span><?php echo e(__('product/template.Call')); ?>: </span><a href="tel:+971503398909">+971 50 339 8909</a></li>
					</ul>
				</div>
			</div>
			<div class="contact-address-details">
				<div class="address-icon relative-position text-center float-left">
					<i class="fas fa-envelope"></i>
				</div>
				<div class="address-details ul-li-block">
					<ul>
						<li><span><?php echo e(__('product/template.Mail')); ?>: </span><a href="mailto:supplies@safetyfirstmed.ae">supplies@safetyfirstmed.ae</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 pl-5">
	<div class="widget-info-footer">
		<h4><?php echo e(__('product/template.Information')); ?></h4>
		<ul>
		<li><a href="/product/about"><i class="fa fa-angle-right"></i>	<?php echo e(__('product/template.AboutUs')); ?></a></li>
		<li><a href="/product/terms"><i class="fa fa-angle-right"></i>	<?php echo e(__('product/template.Terms')); ?></a></li>
		<li><a href="/product/privacy"><i class="fa fa-angle-right"></i> <?php echo e(__('product/template.Privacy')); ?>	 </a></li>
		<li><a href="/product/shipping"><i class="fa fa-angle-right"></i> <?php echo e(__('product/template.Shipping')); ?>	</a></li>
		<li><a href="/product/refund"><i class="fa fa-angle-right"></i>	<?php echo e(__('product/template.Refund')); ?></a></li>
		<!--<li><a href=""><i class="fa fa-angle-right"></i>	Careers</a></li>-->
		<li><a href="/product/contact"><i class="fa fa-angle-right"></i>  <?php echo e(__('product/template.ContactUs')); ?></a></li>
								
</ul>
	</div>
	</div>
	<div class="col-sm-4">
	<div class="widget-social-footer">
		<h4><?php echo e(__('product/template.SocialMedia')); ?></h4>
		
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
				<!-- /footer-widget-content -->	

				<div class="copy-right-menu">

					<div class="row">

						<div class="col-md-12">

							<div class="copy-right-text">

								<p>© 2023 - <?php echo e(__('product/template.Copy1')); ?> <a href="#" title=""> AngeloRemedios</a>. <?php echo e(__('product/template.Copy2')); ?></p>

							</div>

						</div>

	

					</div>

				</div>

			</div>

		</section>

	</footer>

 			<script src="<?php echo e(asset('products/js/jquery-2.1.4.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/bootstrap.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/popper.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/owl.carousel.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/jarallax.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/jquery.magnific-popup.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/lightbox.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/jquery.meanmenu.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/scrollreveal.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/jquery.counterup.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/waypoints.min.js')); ?>"></script>
			<script src="<?php echo e(asset('products/js/jquery-ui.js')); ?>"></script>		
			<script src="<?php echo e(asset('products/js/script.js')); ?>"></script>
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

	

	</html><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/product/template.blade.php ENDPATH**/ ?>