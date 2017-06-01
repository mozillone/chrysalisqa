<?php $__env->startSection('title'); ?> @parent

<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

  <link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
  <script src="<?php echo e(asset('/assets/admin/js/fileinput.js')); ?>"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <section class="content-header">
    <h1>Content Management System</h1>
    <ol class="breadcrumb">
      <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="<?php echo e(url('cms-pages')); ?>">Pages</a>
      </li>

      <li class="active">Add Page</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title col-md-12 heading-agent">Add Page</h3>
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

            <form id="add_cms_page" class="form-horizontal defult-form" name="addCmsPage" action="<?php echo e(route('store-cms-page')); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
              <div class="col-md-12">
                <h2 class="heading-agent">*Page Info</h2>
                <div class="col-md-6">
                  <div class="form-group has-feedback" >
                    <label for="page_title" class="control-label">Page Title<span class="req-field" >*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Page Title"  name="title" id="page_title">
                    <p class="error"><?php echo e($errors->first('title')); ?></p>
                    <span id="page_title_error" style="color:red"></span>
                  </div>
                  <div class="form-group has-feedback page-url-container" >
                    <label for="page_url" class="control-label">Page URL<span class="req-field" >*</span></label>
                    <input type="text" class="form-control page-url" placeholder="Enter Page URL"  name="url" id="page_url">
                    <p class="error"><?php echo e($errors->first('url')); ?></p>
                    <span id="page_url_error" style="color:red"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="page_desc" class="control-label">Page Description<span class="req-field" >*</span></label>
                    <textarea id="page_desc" class="form-control" name="description"></textarea>
                    <p class="error"><?php echo e($errors->first('description')); ?></p>
                    <span id="page_desc_error" style="color:red"></span>
                  </div>
                </div>
              </div>

                <div class="col-md-6">
                  <h2 class="heading-agent">*Meta Information</h2>
                  <div class="col-md-12">
                    <div class="form-group has-feedback" >
                      <label for="meta_title" class="control-label">Meta Title<span class="req-field" >*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Meta Title"  name="meta_title" id="meta_title">
                      <p class="error"><?php echo e($errors->first('meta_title')); ?></p>
                      <span id="meta_title_error" style="color:red"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="meta_desc" class="control-label">Meta Description<span class="req-field" >*</span>
                      </label>
                      <textarea id="meta_desc" class="form-control" rows="6" name="meta_desc"></textarea>
                      <p class="error"><?php echo e($errors->first('meta_desc')); ?></p>
                      <span id="meta_desc_error" style="color:red"></span>
                    </div>
                  </div>
                </div>

          </div>

          <div class="box-footer">
            <div class="pull-right">
              <a href="/cms-pages" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
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
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          $('#page_desc').summernote({
              height:300,
          });

          $('.page-url').on('focusout', function () {
              var pageUrl = $(this).val();

              $.ajax({
                  type: "GET",
                  url: '<?php echo url('check-url-availability'); ?>',
                  data: {'url':pageUrl},
                  dataType: 'JSON',
                  success: function(response) {
                      if(response > 0){
                          $('.page-url-container').addClass('has-error');
                          $('.save-page').attr('disabled', true);
                      }else{
                          $('.page-url-container').removeClass('has-error');
                          $('.save-page').attr('disabled', false);
                      }
                  }
              });

          });
      });
  </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>