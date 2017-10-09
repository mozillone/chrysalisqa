<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container blog-sec">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>BLOG</h2>
                </div>
            </div>
        </div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="/">Home &nbsp;&gt;&nbsp;</a>
            <a class="breadcrumb-item" href="/blog">Blog &nbsp;&gt;&nbsp;</a>
            <span class="breadcrumb-item">Archives &nbsp;&gt;&nbsp;</span>
            <span class="breadcrumb-item active"><?php echo e($year); ?></span>
        </nav>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <?php if(count($blogPosts)): ?>
                        <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php
                                if(isset($post->img) && !empty($post->img)){
                                    $path = '/blog_images/banner/'.$post->img;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/blog_images/listing/'.$post->img);
                                    }else{
                                        $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            ?>
                            <div class="col-md-6">
                                <div class="blog-card">
                                    <a href="/blog/<?php echo e($post->id); ?>"><div class="blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                        </div></a>
                                    <span class="text-muted"><?php echo e(date('d F Y', strtotime($post->created_at))); ?></span>
                                    <a href="/blog/<?php echo e($post->id); ?>"><h3 class="blog-title"><?php echo e($post->title); ?></h3></a>
                                    <p class="blog-description"><?php echo $post->description; ?></p>
                                    <hr/>
                                    <strong>Categories:</strong>
                                    <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if($category->id == $post->category_id): ?>
                                            <small><?php echo e($category->name); ?></small>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <div class="abt_tags">
                                        <?php if(isset($post->tags) && !empty($post->tags)): ?>
                                            <?php $count = 0; ?>
                                            <?php $__currentLoopData = explode(',', $post->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php $count++; ?>
                                                <?php if($count>1): ?><?php echo e(', '); ?><?php endif; ?><a href="/blog/tag/<?php echo e($tag); ?>"><i class="fa fa-tag" aria-hidden="true"></i><span><?php echo e($tag); ?></span></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php else: ?>
                        <div>No Results Found</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="float:right;"><?php echo e($blogPosts->links()); ?></div>
                </div>
            </div>
            <!-- end listing -->
            <div class="col-md-3">
                <div class="press-filters">
                    <h2>CATEGORIES</h2>
                    <?php if(count($blogCategories)): ?>
                        <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php $categoryName = preg_replace('/\s+/', '-', $category->name);
                            $categorySlug = strtolower($categoryName);
                            ?>
                            <p><a href="/blog/category/<?php echo e($category->id); ?>/<?php echo e($categorySlug); ?>"><?php echo e($category->name); ?></a></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php else: ?>
                        <p>No Results Found</p>
                    <?php endif; ?>
                    <h2>ARCHIVES</h2>
                    <?php if(count($yearFilters)): ?>
                        <?php $__currentLoopData = $yearFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <a href="/blog/archive/<?php echo e($filter->year); ?>"><p><?php echo e($filter->year); ?></p></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php else: ?>
                        <p>No Results Found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>

    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/blog_archives.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>