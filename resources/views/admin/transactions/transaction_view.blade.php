@extends('admin.app')

{{-- Web site Title --}}
@section('title') View Transaction #{{$transaction_info[0]->transaction_id}} @parent @endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/pages/order_summary.css')}}">

@stop
{{-- Content --}}
@section('content')
 <section class="content-header">
    <h1>View Transaction #{{$transaction_info[0]->transaction_id}}</h1>
  <nav class="breadcrumb">
  <a class="breadcrumb-item" href="{{url('dashboard')}}">Dashboard &nbsp;&nbsp;></a>
  <a class="breadcrumb-item" href="/transactions">Transactions > &nbsp;</a>
  <span class="breadcrumb-item active">View Transaction #{{$transaction_info[0]->transaction_id}}</span>
</nav>
  
</section>
<div class="view-order">
<section class="content">
<div class="bg-card">
    <div class="row">
<<<<<<< HEAD
	    <div class="table-responsive">
        <div class="col-md-12 col-sm-12 col-xs-12">
=======
        <div class="col-md-12">
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
            <div class="box box-info ">
                <div class="">
                <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 col-sm-12">
										<div class="box-header">
											<h3 class="box-title col-md-12 heading-agent">Transaction Information</h3>
										</div>
										<div class="content">
                                        <table class="table table-striped">
=======
            <div class="box box-info">
                <div class="tab-content">
                <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Transaction Information</h3>
                                        <table>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                                            <tbody>
                                             <tr>
                                                <td>Transaction#:</td>
                                                <td>{{$transaction_info[0]->transaction_id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Order#:</td>
                                                <td>{{$transaction_info[0]->order_id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Customer Name:</td>
                                                <td>{{$transaction_info[0]->user_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Amount:</td>
                                                <td>{{$transaction_info[0]->price}}</td>
                                            </tr>
                                            <tr>
                                                <td>Date :</td>
                                                <td>{{$transaction_info[0]->date}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status :</td>
                                                <td>{{$transaction_info[0]->status}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
<<<<<<< HEAD
										</div>
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                                    </div>
                  </div>

                            </div>
                  </div>
                </div><!-- tab content -->
               
            </div>

<<<<<<< HEAD
        </div>      </div>
=======
        </div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
    </div>
  </section>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
