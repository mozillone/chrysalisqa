<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/chrysalis.css')); ?>">
		<link href="<?php echo e(asset('assets/frontend/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
		<!--<link rel="stylesheet" href="<?php echo e(asset('chat/css/reset.css')); ?>">-->
		<link rel="stylesheet" href="<?php echo e(asset('chat/css/style.css')); ?>">
	</head>
	<body>
		<?php echo $__env->make('frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('frontend.partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="container ">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 chat-tl-dv">
					<div class="list-sec-rm">
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume">MY MESSAGES (0)</p>
						</div>
						<div class="col-md-6 text-right pull-right back-link">
							<a href="/dashboard">Back to My Account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container clearfix message-chat-sec">
			<div class="row">
				<div class="col-md-2 col-xs-12">
					<ul class="nav nav-tabs tabs-left">
						<li id="inbox_sidebar" class="active"><a href="<?php echo e(URL::to('conversations')); ?>" data-toggle="tab">Inbox<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						<li id="sent_sidebar" ><a href="<?php echo e(URL::to('conversations')); ?>" data-toggle="tab">Sent<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="col-md-10 col-xs-12">
					<div class="chat conversation-chat">
						<div class="chat-header clearfix">
							<?php //echo $user;die; ?>
							<div class="chat-about">
								<h4><?php echo e(@$get_con->subject); ?></h4>
								<?php if(isset($user)): ?>
								<div class="chat-with">Between you and <span class="message-data-name user-name"> <?php echo e(@$user->display_name); ?> </span></div>
								<?php else: ?>
								<div class="chat-with">No Thread Selected</div>
								<?php endif; ?>
							</div>
							<ul class="user-info-sec">
                                <?php
                                if(isset($get_con->image) && !empty($get_con->image)){
                                    $path = '/costumers_images/Small/'.$get_con->image;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/costumers_images/Small/'.$get_con->image);
                                    }else{
                                        $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                }
                                ?>
								<div class="msg_order_imge"><a href="<?php echo e(URL::to('/product').$get_con->url_key); ?>"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
								<li><p class="orders_singles_views"><?php if($get_con->type == 'request_a_bag'): ?> Ref no <?php else: ?> Product <?php endif; ?>#: <br><?php echo e(@$get_con->type_id); ?></p></li>
							</ul>
						</div> <!-- end chat-header -->
						<?php echo $__env->yieldContent('content'); ?>
						<div class="chat-message clearfix">
							<span> <?php if(!empty(Auth::user()->user_img)): ?> <img src="<?php echo e(asset('profile_img/resize')); ?><?php echo '/'.Auth::user()->user_img; ?>"> 
							<?php else: ?> <img src="<?php echo e(asset('profile_img/default.jpg')); ?>"> <?php endif; ?> </span>
							<span class="message-data-name user-name"> <?php echo e(Auth::user()->display_name); ?> </span> 
							<form action="" method="post" id="talkSendMessage">
								<textarea name="message-data" id="message-data" placeholder ="Type your message" rows="3"></textarea>
								<input type="hidden" name="_id" value="<?php echo e(@request()->route('id')); ?>">
								<button type="submit">Reply</button>
							</form>
						</div> <!-- end chat-message -->
					</div> <!-- end chat -->
				</div>
			</div>
		</div> <!-- end container -->
	</section>
	<?php echo $__env->make('frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script>
		var __baseUrl = "<?php echo e(url('/')); ?>"
	</script>
	<script src="<?php echo e(asset('js/jquery-2.2.4.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset('angular/lib/angular.js')); ?>"></script>
	<script src="<?php echo e(asset('angular/lib/angular-datatables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/datatables/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('angular/lib/angular-datatables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('angular/app.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/frontend/js/custom.js')); ?>"></script>
	<script src="<?php echo e(asset('angular/directives/datepicker.js')); ?>"></script>
	
	<script src="<?php echo e(asset('chat/js/handlebars.min.js')); ?>"></script>
	<script src="<?php echo e(asset('chat/js/talk.js')); ?>"></script>
    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
		}
        var msgshow = function(data) {
            var html = '<li id="message-' + data.id + '">' +
			'<div class="message-data row">' +
			'<div class="col-md-3 col-sm-3 col-xs-12">' +
			'<span class="message-data-name" >' +
			'<?php if(!empty('+ Auth::user()->user_img +')): ?> '+
			'<img src="<?php echo e(asset("profile_img/resize")); ?><?php echo "/".'+ Auth::user()->user_img +' ?>"> ' +
			'<?php else: ?>' + 
			'<img src="<?php echo e(asset("profile_img/default.jpg")); ?>"> <?php endif; ?>' +
			'</span>' +
			'<span class="message-data-name user-name1111" >'+ data.sender.display_name +'</span>' +
			'</div>' +
			'<div class="col-md-7 col-sm-7 col-xs-12">' +
			'<div class="message other-message">' +
			'' + data.message +'' +
			'</div>' +
			'</div>' +
			'<div class="col-md-2 col-sm-2 col-xs-12">' +
			'<span class="message-data-time" >1 Second ago</span> &nbsp; &nbsp;' +
			'</div>' +
			'</div> ' +       
			'</li>';
            $('#talkMessages').append(html);
		}
        $('#sent_sidebar').click(function(){
			//$('#inbox_sidebar').removeClass('active');
			//$('#sent_sidebar').addClass('active');
			location.href ="<?php echo e(URL::to('conversations#Sent-msg')); ?>";
		});
        $('#inbox_sidebar').click(function(){
			location.href ="<?php echo e(URL::to('conversations#Inbox')); ?>";
		});
	</script>
    <?php echo talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]); ?>

</body>
</html>