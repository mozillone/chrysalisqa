@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<style type="text/css">
.msg-btn{margin-top: 20px; margin-bottom: 50px; float: right; color: #fff;}
.msg_text_div{ margin-left: 20px;padding-right: 60px;}
textarea#support_message {    width: 100%;}
.user-request-sec ul {
    list-style-type: none;
    padding-left: 0px;
}
.user-request-sec {
    background: #f2f2f2;
    padding: 15px;
}
.ticket-sec .media img {
    border-radius: 50%;
    height: 80px;
    width: 80px;
}
input#update_support_status {
    font-size: inherit;
    float: right;
    width: 37%;
    margin-top: -36px;
}
</style>
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Ticket #{{$ticketid}}</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
  <li>
        <a href="/tickets-list"> Support</a>
    </li>
    <li class="active">Manage Ticket</li>
  </ol>
</section>
<section class="content" ng-controller="CostumesController">
    <div class="row">
        <div class="col-md-12">
         @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get('error') }}
                </div>
                @elseif(Session::has('success'))
                 <div class="alert alert-success alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ Session::get('success') }}
                </div>
        @endif
            <div class="box box-info ticket-sec">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$reason_title}}</h3>
                   
                </div>
                <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <div class="content">
             @foreach($messages as $index=>$message)
                <div class="media">
                <div class="media-left">
                 
                  <img src="@if(!empty($message->image)){{asset ('profile_img/resize')}}<?php echo '/'.$message->image ?>@else {{asset('profile_img/default.jpg')}}@endif" class="media-object">
                  <span>{{$message->username}}</span>
                  
                </div>
                <div class="media-body">
                  <div class="header-sec">
                  <h4 class="media-heading">{{$message->username}}</h4>
                  <?php
                  $yrdata = strtotime($message->createddate);
                       $datex  = date(' M, d Y', $yrdata);
                      
                    ?>

                
                  <span class="pull-right"><?php echo $datex; ?></span>
                  </div>
                  <p>{{$message->usermessage}}</p>
                  
                  <ul>
                    <?php $userid=$message->roleid;
                    if($userid =='2'){ ?>
                  <li>{{$message->username}}</li>  
                  <li>{{$message->email}}</li>  
                  <li>Phone: {{$message->phone}}</li>  
                  <?php } ?>
                </ul>
                </div>
                
                </div>
                @endforeach
            </div>
          
          </div>
          <div class="col-md-4">
            <form name="update_support" id="update_support" method="post" action="/update-ticket-support" >
              {{csrf_field()}}
            <div class="user-request-sec">
            <h4>{{$user}} submitted this request</h4>
              <ul class="admin_sub_reques_div">
                <li>Status</li>
                <select name="status" id="status" class="form-control">
                       <option value="">Select Status</option>
                       <option <?php $status == "1"? 'selected':'' ?>   value="1">Open</option>
                       <option <?php $status == "1"? 'selected':'' ?>  value="0">Pending</option>
                        <option <?php $status == "1"? 'selected':'' ?>  value="2">Closed</option>

                </select>
                 <?php 
                $role_user=Auth::user()->role_id;
                if($role_user=="2") {
                ?>
               <input type="button" name="update_support_status" id="update_support_status" value="Update Status"  class="btn btn-primary"></input>
               <?php } ?>
              </ul>
              <ul>
                <li>Priority</li>
                <select name="priority" id="priority" class="form-control">
                       <option value="">Select Priority</option>
                       <option {{$priority == "1"? 'selected':''}} value="1">Major</option>
                       <option {{$priority == "2"? 'selected':''}} value="2">Minor</option>
                </select>
              </ul>
              <ul>
                <li>Assigned To</li>
                <li>
                     
                      
                     <select name="supportuser" id="supportuser" class="form-control">
                      <option value="">Select Support User</option>
                      @foreach($supportusers as $index=>$support)
                      <option {{$assigneduser == $support->id? 'selected':''}} value="{{$support->id}}">{{$support->display_name}}</option> 
                      
                      
                       @endforeach
                       </select>
                       
                    
                </li>
              </ul>
              <ul>
                <li>Order #</li>
                <li><input type="orderid" name="orderid" class="form-control" value="{{$orderid}}"></li>
                <input type="hidden" name="main_ticketid" id="main_ticketid" value="{{$main_ticketid}}">
              </ul>
              <ul>
                <?php 
                $role_user=Auth::user()->role_id;
                if($role_user=="1") {
                ?>
                <li style="text-align:right"><input type="submit" name="submit" value="Update" class="btn btn-primary"  style="text-align:right;"></a></li>
             <?php } ?>
              </ul>
            </div>
          </form>
            
            </div>
        </div>
        
         
       
         
                </div>
                <div class="row">
                  <div class="media-left">
                  </div>
                  @if(($assigneduser != '0' && Auth::user()->id == $assigneduser) || ($assigneduser == '0'))
                  <div class="media-body">
                  <div class="col-md-8 msg_text_div">
            <textarea name="support_message" id="support_message" class="Form-control" cols="10" rows="5"></textarea>
           <input type="hidden" name="conversation_id" id="conversation_id" value="{{$coversationid}}">
          <input type="button" name="support" id="support" value="Send" class="btn btn-primary msg-btn" >
        </div>
            </div>@endif  </div></div>
        </div>
    </div>
</section>


@stop


{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('angular/Admin/UserManagement/Controllers/users-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/user_management.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script type="text/javascript">
$('#support').click(function(){
  
     var message_theard = $('#support_message').val();
     var conversation_id = $('#conversation_id').val();
      $.ajax({
       url: "{{URL::to('support_message')}}",
       type: "POST",
       data: {conversation_id: conversation_id,message_theard: message_theard},      
       success: function(data){
        if (data == "success") {
          $('#support_message').val('');
          location.reload();
        };
        
        
       }
      });
      
    });
$('#update_support_status').click(function(){


 var status=$('#status').val();

 var ticketid=$('#main_ticketid').val();
$.ajax({
       url: "{{URL::to('update_suport_status')}}",
       type: "POST",
       data: {status: status,ticketid:ticketid},      
       success: function(data){
        if (data = "success") {
          $('#support_message').val('');
          location.reload();
        };
        
        
       }
      });


});
</script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
 $("#update_support").validate({
   
            rules: {
                status:{
                        required: true,
                       
                    },
                priority:{
                        required: true,
                        
                    },
                supportuser:{
                        required: true,
                    },

                orderid:{
                     required: true,
            
                },
                orderid:{
                    required:true,
                },
                  
            }
    
        });
</script>



@stop






























