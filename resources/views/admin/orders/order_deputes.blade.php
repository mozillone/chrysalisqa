@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/pages/order_summary.css')}}">
@stop
<style>

</style>
{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>View Order #{{$order_id}}</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="{{url('orders')}}"><i class="fa fa-dashboard"></i> Orders</a>
    </li>
    <li class="active">#{{$order_id}} Shipping Info</li>
  </ol>
</section>
<section class="content" ng-controller="OrderShippingsController">
<div class="view-order">
  <section class="content">
    <div class="bg-card">
      <div class="row">
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
            <div class="box box-info">
            <input type="hidden" name="order_id" value="{{$order_id}}">
               @include('admin.orders.orders_menu')
                <div class="box-header with-border">
                    <h3 class="box-title">Dispute Messages</h3>
                   </div>
                <div class="box-body">
      
          <div class="table-responsive">
          <table class="table table-hover">
                  <tr>
                    <th>Message</th>
                    <th>Messaged By</th>
                    <th>Dispute Comment Date</th>
                  </tr>
                    @if(isset($total_data['messages']))
                    @foreach ($total_data['messages'] as $messages)
                  <tr>
                    <?php //echo "<pre>";print_r($messages);die; ?>
                    <td>{{$messages->message}}</td>
                    <td>{{$messages->display_name}}</td>
                    <td>{{$messages->created_at}}</td>
                  </tr>
                    @endforeach
                    @endif
                </table>
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
  <script src="{{ asset('angular/Admin/Orders/Controllers/order-shippings.js') }}"></script>
@stop






























