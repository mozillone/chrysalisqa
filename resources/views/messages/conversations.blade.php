@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/chrysalis.css')}}">
<link rel="stylesheet" href="{{asset('chat/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@endsection
@section('content')
<div class="container chat_divs">
    <div class="row">
        <div class="col-md-12 col-sm-12">
                <div class="list-sec-rm">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p class="list-sec-rm1 fav_costume">MY MESSAGES ({{$msgs_count[0]->count_dt}})</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right pull-right back-link bck_mycnt">
                        <a href="{{URL::to('/dashboard')}}">Back to My Account</a>
                    </div>
                </div>
        </div>
    </div>
  </div>
  <div class="container clearfix body message-chat-sec">
      <div  class="row">        
        <div class="col-md-2 col-sm-3">
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#Inbox" data-toggle="tab">Inbox ({{$msgs_inbox[0]->count_dt}})<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li><a href="#Sent-msg" data-toggle="tab">Sent ({{$msgs_sent[0]->count_dt}})<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
               
            </ul>
        </div>
        <div class="col-md-10 col-sm-9">
            <div class="clearfix messages-chat-list">
                <div class="tab-content">
                    <div class="tab-pane active" id="Inbox">
                    @if(count($conversations_inbox)>0)
                        <div class="people-list" id="people-list">
                            <div class="row">
                                <div class="message-header">
                                    <div class="col-md-3 col-sm-3">
                                        Sender
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        Message
                                    </div>
                                    <div class="col-md-2 col-sm-2 text-center">
                                        Related Product
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        Action
                                    </div>
                                </div>
                            </div>
                            <div class="list front_chat" id="myUL">
                                @foreach($conversations_inbox as $inbox)
                                <div class="clearfix row" attr-to="{{$inbox->conversation_id}}" >
                               
                                <a href="@if(!empty($inbox->type_id)){{URL::to('message')}}<?php echo '/'.$inbox->conversation_id; ?> @else javascript:void(0); @endif">

                                    <div class="col-md-3 col-sm-4">
                                        <ul>
                                            <li>
                                                <img src="{{isset($inbox->user_img) && !empty($inbox->user_img)?url('/profile_img/'.$inbox->user_img):url('/profile_img/default.jpg')}}" alt="avatar" />      
                                            </li>
                                            <li>
                                                <p>{{$inbox->first_name}}</p>
                                                <span>{{ date('m-d-y', strtotime($inbox->created_at))}}</span>
                                            </li>

                                        </ul>

                                        <div>@if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id)<span class="msg_cnt"></span>@endif</div>

                                    </div>
                                    <div class="col-md-6 col-sm-5">

                                        <h4>{{$inbox->subject}}</h4>
                                        <div @if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id) class="status" @else class="status_unbold" @endif>
                                        @if(auth()->user()->id == $inbox->id)
                                        @endif
                                        <span>{!!substr($inbox->message, 0, 35)!!}@if(strlen($inbox->message)>35){{'...'}}@endif</span>

                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-2 text-center">
                                    <?php
                                    if(isset($inbox->image) && !empty($inbox->image)){
                                        $path = '/costumers_images/Small/'.$inbox->image;
                                        if(file_exists(public_path($path))){
                                            $listingImage = URL::asset('/costumers_images/Small/'.$inbox->image);
                                        }else{
                                            $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                        }
                                    }else{
                                        $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    ?>
                                    @if($inbox->type != "order")
                                    <div class="msg_order_imge"><a href="{{ URL::to('/product').$inbox->url_key }}"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
                                    @endif
                                    <p class="order_cnt">@if($inbox->type == "request_a_bag") Ref no  @elseif($inbox->type == "order") Order Id @else Product Id @endif #: <br>{{$inbox->type_id}}</p>

                                </div>
                                </a>
                                <div class="col-md-1 col-sm-1 text-center">
                                <i class="fa fa-trash-o" id="{{$inbox->conversation_id}}" aria-hidden="true"></i>

                                </div>
                                </div>
                                @endforeach

                            </div>

                        </div>  
                        @else
                        <span id="inbox_nocon">No Conversations</span>
                        @endif
                    </div>
                   
                    <div class="tab-pane" id="Sent-msg">
                         @if(count($conversations_sent)>0)
                            <div class="people-list" id="people-list">
                            <div class="row">
                                <div class="message-header">
                                    <div class="col-md-3 col-sm-3">
                                        Sender
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        Message
                                    </div>
                                    <div class="col-md-2 col-sm-2 text-center">
                                        Related Product
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        Action
                                    </div>
                                </div>
                            </div>
                            <div class="list front_chat" id="myUL">
                                <?php //echo "<pre>";print_r($conversations_sent);die; ?>
                                @foreach($conversations_sent as $inbox)
                                <div class="clearfix row" attr-to="{{$inbox->conversation_id}}" >
                                <a href="{{URL::to('message')}}<?php echo '/'.$inbox->conversation_id; ?>">

                                <div class="col-md-3 col-sm-4">
                                <ul>
                                <li>
                                <img src="{{isset($inbox->user_img) && !empty($inbox->user_img)?url('/profile_img/resize/'.$inbox->user_img):url('/profile_img/default.jpg')}}" alt="avatar" />      
                                </li>
                                <li>
                                <p>{{$inbox->first_name}}</p>
                                <span>{{ date('m-d-y', strtotime($inbox->created_at))}}</span>
                                </li>

                                </ul>

                                <div>@if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id)<span class="msg_cnt"></span>@endif</div>

                                </div>
                                <div class="col-md-6 col-sm-5">

                                <h4>{{$inbox->subject}}</h4>
                                <div @if($inbox->is_seen!=1 && $inbox->user_id!=auth()->user()->id) class="status" @else class="status_unbold" @endif>
                                @if(auth()->user()->id == $inbox->id)
                                @endif
                                <span>{!!substr($inbox->message, 0, 35)!!}@if(strlen($inbox->message)>35){{'...'}}@endif</span>

                                </div>
                                </div>
                                <div class="col-md-2 col-sm-2 text-center">
                                    <?php
                                    if(isset($inbox->image) && !empty($inbox->image)){
                                    $path = '/costumers_images/Small/'.$inbox->image;
                                    if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/costumers_images/Small/'.$inbox->image);
                                    }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    }else{
                                    $listingImage = URL::asset('/costumers_images/default-placeholder.png');
                                    }
                                    ?>
                                    @if($inbox->type != "order")
                                    <div class="msg_order_imge"><a href="{{ URL::to('/product').$inbox->url_key }}"><img src="<?=$listingImage;?>" alt="avatar"></a></div>
                                    @endif
                                 <p class="order_cnt">@if($inbox->type == "request_a_bag") Ref no  @elseif($inbox->type == "order") Order Id @else Product Id @endif #: <br>{{$inbox->type_id}}</p>

                                </div>
                                </a>
                                <div class="col-md-1 col-sm-1 text-center">
                                <i class="fa fa-trash-o" id="{{$inbox->conversation_id}}" aria-hidden="true"></i>

                                </div>
                                </div>
                                @endforeach

                            </div>

                        </div> 
                         @else
                    <span id="sent_nocon">No Conversations</span>
                    @endif
                    </div>                 
                   
                </div>
            
          </div>
            </div>
    </div>   
  </div> <!-- end container -->

@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/js/dashboard.js') }}"></script>
<script type="text/javascript">
    $(document).on('click','.fa-trash-o',function(){
        var id=$(this).attr('id');
        swal({
            title: "Are you sure want to delete?",
            text: "You will not be able to recover this Conversation!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(result){
            if(result){
                $.ajax({
                 url: "{{URL::to('conversation/delete')}}",
                 type: "POST",
                 data: {'conversation_id':id},
                 success: function(data){
                    if (data == "success") {
                        location.reload();
                        }
                 }
             });
            }
        });
    });
</script>

@stop


