<!DOCTYPE html>
<<<<<<< HEAD
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/frontend/css/chrysalis.css')}}">
		<link href="{{asset('assets/frontend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
		<!--<link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">-->
		<link rel="stylesheet" href="{{asset('chat/css/style.css')}}">
	</head>
	<body>
		@include('frontend.partials.header')
		@include('frontend.partials.menu')
		<div class="container ">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 chat-tl-dv">
					<div class="list-sec-rm">
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume">MY MESSAGES (0)</p>
=======
<html >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Talk Message</title>
    
    
    <link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/chrysalis.css')}}">

        <link rel="stylesheet" href="{{asset('chat/css/style.css')}}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    
    
  </head>

  <body>
  <div class="container">
  <div class="row">
	<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume">MY MESSAGES (3)</p>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
						</div>
						<div class="col-md-6 text-right pull-right back-link">
							<a href="/dashboard">Back to My Account</a>
						</div>
<<<<<<< HEAD
					</div>
				</div>
			</div>
		</div>
		<div class="container clearfix message-chat-sec">
			<div class="row">
				<div class="col-md-2 col-xs-12">
					<ul class="nav nav-tabs tabs-left">
						<li id="inbox_sidebar" class="active"><a href="{{URL::to('conversations')}}" data-toggle="tab">Inbox<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						<li id="sent_sidebar" ><a href="{{URL::to('conversations')}}" data-toggle="tab">Sent<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="col-md-10 col-xs-12">
					<div class="chat conversation-chat">
						<div class="chat-header clearfix">
							<?php //echo $user;die; ?>
							<div class="chat-about">
								<h4>{{@$get_con->subject}}</h4>
								@if(isset($user))
								<div class="chat-with">Between you and <span class="message-data-name user-name"> {{@$user->display_name}} </span></div>
								@else
								<div class="chat-with">No Thread Selected</div>
								@endif
							</div>
							<ul class="user-info-sec">
                                <?php
                                if(isset($get_con->image) && !empty($get_con->image)){
                                    $path = '/costumers_images/Small/'.$get_con->image;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/costumers_images/Small/'.$get_con->image);
                                    }else{
                                        $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                }
                                ?>
								<div class="msg_order_imge"><a href="{{ URL::to('/product').$get_con->url_key }}"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
								<li><p class="orders_singles_views">@if($get_con->type == 'request_a_bag') Ref no @else Product @endif#: <br>{{@$get_con->type_id}}</p></li>
							</ul>
						</div> <!-- end chat-header -->
						@yield('content')
						<div class="chat-message clearfix">
							<span> @if(!empty(Auth::user()->user_img)) <img src="{{asset('profile_img/resize')}}<?php echo '/'.Auth::user()->user_img; ?>"> 
							@else <img src="{{asset('profile_img/default.jpg')}}"> @endif </span>
							<span class="message-data-name user-name"> {{Auth::user()->display_name}} </span> 
							<form action="" method="post" id="talkSendMessage">
								<textarea name="message-data" id="message-data" placeholder ="Type your message" rows="3"></textarea>
								<input type="hidden" name="_id" value="{{@request()->route('id')}}">
								<button type="submit">Reply</button>
							</form>
						</div> <!-- end chat-message -->
					</div> <!-- end chat -->
				</div>
			</div>
		</div> <!-- end container -->
	</section>
	@include('frontend.partials.footer')
	<script>
		var __baseUrl = "{{url('/')}}"
	</script>
	<script src="{{asset('js/jquery-2.2.4.js')}}"></script>
	<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('angular/lib/angular.js')}}"></script>
	<script src="{{asset('angular/lib/angular-datatables.min.js')}}"></script>
	<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('angular/lib/angular-datatables.min.js')}}"></script>
	<script src="{{asset('angular/app.js')}}"></script>
	<script src="{{asset('js/jquery.validate.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/custom.js')}}"></script>
	<script src="{{asset('angular/directives/datepicker.js')}}"></script>
	
	<script src="{{asset('chat/js/handlebars.min.js')}}"></script>
	<script src="{{asset('chat/js/talk.js')}}"></script>
    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
		}
        var msgshow = function(data) {
            var html = '<li id="message-' + data.id + '">' +
			'<div class="message-data row">' +
			'<div class="col-md-3 col-sm-3 col-xs-12">' +
			'<span class="message-data-name" >' +
			'@if(!empty('+ Auth::user()->user_img +')) '+
			'<img src="{{asset("profile_img/resize")}}<?php echo "/".'+ Auth::user()->user_img +' ?>"> ' +
			'@else' + 
			'<img src="{{asset("profile_img/default.jpg")}}"> @endif' +
			'</span>' +
			'<span class="message-data-name user-name1111" >'+ data.sender.display_name +'</span>' +
			'</div>' +
			'<div class="col-md-7 col-sm-7 col-xs-12">' +
			'<div class="message other-message">' +
			'' + data.message +'' +
			'</div>' +
			'</div>' +
			'<div class="col-md-2 col-sm-2 col-xs-12">' +
			'<span class="message-data-time" >1 Second ago</span> &nbsp; &nbsp;' +
			'</div>' +
			'</div> ' +       
			'</li>';
            $('#talkMessages').append(html);
		}
        $('#sent_sidebar').click(function(){
			//$('#inbox_sidebar').removeClass('active');
			//$('#sent_sidebar').addClass('active');
			location.href ="{{URL::to('conversations#Sent-msg')}}";
		});
        $('#inbox_sidebar').click(function(){
			location.href ="{{URL::to('conversations#Inbox')}}";
		});
	</script>
    {!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}
</body>
</html>
=======

					</div>
					</div>
</div>
</div>

      <div class="container clearfix body">
    
    <div class="chat">
      <div class="chat-header clearfix">
        @if(isset($user))
            <img src="{{@$user->avatar}}" alt="avatar" />
        @endif
        <div class="chat-about">
            @if(isset($user))
                <div class="chat-with">{{'Chat with ' . @$user->name}}</div>
            @else
                <div class="chat-with">No Thread Selected</div>
            @endif
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      
      @yield('content')
      
      <div class="chat-message clearfix">
      <form action="" method="post" id="talkSendMessage">
            <textarea name="message-data" id="message-data" placeholder ="Type your message" rows="3"></textarea>
            <input type="hidden" name="_id" value="{{@request()->route('id')}}">
            <button type="submit">Send</button>
      </form>

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->


      <script>
          var __baseUrl = "{{url('/')}}"
      </script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>



        <script src="{{asset('chat/js/talk.js')}}"></script>

    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
        }

        var msgshow = function(data) {
            var html = '<li id="message-' + data.id + '">' +
            '<div class="message-data">' +
            '<span class="message-data-name">' + data.sender.name + '</span>' +
            '<span class="message-data-time">1 Second ago</span>' +
            '</div>' +
            '<div class="message my-message">' +
            data.message +
            '</div>' +
            '</li>';

            $('#talkMessages').append(html);
        }

    </script>
    {!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}

  </body>
</html>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
