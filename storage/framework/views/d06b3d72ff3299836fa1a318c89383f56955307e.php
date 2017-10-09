<?php $__env->startSection('content'); ?>
    <div class="chat-history">
        <ul id="talkMessages">
            <?php 	//echo "<pre>";print_r($user);die; ?>
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if($message->sender->id == auth()->user()->id): ?>
                    <li class="clearfix" id="message-<?php echo e($message->id); ?>">
                        <div class="message-data row">
							<div class="col-md-3 col-sm-3 col-xs-12 ">
									<span class="message-data-name" ><?php if(!empty($message->sender->user_img)): ?> <img src="<?php echo e(asset('profile_img/resize')); ?><?php echo '/'.$message->sender->user_img; ?>"> <?php else: ?> <img src="<?php echo e(asset('profile_img/default.jpg')); ?>"> <?php endif; ?></span>
									<span class="message-data-name user-name" ><?php echo e($message->user_name); ?></span>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="message other-message">
									<?php echo e($message->message); ?>

								</div>
							</div>
							<div class="col-md-2 col-sm-2  col-xs-12">
									<span class="message-data-time" ><?php echo e($message->humans_time); ?> ago</span> &nbsp; &nbsp;
							</div>
                            
                            
                            
                        </div>
						
                        
                    </li>
					<hr>
                <?php else: ?>

                    <li id="message-<?php echo e($message->id); ?>">
                        <div class="message-data row">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<span class="message-data-name"><?php if(!empty($message->sender->user_img)): ?> <img src="<?php echo e(asset('profile_img/resize')); ?><?php echo '/'.$message->sender->user_img; ?>"> <?php else: ?> <img src="<?php echo e(asset('profile_img/default.jpg')); ?>"> <?php endif; ?></span>
								<span class="message-data-name user-name"><?php echo e($message->user_name); ?></span>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="message my-message">
									<?php echo e($message->message); ?>

								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<span class="message-data-time"><?php echo e($message->humans_time); ?> ago</span>
							</div>
                            
                            
                        </div>
                        
                    </li>
					<hr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


        </ul>

    </div> <!-- end chat-history -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.chat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>