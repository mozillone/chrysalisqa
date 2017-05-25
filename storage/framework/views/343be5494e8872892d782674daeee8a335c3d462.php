<?php $__env->startSection('content'); ?>
    <div class="chat-history">
        <ul id="talkMessages">

            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if($message->sender->id == auth()->user()->id): ?>
                    <li class="clearfix" id="message-<?php echo e($message->id); ?>">
                        <div class="message-data align-right">
                            <span class="message-data-time" ><?php echo e($message->humans_time); ?> ago</span> &nbsp; &nbsp;
                            <span class="message-data-name" ><?php echo e($message->sender->name); ?></span>
                        </div>
                        <div class="message other-message float-right">
                            <?php echo e($message->message); ?>

                        </div>
                    </li>
                <?php else: ?>

                    <li id="message-<?php echo e($message->id); ?>">
                        <div class="message-data">
                            <span class="message-data-name"><?php echo e($message->sender->name); ?></span>
                            <span class="message-data-time"><?php echo e($message->humans_time); ?> ago</span>
                        </div>
                        <div class="message my-message">
                            <?php echo e($message->message); ?>

                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


        </ul>

    </div> <!-- end chat-history -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.chat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>