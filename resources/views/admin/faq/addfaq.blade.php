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
        <h1>FAQs</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('manage-faqs')}}">FAQs</a>
            </li>

            <li class="active">Add FAQ</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title col-md-12 heading-agent">Add FAQ</h3>
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

                        <form id="add_faq" class="form-horizontal defult-form" name="addFaq" action="{{route('store-faq')}}" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-12">
                                <!-- post information starts here -->
                                <div class="col-md-8">
                                    <div class="form-group has-feedback" >
                                        <label for="faq_title" class="control-label">FAQ Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter FAQ Title"  name="title" id="faq_title">
                                        <p class="error">{{ $errors->first('title') }}</p>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="faq-block" class="control-label">FAQ Block<span class="req-field" >*</span></label>
                                        <select class="form-control" id="faq-block" name="block">
                                            <option default value="how-it-works">How It Works</option>
                                            <option value="support-and-contact">Support And Contact</option>
                                            <option value="sell-a-costume">Sell A Costume</option>
                                        </select>
                                        <p class="error">{{ $errors->first('block') }}</p>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="faq_description" class="control-label">FAQ Description<span class="req-field" >*</span></label>
                                        <textarea id="faq_description" class="form-control" name="faq_description"></textarea>
                                        <p class="error">{{ $errors->first('faq_description') }}</p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>

                                    <div class="form-group has-feedback" >
                                        <label for="sorting" class="control-label">Sort No.<span class="req-field" >*</span></label>
                                        <input type="text" name="sort_no" class="form-control" id="sorting"/>
                                        <p class="error">{{ $errors->first('sort_no') }}</p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>
                                </div>
                                <!-- post information ends here -->
                            </div>

                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/manage-faqs" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
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
    <script src="{{ asset('/assets/admin/js/pages/faqs.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            CKEDITOR.replace( 'faq_description' );

            $("#sorting").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

        });
    </script>


@stop