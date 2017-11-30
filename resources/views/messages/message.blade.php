@extends('layouts.chat')

@section('content')
    <div class="chat-history">
        <ul id="talkMessages">
            <?php 	//echo "<pre>";print_r($messages);die; ?>
            @foreach($messages as $message)
                @if($message->sender->id == auth()->user()->id)
                    <li class="clearfix" id="message-{{$message->id}}">
                        <div class="message-data row">
							<div class="col-md-3 col-sm-3 col-xs-12 ">
									<span class="message-data-name" >@if(!empty($message->sender->user_img)) <img src="{{asset('profile_img/resize')}}<?php echo '/'.$message->sender->user_img; ?>"> @else <img src="{{asset('profile_img/default.jpg')}}"> @endif</span>
									<span class="message-data-name user-name" >{{$message->user_name}}</span>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="message other-message">
									{{$message->message}}
								</div>
							</div>
							<div class="col-md-2 col-sm-2  col-xs-12">
									<span class="message-data-time" >{{$message->humans_time}} ago</span> &nbsp; &nbsp;
							</div>  
                        </div>
                    </li>
					<hr>
                @else
                    <li id="message-{{$message->id}}">
                        <div class="message-data row">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<span class="message-data-name">@if(!empty($message->sender->user_img)) <img src="{{asset('profile_img/resize')}}<?php echo '/'.$message->sender->user_img; ?>"> @else <img src="{{asset('profile_img/default.jpg')}}"> @endif</span>
								<span class="message-data-name user-name">{{$message->user_name}}</span>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="message my-message">
									{{$message->message}}
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<span class="message-data-time">{{$message->humans_time}} ago</span>
							</div>
                        </div>
                    </li>
					<hr>
                @endif
            @endforeach
        </ul>
    </div> <!-- end chat-history -->

@endsection
