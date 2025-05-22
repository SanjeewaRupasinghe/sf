<html xmlns='https://www.w3.org/1999/xhtml'>
<head></head>
<body>

<form action='https://checkout.payfort.com/FortAPI/paymentPage' method='post' name='frm'>
<?php $__currentLoopData = $requestParams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $a=htmlentities($a); $b=htmlentities($b); ?>
    <input type='hidden' name='<?php echo e($a); ?>' value='<?php echo e($b); ?>'>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script type='text/javascript'>
document.frm.submit();
</script>
</form>
</body>
</html><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/main/paynow.blade.php ENDPATH**/ ?>