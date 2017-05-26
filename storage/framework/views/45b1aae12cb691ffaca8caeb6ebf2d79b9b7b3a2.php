<li class="clearfix" id="message-<?php echo e($message->id); ?>">
    <div class="message-data align-right">
        <span class="message-data-time" ><?php echo e($message->humans_time); ?> ago</span> &nbsp; &nbsp;
        <span class="message-data-name" ><?php echo e($message->sender->name); ?></span>
    </div>
    <div class="message other-message float-right">
        <?php echo e($message->message); ?>

    </div>
</li>
