<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('chat/css/reset.css')); ?>">
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/chrysalis.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('chat/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container chat_divs">
    <div class="row">
        <div class="col-md-12 col-sm-12">
                <div class="list-sec-rm">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p class="list-sec-rm1 fav_costume">MY MESSAGES (<?php echo e($msgs_count[0]->count_dt); ?>)</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right pull-right back-link bck_mycnt">
                        <a href="<?php echo e(URL::to('/dashboard')); ?>">Back to My Account</a>
                    </div>
                </div>
        </div>
    </div>
  </div>
  <div class="container clearfix body message-chat-sec">
      <div  class="row">        
        <div class="col-md-2 col-sm-3">
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#Inbox" data-toggle="tab">Inbox (<?php echo e($msgs_inbox[0]->count_dt); ?>)<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li><a href="#Sent-msg" data-toggle="tab">Sent (<?php echo e($msgs_sent[0]->count_dt); ?>)<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
               
            </ul>
        </div>
        <div class="col-md-10 col-sm-9">
            <div class="clearfix messages-chat-list">
                <div class="tab-content">
                    <div class="tab-pane active" id="Inbox">
                    <?php if(count($conversations_inbox)>0): ?>
                        <div class="people-list" id="people-list">
                            <div class="row">
                                <div class="message-header">
                                    <div class="col-md-3 col-sm-3">
                                        Sender
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        Message
                                    </div>
                                    <div class="col-md-2 col-sm-2 text-center">
                                        Related Product
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        Action
                                    </div>
                                </div>
                            </div>
                            <div class="list front_chat" id="myUL">
                                <?php $__currentLoopData = $conversations_inbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inbox): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div class="clearfix row" attr-to="<?php echo e($inbox->conversation_id); ?>" >
                               
                                <a href="<?php if(!empty($inbox->type_id)): ?><?php echo e(URL::to('message')); ?><?php echo '/'.$inbox->conversation_id; ?> <?php else: ?> javascript:void(0); <?php endif; ?>">

                                    <div class="col-md-3 col-sm-4">
                                        <ul>
                                            <li>
                                                <img src="<?php echo e(isset($inbox->user_img) && !empty($inbox->user_img)?url('/profile_img/'.$inbox->user_img):url('/profile_img/default.jpg')); ?>" alt="avatar" />      
                                            </li>
                                            <li>
                                                <p><?php echo e($inbox->first_name); ?></p>
                                                <span><?php echo e(date('m-d-y', strtotime($inbox->created_at))); ?></span>
                                            </li>

                                        </ul>

                                        <div><?php if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id): ?><span class="msg_cnt"></span><?php endif; ?></div>

                                    </div>
                                    <div class="col-md-6 col-sm-5">

                                        <h4><?php echo e($inbox->subject); ?></h4>
                                        <div <?php if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id): ?> class="status" <?php else: ?> class="status_unbold" <?php endif; ?>>
                                        <?php if(auth()->user()->id == $inbox->id): ?>
                                        <?php endif; ?>
                                        <span><?php echo substr($inbox->message, 0, 35); ?><?php if(strlen($inbox->message)>35): ?><?php echo e('...'); ?><?php endif; ?></span>

                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-2 text-center">
                                    <?php
                                    if(isset($inbox->image) && !empty($inbox->image)){
                                        $path = '/costumers_images/Small/'.$inbox->image;
                                        if(file_exists(public_path($path))){
                                            $listingImage = URL::asset('/costumers_images/Small/'.$inbox->image);
                                        }else{
                                            $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                        }
                                    }else{
                                        $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    ?>
                                    <div class="msg_order_imge"><a href="<?php echo e(URL::to('/product').$inbox->url_key); ?>"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
                                    <p class="order_cnt"><?php if($inbox->type == "request_a_bag"): ?> Ref no <?php else: ?> Product Id <?php endif; ?> #: <br><?php echo e($inbox->type_id); ?></p>

                                </div>
                                </a>
                                <div class="col-md-1 col-sm-1 text-center">
                                <i class="fa fa-trash-o" id="<?php echo e($inbox->conversation_id); ?>" aria-hidden="true"></i>

                                </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </div>

                        </div>  
                        <?php else: ?>
                        <span id="inbox_nocon">No Conversations</span>
                        <?php endif; ?>
                    </div>
                   
                    <div class="tab-pane" id="Sent-msg">
                         <?php if(count($conversations_sent)>0): ?>
                            <div class="people-list" id="people-list">
                            <div class="row">
                                <div class="message-header">
                                    <div class="col-md-3 col-sm-3">
                                        Sender
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        Message
                                    </div>
                                    <div class="col-md-2 col-sm-2 text-center">
                                        Related Product
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        Action
                                    </div>
                                </div>
                            </div>
                            <div class="list front_chat" id="myUL">
                                <?php //echo "<pre>";print_r($conversations_sent);die; ?>
                                <?php $__currentLoopData = $conversations_sent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inbox): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div class="clearfix row" attr-to="<?php echo e($inbox->conversation_id); ?>" >
                                <a href="<?php echo e(URL::to('message')); ?><?php echo '/'.$inbox->conversation_id; ?>">

                                <div class="col-md-3 col-sm-4">
                                <ul>
                                <li>
                                <img src="<?php echo e(isset(Auth::user()->user_img) && !empty(Auth::user()->user_img)?url('/profile_img/resize/'.Auth::user()->user_img):url('/profile_img/default.jpg')); ?>" alt="avatar" />      
                                </li>
                                <li>
                                <p><?php echo e($inbox->first_name); ?></p>
                                <span><?php echo e(date('m-d-y', strtotime($inbox->created_at))); ?></span>
                                </li>

                                </ul>

                                <div><?php if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id): ?><span class="msg_cnt"></span><?php endif; ?></div>

                                </div>
                                <div class="col-md-6 col-sm-5">

                                <h4><?php echo e($inbox->subject); ?></h4>
                                <div <?php if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id): ?> class="status" <?php else: ?> class="status_unbold" <?php endif; ?>>
                                <?php if(auth()->user()->id == $inbox->id): ?>
                                <?php endif; ?>
                                <span><?php echo substr($inbox->message, 0, 35); ?><?php if(strlen($inbox->message)>35): ?><?php echo e('...'); ?><?php endif; ?></span>

                                </div>
                                </div>
                                <div class="col-md-2 col-sm-2 text-center">
                                    <?php
                                    if(isset($inbox->image) && !empty($inbox->image)){
                                    $path = '/costumers_images/Small/'.$inbox->image;
                                    if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/costumers_images/Small/'.$inbox->image);
                                    }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    ?>
                                    <div class="msg_order_imge"><a href="<?php echo e(URL::to('/product').$inbox->url_key); ?>"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
                                 <p class="order_cnt"><?php if($inbox->type == "request_a_bag"): ?> Ref no <?php else: ?> Product Id <?php endif; ?> #: <br><?php echo e($inbox->type_id); ?></p>

                                </div>
                                </a>
                                <div class="col-md-1 col-sm-1 text-center">
                                <i class="fa fa-trash-o" id="<?php echo e($inbox->conversation_id); ?>" aria-hidden="true"></i>

                                </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </div>

                        </div> 
                         <?php else: ?>
                    <span id="sent_nocon">No Conversations</span>
                    <?php endif; ?>
                    </div>                 
                   
                </div>
            
          </div>
            </div>
    </div>   
  </div> <!-- end container -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/dashboard.js')); ?>"></script>
<script type="text/javascript">
    $(document).on('click','.fa-trash-o',function(){
        var id=$(this).attr('id');
        swal({
            title: "Are you sure want to delete?",
            text: "You will not be able to recover this Listing!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(result){
            if(result){
                $.ajax({
                 url: "<?php echo e(URL::to('conversation/delete')); ?>",
                 type: "POST",
                 data: {'conversation_id':id},
                 success: function(data){
                    if (data == "success") {
                        location.reload();
                        }
                 }
             });
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>