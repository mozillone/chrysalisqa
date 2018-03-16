@extends('/frontend/app')
@section('styles')
@endsection
@section('content')
    <div class="container event-sec">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>EVENTS</h2>
                    <div class="right-sec form-inline">
                        <label for="basic-url">Only view events in:</label>
                        <div class="input-group">
                            <input placeholder="Enter Zip Code" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="event-review-header">
            <span>Have an Event?</span> Click  <a href="#" data-toggle="modal" @if(Auth::check()) data-target="#myModal" @else data-target="#signup_popup" @endif>here</a> to submit your listing.
        </p>
        <div class="row">
            <div class="col-md-12">
                @foreach($events as $key => $value)
                <div class="media">
                    <div class="media-left">
                        <img src="<?='../profile_img/'.$value->user_img;?>" style="height: 185px; width: 290px;" class="media-object">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading"><?=$value->event_name?></h3>
                        <ul>
                            <li>Contributed By:</li>
                            <li> Jane Doe</li>
                        </ul>
                        <ul>
                            <li>Location:</li>
                            <li><?=$value->location_name;?></li>
                        </ul>
                        <ul>
                            <li>Time:</li>
                            <li><?=date('g:i A', strtotime($value->from_time)).' - '.date('g:i A', strtotime($value->to_time));?></li>
                        </ul>
                        <ul>
                            <li>Event Link:</li>
                            <li><a href="<?=$value->event_url;?>"><?=$value->event_url;?></a></li>
                        </ul>
                        <p><?=$value->event_desc;?></p>
                        <div class="date-tag">
                            <div class="bg-branding">
                                <h2><?=date('d', strtotime($value->from_date)); ?></h2>
                                <span><?= strtoupper(date('M - y', strtotime($value->from_date))); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>


    </div>

    <!-- create event modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Contribute An Event</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="event-name">Event Name<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="event_name" id="event-name" placeholder="Event Name">
                        </div>
                        <div class="form-group">
                            <label for="event-link">Event Link<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="event_link" id="event-link" placeholder="Event Link">
                        </div>
                        <div class="form-group">
                            <label for="event-date">Event Date<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="event_date" id="event-date">
                        </div>
                        <div class="form-group">
                            <label for="event-location">Event Location<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="event_location" id="event-location">
                        </div>
                        <div class="form-group">
                            <label for="event-description">Event Description<span class="req-field" >*</span></label>
                            <textarea class="form-control" name="event_description" rows="5" id="event-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="user-email">Your Email Address<span class="req-field" >*</span></label>
                            <input type="email" class="form-control" name="user_email" rows="5" id="user-email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username<span class="req-field" >*</span></label>
                            <input type="text" class="form-control" name="username" rows="5" id="username">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end create event modal -->
@stop
@section('footer_scripts')
@stop