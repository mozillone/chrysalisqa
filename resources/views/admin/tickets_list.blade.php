@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Ticket #CCSP134345</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
	<li>
        <a href="{{url('dashboard')}}"> Support</a>
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
                    <h3 class="box-title">Dispute Against Order #12456</h3>
                   
                </div>
                <div class="box-body">
				<div class="row">
					<div class="col-md-8">
						<div class="content">
							<div class="media">
								<div class="media-left">
								  <img src="https://organicthemes.com/demo/profile/files/2012/12/profile_img.png" class="media-object">
								  
								</div>
								<div class="media-body">
									<div class="header-sec">
								  <h4 class="media-heading">Left-aligned</h4>
								  <span class="pull-right">May, 29 2017</span>
								  </div>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							  </div>
							  <div class="media">
								<div class="media-left">
								  <img src="https://organicthemes.com/demo/profile/files/2012/12/profile_img.png" class="media-object">
								  <span>John Deo</span>
								  
								</div>
								<div class="media-body">
									<div class="header-sec">
								  <h4 class="media-heading">Left-aligned</h4>
								  <span class="pull-right">May, 29 2017</span>
								  </div>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								  <ul>
									<li>Marty Simmons</li>	
									<li>support@chrysalis.com</li>	
									<li>Phone: 1-80-CHRYSALIS</li>	
								</ul>
								</div>
								
							  </div>
						</div>
					
					</div>
					<div class="col-md-4">
						<div class="user-request-sec">
						<h4>John submitted this request</h4>
							<ul>
								<li>Status</li>
								<li>Open</li>
							</ul>
							<ul>
								<li>Priority</li>
								<li>---</li>
							</ul>
							<ul>
								<li>Assigned To</li>
								<li>
										 <form>
											<div class="form-group">
											  
											  <select class="form-control" id="sel1">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
											  </select>
											 </div>
										  </form>
								</li>
							</ul>
							<ul>
								<li>Order #</li>
								<li><a>12456</a></li>
							</ul>
						</div>
						
						</div>
				</div>
				 
       
         
                </div>
            </div>
        </div>
    </div>
</section>


@stop


{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('angular/Admin/UserManagement/Controllers/users-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/user_management.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>




@stop






























