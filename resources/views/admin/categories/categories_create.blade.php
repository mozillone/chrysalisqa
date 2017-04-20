@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Category create@parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="{{ asset('/vendors/jquery-ui/themes/base/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/jquery-ui/themes/base/sortable.css')}}">

@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Categories</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{route('categories-list')}}">Categories List</a>
        </li>
        
        <li class="active">Add Category</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Add Category</h3>
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
                    <form id="category-create" class="form-horizontal defult-form" name="userForm" action="{{route('categories-create')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div class="col-md-12">
                            <h4>Basic Information</h4>
                            <hr>
                            <div class="col-md-6">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Name <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter category name"  name="name" id="name">
                                        <p class="error">{{ $errors->first('name') }}</p> 
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Parent Category</label>
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="">--Select--</option>
                                                @foreach($parent_cats as $cats)
                                                <option value="{{$cats->category_id}}">{{$cats->name}}</option>
                                                @endforeach
                                           </select>
                                        <p class="error">{{ $errors->first('parent_id') }}</p> 
                                    </div>
                                     <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Description<span class="req-field" >*</span></label>
                                            <textarea class="form-control" placeholder="Enter category description"  name="desc"></textarea> 
                                        <p class="error">{{ $errors->first('desc') }}</p> 
                                    </div>
                                </div> 
                            <div class="col-md-6">
                             <div class="col-md-12">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Image <span class="req-field" >*</span></label>
                                            <input type="file" class="form-control" name="cat_image" id="cat_image">
                                        <p class="error">{{ $errors->first('cat_image') }}</p> 
                                    </div>
                                     <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Banner Image <span class="req-field" >*</span></label>
                                            <input type="file" class="form-control" name="banner_image" id="banner_image">
                                        <p class="error">{{ $errors->first('banner_image') }}</p> 
                                    </div>
                                </div> 
                            </div>
                    </div> 
                     <div class="col-md-12 costumes hide">
                            <h4>Category Costumes</h4>
                            <hr>
                            
                                <div class="col-md-6">
									<div class=" c_ctmes-admin ">
											<div class="form-group has-feedback col-md-10" >
												<label for="inputEmail3" class="control-label">Product</label>
													<input type="text" class="form-control" placeholder="Enter category name"  name="products_list" id="products_list">
													<input type="hidden"  id="cst_name">
													<input type="hidden"  id="products_id">
													<input type="hidden"  id="sku_no">
													<input type="hidden"  id="price">
													<span>Note: Type the product name to autopopulate</span>
										
											</div>
															<div class="form-group col-md-1 text-left add_btn">
												
											 <a class="btn btn-primary pull-right add-prod">+Add</a>
											 </div>
									</div>
								
                                </div> 
                            <div class="col-md-2">
                               
                            </div>
                     
                            <div class="col-md-12">
                                <h4>Assigned Products</h4>
                                <table class="table table-inverse">
                                  <thead>
                                    <tr>
                                      <th>Costume Name</th>
                                      <th>SKU No</th>
                                      <th>Price</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody id='reorder' class="assigned-products">
                                  </tbody>
                                </table>

                            </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/categories" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
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
<script src ="{{ asset('/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/category.js') }}"></script>
<script src="{{ asset('/js/validator-addtional-methods.js')}}"></script>

@stop
