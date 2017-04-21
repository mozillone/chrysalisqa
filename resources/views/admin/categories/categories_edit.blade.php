@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Category edit@parent
@endsection


{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/jquery-ui/themes/base/jquery-ui.css')}}">
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
        
        <li class="active">edit {{$cat_data[0]->name}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Edit {{$cat_data[0]->name}}</h3>
                </div>
                <div class="box-body">
                     <form id="category-edit" class="form-horizontal defult-form" name="userForm" action="{{route('categories-edit')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <input type="hidden" name="category_id" value="{{$cat_data[0]->category_id}}"> 
                        <div class="col-md-12">
                            <h4>Basic Information</h4>
                            <hr>
                            <div class="col-md-6">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Name <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter category name"  name="name" id="name" value="{{$cat_data[0]->name}}">
                                        <p class="error">{{ $errors->first('name') }}</p> 
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Parent Category</label>
                                            <select class="form-control" id="parent_id" name="parent_id">
                                                <option value="">--Select--</option>
                                                @foreach($parent_cats as $cats)
                                                <option value="{{$cats->category_id}}" @if($cats->category_id==$cat_data[0]->parent_id && $cat_data[0]->parent_id!="0") selected @endif>{{$cats->name}}</option>
                                                @endforeach
                                           </select>
                                        <p class="error">{{ $errors->first('parent_id') }}</p> 
                                    </div>
                                     <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Description<span class="req-field" >*</span></label>
                                            <textarea class="form-control" placeholder="Enter category description"  name="desc">{{$cat_data[0]->description}}</textarea> 
                                        <p class="error">{{ $errors->first('desc') }}</p> 
                                    </div>
                                </div> 
                           <!--  <div class="col-md-6">
                             <div class="col-md-12">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Image <span class="req-field" >*</span></label>
                                            <input type="file" class="form-control" name="cat_image" id="cat_image">
                                            <div class="col-md-12">
                                                 <img @if(file_exists( public_path('category_images/Normal/'.$cat_data[0]->thumb_image)))) src="/category_images/Normal/{{$cat_data[0]->thumb_image}}" @else  src="/category_images/df_img.jpg" @endif class="img-responsive"/>
                                            </div>
                                        <p class="error">{{ $errors->first('cat_image') }}</p> 
                                    </div>
                                     <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Category Banner Image <span class="req-field" >*</span></label>
                                            <input type="file" class="form-control" name="banner_image" id="banner_image">
                                            <div class="col-md-12">
                                                 <img @if(file_exists( public_path('category_images/Banner/'.$cat_data[0]->banner_image)))) src="/category_images/Banner/{{$cat_data[0]->banner_image}}" @else  src="/category_images/df_img.jpg" @endif class="img-responsive"/>
                                            </div>
                                        <p class="error">{{ $errors->first('banner_image') }}</p> 
                                    </div>
                                </div> 
                            </div> -->
                             <div class="col-md-6">
                            <label for="inputEmail3" class="control-label">Category Image <span class="req-field" >*</span></label>
                                <div class="col-md-12">
                                    <div class="form-group">

                                      <div class="row upload_bx col-md-4 col-sm-6 col-xs-12">
                                          <div class="">
                                            <div class=" upload_btns">
                                                      <span class=" btn-file">
                                                        <span class="fileupload-exists"></span>     
                                                        <input id="cat_image" name="cat_image" type="file" placeholder="Profile Image" class="img-pview img-responsivel">
                                                        <input type="hidden" name="is_removed"/>
                                              </span> 
                                              </div>
                                            </div>
                                      </div>
									  <div class="col-md-6 col-sm-6 col-xs-12 ">
                                      <div class="cat_img fileupload fileupload-new" data-provides="fileupload"> 
                                          <img @if(file_exists( public_path('category_images/Normal/'.$cat_data[0]->thumb_image)))) src="/category_images/Normal/{{$cat_data[0]->thumb_image}}" @else  src="/category_images/df_img.jpg" @endif  class="img-responsive"  id="img-chan1">
                                      
                         
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                      </div>
												   </div>
                                    </div>
                            </div>  
                        </div>
                          <div class="col-md-6">
                            <label for="inputEmail3" class="control-label">Category Banner Image <span class="req-field" >*</span></label>
                                <div class="col-md-12">
                                    <div class="form-group">

                                      <div class="row upload_bx col-md-4 col-sm-6 col-xs-12">
                                          <div class="">
                                            <div class=" upload_btns">
                                                      <span class=" btn-file">
                                                        <span class="fileupload-exists"></span>     
                                                        <input id="banner_image" name="banner_image" type="file" placeholder="Profile Image" class="img-pview img-responsivel">
                                                        <input type="hidden" name="is_removed"/>
                                              </span> 
                                              </div>
                                            </div>
                                      </div>
									  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="ban_img fileupload fileupload-new" data-provides="fileupload"> 
                                          <img @if(file_exists( public_path('category_images/Banner/'.$cat_data[0]->banner_image)))) src="/category_images/Banner/{{$cat_data[0]->banner_image}}" @else  src="/category_images/df_img.jpg" @endif class="img-responsive"  id="img-chan2">
                                 
                         
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                      </div>
										    </div>
                                    </div>
                            </div>  
                        </div>
                    </div> 
                    </div> 
                     <div class="col-md-12 costumes @if($cat_data[0]->parent_id=='0')hide @endif ">
                            <h4>Category Costumes</h4>
                            <hr>
                            <div class="col-md-8">
                                <div class="col-md-6">
                                        <div class="form-group has-feedback" >
                                            <label for="inputEmail3" class="control-label">Product</label>
                                                <input type="text" class="form-control" placeholder="Enter category name"  name="products_list" id="products_list">
                                                 <input type="hidden"  id="cst_name">
                                                 <input type="hidden"  id="products_id">
                                                 <input type="hidden"  id="sku_no">
                                                 <input type="hidden"  id="price">
                                                 <span>Note: Type the product name to autopopulate</span>
                                        </div>
                                </div> 
                            <div class="col-md-2">
                                <a class="btn btn-primary pull-right add-prod">+Add</a>
                            </div>
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
                                    @foreach($cat_costumes as $cst)
                                    <tr>
                                        <td><input type="hidden" value="{{$cst->costume_id}}" name="costume_list[]" class="costume_id"/>{{$cst->cst_name}}</td>
                                        <td>{{$cst->sku_no}}</td>
                                        <td>${{$cst->price}}</td>
                                        <td><a href="javascript::void(0);" class="remove_cost"  data-cost-id='{{$cst->costume_id}}'><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/categories" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
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
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src ="{{ asset('/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/category.js') }}"></script>
<script src="{{ asset('/js/validator-addtional-methods.js')}}"></script>

@stop
