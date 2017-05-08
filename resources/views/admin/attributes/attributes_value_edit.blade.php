@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Attributes edit@parent
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
            <a href="{{route('attributes-values-list')}}">Attribute Values List</a>
        </li>
        
        <li class="active">edit {{$attribute_value_data[0]->option_value}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Edit {{$attribute_value_data[0]->option_value}}</h3>
                </div>
                <div class="box-body">
                    <form id="attribute-value-edit" class="form-horizontal defult-form" name="userForm" action="{{route('attribute-value-edit')}}" method="POST" novalidate autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <input type="hidden" name="id" value="{{$attribute_value_data[0]->option_id}}"> 
                         <div class="col-md-6">
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Attribute Name<span class="req-field" >*</span></label>
                                        <select class="form-control" id="attribute_id" name="attribute_id">
                                            <option value="">--Select--</option>
                                            @foreach($attributes as $data)
                                            <option value="{{$data->attribute_id}}" @if($attribute_value_data[0]->attribute_id==$data->attribute_id) selected @endif>{{$data->label}}</option>
                                            @endforeach
                                       </select>
                                    <p class="error">{{ $errors->first('type') }}</p> 
                                </div>
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Option Value<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Option Value"  name="option_value" id="option_value" value="{{$attribute_value_data[0]->option_value}}">
                                    <p class="error">{{ $errors->first('option_value') }}</p> 
                                </div>
                               
                            </div> 
                        </div>
                    </div> 
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="{{route('attributes-values-list')}}" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
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
 $("#attribute-value-edit").validate({
            rules: {
                option_value:{
                        required: true,
                        maxlength: 50
                    },
                attribute_id:{
                        required: true
                    }
                }
    
        });
</script>
@stop
