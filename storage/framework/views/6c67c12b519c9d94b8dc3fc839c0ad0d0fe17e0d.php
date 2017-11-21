<?php //echo "<pre>";print_r($message->message);die; ?>
<li class="clearfix" id="message-<?php echo e($message->id); ?>">
<div class="message-data row">
<div class="col-md-3 col-sm-3 col-xs-12">
<span class="message-data-name" ><?php if(!empty(Auth::user()->user_img)): ?> <img src="<?php echo e(asset('profile_img/resize')); ?><?php echo '/'.Auth::user()->user_img; ?>"> <?php else: ?> <img src="<?php echo e(asset('profile_img/default.jpg')); ?>"> <?php endif; ?></span>
<span class="message-data-name user-name" ><?php echo e(Auth::user()->display_name); ?></span>
</div>
<div class="col-md-7 col-sm-7 col-xs-12">
<div class="message other-message">
<?php echo e($message->message); ?>

</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-12">
<span class="message-data-time" >1 Second ago</span> &nbsp; &nbsp;
</div>
</div>
</li>
