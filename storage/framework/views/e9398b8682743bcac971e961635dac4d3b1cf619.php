<?php $__env->startSection('title'); ?>
View User |@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
       
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
<section class="content-header">
	<h1>Settings</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li class="active">Settings</li>
	</ol>
	
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-body">
				
					<?php if(Session::has('error')): ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo e(Session::get('error')); ?>

					</div>
					<?php elseif(Session::has('success')): ?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo e(Session::get('success')); ?>

					</div>
					<?php endif; ?> 
					<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-file">
                            </span> Selling Address</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body"><form class="" action="<?php echo e(route('seller-location-address')); ?>" method="POST" id="seller_address">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
       	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="chek-out">
							<div class="new_address">
								<div class="address-form">
									<div class="col-md-12">
										  <div class="col-md-12 location-div">
                                            <div class="form-group has-feedback add-event-error" >
                                                <div id="locationField">
                                                    <input type="text" class="form-control" placeholder="Enter Location"  id="autocomplete" onFocus="geolocate()" >
                                                    <label class="note">Note: Type the location name and select  to populate in address fields</label>
                                                    <p class="error"><?php echo e($errors->first('location')); ?></p>

                                                </div>

                                            </div>
                                            <div class="form-group has-feedback selling_location_note" >


                                                <input type="hidden" class="field form-control" id="country" name="country">
                                                     <?php if(count($seller_address)): ?>  <input type="hidden" class="field form-control" name="add_id" value="<?php echo e($seller_address[0]->address_id); ?>">  <input type="hidden" class="field form-control" name="is_edit" value="0"> <?php endif; ?>
                                                
									  </div>
                                        <div class="clearfix"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<input type="hidden" class="field form-control" id="street_number">
                                        <input type="text" class="field form-control" id="address_1" name="address_1" disable="true" placeholder="Apt or Suite no." value="<?php if(count($seller_address)): ?> <?php echo e($seller_address[0]->address1); ?> <?php endif; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group">
                                       <input type="text" class="field form-control" name="address_2" id="route" placeholder="Address *" value="<?php if(count($seller_address)): ?> <?php echo e($seller_address[0]->address2); ?> <?php endif; ?>">
                                    </div>
                                    </div>

                                     <div class="col-md-6">
										<div class="form-group">
                                        <input type="text" class="field form-control" id="locality" name="city" placeholder="City *" value="<?php if(count($seller_address)): ?> <?php echo e($seller_address[0]->city); ?> <?php endif; ?>">
                                   		 </div>
                                    </div>

                                     <div class="col-md-6">
										<div class="form-group">
                                        <input type="text" class="field form-control" id="administrative_area_level_1" name="state" 
                                        placeholder="State *" value="<?php if(count($seller_address)): ?> <?php echo e($seller_address[0]->state); ?> <?php endif; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group">
                                        <input type="text" class="field form-control" id="postal_code" name="zipcode" placeholder="Zip code *" value="<?php if(count($seller_address)): ?><?php echo e($seller_address[0]->zip_code); ?><?php endif; ?>">
                                   		 </div>
                                   </div>
                                      <div class="col-md-12">
                                      <?php if(count($seller_address)): ?> <button class="btn btn-primary submit-btn">Update</button> <?php else: ?> <button class="btn btn-primary submit-btn">Submit</button> <?php endif; ?>
                                    </div>
								
									
								</div>
							</div>
		
								
							
					</div>
				</div>

       </form></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th-list">
                            </span> Request Bag Services</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                            <form class="" action="<?php echo e(route('request_bag')); ?>" method="POST" id="request_bag" autocomplete="off">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="request_bag[service]" placeholder="Service From Chrysalis *" <?php if(isset($request_bag['service'])): ?> value="<?php echo e($request_bag['service']); ?>" id="service" <?php endif; ?>/>
                                    </div>
                                     <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Weight *" name="request_bag[weight]" <?php if(isset($request_bag['weight'])): ?> value="<?php echo e($request_bag['weight']); ?>" id="weight" <?php endif; ?>/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm well-primary">
                                         <button class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
            async defer></script>
  <script>
  var request_bag=$("#request_bag").validate({ignore: ":hidden" });
  var seller_address=$("#seller_address").validate({ignore: ":hidden" });

  $("#address_1").rules("add", {maxlength: 100});
  $("#route").rules("add", {required:true,maxlength: 100});
  $("#locality").rules("add", {required:true});
  $("#postal_code").rules("add", {required:true,number:true});
  $("#administrative_area_level_1").rules("add", {required:true});


  $("#service").rules("add", {required:true,maxlength: 100});
  $("#weight").rules("add", {required:true,maxlength: 100});
  
       $(document).on('click','.selling_popup_add',function(){
       	$('#selling_popup_add').modal('show'); 
       });
       $(document).on('click','.edit_selling_addr',function(){
       	$('#selling_popup_add').modal('show'); 
       });
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type  {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
        	  console.log(document.getElementById(component).value);
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            if(addressType=="route"){
            	$('#route').val($('#street_number').val()+" "+val);
        	}else{
        	 document.getElementById(addressType).value = val;
        	}
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>