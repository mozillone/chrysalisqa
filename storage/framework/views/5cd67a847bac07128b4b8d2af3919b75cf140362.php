
<div class="people-list" id="people-list">
 <?php if(count($messages)>0): ?>
    <div class="search" style="text-align: center">
<i class="fa fa-search" aria-hidden="true"></i>
        <input class="search-input" type="text" value="" placeholder="Search..." id="myInput" onkeyup="myFunction()">
    </div>
    <?php endif; ?>
	<div class="row">
		<div class="message-header">
				<div class="col-md-3">
					Sender
				</div>
				<div class="col-md-6">
					Message
				</div>
				<div class="col-md-2 text-center">
					Related Product
				</div>
				<div class="col-md-1">
					Action
				</div>
		</div>
		</div>
		<hr>
    

    <div class="list front_chat" id="myUL">


        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inbox): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if(!is_null($inbox->thread)): ?>

		
        <div class="clearfix row" attr-to="<?php echo e($inbox->thread->conversation_id); ?>" >
            <a href="<?php echo e(URL::to('message')); ?><?php echo '/'.$inbox->thread->conversation_id; ?>">
<!-- 
               <li class="clearfix" attr-to="<?php echo e($inbox->withUser->id); ?>">
            <a href="<?php echo e(route('message.read', ['id'=>$inbox->withUser->id])); ?>"> -->
	<?php //echo "<pre>";print_r($inbox);die; ?>
            <div class="col-md-3">
				<ul>
					<li>
						<img src="<?php echo e(isset($inbox->withUser->user_img) && !empty($inbox->withUser->user_img)?url('/profile_img/'.$inbox->withUser->user_img):url('/profile_img/default.jpg')); ?>" alt="avatar" />		
					</li>
					<li>
						<p><?php echo e($inbox->withUser->display_name); ?></p>
						<span>25/05/2017</span>
					</li>
				
				</ul>
					
					<div><?php if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id): ?><span class="msg_cnt"></span><?php endif; ?></div>
                
			</div>
			<div class="col-md-6">
				
				<h4>Question about the Costume</h4>
				<div <?php if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id): ?> class="status" <?php else: ?> class="status_unbold" <?php endif; ?>>
                    <?php if(auth()->user()->id == $inbox->thread->sender->id): ?>
                    <?php endif; ?>
                    <span><?php echo substr($inbox->thread->message, 0, 35); ?><?php if(strlen($inbox->thread->message)>35): ?><?php echo e('...'); ?><?php endif; ?></span>
					
                </div>
				
				
				
			</div>
			<div class="col-md-2 text-center">
				<img src="https://d3ieicw58ybon5.cloudfront.net/ex/350.457/shop/product/4a713b3ec3d24d43b1ab750cb7e51800.jpg" >
				<p>Product #: <br>126484638</p>
				
			</div>
			<div class="col-md-1 text-center">
				<i class="fa fa-trash-o" aria-hidden="true"></i>
			
			</div>
            
         
                
               
          
            </a>
        </div>
		<hr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    </div>
   
</div>

