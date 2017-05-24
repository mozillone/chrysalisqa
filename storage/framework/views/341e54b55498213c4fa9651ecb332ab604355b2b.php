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
    
    <div class="chat">
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
      </div> <!-- end chat-header -->
      
      <?php echo $__env->yieldContent('content'); ?>
      
      <div class="chat-message clearfix">
      <form action="" method="post" id="talkSendMessage">
            <textarea name="message-data" id="message-data" placeholder ="Type your message" rows="3"></textarea>
            <input type="hidden" name="_id" value="<?php echo e(@request()->route('id')); ?>">
            <button type="submit">Send</button>
      </form>

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->


      <script>
          var __baseUrl = "<?php echo e(url('/')); ?>"
      </script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>



        <script src="<?php echo e(asset('chat/js/talk.js')); ?>"></script>

    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
        }

        var msgshow = function(data) {
            var html = '<li id="message-' + data.id + '">' +
            '<div class="message-data">' +
            '<span class="message-data-name">' + data.sender.name + '</span>' +
            '<span class="message-data-time">1 Second ago</span>' +
            '</div>' +
            '<div class="message my-message">' +
            data.message +
            '</div>' +
            '</li>';

            $('#talkMessages').append(html);
        }

    </script>
    <?php echo talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]); ?>


  </body>
</html>
