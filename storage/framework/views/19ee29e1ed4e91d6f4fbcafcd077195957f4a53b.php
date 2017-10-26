<?php $__env->startSection('content'); ?>

<table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
	<tbody>
		<tr>
			<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#fff;">

				<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Dear <?php if(isset($username) && !empty($username)): ?> <?php echo e($username); ?> <?php else: ?> Admin <?php endif; ?>,<br />
				</h1>
			
				<?php if(isset($bag_url) && !empty($bag_url)): ?>
	        		<div>You have received request a bag from <?php echo e($cus_name); ?>. <a href="<?php echo e(url('/')); ?><?php echo e($bag_url); ?>" target="_blank">Click here</a> to view.</div>
	        	<?php else: ?>
	        		<div>Your bag is on the way!</div>
	        	<?php endif; ?>
			
			</td>
		</tr>
	</tbody>
</table> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/email_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>