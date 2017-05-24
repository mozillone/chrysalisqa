
<div class="people-list" id="people-list">
 <?php if(count($messages)>0): ?>
    <div class="search" style="text-align: center">
<i class="fa fa-search" aria-hidden="true"></i>
        <input class="search-input" type="text" value="" placeholder="Search..." id="myInput" onkeyup="myFunction()">
    </div>
    <?php endif; ?>
    

    <ul class="list front_chat" id="myUL">


        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inbox): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if(!is_null($inbox->thread)): ?>


        <li class="clearfix" attr-to="<?php echo e($inbox->thread->conversation_id); ?>" >
            <a href="<?php echo e(URL::to('message')); ?><?php echo '/'.$inbox->thread->conversation_id; ?>">
<!-- 
               <li class="clearfix" attr-to="<?php echo e($inbox->withUser->id); ?>">
            <a href="<?php echo e(route('message.read', ['id'=>$inbox->withUser->id])); ?>"> -->

            
            <img src="<?php echo e(isset($inbox->withUser->user_img) && !empty($inbox->withUser->user_img)?url('/profile_img/'.$inbox->withUser->user_img):url('/profile_img/default.jpg')); ?>" alt="avatar" />
            <div class="about">
                <div><?php if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id): ?><span class="msg_cnt"></span><?php endif; ?></div>
                <div><?php echo e($inbox->withUser->display_name); ?></div>
                <div <?php if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id): ?> class="status" <?php else: ?> class="status_unbold" <?php endif; ?>>
                    <?php if(auth()->user()->id == $inbox->thread->sender->id): ?>
                        <span class="fa fa-reply"></span>
                    <?php endif; ?>
                    <span><?php echo substr($inbox->thread->message, 0, 35); ?><?php if(strlen($inbox->thread->message)>35): ?><?php echo e('...'); ?><?php endif; ?></span>
                </div>
            </div>
            </a>
        </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    </ul>
   
</div>

