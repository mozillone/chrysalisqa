@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection
{{-- page level styles --}}

@section('header_styles')

    <link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.default.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/taginput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.bootstrap3.css') }}">
    <script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <style type="text/css">
        .bootstrap-tagsinput .label-info{background-color: #5fc5ac !important;}
        .form-group.has-feedback.blog-tags{position: relative;}
        .form-group.has-feedback.blog-tags span.error{position: absolute; top:100%; left:0;}
    </style>

@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Blog Posts</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('blog-posts')}}">Blog Posts</a>
            </li>

            <li class="active">{{$blogPost->title}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title col-md-12 heading-agent">Post Information</h3>
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

                        <form id="add_blog_post" class="form-horizontal defult-form" name="addCmsPage" action="/update-blog-post/{{ $blogPost->id }}" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="posted_by" value="{{ $blogPost->posted_by }}">
                            <div class="col-md-12">
                                <!-- post information starts here -->
                                <div class="col-md-8">

                                    <div class="form-group has-feedback" >
                                        <label for="post_title" class="control-label">Post Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Post Title" value="{{ $blogPost->title }}" name="title" id="post_title">
                                        <p class="error">{{ $errors->first('title') }}</p>
                                        <span id="page_title_error" style="color:red"></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="post_desc" class="control-label">Post Description<span class="req-field" >*</span></label>
                                        <textarea id="post_desc" class="form-control" name="post_desc">{{ $blogPost->description }}</textarea>
                                        <p class="error">{{ $errors->first('description') }}</p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="blog_image" class="control-label image-label">Upload<span class="req-field" >*</span></label>
                                        <div class="fileupload fileupload-new rmvimg" data-provides="fileupload">
                                            <?php
                                                $blogImage = $blogPost->img;
                                                $filesource = null;
                                                $imageExists = null;
                                                if(!empty($blogImage)){
                                                    $fileExist = file_exists(public_path('/blog_images/listing/'.$blogPost->img));
                                                    if($fileExist){
                                                        $filesource = URL::asset('/blog_images/listing/'.$blogPost->img);
                                                        $imageExists = $blogPost->img;
                                                    }else{
                                                        $filesource = URL::asset('/blog_images/preview_placeholder.png');
                                                    }
                                                }else{
                                                    $filesource = URL::asset('/blog_images/preview_placeholder.png');
                                                }

                                            ?>
                                            <img  src="<?=$filesource?>" class="img-pview img-responsive" id="img-chan" name="img-chan">
                                            @if($fileExist)
                                             <span class="remove_pic" id="removeImg">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </span>
                                            @endif
                                           

                                            <span class="btn btn-default btn-file">
                                                <span class="fileupload-new" style="float:right">Upload Photo</span>
                                                <span class="fileupload-exists"></span>
                                                <input name="imageExists" value="<? echo (!empty($imageExists) ? $imageExists : '')?>" type="hidden">
                                                <input id="blog_image" name="blogImage" type="file" placeholder="Blog Image" class="form-control">
                                            </span>

                                            <p class="noteices-text">Note: The file should not exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>

                                            <span class="fileupload-preview"></span>

                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                        </div>
                                        <p class="error">{{ $errors->first('blogImage') }}</p>
                                    </div>

                                    <div class="form-group has-feedback blog-tags" >
                                        <label for="blog-tags" class="control-label">Blog Tags<span class="req-field" >*</span></label>
                                        <input type="text" name="blogTags" class="form-control" id="blog-tags" value="{{ $blogPost->tags }}"/>
                                        <input id="dummyBlogTags" name="dummyBlogTags" type="hidden"/>
                                        <p class="error">{{ $errors->first('blogTags') }}</p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>
                                </div>
                                <!-- post information ends here -->
                                <!-- option starts here -->
                                <div class="col-md-4">
                                    <div class="form-group has-feedback" >
                                        <label for="page_title" class="control-label">Blog Status<span class="req-field" >*</span></label>
                                        <select class="form-control" name="status" id="blog-status">
                                            <option defualt value="">Select Status</option>
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                        <p class="error">{{ $errors->first('status') }}</p>
                                        <span id="page_title_error" style="color:red"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="page_desc" class="control-label">Blog Categories<span class="req-field" >*</span></label>
                                        <div class="input-group blog-categories">
                                            @if(count($blogCategories))
                                                @foreach($blogCategories as $category)
                                                    <div class="form-input ">
                                                        <input type="radio" name="category" value="{{$category->id}}"> {{$category->name}}
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="button" data-toggle="modal" data-target="#addCategory" class="btn btn-default">Add Category</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="error">{{ $errors->first('blog_category') }}</p>
                                        <span id="page_desc_error" style="color:red"></span>
                                    </div>
                                </div>
                                <!-- options ends here -->
                            </div>

                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/blog-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-info pull-right save-page">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close category-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Blog Category</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissable category-alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div class="form-group category-name-container has-feedback">
                        <label for="blogCategory">Blog Category</label>
                        <input type="text" class="form-control" id="blogCategory" name="name" placeholder="Enter Blog Category">
                        <p class="error">{{ $errors->first('blog_category') }}</p>
                        <span id="page_desc_error" style="color:red"></span>
                    </div>
                    <button type="button" class="btn btn-primary save-category">Save</button>
                </div>
            </div>
        </div>
    </div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="{{ asset('/assets/admin/js/pages/blog.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('/assets/admin/js/selectize.js') }}"></script>
    <script src="{{ asset('/assets/admin/vendors/taginput/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            CKEDITOR.replace( 'post_desc' );

            var blogStatus = '<?=$blogPost->status;?>';
            $('#blog-status').val(blogStatus);

            var categoryId = '<?=(($blogPost->category_id == 0) ? '' : $blogPost->category_id);?>';
            $("input[name=category][value="+categoryId+"]").prop("checked", true);

            $("#blog-tags").tagsinput({maxChars: 50,maxTags: 10});
            /*$('#blog-tags').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });*/

            $('.save-category').on('click', function () {
                var categoryName = $('#blogCategory').val();

                $.ajax({
                    type: "GET",
                    url: '{!! url('blog-category-availability') !!}',
                    data: {'name':categoryName},
                    dataType: 'JSON',
                    success: function(response) {
                        if(response > 0){
                            $('.category-alert').show();
                            $('.category-alert').html('Category name already taken. Pls enter new one.');
                            setTimeout(function() {
                                $('.category-alert').fadeOut('fast');
                            }, 4000);
                        }else{
                            $.ajax({
                                type: "POST",
                                url: '{!! url('add-blog-category') !!}',
                                data: {'name':categoryName},
                                dataType: 'JSON',
                                success: function(response) {
                                    if(response){
                                        var categoryId = response.id;
                                        var categoryName = response.name;
                                        var categoryRadio = $("<input type='radio' name='category' value='"+categoryId+"'><span>"+categoryName+' '+"</span>");
                                        var categoryDiv = $("<div class='form-input' data-id="+categoryId+"></div>").appendTo(".blog-categories");
                                        categoryRadio.appendTo(categoryDiv);
                                        $('.category-close').trigger('click');
                                    }
                                },
                                error: function () {
                                    $('.category-alert').show();
                                    $('.category-alert').html('Category could not be saved. Pls try again.');
                                    setTimeout(function() {
                                        $('.category-alert').fadeOut('fast');
                                    }, 4000);
                                }
                            });
                        }
                    }
                });
            });

        });
    </script>


@stop