@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection
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

@stop

{{-- Page content --}}
@section('content')
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
                                            <div class="fileupload fileupload-new rmvimg" data-provides="fileupload">
                                                <img src="../event_images/preview_placeholder.png" class="img-pview img-responsive" id="img-chan" name="img-chan" style="alt=;width: 160px;height: 160px;" "="" riot"="">
                                                <!-- <span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span> -->

                                                <input id="event_image" name="event_image" placeholder="Profile Image" class="form-control" type="file">

                                                <input id="imageExists" name="imageExists" value="" type="hidden">
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