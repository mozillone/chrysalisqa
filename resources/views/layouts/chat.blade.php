<!DOCTYPE html>
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
						</div>
						<div class="col-md-6 text-right pull-right back-link">
							<a href="/dashboard">Back to My Account</a>
						</div>

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
