<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
</style>
<div class="container press-page">
	<div class="row">
		<div class="col-md-12">
			<div class="progressbar_main request-bag">
				<h2>PRESS</h2>
			</div>
		</div>
		<!-- Posts listing -->
		<div class="col-md-9 col-sm-9 col-xs-12 press-articles">
			<p class="press-mobile-head hidden-lg hidden-md">Please take a moment to review the FAQs below. We might have already answered your question!</p>
			<?php
                $count=count($posts);
                if($count > 0 ){ ?>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<?php
					if(isset($value->user_img) && !empty($value->user_img)){
						$path = '/press_images/'.$value->user_img;
						if(file_exists(public_path($path))){
							$listingImage = URL::asset('/press_images/'.$value->user_img);
                            }else{
							$listingImage = URL::asset('/press_images/listing_placeholder.png');
						}
                        }else{
						$listingImage = URL::asset('/press_images/listing_placeholder.png');
					}
				?>
                <div class="media">
                    <div class="media-left" >
                        <div class="press_div_img" style="background: url(<?php echo $listingImage; ?>)">
						</div>
					</div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo e($value->press_title); ?></h4>
                        <span><?php echo e(date('d M Y', strtotime($value->created_at))); ?></span>
                        <strong><a href="<?php echo e($value->source); ?>" target="_blank" ><?php echo e($value->source); ?></a></strong>
                        <p><?php echo $value->press_desc; ?>​​​​​​​</p>
					</div>
				</div>
				<hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <div style="float:right;">
                    <a href="<?php echo e($posts->links()); ?>" class="press-link"><?php echo e($posts->links()); ?></a>
				</div>
                <?php } else { ?>
                <div> No Results Found</div>
			<?php } ?>
		</div>
		<!-- end posts listing -->
		<div class="col-md-3 col-sm-3 col-xs-12 hidden-xs  press-articles_right">
			<div class="press-filters">
				<h2>FILTERS</h2>
				<p><a href="/press">Most Recent</a></p>
				<p>Most Popular</p>
				<p>Most Shared</p>
				<h2>RECENT BLOG POSTS</h2>
				<?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogPost): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<?php
					if(isset($blogPost->img) && !empty($blogPost->img)){
						$path = '/blog_images/filter_thumbs/'.$blogPost->img;
						if(file_exists(public_path($path))){
							$listingImage = URL::asset('/blog_images/filter_thumbs/'.$blogPost->img);
                            }else{
							$listingImage = URL::asset('/press_images/blog_thumb.png');
						}
                        }else{
						$listingImage = URL::asset('/press_images/blog_thumb.png');
					}
				?>
				<div class="media">
					<div class="media-left" >
						<div class="press-rght_blogs" style="background: url(<?php echo $listingImage; ?>)">
						</div>
					</div>
					<div class="media-body">
						<span><?php echo e(date('d F y', strtotime($blogPost->created_at))); ?></span>
						<a href="/blog/<?php echo e($blogPost->id); ?>"><h5 class="media-heading blog-title"><?php echo e($blogPost->title); ?></h5></a>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</div>
		</div>
		
		
		<div class="col-md-3 col-sm-3 col-xs-12 hidden-md hidden-sm hidden-lg mobile-special-view-recent-blog">
		
					<div class="press-filters">
				<h2>RECENT BLOG POSTS</h2>
				<?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogPost): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<?php
					if(isset($blogPost->img) && !empty($blogPost->img)){
						$path = '/blog_images/filter_thumbs/'.$blogPost->img;
						if(file_exists(public_path($path))){
							$listingImage = URL::asset('/blog_images/filter_thumbs/'.$blogPost->img);
                            }else{
							$listingImage = URL::asset('/press_images/blog_thumb.png');
						}
                        }else{
						$listingImage = URL::asset('/press_images/blog_thumb.png');
					}
				?>
				<div class="media">
					<div class="media-left" >
						<div class="press-rght_blogs" style="background: url(<?php echo $listingImage; ?>)">
						</div>
					</div>
					<div class="media-body">
						<span><?php echo e(date('d F y', strtotime($blogPost->created_at))); ?></span>
						<a href="/blog/<?php echo e($blogPost->id); ?>"><h5 class="media-heading blog-title"><?php echo e($blogPost->title); ?></h5></a>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</div>
			</div>
		
		
		
		
		
		
		
		<div class="panel-group-mobile-cms  " id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-group-mobile-cms hidden-md hidden-lg hidden-sm" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							FILTER PRESS <i class="more-less glyphicon glyphicon-plus"></i>
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" class="hidden-md hidden-lg hidden-sm">
					<div class="panel-body">
						<div class="press-filters">
							<p><a href="press">Most Recent</a></p>
							<p>Most Popular</p>
							<p>Most Shared</p>
							<h2>RECENT BLOG POSTS</h2>
							<?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogPost): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<div class="media">
								<div class="media-left">
									<img src="<?php if(isset($blogPost->img) && !empty($blogPost->img)): ?><?php echo e('../blog_images/'.$blogPost->img); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?>" class="media-object" style="width:60px">
								</div>
								<div class="media-body">
									<span><?php echo e(date('d F Y', strtotime($blogPost->created_at))); ?></span>
									<a href="/blog/<?php echo e($blogPost->id); ?>"><h5 class="media-heading"><?php echo e($blogPost->title); ?></h5></a>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- panel-group-mobile-cms -->
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>