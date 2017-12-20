@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')

<?php
$event_id=Request::segment(3);
/*echo "<pre>";
print_r($users->press_title);
die;*/
?>


<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">



       
@stop

{{-- Page content --}}
@section('content')
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
</style>

<section class="content-header">
    <h1>Press</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('press-posts')}}"></i>Press Posts</a>
        </li>
        <li class="active">Edit Press Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
            <h3 class="box-title heading-agent col-md-12">Edit Press Post </h3>
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
                    
                    <form id="press-create" class="form-horizontal defult-form" name="userForm" action="/admin/updatepress" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-6">
                            <h2 class="heading-agent">Update Information</h2>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Post Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" value="{{$categories->press_title}}"  name="postTitle" id="postTitle">
                                        <p class="error">{{ $errors->first('postTitle') }}</p> 
                                    </div>

                                    <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Source<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" value="{{$categories->source}}"  name="postSource" id="postSource">
                                    <p class="error">{{ $errors->first('postSource') }}</p> 
                                </div>
                               
                                    
                                <div class="clearfix"></div>
                                    
                                <div class="form-group has-feedback" >
                                <label for="inputEmail3" class="control-label">Post Description
        <span class="req-field" >*</span>
        </label>
                    <textarea id="postDesc" name=postDesc>{{$categories->press_desc}}</textarea>
                        <p class="error">{{ $errors->first('postDesc') }}</p> 
                                </div>


                                   

                                
                                      
                                </div>
                                </div>         
                                
                                <div class="col-md-6">
                            <h2 class="heading-agent">Settings</h2>
                                
                                <div class="col-md-12">
                              
                                <div class="box-body">
                                        <div class="col-md-12 file-ups">
                                            <div class="form-group">
                                                <label for="Image" class="control-label">Upload Image<span class="req-field" >*</span></label>
                                                <div class="fileupload fileupload-new rmvimg" data-provides="fileupload">
                                                    <?php
                                                    $pressImage = $categories->user_img;
                                                    $filesource = null;
                                                    $imageExists = null;
                                                    $fileExist = null;
                                                    if(!empty($pressImage)){
                                                        $fileExist = file_exists(public_path('/press_images/'.$categories->user_img));
                                                        if($fileExist){
                                                            $filesource = URL::asset('/press_images/'.$categories->user_img);
                                                            $imageExists = $categories->user_img;
                                                        }else{
                                                            $filesource = URL::asset('/blog_images/preview_placeholder.png');
                                                        }
                                                    }else{
                                                        $filesource = URL::asset('/blog_images/preview_placeholder.png');
                                                    }

                                                    ?>
                                                    <img  style="width:160px;height:160px;"  src="<?=$filesource?>" class="img-pview img-responsive" id="img-chan" name="img-chan" style=" alt="" riot"="" >
                                                    @if($fileExist)
                                                     <span class="remove_pic" id="removeImg">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </span>
                                                    @endif
                                                    <span class="fileupload-exists"></span>
                                                    <input id="imageExists" name="imageExists" value="<?php echo (!empty($imageExists) ? $imageExists : '')?>" type="hidden">
                                                    <input id="press_image" name="press_image" placeholder="Profile Image" style="margin-top: 15px;" class="form-control" type="file">
                                                    <span class="fileupload-preview"></span>
                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                                </div>
                                                <p ><b>Note:</b> The file could not be exceed above 10MB and allowed only .JPG, .JPEG, .PNG format.</p>
                                            </div>
                                        </div>
                                    </div>   
                        <?php // echo "<pre>";print_r($categories);die; ?>
                       <input type="hidden" name="pressid" id="pressid" value="{{ $categories->id }}">
                       
                        </div>
                        </div>
                   

                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary pull-right">update</button>

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
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor/ckeditor.js')}}"></script>

<!-- Summernote -->

<script type="text/javascript">
$(document).ready(function() {
    $(document).ready(function() {
        CKEDITOR.replace( 'postDesc' );
    });
});
$(".remove_pic").on("click",function(){
    $('#img-chan').attr('src',"/press_images/listing_placeholder.png");
    $('input[type="file"]').val('');
    $('input[name="imageExists"]').val("");
    $("#removeImg").remove();
});
$(document).on('click','#removeImg',function(){
    $('#img-chan').attr('src',"/press_images/listing_placeholder.png");
    $('input[type="file"]').val('');
    $('input[name="imageExists"]').val("");
    $("#removeImg").remove();
});
</script>





    @stop
