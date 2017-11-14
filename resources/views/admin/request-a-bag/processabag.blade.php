@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Manage Bag@parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">

<style type="text/css">
#dtTable tr>th:first-child{
display: none;
}
select#payout_type {
padding: 6px;
margin-bottom: 15px;
border: 1px solid #cccccc;
}
#dtTable tr>td:first-child{
display: none;
}
.address p
{
margin: 0px;
}
</style>
@stop

{{-- Page content --}}
@section('content')
	@if (isset($total_data) && !empty($total_data)) 
		<?php 	$all_data = $total_data['request_a_bag']; ?>
	@else
		<?php 	$all_data = ""; ?>
	@endif
	@if (isset($total_data) && !empty($total_data)) 
		 <?php 	$label_html = $total_data['generated_lables_html']; ?>
	@else
		<?php 	$label_html = ""; ?>
	@endif
	@if (isset($total_data) && !empty($total_data)) 
		 <?php 	$payout_html = $total_data['payout_html']; ?>
	@else
		<?php 	$payout_html = ""; ?>
	@endif
	@if (isset($total_data) && !empty($total_data)) 
		 <?php 	$return_html = $total_data['return_html']; ?>
	@else
		<?php 	$return_html = ""; ?>
	@endif
<section class="content-header">
<h1>Manage Request A Bag</h1>
<ol class="breadcrumb">
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li>
    <a href="{{url('manage-bags')}}"><i class="fa fa-suitcase"></i> Manage Bag list</a>
</li>
<li class="active">Ref no #{{$all_data->ref_no}}</li>
</ol>
</section>
<section class="content request-bag-admin">
<div class="row">
	<div class="col-sm-12 col-md-12">
	 @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
                    {{ Session::get('error') }}
                </div>
                @elseif(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
                    {{ Session::get('success') }}
                </div>
                @endif
		<div class="box box-primary">
		
<?php 
/*echo "<pre>";
print_r($all_data);die;*/

?>
			<div class="box-header">
				<h3 class="box-title col-md-12 heading-agent">Ref no #{{$all_data->ref_no}}</h3>
			</div>
			<div class="details-sec row">
			<div class="col-md-6 col-sm-6">
                            <input type="hidden" name="req_bag_id" id="req_bag_id" value="{{$all_data->id}}">    
			<input type="hidden" name="hidden_id" id="hidden_id" value="{{$all_data->ref_no}}">
			<input type="hidden" name="address_id" id="address_id" value="{{$all_data->address_id}}">
			<input type="hidden" name="user_id" id="user_id" value="{{$all_data->user_id}}">
			<input type="hidden" name="conversation_id" id="conversation_id" value="{{$all_data->conversation_id}}">
			<input type="hidden" name="label_html" id="label_html" value="{{$label_html}}">
				<table>

				  <tr>
					<td>Reference #</td>
					<td>{{$all_data->ref_no}}</td>
				  
				  </tr>
				  <tr>
					<td>Request Date:</td>
					<td>{{date('M d, Y h:i A',strtotime($all_data->created_at))}}</td>
				

				  </tr>
				  <tr>
					<td>Status:</td>
					<td id="dynamic_status">{{$all_data->status}}</td>

				  </tr>
				  <?php if ($all_data->is_payout == "0") {
						$is_payout = "No";
					}else{
						$is_payout = "Yes";
						} ?>
				   <tr>
					<td>Payout:</td>
					<td>{{$is_payout}}</td>

				  </tr>
				  <?php if ($all_data->is_return == "0") {
						$is_return = "No";
					}else{
						$is_return = "Yes";
						} ?>
				  <tr>
					<td>Return Assurance:</td>
					<td>{{$is_return}}</td>

				  </tr>
				</table>
			</div>
			<div class="col-md-6 col-sm-6">
				<table> 
				  <tr>
					<td>Customer Name:</td>
					<td>{{$all_data->cus_name}}</td>
				  
				  </tr>
				  <tr>
					<td>Customer Email:</td>
					<td>{{$all_data->cus_email}}</td>

				  </tr>
				  <tr>
					<td>Customer Phone:</td>
					<td>{{$all_data->cus_phone}}</td>

				  </tr>
				  <tr>
					<td valign="top">Location:</td>
					<td class="address">
                    	<p>{{$all_data->address1}}</p>                   
                    	<p>{{$all_data->address2}}</p>                        	
                    	<p>{{$all_data->city}}</p>
                    	<p>{{$all_data->name}}&nbsp;{{$all_data->zip_code}}</p>
                    </td>

				  </tr>
				</table>
			</div>
			</div>
                            
                            <div class="sending-bag-sec">
                                <div class="box-header">
                                        <h3 class="box-title col-md-12 heading-agent">Send Bag</h3>
                                </div>
                                @if ($label_html != "0")
                                    <div class="box-body" id="tracking_ids">
                                        <?php echo $label_html; ?>
                                    </div>
                                @else
                                @if($all_data->status == "Requested")
                                <div class="" id="req_bag_label">
                                    <div class="box-body" id="heading_lables" >
                                        <p>Click below to generate your tracking labels for sending a bag to the customer.</p>
                                        <div class="">
                                                <form action="{{URL::to('generatelables')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="hidden_id" id="hidden_id" value="{{$all_data->id}}">
                                                <input type="hidden" name="address_id" id="address_id" value="{{$all_data->address_id}}">
                                                        <button class="btn btn-primary submit">Generate Bag Labels</button>
                                                 </form>
                                        </div>
                                    </div>
                                </div>    
                                @endif 
                                @endif
                            </div>
			<div class="box-body" id="tracking_ids" style="display: none;">
				
				
			</div>
			<div class="box-header">
				<h3 class="box-title col-md-12 heading-agent">Process Bag</h3>
			</div>
                            
			<div class="row process-bag-steps">
                @if($is_label_generated > 0)
					<div class="col-md-4">
	            		@if($all_data->is_payout == "1")    
		                	<h4>Payout:</h4>
		                	@if($payout_html != "0")
		                		<div class="" id="existing_payout">
	                                <?php echo $payout_html; ?>
	                            </div>
	                        @else
		                    	<div class="" id="enter_payout_amount">
		                            <p>Customer has Requested a Payout.</p>
		                            <select id="payout_type" name="payout_type">
		                                <option value="">Select Payout Type</option>
		                                <option value="credit">Store Credit</option>
		                                <option value="paypal_paypout">Paypal Payout</option>
		                            </select>
		                            <span id="payout_type_error" style="color:red"></span>

		                            <input type="text" name="payout_amount" id="payout_amount" placeholder="Amount">
		                            <div id="payout_amount_error" style="color:red"></div>
		                            <a style="margin-top: 10px"  class="btn btn-primary submit" onclick="PayoutAmount()">Save</a>
		                        </div>
	                        	<div id="req_payout_sub_msg" style="display:none;">submitting...</div>
	                        	<div id="req_payout_err_msg" style="display:none;"></div>
	                        	<div class="" id="credited_payout_amount" style="display: none;"></div>
	                        @endif
						@endif
					</div>
					<div class="col-md-4">
						<h4>Return Items:</h4>
						<?php if ($return_html != "0") { ?>
						<div class="" id="existing_payout">
							<?php echo $return_html; ?>
						</div>
						<?php }else{ ?>
						<div class="" id="enter_return_amount">
							<p>Customer has Requested Return Bag</p>
						
							<input type="text" name="return_amount" id="return_amount" placeholder="Bag Weight (lbs)">
							<span id="return_amount_error" style="color:red"></span>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="exclude_credit_deduction" id="exclude_credit_deduction"  value="">Exclude Credit Deduction
								</label>
							</div>
							<a class="btn btn-primary submit" onclick="ReturnAmount()">Save</a>
						</div>
						<div id="req_return_sub_msg" style="display:none;">submitting...</div>
	                    <div id="req_return_err_msg" style="display:none;"></div>
						<div class="box-body" id="credited_return_amount" style="display: none;"></div>
						<?php } ?>
                    </div>
                @endif
				<div class="col-md-4">
	                <h4>Close Request:</h4>
	                <div class="" id="request_close_div">
	                    <?php if ($all_data->status == 'Closed') { ?>
	                            <p>Closed</p>
	                    <?php  }else{  ?>
	                    <a class="btn btn-primary submit" onclick="CloseRequest()">Close Request</a>
	                    <?php } ?>
	                </div>
	                <div class="" id="close_request_response" style="display: none;">
	                    Closed		
	                </div>
				</div>
			</div>
			
			<div id="messaging_div" class="message-sec-admin">
			<h3>Messages</h3>
		
				<?php //echo "<pre>";print_r($total_data['messagingtheard']);die; 
				if (isset($total_data['messagingtheard']) && !empty($total_data['messagingtheard'])) {
					$theads = $total_data['messagingtheard'];
				}else{
					$theads = "";
				}
				?>
				@foreach ($theads as $theard)
					<div class="media">
					  	<div class="media-left">	
					  	@if(!empty($theard->user_img))
					  	<?php $image= URL::asset('profile_img/resize').'/'.$theard->user_img; 	
					  	?>
					  	@else
					  	<?php $image= URL::asset('/img/default.png'); ?>
					  	@endif						
							<img src="{{$image}}"><p>{{$theard->display_name}}</p>
						</div>
						<div class="media-body">
							<div class="media-heading">
									<p>{{$theard->message}}</p>
									<span>Sent {{helper::time_elapsed_string($theard->created_at)}}</span>
							</div>							
						</div>
					</div>
				@endforeach
				<textarea id="message_theard" class="form-control" rows="6" cols="50"></textarea>
				<input type="button" name="theard" id="theard" value="SEND" class="btn btn-primary msg-submit" ></input>
			

				
				
			</div>
			
			
			
		</div>
		</div>
		
	</div>
</section>
@stop
{{-- page level scripts --}}

@section('footer_scripts') 
<script type="text/javascript">
$(document).ready(function()
{
	$('#generate_lables').click(function(){
		/*$('#tracking_ids').css('display','block');
		$('#generate_lables').css('display','none');*/
		$('#generate_lables').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
		$('#generate_lables').append('<div class="modal-backdrop fade in"></div>');
		var id = $('#hidden_id').val();
		var address_id = $('#address_id').val();
		$.ajax({
		 url: "{{URL::to('generatelables')}}",
		 type: "POST",
		 data: {id: id,address_id:address_id},			 
		 success: function(data){
		 	$('#ajax_loader').css('display','none');
			$('.modal-backdrop').remove();
			$('#heading_lables').css('display','none');
			$('#tracking_ids').css('display','block');
			$('#tracking_ids').append(data.html);
			$('#dynamic_status').html('');
			$('#dynamic_status').append(data.status);
		 	
		 }
		});
	});
	$('#theard').click(function(){
		$('#theard').attr('disabled','true');
		/*$('#tracking_ids').css('display','block');
		$('#generate_lables').css('display','none');*/
		//$('#generate_lables').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
		//$('#generate_lables').append('<div class="modal-backdrop fade in"></div>');
		var message_theard = $('#message_theard').val();
		var conversation_id = $('#conversation_id').val();
		var user_id = $('#user_id').val();
		var hidden_id = $('#hidden_id').val();
		$.ajax({
		 url: "{{URL::to('requestabag_message')}}",
		 type: "POST",
		 data: {conversation_id: conversation_id,hidden_id: hidden_id,message_theard: message_theard,user_id: user_id},			 
		 success: function(data){
		 	if (data == "success") {
		 		location.reload();
		 	};
			
		 	
		 }
		});
	});
	
});
function init() {
// Clear forms here
document.getElementById("message_theard").value = "";
}
window.onload = init;
var loading = false;
function PayoutAmount(a){
	str=true;
	var payout_amount = $('#payout_amount').val();
	var payout_type   = $('#payout_type').val();
	var id = $('#req_bag_id').val();
	$('#payout_amount').css('border','');
	$('#payout_type').css('border','');
	$('#payout_amount_error').html('');
	$('#payout_type_error').html('');
	if (payout_type == "" ) {
		$('#payout_type').css('border','1px solid red');
		$('#payout_type_error').html('* required');
		str=false;
	}
	if (payout_amount == "" ) {
		$('#payout_amount').css('border','1px solid red');
		$('#payout_amount_error').html('This field is required.');
		str=false;
	}
            
            if (loading) {
                return ;
            }
            loading = true;
            
	if (str == true) {
		$("#req_payout_sub_msg").show();
		$("#req_payout_err_msg").html('');
        $("#req_payout_err_msg").hide();
		$.ajax({
		 url: "{{URL::to('payoutamount')}}",
		 type: "POST",
		 data: {payout_amount: payout_amount,type_id:id,payout_type:payout_type},			 
		 success: function(data){
		 	$('#enter_payout_amount').css('display','none');
		 	$('#credited_payout_amount').css('display','block');
		 	$('#credited_payout_amount').append(data.html);
		 	$('#dynamic_status').html('');
			$('#dynamic_status').append(data.status);
                            loading = false;
                            $("#req_payout_sub_msg").hide();
                            $("#req_payout_err_msg").html('');
                            $("#req_payout_err_msg").hide();
                        },
                       error: function(request, status, error) {
                       		//alert(data);
                            loading = false;
                            $("#req_payout_sub_msg").hide();
                            $("#req_payout_err_msg").html(request.responseText);
                            $("#req_payout_err_msg").show();
                       }
		});
	}
}

    
    function ReturnAmount(a){
	str=true;
	var return_amount = $('#return_amount').val();
	var checkbox = "1";
	var id = $('#req_bag_id').val();
	if($('input[name=exclude_credit_deduction]:checked').length<=0){
		var checkbox = "0";	
	}
	$('#return_amount').css('border','');
	$('#return_amount').html('');
	if (return_amount == "" ) {
		$('#return_amount').css('border','1px solid red');
		$('#return_amount_error').html('This field is required.');
		str=false;
	}
	
    if (loading) {
        return ;
    }
    loading = true;
	if (str == true) {
                $("#req_return_sub_msg").show();
                $("#req_return_err_msg").html('');
                $("#req_return_err_msg").hide();
                $.ajax({
                 url: "{{URL::to('returnamount')}}",
                 type: "POST",
                 data: {return_amount: return_amount,type_id:id,checkbox_value:checkbox},	 
                 success: function(data){
                        $('#enter_return_amount').css('display','none');
                        $('#credited_return_amount').css('display','block');
                        $('#credited_return_amount').append(data.html);
                        $('#dynamic_status').html('');
                        $('#dynamic_status').append(data.status);
                        loading = false;
                        $("#req_return_sub_msg").hide();
                        $("#req_return_err_msg").html('');
                        $("#req_return_err_msg").hide();
                 },
          error: function(request, status, error) {
                    //alert(data);
               loading = false;
               $("#req_return_sub_msg").hide();
               $("#req_return_err_msg").html(request.responseText);
               $("#req_return_err_msg").show();
          }
            });
        }
}
    
function CloseRequest(a){
	var id = $('#req_bag_id').val();
	$.ajax({
	url: "{{URL::to('closerequest')}}",
	type: "POST",
	data: {type_id:id},	 
	success: function(data){
                    $('#request_close_div').css('display','none');
                    $('#close_request_response').css('display','block');
                    $('#req_bag_label').css('display','none');      
	}	
	});
	
}

</script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/angular/Admin/Charities/Controllers/charities-lists.js') }}"></script>
<script src="{{ asset('/angular/Admin/Charities/Services/charities.js') }}"></script>
<script src="{{ asset('angular/Admin/ExportCsv/Services/ExportCsv.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/angular/Admin/directives/datepicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop
