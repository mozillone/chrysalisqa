<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.carousel.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $pageData->description ?>

    <div class="aboutblogslider_div about_main_div ">
        <div class="container">
            <div class="row about_blog_slider-btm">
                <div class="col-md-12">
                    <h2 class="sub-heading">From the Blog</h2>
                </div>
                <div class="about_div_scrl owl-carousel">
                    <?php if(count($blogPosts)): ?>
                        <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php
                            if(isset($blog->img) && !empty($blog->img)){
                                $path = '/blog_images/listing/'.$blog->img;
                                if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/blog_images/listing/'.$blog->img);
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            }else{
                                $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                            }
                            ?>
                            <div class="item">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="blog-card">
                                        <div class="about_bnr blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                        </div>
                                        <span class="text-muted"><?php echo e(date('d F Y', strtotime($blog->created_at))); ?></span>
                                        <a href="/blog/<?php echo e($blog->id); ?>"><h3 class="blog-title"><?php echo e($blog->title); ?></h3></a>
                                        <p class="blog-description"><?php echo $blog->description; ?></p>
                                        <strong>Categories:</strong>
                                        <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($category->id == $blog->category_id): ?>
                                                <small><?php echo e($category->name); ?></small>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <div class="abt_tags">
                                            <?php if(isset($blog->tags) && !empty($blog->tags)): ?>
                                                <?php $count = 0 ;?>
                                                <?php $__currentLoopData = explode(',', $blog->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <?php $count++; ?>
                                                    <?php if($count>1): ?><?php echo e(', '); ?><?php endif; ?><a href="/blog/tag/<?php echo e($tag); ?>"><i class="fa fa-tag" aria-hidden="true"></i><span><?php echo e($tag); ?></span></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php else: ?>
                        <div>No Records Found</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/about.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>