@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Edit {{$data['basic'][0]->name}} Promotion @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/jquery-ui/themes/base/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/jquery-ui/themes/base/sortable.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">

@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Edit {{$data['basic'][0]->name}} Promotion</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{route('promotions-list')}}">Promotions List</a>
        </li>
        
        <li class="active">Edit {{$data['basic'][0]->name}} Promotion</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Edit {{$data['basic'][0]->name}} Promotion</h3>
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
                    <form id="promotions-create" class="form-horizontal defult-form" name="userForm" action="{{route('promotion-edit')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <input type="hidden" name="coupon_id" value="{{$data['basic'][0]->coupon_id}}"> 
                        <div class="col-md-12">
                            <h4>Basic Information</h4>
                            <hr>
                            <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Promotion Name <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter promotion name"  name="name" id="name" value="{{$data['basic'][0]->name}}">
                                        <p class="error">{{ $errors->first('name') }}</p> 
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Promotion Code</label>
                                            <input type="text" class="form-control" placeholder="Enter promotion code"  name="code" id="code" value="{{$data['basic'][0]->code}}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Discount Type <span class="req-field" >*</span></label>
										<div class="row_pregt">
                                            <div class="radio col-md-4">
                                                <input type="radio" value="percentage" name="type" @if($data['basic'][0]->type=="percentage") checked @endif>Percentage</label>
                               
                                            </div>
											  <div class="radio col-md-4">
                                              
                                                <input type="radio" value="flat"  name="type" @if($data['basic'][0]->type=="flat") checked @endif>Flat Amount</label>
                                            </div>
											  </div>
											
									
                                          <p class="error">{{ $errors->first('type') }}</p> 
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Discount <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter discount"  name="discount" id="discount" value="{{(int)$data['basic'][0]->discount}}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Applied From <span class="req-field" >*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date_start" id="date_start" value="{{$data['basic'][0]->datestart}}"> 
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                                        </div>
                                    </div>
                                   <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Applied Till <span class="req-field" >*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date_end" id="date_end" value="{{$data['basic'][0]->dateend}}">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Maximum Uses</label>
                                            <input type="text" class="form-control" placeholder="Enter maximum uses"  name="uses_total" id="uses_total" value="{{$data['basic'][0]->uses_total}}">
                                    </div>
                                </div> 
                            <div class="col-md-6">
                             <div class="col-md-12 cupn_catries">
                                <h4>Coupon Categories</h4>
						
                                    <hr>
                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Category List</label>
                                              <select class="form-control" id="cats">
                                                <option value="">--Select--</option>
                                                @foreach($cats_list as $cats)
                                                <option value="{{$cats->category_id}}">{{$cats->name}}</option>
                                                @endforeach
                                            </select>
                                           <a href="javascript::void(0);" class="add_cat btn btn-primary">+Add</a>
                                    </div>
                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Selected Categories</label>
                                         <select multiple class="form-control"  name="cats[]" id="cats_list">
                                        @foreach($data['promo_cats'] as $cats)
                                        <option value="{{$cats->category_id}}" selected>{{$cats->parent_cat}}-{{$cats->sub_cat}}</option>
                                        @endforeach
                                        </select>
                                        </select>
										            
                                        <span>Note: Select the category and click on Remove button to remove the category from the list</span><br>
                                        <a href="javascript::void(0);" class="remove_cat btn btn-danger">-Remove</a>
                            
                                    </div>
								
                                </div>
                                  <div class="col-md-12">
                                <h4>Coupon Products</h4>
                                    <hr>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Product</label>
                                        <input type="text" class="form-control" placeholder="Enter category name"  name="products_list" id="products_list">
                                        <input type="hidden"  id="cst_name">
                                        <input type="hidden"  id="products_id">
                                        <input type="hidden"  id="sku_no">
										<span>Note: Type the product name to autopopulate</span>
										     <br>
                                        <a href="javascript::void(0);" class="add-prod btn btn-primary">+Add</a>
                                   
                                        
                                    </div>

                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Selected Products</label>
                                        <select multiple class="form-control" name="costumes[]" id="costumes">
                                        @foreach($data['promo_costumes'] as $csts)
                                        <option value="{{$csts->costume_id}}" selected>{{$csts->sku_no}}-{{$csts->name}}</option>
                                        @endforeach
                                        </select>
                                        <a href="javascript::void(0);" class="remove_product btn btn-danger">-Remove</a>
                                    
                                        <span>Note: Select the product and click on Remove button to remove the product from the list</span>
                                    </div>
                                </div>
                                </div> 
                            </div>
                    </div> 
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/promotions" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <a  href="javascript::void(0);" class="btn btn-primary pull-right submit">Update</a>
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
<script src ="{{ asset('/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/promotions.js') }}"></script>

@stop
