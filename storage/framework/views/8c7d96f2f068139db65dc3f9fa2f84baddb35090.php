<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container event-sec">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>EVENTS</h2>
                    <div class="right-sec form-inline">
                        <label for="basic-url">Only view events in:</label>
                        <form method="GET" action="/search" name="searchByZip" id="search-by-zip" autocomplete="off" enctype="multipart/form-data">
                            <div class="input-group event_zip">
                                <input type="text" class="form-control" name="zip" placeholder="Enter ZIP Code">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="event-review-header"></p>
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-md-12">
                <?php if(count($eventsByZip)): ?>
                    <?php $__currentLoopData = $eventsByZip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <?php
                        if(isset($event->user_img) && !empty($event->user_img)){
                            $path = '/event_images/'.$event->user_img;
                            if(file_exists(public_path($path))){
                                $listingImage = URL::asset('/event_images/'.$event->user_img);
                            }else{
                                $listingImage = URL::asset('/event_images/listing_placeholder.png');
                            }
                        }else{
                            $listingImage = URL::asset('/event_images/listing_placeholder.png');
                        }
                        ?>
                        <div class="media">
                            <div class="media-left">
                                <div class="event_img_div" style="background: url(<?php echo $listingImage; ?>)">

                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading"><?php echo e($event->event_name); ?></h3>
                                <ul>
                                    <li>Contributed By:</li>
                                    <li> <?php echo e($event->display_name); ?> </li>
                                </ul>
                                <ul>
                                    <li>Location:</li>
                                    <li><?php echo e($event->location_name); ?></li>
                                </ul>
                                <ul>
                                    <li>Time:</li>
                                    <li><?php echo e(date('g:i A', strtotime($event->from_time)).' - '.date('g:i A', strtotime($event->to_time))); ?></li>
                                </ul>
                                <ul>
                                    <li>Event Link:</li>
                                    <li><a href="<?php echo e($event->event_url); ?>" class="event-link"><?php echo e($event->event_url); ?></a></li>
                                </ul>
                                <p><?php echo $event->event_desc; ?></p>
                                <div class="date-tag">
                                    <div class="bg-branding">
                                        <h2><?php echo e(date('d', strtotime($event->from_date))); ?></h2>
                                        <span><?php echo e(strtoupper(date('M - y', strtotime($event->from_date)))); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php else: ?>
                    <p class="no-result">No Results Found</p>
                <?php endif; ?>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/event_zip.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>