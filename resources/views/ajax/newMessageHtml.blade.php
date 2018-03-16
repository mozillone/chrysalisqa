<?php //echo "<pre>";print_r($message->message);die; ?>
<li class="clearfix" id="message-{{$message->id}}">
<div class="message-data row">
<div class="col-md-3 col-sm-3 col-xs-12">
<span class="message-data-name" >@if(!empty(Auth::user()->user_img)) <img src="{{asset('profile_img/resize')}}<?php echo '/'.Auth::user()->user_img; ?>"> @else <img src="{{asset('profile_img/default.jpg')}}"> @endif</span>
<span class="message-data-name user-name" >{{Auth::user()->display_name}}</span>
</div>
<div class="col-md-7 col-sm-7 col-xs-12">
<div class="message other-message">
{{$message->message}}
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-12">
<span class="message-data-time" >1 Second ago</span> &nbsp; &nbsp;
</div>
</div>
</li>
<hr>
