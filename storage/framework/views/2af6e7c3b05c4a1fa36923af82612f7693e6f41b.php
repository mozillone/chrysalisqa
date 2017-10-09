<!DOCTYPE html>
<html>
<head>
	 <!-- head -->
<?php echo $__env->make('frontend.email_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
 <!-- end head -->
<body style="margin:0; padding:0; box-sizing:border-box; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; font-size:14px;">
<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

<table style="text-align:center;  padding:20px 40px 40px 40px; width:800px; margin:0px auto 0px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; background: url('https://image.ibb.co/kDBD5v/bg.png');    background-size: 100% 100%;">
<tr>
	<th style="color:#000; font-size:50px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;"><a href="<?php echo e(URL::to('/')); ?>"><img class="img-responsive" src="<?php echo e(URL::to('/')); ?>/img/brand.png"  width="150px;"></a></th>
</tr>

</table>




<?php echo $__env->yieldContent('content'); ?>

<!-- footer -->
<?php echo $__env->make('frontend.email_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->


</body>
</html>