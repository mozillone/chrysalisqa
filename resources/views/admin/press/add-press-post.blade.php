@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')




<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">




@stop

{{-- Page content --}}
@section('content')
<style>
    .fileupload-new .btn-file {
     margin: 10px 0 0 20px;
 }
</style>

<section class="content-header">
    <h1>Add Press Post</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('press-posts')}}"></i> Press Posts</a>
        </li>
        <li class="active">Add Press Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                
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
                    
                    <form id="press-create" class="form-horizontal defult-form" name="userForm" action="{{ route('insert-press-post') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-7">
                            <h2 class="heading-agent">Post Information</h2>
                            <div class="col-md-12">
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Post Title<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Post Title"  name="postTitle" id="postTitle">
                                    <p class="error">{{ $errors->first('postTitle') }}</p> 
                                </div>
                                
                                
                                <div class="clearfix"></div>
                                
                                <div>
                                    <label for="inputEmail3" class="control-label">Post Description
                                        <span class="req-field" >*</span>
                                    </label>
                                    <textarea id="summernote" name=postDesc></textarea>
                                    <p class="error">{{ $errors->first('postDesc') }}</p> 
                                </div>


                                

                                
                                
                            </div>
                        </div>         
                        
                        <div class="col-md-3">
                            <h2 class="heading-agent">Settings</h2>
                            
                            <div class="col-md-12">
                              
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Status<span class="req-field" >*</span></label>
                                    <select class="form-control" id="sel1" name="status">
                                       <option value="">Select Status</option>
                                       <option value="Draft">Draft</option>
                                       
                                       <option value="Publish">Publish</option>
                                       
                                   </select>
                                   <p class="error">{{ $errors->first('status') }}</p> 
                               </div>
                               
                               <div>
                                Categories<br>
                                @foreach($users as $user)
                                <input type="checkbox" name="Categories[]" value="{{$user->id}}">{{$user->cat_name}}<br>
                                @endforeach
                            </div>
                            

                        </div>
                    </div>
                </div>   
                
                
                
            </div>
        </div>
        

        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>

                <a href="/press-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Cancel</a>
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





@stop
