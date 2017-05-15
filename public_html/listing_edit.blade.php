@extends('app')
	@section('title')
	Listing Edit @parent

	@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/css/drop_uploader.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-ui/themes/base/sortable.css')}}">
@endsection

@section('content')
  @include('partials.inner_pages_header')
	<!-- create list start here -->

<section class="create_section_page">
		<div class="container create-list-tldiv">
			<div class="row creat_listings">

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

					<div class="col-md-12">
				<div class="main-headings">
					<h1> <span>{{Auth::user()->display_name}},</span> ready to Edit your listing?</h1>
					<h4>The Basics</h4>
				</div>
				</div>
				<div class="row list-frm">
				<div class="col-md-12">
					<form action="/list-edit/{{$data['basic_info'][0]->rs_id}}" name="listing_edit" id="listing_edit" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="rs_id" value="{{$data['basic_info'][0]->rs_id}}">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Type of Space</label>
<?php
if (Auth::user()->id != "1") {
	$spaces = explode(',', Session::get('sub_details')[0]->spaces);
} else {
	$spaces = explode(',', $sub_details[0]->spaces);
}
?>
<select class="form-control" name="listing_type" id="listing_type">
									@foreach($spaces as $sp)
									<option value="{{$sp}}" {{$data['basic_info'][0]->type}} {{ucfirst($sp)}} @if($data['basic_info'][0]->type==ucfirst($sp)) selected @endif>@if($sp=="popup") Pop-Up @else {{ucfirst($sp)}} @endif Space</option>
									@endforeach
								</select>
								<p class="error">{{ $errors->first('listing_type') }}</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group @if($data['basic_info'][0]->type=="Entire") hide @endif">
								<label for="">Shared Space</label>
									<select class="form-control" name="is_sharable" id="is_sharable">
									<option value="1" @if($data['basic_info'][0]->is_sharable=="1") selected @endif>Yes</option>
									<option value="0" @if($data['basic_info'][0]->is_sharable=="0") selected @endif>No</option>
								</select>
							</div>
						</div>
							<div class="@if($data['basic_info'][0]->type=="Entire") col-md-6 @else col-md-3 @endif">
							<div class="form-group sq">
								<label for="">Available Space <span class="require">*</span></label>
								<input type="text" class="form-control" name="available_space" id="available_space" value="{{$data['basic_info'][0]->available_space}}">
								<p class="error">{{ $errors->first('available_space') }}</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Listing Title <span class="require">*</span></label>
								<input type="text" class="form-control" placeholder="A short description of your space" name="name" id="name" value="{{$data['basic_info'][0]->name}}">
								<p class="error">{{ $errors->first('name') }}</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Property Description <span class="require">*</span></label>
								<textarea class="form-control" rows="5" name="description" id="description" placeholder="Write a brief description of the space. What makes it special? Why should people book your space?">{{$data['basic_info'][0]->description}}</textarea>
								<span class="text-limit text-right">[<span class="count">{{strlen($data['basic_info'][0]->description)}}</span> of 500 character limit]</span>
								<p class="error">{{ $errors->first('description') }}</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Keywords</label>
								<input class="form-control" rows="5" name="keywords" id="keywords" placeholder="Use keywords that describe the space separated by commas." value="{{$data['basic_info'][0]->keywords}}"></input>
							</div>
						</div>
					<div class="aminities  sub-heading">
						<div class="col-md-12">
						<h4>Amenities</h4>
						</div>
						<ul>
							@foreach($amenties_list as $amenties)
								  <li><label><input type="checkbox" value="{{$amenties->option_value_id}}" name="amenties_list[]" @foreach($data['list_amenties'] as $lst_am) @if($lst_am->name==$amenties->name) checked @endif @endforeach/>{{$amenties->name}}</label></li>
							@endforeach
						</ul>
					</div>
					<div class="aminities  sub-heading">
						<div class="col-md-12">
						<h4>Styles</h4>
						</div>
						<ul>
						@foreach($styles_list as $styles)
						  <li><label><input type="checkbox" value="{{$styles->option_value_id}}" name="styles_list[]" @foreach($data['list_styles'] as $lst_sty) @if($lst_sty->name==$styles->name) checked @endif @endforeach/>{{$styles->name}}</label></li>
						@endforeach
						</ul>
					</div>

					<div class=" Property  sub-heading">
						<div class="col-md-12">
					<h4>Property Address</h4>
					</div>
					<input type="hidden" class="form-control" name="address_id"  value="{{$data['basic_info'][0]->address_id}}">
					<div class="col-md-6">
							<div class="form-group">
								<label for="">Address 1 <span class="require">*</span></label>
							<input type="text" class="form-control" name="address1" id="address1" value="{{$data['basic_info'][0]->address1}}">
							<p class="error">{{ $errors->first('address1') }}</p>

							</div>
						</div>
								<div class="col-md-6">
							<div class="form-group">
								<label for="">Address 2</label>
						<input type="text" class="form-control" name="address2" id="address2" value="{{$data['basic_info'][0]->address2}}">
							</div>
						</div>
							<div class="col-md-6">
							<div class="form-group">
								<label for="">City <span class="require">*</span></label>
							<!-- 	<select class="form-control" name="city" id="city">
									<option value="">City</option>
									<option value="New York" @if($data['basic_info'][0]->city=="New York") selected @endif>New York</option>
							</select> -->
							<input type="text" class="form-control" name="city" id="city" value="{{$data['basic_info'][0]->city}}">
							<p class="error">{{ $errors->first('city') }}</p>
							</div>
						</div>
								<div class="col-md-6">
							<div class="form-group">
								<label for="">State <span class="require">*</span></label>
						<select class="form-control" name="state" id="state">
									<option>State</option>
									@foreach($status as $st)
									<option value="{{$st->id}}" @if($data['basic_info'][0]->state_name==$st->state_name) selected @endif>{{$st->state_name}}</option>
									@endforeach
						</select>
						<p class="error">{{ $errors->first('state') }}</p>
							</div>
						</div>
							<!-- <div class="col-md-6">
							<div class="form-group">
								<label for="">Country</label>
							<select class="form-control" name="country" id="country">
									<option value="230">United States</option>
							</select>
							<p class="error">{{ $errors->first('country') }}</p>
							</div>
						</div> -->
						<input name="country" value="230" id="country" type="hidden"/>
								<div class="col-md-6">
						<div class="form-group">
								<label for="">Zip Code <span class="require">*</span></label>
						<input type="text" class="form-control" name="zip_code" id="zip_code" value="{{$data['basic_info'][0]->zip_code}}">
						<p class="error">{{ $errors->first('zip_code') }}</p>
						</div>
						</div>
					</div>


					<div class="business sub-heading clearfix  @if($data['basic_info'][0]->type=="Entire") hide @endif">
						<div class="col-md-12">
					<h4>Business Hours <!-- <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-original-title="08:00AM-10:00PM" aria-hidden="true"></i> --></h4>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Monday</label>
							<input type="text" class="form-control" name="sun_time" id="sun_time" value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->sun_time}}@endif" placeholder="08:00AM-10:00PM">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Tuesday</label>
						<input type="text" class="form-control" name="mon_time" id="mon_time" value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->mon_time}}@endif" placeholder="08:00AM-10:00PM">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
							<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Wedneday</label>
							<input type="text" class="form-control" name="tue_time" id="tue_time"  value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->tue_time}}@endif" placeholder="08:00AM-10:00PM">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Thursday</label>
						<input type="text" class="form-control" name="wed_time" id="wed_time"  value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->wed_time}}@endif" placeholder="08:00AM-10:00PM">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
							<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Friday</label>
							<input type="text" class="form-control" name="thu_time" id="thu_time"  value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->thu_time}}@endif" placeholder="08:00AM-10:00PM">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Saturday</label>
						<input type="text" class="form-control" name="fri_time" id="fri_time"  value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->fri_time}}@endif" placeholder="08:00AM-10:00PM">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
							<div class="form-group">
								<label for="">Sunday</label>
						<input type="text" class="form-control" name="sat_time" id="sat_time"  value="@if($data['basic_info'][0]->type!="Entire"){{$data['list_hours'][0]->sat_time}}@endif" placeholder="08:00AM-10:00PM">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
					</div>
					<div class="Pricing sub-heading">
						<div class="col-md-12">
					<h4>Pricing</h4>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12 ngtl">
							<div class="form-group">
							<div class="radio">
								<input type="radio" value="negotiable" name="rent_price_type" id="rent_price_type" @if($data['basic_info'][0]->rent_price_type=="1") checked @endif><label for="">Negotiable</label>
							</div>
							</div>
						</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								<div class="radio">
						  <label><input type="radio" value="flat_rate" name="rent_price_type" id="rent_price_type" @if($data['basic_info'][0]->rent_price_type=="2") checked @endif>Flat Rate</label>
						 	<div class="col-md-12 col-sm-12 col-xs-12 @if($data['basic_info'][0]->type=="Entire") yrs  @elseif($data['basic_info'][0]->type=="Events") hrs @else dys @endif flat_range @if($data['basic_info'][0]->rent_price_type!="2") hide @endif">
						 	 <input type="text" class="form-control"  name="flat_rent_to" id="flat_rent_to" placeholder="$0.00"  @if($data['basic_info'][0]->rent_price_type=="2") value="${{$data['basic_info'][0]->rent_from}}" @endif>
						 	 </div>
						</div>
							</div>
						</div>
							<div class="col-md-6 col-sm-12 col-xs-12 rnge">
							<div class="form-group ">
								<div class="radio">
						  <label><input type="radio" value="range" name="rent_price_type" id="rent_price_type" @if($data['basic_info'][0]->rent_price_type=="3") checked @endif>Range</label>
						  <div class="row price_range  @if($data['basic_info'][0]->rent_price_type!="3") hide @endif">
							<div class="col-md-5 col-sm-6 col-xs-5 prc_from @if($data['basic_info'][0]->type=="Entire") yrs  @elseif($data['basic_info'][0]->type=="Event") hrs @else dys @endif">
						  <input type="text" class="form-control"  name="rent_from" id="rent_from" placeholder="$0.00" @if($data['basic_info'][0]->rent_price_type=="3") value="${{$data['basic_info'][0]->rent_from}}" @endif >
						</div>
							<div class="col-md-1 col-sm-1 col-xs-1"> <span>TO </span>	</div>
							<div class="col-md-5 col-sm-5  col-xs-5 prc_to @if($data['basic_info'][0]->type=="Entire") yrs  @elseif($data['basic_info'][0]->type=="Event") hrs @else dys @endif">
							  <input type="text" class="form-control" name="rent_to" id="rent_to"  placeholder="$0.00" @if($data['basic_info'][0]->rent_price_type=="3") value="${{$data['basic_info'][0]->rent_to}}" @endif>
							</div>
						  </div>
						</div>
							</div>
						</div>
						<div class="period_info @if($data['basic_info'][0]->type=="Entire") hide @endif">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group hours-tm">
								<label for="">Minimum Rental Period</label>
							<input type="text" class="form-control"  name="min_rental_from" id="min_rental_from" value="{{$data['basic_info'][0]->min_rental_from}}">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group hours-tm">
								<label for="">Maximum Rental Period</label>
							<input type="text" class="form-control"  name="min_rental_to" id="min_rental_to" value="{{$data['basic_info'][0]->min_rental_to}}">
							</div>
						</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group caldr-lst">
								<label for="">Space Availability From</label>
							<input type="text" class="form-control from_date" name="min_space_from" id="min_space_from"  value="{{$data['basic_info'][0]->min_space_from}}" >
							</div>
						</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group caldr-lst">
								<label for="">Space Availability To</label>
							<input type="text" class="form-control to_date" name="min_space_to" id="min_space_to" value="{{$data['basic_info'][0]->min_space_to}}">
							</div>
						</div>
						<p class="error">{{ $errors->first('rent_price_type') }}</p>
						<div class="payment-optons">
								<div class="col-md-12">
							<div class="form-group">
								<label for="">Accept credit card payment <!-- <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-original-title="Lorum" aria-hidden="true"></i> --></label>
							<select class="form-control" name="accept_cc" id="accept_cc">
									<option value="1" @if($data['basic_info'][0]->accept_cc=="1") selected @endif>Yes</option>
									<option value="0" @if($data['basic_info'][0]->accept_cc=="0") selected @endif>No</option>

								</select>
							</div>
						</div>
						</div>
								<div class="col-md-12">
							<div class="form-group">
								<label for="">Allow Instant Booking <!-- <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-original-title="Lorum" aria-hidden="true"></i> --></label>
							<select class="form-control"  name="is_instant_booking" id="is_instant_booking">
									<option value="1"  @if($data['basic_info'][0]->is_instant_booking=="1") selected @endif>Yes</option>
									<option value="0"  @if($data['basic_info'][0]->is_instant_booking=="0") selected @endif>No</option>

								</select>
							</div>
						</div>
							</div>
					</div>

					<div class="photo-section sub-heading">
						<div class="col-md-12">
					<h4>Photos <span class="require">*</span></h4>
					</div>
					<div class="col-md-12  ">
					<p>Add as many images of your space as you’d like, we suggest at least 5 images. Make sure they are at least 1400px width and 1024px height. The first uploaded image will be the cover photo.</p>
					<div class="col-md-12" id="imagelist">
					<ul id="reorder">
					@if(!empty($data['images']))
					 @foreach($data['images'] as $images)
					<li  data-image-id="{{$images->id}}">
						<div class="img_remver-prnt blk"><a href="" class="image-remove">
						 <input type="hidden" name="images_ids[]" value="{{$images->id}}"/>
						  <img class="img-responsive" src="/uploads/listing_images/popups/{{$images->filename}}" />
						   <i class="fa fa-times-circle remove-pict" aria-hidden="true"></i>
						</a>
					</div>
					</li>
					@endforeach
					@endif
					<!-- @foreach($data['list_thumbs'] as $list_thumbs)
					<li data-image-id="{{$data['list_images'][0]->id}}">
						<div class="col-md-2 col-sm-2 col-xs-4 blk">
							<a href="" class="image-remove">
							<input type="hidden" name="images_ids[]" value="{{$list_thumbs->id}}">
								<img class="img-responsive"  src="/uploads/listing_images/popups/{{$list_thumbs->filename}}" />
								<i class="fa fa-times-circle remove-pict" aria-hidden="true"></i>
								</a>
						</div>
					</li>
					@endforeach -->
					</div>
					<div class="clearfix"></div>
				<div class="has-advanced-upload">
						<div class="box__input">
							<input type="file" name="images[]" id="file" class="box__file" multiple>
						</div>
					</div>
					</div>
						</div>

					<div class="col-md-12 text-center">
					<button type="submit" class="box__button">Update Listings</button>

					</div>



					</form>
				</div>		</div>
				</div>	</div>
			</div>

</section>			<!-- create list End here -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/assets/vendors/moment/js/moment.min.js')}}"></script>
<script src="{{ asset('/assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/assets/vendors/currencyFormat/jquery.maskMoney.min.js')}}"></script>
<script src="{{ asset('/assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/js/pages/listing_create.js')}}"></script>
<script src="{{ asset('/assets/js/drop_uploader.js')}}"></script>
<script src ="{{ asset('/assets/vendors/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="text/javascript">
$('.from_date').datetimepicker({format: 'MM/DD/YYYY'});
$('.to_date').datetimepicker({format: 'MM/DD/YYYY'});
$(".from_date").on("dp.change", function (e) {
            $('.to_date').data("DateTimePicker").minDate(e.date);
        });
        $(".to_date").on("dp.change", function (e) {
        	//$('.from_date').data("DateTimePicker").maxDate(e.date);
 });
$( "ul#reorder" ).sortable({
	cursor: 'move',
	//axis: 'x' ,
    start: function(event, ui) {
        ui.item.startPos = ui.item.index();
    },
     stop: function(event, ui) {
     	var new_position=ui.item.index();
	    	var old_position= ui.item.startPos;
	    	var image_id=$(ui.item).attr('data-image-id');
	    	var _token=$('input[name="_token"]').val();
	    	var listing_id={!! $data['basic_info'][0]->rs_id !!};
		 $.ajax({
           	        url: "/list/image/position/update",
            	        method:"POST",
            	        data:{new_position:new_position,old_position:old_position,image_id:image_id,listing_id:listing_id,_token:_token},
            	 		async: true,
            	        success: function( response ) {
            	        }
           	});
       }
});
</script>
@stop
