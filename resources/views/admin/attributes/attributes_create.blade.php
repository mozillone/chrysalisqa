@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Attribute create@parent
@endsection

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Attributes</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{route('attributes-list')}}">Attributes List</a>
        </li>
        
        <li class="active">Add Attribute</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Add Attribute</h3>
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
                    <!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > --> 
                    <form id="attribute-create" class="form-horizontal defult-form" name="userForm" action="{{route('attributes-create')}}" method="POST" novalidate autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div class="col-md-6">
                         <div class="col-md-12">
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attribute name"  name="name" id="name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Code<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attribute code"  name="code" id="code">
                                    <p class="error">{{ $errors->first('code') }}</p> 
                                </div>
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Type<span class="req-field" >*</span></label>
                                        <select class="form-control" id="sel1" name="type">
                                            <option value="">--Select--</option>
                                            <option value="text">Text</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="radio">Radio</option>
                                            <option value="select">Select</option>
                                            <option value="textarea">Text Area</option>
                                       </select>
                                    <p class="error">{{ $errors->first('type') }}</p> 
                                </div>
                            </div> 
                        </div>
                    </div> 
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/amenities" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </section>

@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
 $("#attribute-create").validate({
            rules: {
                name:{
                        required: true,
                        maxlength: 50
                    },
                code:{
                        required: true,
                        maxlength: 50
                    },
                type:{
                        required: true
                    },
                }
 	
        });
</script>
@stop
