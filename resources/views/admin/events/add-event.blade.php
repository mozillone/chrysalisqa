@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection
<<<<<<< HEAD
{{-- page level styles --}}

@section('header_styles')

    <link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
    <script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>

    <style>
        .fileupload-new .btn-file {
            margin: 10px 0 0 20px;
        }
        .notes{
            margin-top: 31PX;
        }
    </style>

=======

{{-- page level styles --}}
@section('header_styles')




<link rel="stylesheet" href="{{ asset('/assets/admin/css/googleautostyle.css') }}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/bootstrap-tagsinput.css') }}">

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">

      
       
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
@stop

{{-- Page content --}}
@section('content')
<<<<<<< HEAD
    <section class="content-header">
        <h1>Add Event</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('events-list')}}">Events</a>
            </li>

            <li class="active">Add Event</li>
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

                        <form id="events-create" class="form-horizontal defult-form" name="userForm" action="{{route('insert-events')}}" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-12">
                                <!-- post information starts here -->
                                <div class="col-md-6">
                                    <h2 class="heading-agent">Event Information</h2>
                                    <div class="form-group has-feedback" >
                                        <label for="event-name" class="control-label">Event Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Event Name"  name="eventname" id="event-name">
                                        <p class="error">{{ $errors->first('eventname') }}</p>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="event-url" class="control-label">Event URL<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Event URL"  name="eventurl" id="event-url">
                                        <p class="error">{{ $errors->first('eventurl') }}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback" >
                                                <label for="from-date" class="control-label">From Date<span class="req-field" >*</span></label>
                                                <input type="text" class="form-control" name="fromdate" id="from-date">
                                                <p class="error">{{ $errors->first('fromdate') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback" >
                                                <label for="from-time" class="control-label">From Time<span class="req-field" >*</span></label>
                                                <input type="text" class="form-control" name="fromtime" id="from-time">
                                                <p class="error">{{ $errors->first('fromtime') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback" >
                                                <label for="to-date" class="control-label">To Date<span class="req-field" >*</span></label>
                                                <input type="text" class="form-control" name="todate" id="to-date">
                                                <p class="error">{{ $errors->first('todate') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback" >
                                                <label for="to-time" class="control-label">To Time<span class="req-field" >*</span></label>
                                                <input type="text" class="form-control" name="totime" id="to-time">
                                                <p class="error">{{ $errors->first('totime') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="eventDesc" class="control-label">Event Description<span class="req-field" >*</span></label>
                                        <textarea id="eventDesc" class="form-control" name="eventDesc"></textarea>
                                        <p class="error">{{ $errors->first('eventDesc') }}</p>
                                    </div>
                                </div>
                                <!-- post information ends here -->
                                <!-- option starts here -->
                                <div class="col-md-6 col-sm-4 col-xs-12 blog_status_right">
                                    <h2 class="heading-agent">Event Address</h2>
                                    <div class="form-group has-feedback">
                                        <label for="autocomplete" class="control-label">Location Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Your Address" onFocus="geolocate()"  name="location" id="autocomplete">
                                        <p class="error">{{ $errors->first('location') }}</p>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="street_number" class="control-label">Address 1<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" id="street_number" name="address1">
                                        <p class="error">{{ $errors->first('address1') }}</p>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="route" class="control-label">Address 2<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" id="route" name="address2">
                                        <p class="error">{{ $errors->first('address2') }}</p>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="locality" class="control-label">City<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" id="locality" name="city">
                                        <p class="error">{{ $errors->first('city') }}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="administrative_area_level_1" class="control-label">State<span class="req-field" >*</span></label>
                                                <select class="form-control" name="state" id="administrative_area_level_1">
                                                    <option defualt value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->abbrev}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="error">{{ $errors->first('state') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="postal_code" class="control-label">Zip Code<span class="req-field" >*</span></label>
                                                <input type="text" class="form-control" id="postal_code" name="zipcode">
                                                <p class="error">{{ $errors->first('zipcode') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="hidden" class="form-control" id="country" name="country">
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <div class="form-group {{ $errors->has('profile_img') ? ' has-error' : '' }}" >
                                            <label for="Image" class="control-label">Upload Image <span class="req-field"> * </span></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <img src="../event_images/preview_placeholder.png" class="img-pview img-responsive" id="img-chan" name="img-chan" style="alt=;width: 160px;height: 160px;" "="" riot"="">
                                                <span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span>

                                                <input id="event_image" name="event_image" placeholder="Profile Image" class="form-control" type="file">

                                                <input type="hidden" name="img_removed" class="img_removed">
                                                <input type="hidden" class="name_img" class="find_img" value="{{ isset($user->profile_img) && ($user->profile_img!='default.jpg') ? $user->profile_img : 'default_pic.png' }}">
                                                <span class="fileupload-preview"></span>
                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                                            </div>
                                            <p><b>Note:</b> The file could not be exceed above 10MB and allowed only .JPG, .JPEG, .PNG format.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- options ends here -->
                            </div>

                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/events-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="{{ asset('/assets/admin/js/pages/events.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
    <script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete" async defer></script>
    <script type="text/javascript">
        $(document).ready(function() {

            CKEDITOR.replace( 'eventDesc' );

            $('#from-date,#to-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });

            $('#from-time,#to-time').clockpicker();

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

            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {
                    types: ['geocode'],
                    componentRestrictions: {country: 'us'}
                }
            );

            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {

            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

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

@stop
=======
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
.notes{
    margin-top: 31PX;
}
</style>

<section class="content-header">
    <h1>Events</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('events-list')}}"> Events List</a>
        </li>
        <li class="active">Add Event</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title heading-agent col-md-12">Add Event </h3>
                </div>
                <div class="box-body">
                <!--Tabs code starts here-->
                 
<!--Tab code ends here-->
                
                

                  <form id="events-create" class="form-horizontal defult-form" name="userForm" action="{{ route('insert-events') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-6">
                            <h2 class="heading-agent">Event Information</h2>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Event Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Event name"  name="eventName" id="eventName">
                                        <p class="error">{{ $errors->first('eventName') }}</p> 

                                    </div>
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Event URL<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Event URL"  name="eventUrl" >
                                    <p class="error">{{ $errors->first('eventUrl') }}</p> 
                                </div>

                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Event Image<span class="req-field" >*</span></label>
                        <input type="file" name="eventImage"><br><br>
                                    <p class="error">{{ $errors->first('eventUrl') }}</p> 
                                </div>

                                <div class="row">
                                    <div class="col-md-6 cldr" >
                                        <div class="form-group" >
                                        <label for="inputEmail3" class="control-label">From Date<span class="req-field" >*</span> </label>
                                    
                                    <input type="text" class="datepicker form-control" name="fromDate" maxlength="50" >
                                    <p class="error">{{ $errors->first('fromDate') }}</p> 
                                    </div>
                                </div>

            
        <div class="col-md-6">
        <div class="form-group input-group clockpicker">
        <label for="inputEmail3" class="control-label time-label">From Time<span class="req-field" >*</span></label>
<input type="text" class="form-control" name="fromTime">
<p class="error">{{ $errors->first('fromTime') }}</p>
    
        <span class="input-group-addon glyphicon glyphicon-time"></span>
    
</div>
</div>
        

       

                                    

                                   

                                    <div class="clearfix"></div>

                                    <div class="col-md-6 cldr">
                                        <div class="form-group" >
                                        <label for="inputEmail3" class="control-label">To Date<span class="req-field" >*</span></label>
                                    
                                    <input type="text" name="toDate" class="datepicker form-control" maxlength="50">
                                <p class="error">{{ $errors->first('toDate') }}</p> 
                                        </div>
                                    </div>

        
 <div class="col-md-6">
        <div class="form-group input-group clockpicker">
        <label for="inputEmail3" class="control-label time-label">To Time<span class="req-field" >*</span></label>
    <input type="text" class="form-control" name="toTime">
    <p class="error">{{ $errors->first('toTime') }}</p>
    
        <span class="input-group-addon glyphicon glyphicon-time"></span>
    
</div>
</div>
                                    
                                <div class="clearfix"></div>
                                    
                                <div>
                                <label for="inputEmail3" class="control-label">Event Description
        <span class="req-field" >*</span>
        </label>
                        <textarea id="summernote" name=eventDesc></textarea>
                        <p class="error">{{ $errors->first('eventDesc') }}</p> 
                                </div>


        
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Event Tags<span class="req-field" >*</span></label>
                                    <input type="text"  class="form-control" name="eventTags" id="eventTags"/>
                                    
                                    <input type="text" name="tags" placeholder="Tags" class="typeahead tm-input form-control tm-input-info"/>
                                        <!-- <input type="text" class="form-control" placeholder="Enter Event Tags"  name="eventTags">
                                        <p class="error"> -->{{ $errors->first('eventTags') }}</p>
                                </div>
                                      
                                </div>
                                </div>          </div>   
                                <div class="col-md-6">
                            <h2 class="heading-agent">Event Address</h2>
                                <div class="col-md-12">
                                
                                <div class="row">
                                <div class="col-md-12">
                              <label for="inputEmail3" class="control-label"> Location Name<span class="req-field" >*</span></label>
                            <div class="form-group has-feedback add-event-error" >

                                    <div id="locationField">
                                        <input type="text" class="form-control" placeholder="Enter Location"  name="location" id="autocomplete" onFocus="geolocate()" >
                                        <label class="note" style="margin-top: 31px;">Note: Type the location name and select  to populate in address fields</label>
                                        <p class="error">{{ $errors->first('location') }}</p>

                                   </div>
                                  
                                </div>
                                <div class="form-group has-feedback" >


                                
                                
                                
                                    
                                    
                                    
                                    <input type="hidden" class="field form-control" id="country" name="country" required></input>

                                </div>
                                </div>
                                <div class="clearfix"></div>
                                </div>
                                
                                <div class="form-group has-feedback">
                                    <label for="inputEmail3" class="control-label">Address 1</label>
                                        <input type="text" class="field form-control" id="street_number" name="address1" disable="true" required></input>
                                </div>

                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Address 2</label>
                                        <input type="text" class="field form-control" name="address2" id="route" required></input></td> 
                                </div>

                                <div class="form-group has-feedback wideField" colspan="3">
                                    <label for="inputEmail3" class="control-label">City</label>
                                        <input type="text" class="field form-control" id="locality" name="city" required="">
                                </div>

                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">State</label>
                                    <input type="text" class="field form-control" id="administrative_area_level_1" name="state"></input>
                                        
                                </div>
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Zip Code</label>
                                        <input type="text" class="field form-control" id="postal_code" name="zipcode">
                                </div>
                            </div>
                        </div>
                        
                       
                       
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/events-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right">Create Event</button>
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
    <!-- <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/jquery.datetimepicker.js') }}"></script>
    <script src="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/moment/js/moment.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->

    
    <!-- <script src="{{ asset('/assets/admin/js/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/jquery-ui.js') }}"></script> -->


<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    


    
<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>

 <script src="{{ asset('/assets/admin/js/pages/events.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script><script>
  $( function() {
    $( ".datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "{{ asset('img/calendar.png') }}",
      buttonImageOnly: true,
      buttonText: "Select date",
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


<!-- Google AutoComplete Places -->
<script>
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
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode'],
            componentRestrictions: {country: 'us'}});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
        async defer></script>


    <script type="text/javascript">
    $("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#dimensions").on("keyup", function(){
        var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
            val = this.value;

        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#price,#charity_amount").on("keyup", function(){
        var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
            val = this.value;

        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    </script>


<!-- Event Tags Bootstrap Code starts here -->

<script type="text/javascript">

  $(document).ready(function() {

    var tagApi = $(".tm-input").tagsManager();


    jQuery(".typeahead").typeahead({

      name: 'tags',

      displayKey: 'name',

      source: function (query, process) {

        return $.get('/admin/event/tags', { query: query }, function (data) {
          
          return process(data);

        });

      },

      afterSelect :function (item){

        tagApi.tagsManager("pushTag", item);

      }

    });

  });

</script>

    @stop
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
