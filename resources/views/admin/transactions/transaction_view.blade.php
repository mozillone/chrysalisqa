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
        <div class="col-md-12">
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
            <div class="box box-info">
                <div class="tab-content">
                <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Transaction Information</h3>
                                        <table>
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
                                    </div>
                  </div>

                            </div>
                  </div>
                </div><!-- tab content -->
               
            </div>

        </div>
    </div>
  </section>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
