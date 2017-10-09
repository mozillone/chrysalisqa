<?php $__env->startSection('title'); ?> @parent

<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <?php
    $event_id=Request::segment(3);
    /*echo "<pre>";
    print_r($users->event_name);
    die;*/
    ?>


    <?php if(isset($users) && !empty($users)): ?>
        <?php
        $all_data = $users;

        ?>
    <?php else: ?>
        <?php
        $all_data = ""; ?>
    <?php endif; ?>


    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/googleautostyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/clockpicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <style>
        .fileupload-new .btn-file {
            margin: 10px 0 0 20px;
        }
    </style>

    <section class="content-header">
        <h1>Events</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo e(url('events-list')); ?>"> Events List</a>
            </li>
            <li class="active"><?php echo e($all_data->event_name); ?></li>
        </ol>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title heading-agent col-md-12">Edit Event </h3>
                    </div>
                    <div class="box-body">
                        <!--Tabs code starts here-->

                        <!--Tab code ends here-->



                        <form id="events-update" class="form-horizontal defult-form" name="userForm" action="/admin/updateevent" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div>

                                <div class="col-md-6">
                                    <h2 class="heading-agent">Event Information</h2>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback" >
                                            <label for="inputEmail3" class="control-label">Event Name<span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Event name"  name="eventName" id="eventName" value="<?php echo e($all_data->event_name); ?>">
                                            <p class="error"><?php echo e($errors->first('eventName')); ?></p>

                                        </div>
                                        <div class="form-group has-feedback" >
                                            <label for="inputEmail3" class="control-label">Event URL<span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Event URL"  name="eventUrl" id="name" value="<?php echo e($all_data->event_url); ?>">
                                            <p class="error"><?php echo e($errors->first('eventUrl')); ?></p>
                                        </div>

                                
                                        <?php
                                        $fromDate = $users->from_date;
                                        $explode = explode('-', $fromDate);
                                        $year = $explode[0];
                                        $month = $explode[1];
                                        $date = $explode[2];
                                        $fullFromDate = $month.'/'.$date.'/'.$year;
                                        // print_r($fullFromDate);exit;

                                        ?>

                                        <div class="row">
                                            <div class="col-md-6 cldr" >
                                                <div class="form-group" >
                                                    <label for="inputEmail3" class="control-label">From Date<span class="req-field" >*</span></label>

                                                    <input type="text" class="datepicker form-control" name="fromDate" id="fromDate" maxlength="50" value="<?php echo e($fullFromDate); ?>">
                                                    <p class="error"><?php echo e($errors->first('fromDate')); ?></p>
                                                </div>
                                            </div>




                                            <div class="col-md-6">
                                                <div class="form-group input-group clockpicker" id="error-msg-align">
                                                    <label for="inputEmail3" class="control-label time-label error-msg-align">From Time<span class="req-field" >*</span></label>
                                                    <input type="text" class="form-control" name="fromTime" value="<?php echo e($users->from_time); ?>">
                                                    <p class="error"><?php echo e($errors->first('fromTime')); ?></p>

                                                    <span class="input-group-addon glyphicon glyphicon-time"></span>

                                                </div>
                                            </div>


                                            <?php
                                            $toDate = $users->to_date;
                                            //echo $toDate;exit;
                                            $explode = explode('-', $toDate);
                                            //print_r($explode);exit;
                                            $year = $explode[0];
                                            // print_r($month);exit;
                                            $month = $explode[1];
                                            // print_r($date);exit;
                                            $date = $explode[2];
                                            // print_r($year);exit;
                                            $fullToDate = $month.'/'.$date.'/'.$year;
                                            // print_r($fullToDate);exit;
                                            ?>


                                            <div class="clearfix"></div>

                                            <div class="col-md-6 cldr">
                                                <div class="form-group" >
                                                    <label for="inputEmail3" class="control-label">To Date<span class="req-field" >*</span></label>

                                                    <input type="text" name="toDate" id=toDate" class="datepicker form-control" maxlength="50" value="<?php echo e($fullToDate); ?>">
                                                    <p class="error"><?php echo e($errors->first('toDate')); ?></p>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group input-group clockpicker" id="error-msg-align">
                                                    <label for="inputEmail3" class="control-label time-label ">To Time<span class="req-field" >*</span></label>
                                                    <input type="text" class="form-control" name="toTime" value="<?php echo e($users->to_time); ?>">
                                                    <p class="error"><?php echo e($errors->first('toTime')); ?></p>

                                                    <span class="input-group-addon glyphicon glyphicon-time"></span>

                                                </div>
                                            </div>



                                            <div class="clearfix"></div>

                                            <div>
                                                <label for="inputEmail3" class="control-label">Post Description
                                                    <span class="req-field" >*</span>
                                                </label>
                                                <textarea id="eventDesc" name=eventDesc><?php echo e($users->event_desc); ?></textarea>
                                                <p class="error"><?php echo e($errors->first('eventDesc')); ?></p>
                                            </div>

                                        </div>
                                    </div>           </div>
                                <div class="col-md-6">
                                    <h2 class="heading-agent">Event Address</h2>
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="inputEmail3" class="control-label"> Location Name</label>
                                                <span class="req-field" >*</span></label>
                                                <div class="form-group has-feedback" >

                                                    <div id="locationField">
                                                        <input type="text" class="form-control" placeholder="Enter Location" value="<?php echo e($users->location_name); ?>"  name="location" id="autocomplete" onFocus="geolocate()" >
                                                    </div>
                                                    <span id="autocomplete_error" style="color:red"></span>
                                                </div>
                                                <div class="form-group has-feedback" >



                                                    <div class="form-group has-feedback">
                                                        <label for="inputEmail3" class="control-label">Address 1</label>

                                                        <input type="text" class="field form-control" id="street_number" name="address1" disable="true" value="<?php echo e($users->address1); ?>" required></input>
                                                    </div>

                                                    <div class="form-group has-feedback" >
                                                        <label for="inputEmail3" class="control-label">Address 2</label>
                                                        <input type="text" class="field form-control" name="address2" id="route" value="<?php echo e($users->address2); ?>" required></input></td>
                                                    </div>

                                                    <div class="form-group has-feedback">
                                                        <label for="inputEmail3" class="control-label">City</label>
                                                        <input type="text" class="field form-control" id="locality" name="city" value="<?php echo e($users->city); ?>" required>
                                                    </div>

                                                    <div class="form-group has-feedback" >
                                                        <label for="inputEmail3" class="control-label">State</label>
                                                        <input type="hidden" class="field form-control state_hidden" id="administrative_area_level_1" name="state"></input>
                                                        <select id="state_select" class="form-control">
                                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                                <option class="state_dropdown" <?php if($users->state == $state->abbrev): ?> selected="selected" <?php endif; ?> value="<?php echo e($state->abbrev); ?>"><?php echo e($state->name); ?></option>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                        </select>

                                                    </div>
                                                   

                                                    <div class="form-group has-feedback" >
                                                        <label for="inputEmail3" class="control-label">Zip Code</label>
                                                        <input type="text" class="field form-control" id="postal_code" name="zipcode" value="<?php echo e($users->zip_code); ?>">
                                                    </div>
                                                    <div class="form-group has-feedback" >
                                                     <div class="box-body">
                                        <div class="col-md-12 file-ups">
                                            <div class="form-group">
                                                <label for="Image" class="control-label">Upload Image<span class="req-field"> * </span></label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <img  style="width:160px;height:160px;"  src="<?php echo e(isset($users->user_img) && ($users->user_img!='default.jpg') ? URL::asset('event_images/'.$users->user_img) : URL::asset('default_pic.png')); ?>" class="img-pview img-responsive" id="img-chan" name="img-chan" style=" alt="" riot"="" >
                                                    <span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                    <span class="fileupload-exists"></span>
                                                        <input id="event_image" name="event_image" placeholder="Profile Image" class="form-control" type="file">

                                                    <input type="hidden" name="img_removed" class="img_removed">
                                <input type="hidden" class="name_img" class="find_img" value="<?php echo e(isset($users->user_img) && ($users->user_img!='default_pic.png') ? $users->user_img : 'default_pic.png'); ?>">
                                <span class="fileupload-preview"></span>
                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                                </div>
                                                <p ><b>Note:</b> The file could not be exceed above 10MB and allowed only .JPG, .JPEG, .PNG format.</p>
                                            </div>
                                        </div>
                                    </div>   
                                                    </div>

                                                    <input type="hidden" class="field form-control" id="country" name="country" required></input>

                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>




                                        <input type="hidden" name="eventid" id="eventid" value="<?php echo e($users->id); ?>">



                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="pull-right">
                                        <a href="/events-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                                        <button type="submit" class="btn btn-primary pull-right">Update Event</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

    <script src="<?php echo e(asset('/assets/admin/js/clockpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/admin/js/pages/events.js')); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script src="<?php echo e(asset('ckeditor/ckeditor/ckeditor.js')); ?>"></script>

    <script>
        $( function() {
            $('#fromDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#toDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
        } );
        $('.clockpicker').clockpicker();

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name',
        };
        function initAutocomplete() {
// Create the autocomplete object, restricting the search to geographical
// location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type  {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode'],
                    componentRestrictions: {country: 'us'}});

// When the user selects an address from the dropdown, populate the address
// fields in the form.

            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
// Get the place details from the autocomplete object.

            var place = autocomplete.getPlace();
            console.log(place.address_components);
            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

// Get each component of the address from the place details
// and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {

                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;




                    if(addressType == "administrative_area_level_1")
                        $("#state_select").val(val);



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

        $(document).ready(function() {
            CKEDITOR.replace( 'eventDesc' );
        });


    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>