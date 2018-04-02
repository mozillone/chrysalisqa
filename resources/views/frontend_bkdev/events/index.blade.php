@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/event.css') }}">
@endsection
@section('content')
    <div class="container event-sec">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>EVENTS</h2>
                    <div class="right-sec form-inline">
                        <label for="basic-url">Only view events in:</label>
                        <form method="GET" action="/search" name="searchByZip" id="search-by-zip" autocomplete="off" enctype="multipart/form-data">
                            <div class="input-group event_zip">
                                <input type="text" class="form-control" name="zip" placeholder="Enter ZIP Code">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="event-review-header">
            <span>Have an Event?</span> Click  <a href="#" data-toggle="modal" @if(Auth::check()) data-target="#myModal" @else <?php Session::put('is_event', true); ?> data-target="#signup_popup" @endif>here</a> to submit your listing.
        </p>
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($events))
                    @foreach($events as $key => $value)
                        <?php
                            if(isset($value->user_img) && !empty($value->user_img)){
                                $path = '/event_images/'.$value->user_img;
                                if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/event_images/'.$value->user_img);
                                }else{
                                    $listingImage = URL::asset('/event_images/listing_placeholder.png');
                                }
                            }else{
                                $listingImage = URL::asset('/event_images/listing_placeholder.png');
                            }
                        ?>
                    <div class="media">
                        <div class="media-left">
                            <div class="event_img_div" style="background: url(<?php echo $listingImage; ?>)">
                            </div>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">{{$value->event_name}}</h3>
                            <ul>
                                <li>Contributed By:</li>
                                <li> {{ $value->display_name }} </li>
                            </ul>
                            <ul>
                                <li>Location:</li>
                                <li>{{ $value->location_name }}</li>
                            </ul>
                            <ul>
                                <li>Time:</li>
                                <li>{{ date('d F Y', strtotime($value->from_date)).', '.date('g:i A', strtotime($value->from_time)).' - '.date('d F Y', strtotime($value->to_date)).', '.date('g:i A', strtotime($value->to_time)) }}</li>
                            </ul>
                            <ul>
                                <li>Event Link:</li>
                                <li><a href="<?php if(!preg_match('~^(?:f|ht)tps?://~i', $value->event_url)){ echo 'http://'.$value->event_url; }else{ echo $value->event_url; } ?>" class="event-link" target="_blank">{{$value->event_url}}</a></li>
                            </ul>
                            <p class="more">{!! substr($value->event_desc,0,350) !!}</p>
                            <div class="date-tag">
                                <div class="bg-branding">
                                    <h2>{{ date('d', strtotime($value->from_date)) }}</h2>
                                    <span>{{strtoupper(date('M - y', strtotime($value->from_date)))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                @else
                    <p>No Results Found</p>
                @endif
                <div style="float:right;">{{ $events->links() }}</div>
            </div>
        </div>


    </div>

    <!-- create event modal -->
    <div class="modal fade event-pop" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Contribute An Event</h2>
					
                </div>
				<h5>Please ensure that the named event is submitted at least a week in advance.</h5>
                <div class="modal-body">
                    <form method="POST" action="/save-event/{{ $userId }}" name="saveEvent" id="save-event" autocomplete="on" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-feedback">
                            <label for="event-name">Event Name<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Event Name">
                            <p class="error">{{ $errors->first('event_name') }}</p>
                            <span id="page_title_error" style="color:red"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="event-link">Event Link<span class="req-field" >*</span></label>
                                <input type="text" class="form-control" name="event_url" id="event-link" placeholder="Event Link">
                            <p class="error">{{ $errors->first('event_url') }}</p>
                            <span id="page_title_error" style="color:red"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="event-from-date">Event From Date<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" name="from_date" id="event-from-date">
                                    <p class="error">{{ $errors->first('from_date') }}</p>
                                    <span id="page_title_error" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="event-from-time">Event From Time<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" name="from_time" id="event-from-time">
                                    <p class="error">{{ $errors->first('from_time') }}</p>
                                    <span id="page_title_error" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="event-to-date">Event To Date<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" name="to_date" id="event-to-date">
                                    <p class="error">{{ $errors->first('to_date') }}</p>
                                    <span id="page_title_error" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="event-to-time">Event To Time<span class="req-field" >*</span></label>
                                    <input type="text" class="form-control" name="to_time" id="event-to-time">
                                    <p class="error">{{ $errors->first('to_time') }}</p>
                                    <span id="page_title_error" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="event-location">Event Location<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="location" id="autocomplete" onfocus="geolocate()">
                            <p class="error">{{ $errors->first('location_name') }}</p>
                            <span id="page_title_error" style="color:red"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="event-description">Event Description<span class="req-field" >*</span></label>
                            <textarea class="form-control" name="event_desc" rows="5" id="event-description"></textarea>
                            <p class="error">{{ $errors->first('event_desc') }}</p>
                            <span id="page_title_error" style="color:red"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="user-email">Your Email Address<span class="req-field" >*</span></label>
                            <input type="email" class="form-control" name="user_email" value="{{ $userEmail  }}" id="user-email">
                            <p class="error">{{ $errors->first('user_email') }}</p>
                            <span id="page_title_error" style="color:red"></span>
                        </div>
                        <input type="hidden" class="form-control" id="street_number" name="address1">
                        <input type="hidden" class="form-control" id="route" name="address2">
                        <input type="hidden" class="form-control" id="locality" name="city">
                        <input type="hidden" class="form-control" id="administrative_area_level_1" name="state">
                        <input type="hidden" class="form-control" id="postal_code" name="zipcode">
                        <input type="hidden" class="form-control" id="country" name="country">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end create event modal -->
@stop
@section('footer_scripts')

    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/event.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete" async defer></script>
@stop