@extends('frontend.app')
{{-- Web site Title --}}
@section('title') View Order #{{$order_id}} @parent @endsection
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/pages/order_summary.css')}}">
@stop
{{-- Content --}}
@section('content')
<section class="container content-header view-order_tl_div">
  	<div class="row">
		<div class="col-md-12">
			<nav class="breadcrumb ">
				<a class="breadcrumb-item" href="{{url('dashboard')}}">Dashboard &nbsp;></a>
				<a class="breadcrumb-item" href="/my/orders">Orders List > &nbsp;</a>
				<span class="breadcrumb-item active">#{{$order_id}} Transactions Info</span>
			</nav>
		</div>
	</div>
</section>
<div class="view-order">
	<section class="container content" ng-controller="OrderShippingsController  ">
		<div class="bg-card">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info view_order_div_blog">
						<div class="viewTabs_rm">
							@include('frontend.orders.orders_menu')
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="summery">
								<div class="summery-details">
									<div class="summery-info">
										<div class="row">
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
											<div class="rencemt_order_table">
												<input type="hidden" name="order_id" value="{{$order_id}}">
												<div class="box-header with-border">
													<h2 class="box-title">#{{$order_id}} Transactions Info</h2>
													</div>
													<div class="box-body">
														<div class="table-responsive auto-scroll-none">
														</div>
														<div class="table-responsive auto-scroll-none">
															<table datatable dt-options="dtOptions" dt-columns="dtColumns"
															class="table table-striped" id="dtTable">
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('angular/Frontend/Orders/Controllers/order-transactions.js') }}"></script>
	<script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
	@stop