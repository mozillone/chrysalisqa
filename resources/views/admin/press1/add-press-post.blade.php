@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
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
    <h1>Press</h1>
<!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('press-posts')}}"></i>Press Posts</a>
        </li>
        <li class="active">Add Press Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
            <h3 class="box-title heading-agent col-md-12">Add Press Post </h3>
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
                    <form id="press-create" class="form-horizontal defult-form" name="userForm" action="{{ route('insert-press-post') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-6">
                        
                            <h3 class="heading-agent">Post Information</h3>
                            <div class="col-md-12">
<!-- Post Title -->
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Title<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Post Title"  name="postTitle" id="postTitle">
                                    <p class="error">{{ $errors->first('postTitle') }}</p> 
                                </div>
                                
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Source<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Post Source"  name="postSource" id="postSource">
                                    <p class="error">{{ $errors->first('postSource') }}</p> 
                                </div>

                                <div class="clearfix"></div>
                                
                                <div>
                                    <label for="inputEmail3" class="control-label">Post Description
                                        <span class="req-field" >*</span>
                                    </label>
                                    <textarea id="postDesc" name=postDesc></textarea>
                                    <p class="error">{{ $errors->first('postDesc') }}</p> 
                                </div>


                                

                                
                                
                            </div>
                        </div>         
                        
                        <div class="col-md-6">
                            <h2 class="heading-agent">Settings</h2>
                            
                            <div class="col-md-12">
                              
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Image</label>
                                    <span class="req-field" >*</span>
                        <input type="file" name="postImage" id="postImage"><p class="error">{{ $errors->first('postImage') }}</p><br><br>

                                </div>
                               
                               
                            

                        </div>
                    </div>
                </div>   
                
                
                
            </div>
        </div>
        

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>

                <a href="/press-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
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





@stop
