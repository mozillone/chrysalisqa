<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('<?php echo e($talk__appKey); ?>', <?php echo $talk__options; ?>);

    <?php if(!empty($talk__userChannel['name'])): ?>
    var userChannel = pusher.subscribe('<?php echo e($talk__userChannel['name']); ?>');
    userChannel.bind('talk-send-message', function(data) {
        <?php $__currentLoopData = $talk__userChannel['callback']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $callback): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php echo $callback . '(data);'; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    });

    <?php endif; ?>

    <?php if(!empty($talk__conversationChannel['name'])): ?>
    var conversationChannel = pusher.subscribe('<?php echo e($talk__conversationChannel['name']); ?>');
    conversationChannel.bind('talk-send-message', function(data) {
        <?php $__currentLoopData = $talk__conversationChannel['callback']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $callback): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php echo $callback . '(data);'; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    });
    <?php endif; ?>
</script>
