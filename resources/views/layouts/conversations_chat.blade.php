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
      <div class="container clearfix body message-chat-sec">
	  <div  class="row">
        
        <div class="col-md-2">
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#Inbox" data-toggle="tab">Inbox<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li><a href="#Sent-msg" data-toggle="tab">Sent<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
               
            </ul>
        </div>
        <div class="col-md-10">
		<div class="clearfix messages-chat-list">
            <div class="tab-content">
                <div class="tab-pane active" id="Inbox">
					@include('partials.peoplelist')	
				</div>
                <div class="tab-pane" id="Sent-msg">Sent messages</div>
                
            </div>
			
        </div>
		</div>
    </div>

    

    
  </div> <!-- end container -->
  </body>
</html>
