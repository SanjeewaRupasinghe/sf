<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php if(app()->getLocale()=='en'): ?><?php echo e('ltr'); ?><?php else: ?><?php echo e('rtr'); ?><?php endif; ?>">
<head>
<title>Safety First Medical Services</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.png" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('main/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('main/css/animsition.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('main/css/theme.css')); ?>">

</head>
<body id="body" class="animsition">
	<div class="loader-container" id="loader-container">
		<img class="loader-image" src="<?php echo e(asset('main/image/giphy.webp')); ?>" alt="Loading..." />
		<div class="loading-percentage">0%</div>
	</div>
	<header id="header" class="menu-align-right">
		<div class="header-inner tt-wrap">
			<div id="logo">
				<a href="index.html" class="logo-dark"><img src="<?php echo e(asset('main/image/safetyfirstmed.png')); ?>" alt="logo"></a>
				<a href="index.html" class="logo-light"><img src="<?php echo e(asset('main/image/safetyfirstmed.png')); ?>" alt="logo"></a>
				<!-- for small screens -->
				<a href="index.html" class="logo-dark-m"><img src="<?php echo e(asset('main/image/safetyfirstmed.png')); ?>" alt="logo"></a>
				<a href="index.html" class="logo-light-m"><img src="<?php echo e(asset('main/image/safetyfirstmed.png')); ?>" alt="logo"></a>
			</div>
		</div>
	</header>

<section>
<div class="row">
<div class="col-sm-4 pr-0">
<a href="course/" class="cc-item">
<div class="cc-image bg-image main-page-img" style="background-image: url(<?php echo e(asset('main/image/1.webp')); ?>); background-position: 50% 50%;"></div>
<div class="cc-caption center cc-caption-lg m0p0">
<div class="card">
<div class="card-face">
<h2 class="cc-title"><?php echo e(__('main/index.course')); ?></h2>
</div>
<div class="card-face back">
<div class="row">
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.coursename1')); ?></h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.coursename2')); ?>  </h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.coursename3')); ?>  </h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.coursename4')); ?>   </h2></div>
</div>
</div>
</div>
</div>
</a>
</div>
<div class="col-sm-4 pl-0 pr-0">
<a href="product/" class="cc-item abc">
<div class="cc-image bg-image main-page-img" style="background-image: url(<?php echo e(asset('main/image/3.webp')); ?>); background-position: 50% 50%;"></div>
<div class="cc-caption center cc-caption-lg m0p0">
<div class="card">
<div class="card-face">
<h2 class="cc-title"><?php echo e(__('main/index.product')); ?></h2>
</div>
<div class="card-face back">
<div class="row">
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.productname1')); ?></h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.productname2')); ?></h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.productname3')); ?></h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.productname4')); ?></h2></div>
</div>
</div>
</div>
</div>
</a>
</div>
<div class="col-sm-4 pl-0">
<a href="appraisal/" class="cc-item">
<div class="cc-image bg-image main-page-img" style="background-image: url(<?php echo e(asset('main/image/2.webp')); ?>); background-position: 50% 50%;"></div>
<div class="cc-caption center cc-caption-lg m0p0">
<div class="card">
<div class="card-face">
<h2 class="cc-title"><?php echo e(__('main/index.appraisals')); ?></h2>
</div>
<div class="card-face back">
<div class="row">
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.appraisalname1')); ?>  </h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.appraisalname2')); ?> </h2></div>
<div class="col-12"><h2 class="cc-title" style="color: #ffffff;margin-top:15px;font-size:25px;"><?php echo e(__('main/index.appraisalname3')); ?> </h2></div>
</div>
</div>
</div>
</div>
</a>
</div>
</div>
</section>

<script src="<?php echo e(asset('main/js/jquery.min.js')); ?>"></script> <!-- jquery JS (https://jquery.com) -->
<script src="<?php echo e(asset('main/js/bootstrap.min.js')); ?>"></script> <!-- bootstrap JS (http://getbootstrap.com) -->
<!-- Libs and Plugins JS -->
<script src="<?php echo e(asset('main/js/animsition.min.js')); ?>"></script>
<!-- Animsition JS (http://git.blivesta.com/animsition/) -->
<script src="<?php echo e(asset('main/js/jquery.easing.min.js')); ?>"></script>

<script src="<?php echo e(asset('main/js/theme.js')); ?>"></script>
<script>
// show the loader
function showLoader() {
document.getElementById("loader-container").style.display = "flex";
}
// hide the loader
function hideLoader() {
document.getElementById("loader-container").style.display = "none";
}
// loading with a percentage
let percentage = 0;
const loadingInterval = setInterval(function () {
if (percentage < 100) {
percentage += 1;
document.querySelector(".loading-percentage").textContent = percentage + "%";
} else {
clearInterval(loadingInterval);
hideLoader();
}
}, 30);
// page content show
function showPageContent() {
document.body.style.display = "block";
}
// check loaded
window.onload = function () {
showLoader();
showPageContent();
};
</script>


</body>
</html><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/main/index.blade.php ENDPATH**/ ?>