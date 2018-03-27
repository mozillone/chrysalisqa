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
                <a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('/cms-blocks')}}">CMS Blocks</a>
            </li>

            <li class="active">{{ $cmsBlock->title }}</li>
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

                        <form id="edit_cms_block" class="form-horizontal defult-form" name="addCmsBlock" action="/update-block/{{$cmsBlock->id}}" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback" >
                                        <label for="block_title" class="control-label">Block Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Block Title" value="{{(isset($cmsBlock->title) && !empty($cmsBlock->title)) ? $cmsBlock->title : ''}}" name="title" id="block_title">
                                        <p class="error">{{ $errors->first('title') }}</p>
                                        <span id="block_title_error" style="color:red"></span>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="pages" class="control-label">Blocks<span class="req-field" ></span></label>
                                        <select class="form-control" id="pages" disabled="disabled">

                                            <option value="{{ $cmsBlock->slug }}">{{ $pagesData[$cmsBlock->slug] }}</option>

                                        </select>
                                        <input type="hidden" value="{{$cmsBlock->slug}}" name="slug">
                                        <p class="error">{{ $errors->first('slug') }}</p>
                                        <span id="page_title_error" style="color:red"></span>
                                    </div>
									 </div>
									  <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="block_desc" class="control-label">Block Description<span class="req-field" >*</span></label>
                                        <textarea id="block_desc" class="form-control" name="description">{{(isset($cmsBlock->description) && !empty($cmsBlock->description)) ? $cmsBlock->description : ''}}</textarea>
                                        <p class="error">{{ $errors->first('description') }}</p>
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
            CKEDITOR.replace( 'description' );

            var blockPage = '<?=$cmsBlock->slug;?>';
            $('#pages').val(blockPage);
        });
    </script>


@stop