@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
<<<<<<< HEAD
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
=======




<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">




>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
@stop

{{-- Page content --}}
@section('content')
<style>
    .fileupload-new .btn-file {
     margin: 10px 0 0 20px;
 }
<<<<<<< HEAD

</style>
<!-- Header of the Page -->
<section class="content-header">
    <h1>Press</h1>
<!-- Breadcrumb -->
=======
</style>

<section class="content-header">
    <h1>Add Press Post</h1>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
<<<<<<< HEAD
            <a href="{{url('press-posts')}}"></i>Press Posts</a>
=======
            <a href="{{url('press-posts')}}"></i> Press Posts</a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </li>
        <li class="active">Add Press Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
<<<<<<< HEAD
                <div class="box-header">
            <h3 class="box-title heading-agent col-md-12">Add Press Post </h3>
        </div>
=======
                
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                <div class="box-body">
                    
                    
                    
<<<<<<< HEAD
<!-- Error Message -->
=======

>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
<!-- Form Starts here -->
=======
                    
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                    <form id="press-create" class="form-horizontal defult-form" name="userForm" action="{{ route('insert-press-post') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
<<<<<<< HEAD
                        <div class="col-md-6">
                        
                            <h3 class="heading-agent">Post Information</h3>
                            <div class="col-md-12">
<!-- Post Title -->
=======
                        <div class="col-md-7">
                            <h2 class="heading-agent">Post Information</h2>
                            <div class="col-md-12">
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
                                    <textarea id="postDesc" name="postDesc"></textarea>
=======
                                    <textarea id="summernote" name=postDesc></textarea>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                                    <p class="error">{{ $errors->first('postDesc') }}</p> 
                                </div>


                                

                                
                                
                            </div>
                        </div>         
                        
<<<<<<< HEAD
                        <div class="col-md-6">
                            <h2 class="heading-agent">Settings</h2>
                            
                            <div class="col-md-12">
                              <div class="box-body">
                                        <div class="col-md-12 file-ups">
                                            <div class="form-group {{ $errors->has('profile_img') ? ' has-error' : '' }}" >
                                                <label for="Image" class="control-label">Upload Image <span class="required"> * </span></label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                   <img src="http://chrysalis.com/default_pic.png" class="img-pview img-responsive" id="img-chan" name="img-chan" style="alt=;width: 160px;height: 160px;" "="" riot"="">
                                                    <span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span>

                                                        <input id="press_image" name="press_image" placeholder="Profile Image" class="form-control" type="file" style="margin-top: 15px;">

                                                    <input type="hidden" name="img_removed" class="img_removed">
                                <input type="hidden" class="name_img" class="find_img" value="{{ isset($user->profile_img) && ($user->profile_img!='default.jpg') ? $user->profile_img : 'default_pic.png' }}">
                                <span class="fileupload-preview"></span>
                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                                </div>
                                                <p><b>Note:</b> The file could not be exceed above 10MB and allowed only .JPG, .JPEG, .PNG format.</p>
                                            </div>
                                        </div>
                                    </div>
                               
                               
=======
                        <div class="col-md-3">
                            <h2 class="heading-agent">Settings</h2>
                            
                            <div class="col-md-12">
                              
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Image<span class="req-field" >*</span></label>
                        <input type="file" name="postImage" id="postImage"><br><br>
                                    <p class="error">{{ $errors->first('postImage') }}</p> 
                                </div>
                               
                               <div>
                                Categories<br>
                                @foreach($users as $user)
                                <input type="checkbox" name="Categories[]" value="{{$user->id}}">{{$user->cat_name}}<br>
                                @endforeach
                            </div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                            

                        </div>
                    </div>
                </div>   
                
                
                
            </div>
        </div>
        

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>

<<<<<<< HEAD
                <a href="/press-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
=======
                <a href="/press-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Cancel</a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/press.js')}}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'postDesc' );
    });
</script>
<script type="text/javascript">
$(document).ready(function(){

            $("#press-create").validate(
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
=======
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>

<script src="{{ asset('/assets/admin/js/pages/press.js')}}"></script>




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


<!-- Summernote -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height:300,
        });
    });
</script>


>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3



@stop
