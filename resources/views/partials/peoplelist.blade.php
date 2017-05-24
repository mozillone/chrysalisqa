
<div class="people-list" id="people-list">
 @if(count($messages)>0)
    <div class="search" style="text-align: center">
<i class="fa fa-search" aria-hidden="true"></i>
        <input class="search-input" type="text" value="" placeholder="Search..." id="myInput" onkeyup="myFunction()">
    </div>
    @endif
    

    <ul class="list front_chat" id="myUL">


        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))


        <li class="clearfix" attr-to="{{$inbox->thread->conversation_id}}" >
            <a href="{{URL::to('message')}}<?php echo '/'.$inbox->thread->conversation_id; ?>">
<!-- 
               <li class="clearfix" attr-to="{{$inbox->withUser->id}}">
            <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}"> -->

            
            <img src="{{isset($inbox->withUser->user_img) && !empty($inbox->withUser->user_img)?url('/profile_img/'.$inbox->withUser->user_img):url('/profile_img/default.jpg')}}" alt="avatar" />
            <div class="about">
                <div>@if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id)<span class="msg_cnt"></span>@endif</div>
                <div>{{$inbox->withUser->display_name}}</div>
                <div @if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id) class="status" @else class="status_unbold" @endif>
                    @if(auth()->user()->id == $inbox->thread->sender->id)
                        <span class="fa fa-reply"></span>
                    @endif
                    <span>{!!substr($inbox->thread->message, 0, 35)!!}@if(strlen($inbox->thread->message)>35){{'...'}}@endif</span>
                </div>
            </div>
            </a>
        </li>
            @endif
        @endforeach

    </ul>
   
</div>

