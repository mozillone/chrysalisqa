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
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
			@if (isset($total_data) && !empty($total_data)) 
			 <?php 	$all_data = $total_data['request_a_bag']; ?>
			 @else
			  <?php 	$all_data = ""; ?>
			 	@endif
<?php 
/*echo "<pre>";
print_r($all_data);*/

 ?>
				<div class="box-header">
					<h3 class="box-title col-md-12 heading-agent">Bag Request #{{$all_data->ref_no}}</h3>
				</div>
				<div class="box-body">
					<div>
						<p>Reference #:{{$all_data->ref_no}}</p>
						<p>Request Date:{{$all_data->created_at}}</p>
						<p>Status:{{$all_data->status}}</p>
						<?php if ($all_data->is_payout == "0") {
							$is_payout = "No";
						}else{
							$is_payout = "Yes";
							} ?>
						<p>Payout:{{$is_payout}}</p>
						<?php if ($all_data->is_return == "0") {
							$is_return = "No";
						}else{
							$is_return = "Yes";
							} ?>
						<p>Return Assurance:{{$is_return}}</p>
					</div>
					<div>
						<p>Customer Name:{{$all_data->cus_name}}</p>
						<p>Customer Email:{{$all_data->cus_email}}</p>
						<p>Customer Phone:{{$all_data->cus_phone}}</p>
						<p>Location:{{$all_data->address1}}</p>
					</div>
				</div>
				
					<div class="box-footer">
						<div class="pull-right">
							<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
							<button type="submit" id="submit" name="submit" class="btn btn-info pull-right">Submit</button>
						</div>
					</div>

			</div>
			</div>
			
		</div>
	</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/angular/Admin/Charities/Controllers/charities-lists.js') }}"></script>
<script src="{{ asset('/angular/Admin/Charities/Services/charities.js') }}"></script>
<script src="{{ asset('angular/Admin/ExportCsv/Services/ExportCsv.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/angular/Admin/directives/datepicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop
