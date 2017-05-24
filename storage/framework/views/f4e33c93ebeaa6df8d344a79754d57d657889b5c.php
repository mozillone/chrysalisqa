<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Talk Message</title>
    
    
    <link rel="stylesheet" href="<?php echo e(asset('chat/css/reset.css')); ?>">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo e(asset('chat/css/style.css')); ?>">

    
    
    
  </head>

  <body>
<div class="header">
    <div class="container header-brand">
        <a href="<?php echo e(url('/')); ?>" class="brand">Talk Message</a>
    </div>
</div>
      <div class="container clearfix body">
   <?php echo $__env->make('partials.peoplelist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <!-- <div class="chat">
      <div class="chat-header clearfix">
        <?php if(isset($user)): ?>
            <img src="<?php echo e(@$user->avatar); ?>" alt="avatar" />
        <?php endif; ?>
        <div class="chat-about">
            <?php if(isset($user)): ?>
                <div class="chat-with"><?php echo e('Chat with ' . @$user->name); ?></div>
            <?php else: ?>
                <div class="chat-with">No Thread Selected</div>
            <?php endif; ?>
        </div>
        <i class="fa fa-star"></i>
      </div> 
      
      <?php echo $__env->yieldContent('content'); ?>
      
      
      
    </div>  -->
    
  </div> <!-- end container -->
  </body>
</html>
