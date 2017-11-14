<?php $__env->startSection('title'); ?> @parent

<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
    <script src="<?php echo e(asset('/assets/admin/js/fileinput.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Content Management System</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo e(url('/cms-blocks')); ?>">CMS Blocks</a>
            </li>

            <li class="active"><?php echo e($cmsBlock->title); ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title col-md-12 heading-agent">Edit Block</h3>
                    </div>

                    <div class="box-body">
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

                        <form id="edit_cms_block" class="form-horizontal defult-form" name="addCmsBlock" action="/update-block/<?php echo e($cmsBlock->id); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback" >
                                        <label for="block_title" class="control-label">Block Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Block Title" value="<?php echo e((isset($cmsBlock->title) && !empty($cmsBlock->title)) ? $cmsBlock->title : ''); ?>" name="title" id="block_title">
                                        <p class="error"><?php echo e($errors->first('title')); ?></p>
                                        <span id="block_title_error" style="color:red"></span>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="pages" class="control-label">Blocks<span class="req-field" >*</span></label>
                                        <select class="form-control" id="pages" disabled="disabled">

                                            <option value="<?php echo e($cmsBlock->slug); ?>"><?php echo e($pagesData[$cmsBlock->slug]); ?></option>

                                        </select>
                                        <input type="hidden" value="<?php echo e($cmsBlock->slug); ?>" name="slug">
                                        <p class="error"><?php echo e($errors->first('slug')); ?></p>
                                        <span id="page_title_error" style="color:red"></span>
                                    </div>
									 </div>
									  <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="block_desc" class="control-label">Block Description<span class="req-field" >*</span></label>
                                        <textarea id="block_desc" class="form-control" name="description"><?php echo e((isset($cmsBlock->description) && !empty($cmsBlock->description)) ? $cmsBlock->description : ''); ?></textarea>
                                        <p class="error"><?php echo e($errors->first('description')); ?></p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/cms-blocks" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-info pull-right save-page">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/admin/js/pages/cms.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')); ?>"></script>
    <script src="<?php echo e(asset('ckeditor/ckeditor/ckeditor.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace( 'description' );

            var blockPage = '<?=$cmsBlock->slug;?>';
            $('#pages').val(blockPage);
        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>