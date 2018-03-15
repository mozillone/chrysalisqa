@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
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
        <p class="event-review-header"></p>
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
                @if(count($eventsByZip))
                    @foreach($eventsByZip as $event)
                        <?php
                        if(isset($event->user_img) && !empty($event->user_img)){
                            $path = '/event_images/'.$event->user_img;
                            if(file_exists(public_path($path))){
                                $listingImage = URL::asset('/event_images/'.$event->user_img);
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
                                <h3 class="media-heading">{{$event->event_name}}</h3>
                                <ul>
                                    <li>Contributed By:</li>
                                    <li> {{ $event->display_name }} </li>
                                </ul>
                                <ul>
                                    <li>Location:</li>
                                    <li>{{ $event->location_name }}</li>
                                </ul>
                                <ul>
                                    <li>Time:</li>
                                    <li>{{ date('g:i A', strtotime($event->from_time)).' - '.date('g:i A', strtotime($event->to_time)) }}</li>
                                </ul>
                                <ul>
                                    <li>Event Link:</li>
                                    <li><a href="{{$event->event_url}}" class="event-link">{{$event->event_url}}</a></li>
                                </ul>
                                <p>{!! $event->event_desc !!}</p>
                                <div class="date-tag">
                                    <div class="bg-branding">
                                        <h2>{{ date('d', strtotime($event->from_date)) }}</h2>
                                        <span>{{strtoupper(date('M - y', strtotime($event->from_date)))}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p class="no-result">No Results Found</p>
                @endif
            </div>
        </div>


    </div>
@stop
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/event_zip.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
@stop