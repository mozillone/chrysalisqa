@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection
{{-- page level styles --}}

@section('header_styles')

  <link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
  <link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
  <script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>

@stop

{{-- Page content --}}
@section('content')
  <section class="content-header">
    <h1>Content Management System</h1>
    <ol class="breadcrumb">
      <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="{{url('cms-pages')}}">Pages</a>
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
            @if (Session::has('error'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('error') }}
              </div>
            @elseif(Session::has('success'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('success') }}
              </div>
            @endif

            <form id="add_cms_page" class="form-horizontal defult-form" name="add_cms_page" action="{{route('store-cms-page')}}" method="POST" autocomplete="off" enctype="multipart/form-data">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-md-12">
                <h2 class="heading-agent">Page Info</h2>
                <div class="col-md-6">
                  <div class="form-group has-feedback" >
                    <label for="page_title" class="control-label">Page Title<span class="req-field" >*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Page Title"  name="title" id="page_title">
                    <p class="error">{{ $errors->first('title') }}</p>
                    <span id="page_title_error" style="color:red"></span>
                  </div>
                  <div class="form-group has-feedback page-url-container" >
                    <label for="page_url" class="control-label">Page URL<span class="req-field" >*</span></label>
                      <div class="input-group page_route">
                          <div class="input-group-addon"><?=URL::to('/pages').'/';?></div>
                          <input type="text" class="form-control page-url" id="page_url" name="url" placeholder="Enter Page URL">
                      </div>
                    <p class="error">{{ $errors->first('url') }}</p>
                  </div>
				  </div>
				   <div class="col-md-12">
                  <div class="form-group has-feedback">
                    <label for="page_desc" class="control-label">Page Description<span class="req-field" >*</span></label>
                    <textarea id="page_desc" class="form-control" name="page_desc"></textarea>
                    <p class="error">{{ $errors->first('description') }}</p>
                    <span id="page_desc_error" style="color:red"></span>
                  </div>
                </div>
              </div>

                <div class="col-md-6">
                  <h2 class="heading-agent">Meta Information</h2>
                  <div class="col-md-12">
                    <div class="form-group has-feedback" >
                      <label for="meta_title" class="control-label">Meta Title<span class="req-field" >*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Meta Title"  name="meta_title" id="meta_title">
                      <p class="error">{{ $errors->first('meta_title') }}</p>
                      <span id="meta_title_error" style="color:red"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="meta_desc" class="control-label">Meta Description<span class="req-field" >*</span>
                      </label>
                      <textarea id="meta_desc" class="form-control" rows="6" name="meta_desc"></textarea>
                      <p class="error">{{ $errors->first('meta_desc') }}</p>
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
@stop
{{-- page level scripts --}}
@section('footer_scripts')
  <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
  <script src="{{ asset('/assets/admin/js/pages/cms.js') }}"></script>
  <script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
  <script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          CKEDITOR.replace( 'page_desc' );

          $('.page-url').on('focusout', function () {
              var pageUrl = $(this).val();

              $.ajax({
                  type: "GET",
                  url: '{!! url('check-url-availability') !!}',
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


@stop
