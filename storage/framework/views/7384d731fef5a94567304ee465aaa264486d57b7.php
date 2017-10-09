<?php $__env->startSection('content'); ?>

<table style="width:100%;font-weight:normal;border-collapse:collapse;border:0;margin:0;padding:0;font-familfffffl,sans-serif;margin-top:0">
				<tbody>
					<tr>
						<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#fff;">
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi <?php echo e($name); ?>,<br />
						</h1>

						<div>Chrysalis team has Edited your costume name as <strong><?php echo e($costume_name); ?></strong></div>
						</td>
					</tr>
				</tbody>
			</table> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/email_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>