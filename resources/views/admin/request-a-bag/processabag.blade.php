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
#dtTable tr>td:first-child{
display: none;
}
</style>
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Manage Request A Bag</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Manage Request A Bag</li>
  </ol>
</section>
<section class="content request-bag-admin">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
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
<?php 
/*echo "<pre>";
print_r($payout_html);die;*/

 ?>
				<div class="box-header">
					<h3 class="box-title col-md-12 heading-agent">Bag Request #{{$all_data->ref_no}}</h3>
				</div>
				<div class="details-sec row">
				<div class="col-md-6 col-sm-6">
				<input type="hidden" name="hidden_id" id="hidden_id" value="{{$all_data->id}}">
				<input type="hidden" name="label_html" id="label_html" value="{{$label_html}}">
					<table>
 
					  <tr>
						<td>Reference #</td>
						<td>{{$all_data->ref_no}}</td>
					  
					  </tr>
					  <tr>
						<td>Request Date:</td>
						<td>{{$all_data->created_at}}</td>

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
						<td>Location:</td>
						<td>{{$all_data->address1}}</td>

					  </tr>
					</table>
				</div>
				</div>
				<div class="sending-bag-sec">
					<div class="box-header">
						<h3 class="box-title col-md-12 heading-agent">Send Bag</h3>
					</div>
					<?php if ($label_html != "0") { ?>
					<div class="box-body" id="tracking_ids">
						<?php echo $label_html; ?>
					</div>
					<?php }else{ ?>					
					<div class="box-body" id="heading_lables" >
						<p>Click below to generate your tracking labels for sending a bag to the customer.</p>
						<div class="">
							   <a href="" id="generate_lables" class="btn btn-primary submit">Generate Bag Labels</a>
						</div>
					</div>
				</div>
				<div class="box-body" id="tracking_ids" style="display: none;">
					
					
				</div>
				<?php } ?>
				<div class="box-header">
					<h3 class="box-title col-md-12 heading-agent">Process Bag</h3>
				</div>
				<div class="row process-bag-steps">
					<div class="col-md-4">
						<h4>Payout:</h4>
							<?php if ($payout_html != "0") { ?>
								<div class="" id="existing_payout">
								<?php echo $payout_html; ?>
							</div>
							<?php }else{ ?>
							<div class="" id="enter_payout_amount">
								<p>Customer has Requested a Payout.</p>
								<input type="text" name="payout_amount" id="payout_amount" placeholder="Payout Amount">
								<span id="payout_amount_error" style="color:red"></span>
								<a style="margin-top: 10px"  class="btn btn-primary submit" onclick="PayoutAmount()">Save</a>
							</div>
							<div class="" id="credited_payout_amount" style="display: none;">
								
							</div>
							<?php } ?>
					
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
						<div class="box-body" id="credited_return_amount" style="display: none;">
							
						</div>
						<?php } ?>
				
				</div>
				<div class="col-md-4">
					<h4>Close Request:</h4>
					<?php if ($all_data->status == 'Closed') { ?>
						<p>Closed</p>
					<?php  }else{  ?>
					<a class="btn btn-primary submit" onclick="CloseRequest()">Close Request</a>
					<?php } ?>
				</div>
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
			$.ajax({
			 url: "{{URL::to('generatelables')}}",
			 type: "POST",
			 data: {id: id},			 
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
		
	});
	function PayoutAmount(a){
		str=true;
		var payout_amount = $('#payout_amount').val();
		var id = $('#hidden_id').val();
		$('#payout_amount').css('border','');
		$('#payout_amount_error').html('');
		if (payout_amount == "" ) {
			$('#payout_amount').css('border','1px solid red');
			$('#payout_amount_error').html('This field is required.');
			str=false;
		}
		if (str == true) {
			$.ajax({
			 url: "{{URL::to('payoutamount')}}",
			 type: "POST",
			 data: {payout_amount: payout_amount,request_id:id},			 
			 success: function(data){
			 	$('#enter_payout_amount').css('display','none');
			 	$('#credited_payout_amount').css('display','block');
			 	$('#credited_payout_amount').append(data.html);
			 	$('#dynamic_status').html('');
				$('#dynamic_status').append(data.status);
			 }
			});
		}
	}
	function ReturnAmount(a){
		str=true;
		var return_amount = $('#return_amount').val();
		var checkbox = "1";
		var id = $('#hidden_id').val();
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
		if (str == true) {
			$.ajax({
			 url: "{{URL::to('returnamount')}}",
			 type: "POST",
			 data: {return_amount: return_amount,request_id:id,checkbox_value:checkbox},	 
			 success: function(data){
			 	$('#enter_return_amount').css('display','none');
			 	$('#credited_return_amount').css('display','block');
			 	$('#credited_return_amount').append(data.html);
			 	$('#dynamic_status').html('');
				$('#dynamic_status').append(data.status);
			 }
			});
		}
	}
	function CloseRequest(a){
		var id = $('#hidden_id').val();
		$.ajax({
		url: "{{URL::to('closerequest')}}",
		type: "POST",
		data: {request_id:id},	 
		success: function(data){
		 	$('#dynamic_status').html('');
			$('#dynamic_status').append(data.status);
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
