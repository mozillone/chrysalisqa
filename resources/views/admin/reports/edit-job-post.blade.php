@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')
<style>
    .fileupload-new .btn-file {
     margin: 10px 0 0 20px;
 }

</style>
<!-- Header of the Page -->
<section class="content-header">
    <h1>Jobs</h1>
<!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('jobs-list')}}"></i>Jobs</a>
        </li>
        <li class="active">Update Job Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
            <h3 class="box-title heading-agent col-md-12">Update Job Post</h3>
        </div>
                <div class="box-body">
                    
                    
                    
<!-- Error Message -->
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
<!-- Form Starts here -->
                    <form id="job-create" class="form-horizontal defult-form" name="job-create" action="{{ route('update-jobs') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-6">
                        
                            <h3 class="heading-agent">Post Information</h3>
                            <div class="col-md-12">
<!-- Post Title -->
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Job Code<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" name="jobcode" id="jobcode" value="{{$jobs->job_code}}">
                                    <p class="error">{{ $errors->first('postTitle') }}</p> 
                                </div>
                                
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Job Title <span class="req-field" >*</span></label>
                                    <input type="text" class="form-control"  name="jobtitle" id="jobtitle" value="{{$jobs->job_title}}">
                                    <p class="error">{{ $errors->first('postSource') }}</p> 
                                </div>

                                <div class="clearfix"></div>
                                
                                <div>
                                    <label for="inputEmail3" class="control-label">Job Description
                                        <span class="req-field" >*</span>
                                    </label>
                                    <textarea id="postDesc" name="postDesc">{{$jobs->job_description}}</textarea>
                                    <p class="error">{{ $errors->first('postDesc') }}</p> 
                                    <input type="hidden" name="job_id" id="job_id" value="{{$jobs->job_id}}">
                                </div>


                                

                                
                                
                            </div>
                        </div>         
                        
                        
                </div>   
                
                
                
            </div>
        </div>
        

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right">Update</button>

                <a href="/jobs-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>
        </div>
    </div>

</form>

</div>
</div>
</div>
</section>





@stop
{{-- page level scripts --}}
@section('footer_scripts')



<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/press.js')}}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor/ckeditor.js')}}"></script>




<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "{{ asset('img/calendar.png') }}",
      buttonImageOnly: true,
      buttonText: "Select date"
  });
} );
</script>

<!-- Time Picker -->
<script>
    $('.clockpicker').clockpicker();
</script>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'postDesc' );
    });
</script>
<script type="text/javascript">
$(document).ready(function(){

            $("#job-create").validate(
            {
                ignore: [],
                debug: false,
                rules: { 

                    postDesc:{
                         required: function() 
                        {
                         CKEDITOR.instances.postDesc.updateElement();
                        },

                         minlength:10
                    }
                },
                messages:
                    {

                    postDesc:{
                        required:"Please enter Text",
                        minlength:"Please enter 10 characters"


                    }
                }
            });
        });

</script>



@stop
