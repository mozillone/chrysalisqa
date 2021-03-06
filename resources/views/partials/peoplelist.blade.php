
<div class="people-list" id="people-list">
 @if(count($messages)>0)
    <div class="search" style="text-align: center">
<i class="fa fa-search" aria-hidden="true"></i>
        <input class="search-input" type="text" value="" placeholder="Search..." id="myInput" onkeyup="myFunction()">
    </div>
    @endif
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
		<hr>
    

    <div class="list front_chat" id="myUL">


        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))

		
        <div class="clearfix row" attr-to="{{$inbox->thread->conversation_id}}" >
            <a href="{{URL::to('message')}}<?php echo '/'.$inbox->thread->conversation_id; ?>">

            <div class="col-md-3 col-sm-4">
				<ul>
					<li>
						<img src="{{isset($inbox->withUser->user_img) && !empty($inbox->withUser->user_img)?url('/profile_img/'.$inbox->withUser->user_img):url('/profile_img/default.jpg')}}" alt="avatar" />		
					</li>
					<li>
                   	<p>{{$inbox->withUser->first_name}}</p>
						<span><?php echo date_format($inbox->withUser->created_at,"d/m/Y"); ?></span>
					</li>
				
				</ul>
					
					<div>@if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id)<span class="msg_cnt"></span>@endif</div>
                
			</div>
			<div class="col-md-6 col-sm-5">
				
				<h4>Question about the Costume</h4>
				<div @if($inbox->thread->is_seen!=1 && $inbox->thread->user_id!=auth()->user()->id) class="status" @else class="status_unbold" @endif>
                    @if(auth()->user()->id == $inbox->thread->sender->id)
                    @endif
                    <span>{!!substr($inbox->thread->message, 0, 35)!!}@if(strlen($inbox->thread->message)>35){{'...'}}@endif</span>
					
                </div>
				
				
				
			</div>
			<div class="col-md-2 col-sm-2 text-center">
				<p>Product #: <br>126484638</p>
				
			</div>
            </a>
            <div class="col-md-1 col-sm-1 text-center">
                <i class="fa fa-trash-o" id="{{$inbox->thread->conversation_id}}" aria-hidden="true"></i>
            
            </div>
            
         
                
               
          
        </div>
		<hr>
            @endif
        @endforeach

    </div>
   
</div>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<script type="text/javascript">
    $(document).on('click','.fa-trash-o',function(){
        var id=$(this).attr('id');
        swal({
            title: "Are you sure want to delete?",
            text: "You will not be able to recover this Listing!",
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
