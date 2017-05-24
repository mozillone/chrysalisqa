<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Talk Message</title>
    
    
    <link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="{{asset('chat/css/style.css')}}">

    
    
    
  </head>

  <body>
<div class="header">
    <div class="container header-brand">
        <a href="{{url('/')}}" class="brand">Talk Message</a>
    </div>
</div>
      <div class="container clearfix body">
   @include('partials.peoplelist')
    
    <!-- <div class="chat">
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
      </div> 
      
      @yield('content')
      
      
      
    </div>  -->
    
  </div> <!-- end container -->
  </body>
</html>
