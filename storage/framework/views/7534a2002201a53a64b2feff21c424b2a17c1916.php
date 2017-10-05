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
            <span class="breadcrumb-item active"><?php echo e($categoryData->name); ?></span>
        </nav>
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <?php if(count($postsByCategory)): ?>
                        <?php $__currentLoopData = $postsByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogPost): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                            <?php
                                if(isset($blogPost->img) && !empty($blogPost->img)){
                                    $path = '/blog_images/listing/'.$blogPost->img;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/blog_images/listing/'.$blogPost->img);
                                    }else{
                                        $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="blog-card">
                                <a href="/blog/<?php echo e($blogPost->id); ?>"><div class="blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                    </div></a>
                                <span class="text-muted"><?php echo e(date('d F Y', strtotime($blogPost->created_at))); ?></span>
                                <a href="/blog/<?php echo e($blogPost->id); ?>"><h3 class="blog-title"><?php echo e($blogPost->title); ?></h3></a>
                                <p class="blog_list_view blog-description"><?php echo $blogPost->description; ?></p>
                                <hr/>
                                <strong>Categories:</strong>
                                <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($category->id == $blogPost->category_id): ?>
                                        <small><?php echo e($category->name); ?></small>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <div class="abt_tags">
                                    <?php if(isset($blogPost->tags) && !empty($blogPost->tags)): ?>
                                        <?php $count = 0; ?>
                                        <?php $__currentLoopData = explode(',', $blogPost->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $count++; ?>
                                            <?php if($count>1): ?><?php echo e(', '); ?><?php endif; ?><a href="/blog/tag/<?php echo e($tag); ?>"><i class="fa fa-tag" aria-hidden="true"></i><span><?php echo e($tag); ?></span></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php else: ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">No Results Found</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="float:right;"><?php echo e($postsByCategory->links()); ?></div>
                </div>
            </div>
            <!-- end listing -->
            <div class="col-md-3 col-sm-3 col-xs-12 hidden-xs  ">
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
			
			
			
			
			
			
			 <div class="panel-group-mobile-cms  " id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-group-mobile-cms hidden-md hidden-lg hidden-sm" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                       
                       FILTER BLOG <i class="more-less glyphicon glyphicon-plus"></i>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" class="hidden-md hidden-lg hidden-sm">
                <div class="panel-body">
               <div class="press-filters">
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

    </div><!-- panel-group-mobile-cms -->
			
			
			
			
			
			
			
			
			
			
			
			
			

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/blog_category.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>