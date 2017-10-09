<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/pages/blog.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container blog-sec">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>BLOG</h2>
                </div>
            </div>
            <div class="alrt-div col-md-12 col-sm-12 col-xs-12">
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('error')); ?>

                    </div>
                <?php elseif(Session::has('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
        <p class="event-review-header">Have a great <span>DIY Costume or Event Review</span> to share with us?  Click
  <a data-toggle="modal" <?php if(Auth::check()): ?> data-target="#login_popup" <?php else: ?> <?php Session::put('is_blog', true); ?> data-target="#signup_popup" <?php endif; ?> data-dismiss="modal">here</a> to submit it.</p>
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <?php if(count($blogPosts)): ?>
                        <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php
                                if(isset($value->img) && !empty($value->img)){
                                    $path = '/blog_images/listing/'.$value->img;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/blog_images/listing/'.$value->img);
                                    }else{
                                        $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            ?>
                            <div class="col-md-6">
                                <div class="blog-card blog_main_images">
                                    <a href="/blog/<?php echo e($value->id); ?>"><div class="blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                        </div></a>
                                    <span class="text-muted"><?php echo e(date('d F Y', strtotime($value->created_at))); ?></span>
                                    <a href="/blog/<?php echo e($value->id); ?>"><h3 class="blog-title"><?php echo e($value->title); ?></h3></a>
                                    <p class="blog-description"><?php echo $value->description; ?></p>
                                    <hr/>
                                    <strong>Categories:</strong>
                                    <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if($category->id == $value->category_id): ?>
                                            <small><?php echo e($category->name); ?></small>
                                        <?php endif; ?>
									
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <div class="abt_tags">
                                        <?php if(isset($value->tags) && !empty($value->tags)): ?>
                                            <?php $count = 0; ?>
                                            <?php $__currentLoopData = explode(',', $value->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
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
                    <div style="float:right;"><?php echo e($blogPosts->links()); ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 hidden-xs">
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

    <div class="modal fade window-popup event-create-pop" id="login_popup" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class=" modal-header indi_close_icons">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-register" id="loginModal">

                            <div id="myTabContent" class="tab-content">

                                <div class="tab-pane active in" id="login_tab1">
                                    <h2>Contribute Content</h2>
                                    <form method="POST" action="/save-blog-post" name="saveBlogPost" id="save-blog-post" autocomplete="off" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <input type="hidden" name="user_id" value="<?php if(Auth::check()): ?><?php echo e($userId); ?><?php else: ?> '' <?php endif; ?>">
                                        <input type="hidden" name="posted_by" value="user">
                                        <input type="hidden" name="status" value=0>

                                        <div class="form-group has-feedback">
                                            <label for="user_name">Name*</label>
                                            <input type="text" id="user_name"  name="name" class="form-control" value="<?php if(Auth::check()): ?><?php echo e($userName); ?><?php else: ?> '' <?php endif; ?>">
                                            <p class="error"><?php echo e($errors->first('name')); ?></p>
                                            <span id="page_title_error" style="color:red"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="user_email">Email Address*</label>
                                            <input type="text" id="user_email" name="email"  class="form-control" value="<?php if(Auth::check()): ?><?php echo e($userEmail); ?><?php else: ?> '' <?php endif; ?>">
                                            <p class="error"><?php echo e($errors->first('email')); ?></p>
                                            <span id="page_title_error" style="color:red"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="blog-category">Category*</label>
                                            <select class="form-control" id="blog-category" name="category">
                                                <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            </select>
                                            <p class="error"><?php echo e($errors->first('category')); ?></p>
                                            <span id="page_title_error" style="color:red"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="blog_title">Headline*</label>
                                            <input type="text"  name="title" id="blog_title" class="form-control">
                                            <p class="error"><?php echo e($errors->first('title')); ?></p>
                                            <span id="page_title_error" style="color:red"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="blog_description">Description*</label>
                                            <textarea rows="5" name="description" id="blog_description" class="form-control"></textarea>
                                            <p class="error"><?php echo e($errors->first('description')); ?></p>
                                            <span id="page_title_error" style="color:red"></span>
                                        </div>

                                        <div class="form-group">
                                            <div class="login-btn">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/blog.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>