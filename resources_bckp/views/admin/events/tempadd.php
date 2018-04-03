@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')

<link rel="stylesheet" href="{{ asset('/assets/admin/css/googleautostyle.css') }}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.default.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/selectize.bootstrap3.css') }}">

@stop

{{-- Page content --}}
@section('content')
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



                <div class="form-group has-feedback event-tags" >
                    <label for="inputEmail3" class="control-label">Event Tags<span class="req-field" >*</span></label>
                    <input type="text" name="eventTags" class="form-control" id="event-tags"/>
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
                                <input type="text" class="form-control location_name" placeholder="Enter Location"  name="location" id="autocomplete" onFocus="geolocate()" >
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
                    <input type="hidden" class="field form-control state_hidden" id="administrative_area_level_1" name="state"></input>
                    <select id="state_select">
                        @foreach($states as $state)
                        <option class="state_dropdown" value="{{$state->abbrev}}">{{$state->name}}</option>

                        @endforeach
                    </select>


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
<script src="{{ asset('/assets/admin/js/selectize.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>




<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>

<script src="{{ asset('/assets/admin/js/pages/events.js')}}"></script>



<script>
$( function() {
$( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "{{ asset('img/calendar.png') }}",
    buttonImageOnly: true,
    buttonText: "Select date",
    minDate: 0,
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
console.log('before chabg');
console.log($('.state_dropdown').val());
console.log('after change');   
$('.state_hidden').on('change', function(){
    console.log($(this).val());
});
});

$("#administrative_area_level_1").bind("change", function(e){
    console.log('hello');

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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
async defer></script>
<script>
 
</script>


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
$('#event-tags').selectize({
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});
});

</script>

@stop