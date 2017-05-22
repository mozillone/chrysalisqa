@extends('frontend.app')

{{-- Web site Title --}}
@section('title') View Order #{{$order_id}} @parent @endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/pages/order_summary.css')}}">

@stop
{{-- Content --}}
@section('content')
 <section class="content-header">
    <h1>View Order #{{$order_id}}</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="{{url('orders')}}">Orders</a>
    </li>
    <li class="active">View Order #{{$order_id}}</li>
  </ol>
</section>
<div class="view-order">
<section class="content">
<div class="bg-card">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#summery" data-toggle="tab">Summary</a></li>
                    <li><a href="#status" data-toggle="tab">Shipping Status</a></li>
                    <li><a href="#payment" data-toggle="tab">Payment Info</a></li>
                    <li><a href="#dispute" data-toggle="tab">Dispute</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="summery">
                        <div class="summery-details">
                            <div class="summery-info">
                                <div class="row">
                                <div class="col-md-4">
                                    <h3>Order Summary</h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>Order #</td>
                                            <td>{{$order['basic'][0]->order_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ordered Date:</td>
                                            <td>{{$order['basic'][0]->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$order['basic'][0]->status}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h3>Buyer Information</h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>Buyer Name:</td>
                                            <td>{{$order['basic'][0]->buyer_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$order['basic'][0]->buyer_email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone #:</td>
                                            <td>{{$order['basic'][0]->buyer_phone}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h3>Seller Information</h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>Seller Name:</td>
                                            <td>{{$order['basic'][0]->seller_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$order['basic'][0]->seller_email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone #:</td>
                                            <td>{{$order['basic'][0]->seller_phone}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <div class="address-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Billing Address
                                        </h3>
                                        <p>{{$order['basic'][0]->pay_username}}</p>
                                        <p>{{$order['basic'][0]->pay_address_1}}</p>
                                        <p>{{$order['basic'][0]->pay_city}}</p>
                                        <p>{{$order['basic'][0]->pay_state}} {{$order['basic'][0]->pay_zipcode}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Shipping Address
                                        </h3>
                                        <p>{{$order['basic'][0]->ship_username}}</p>
                                        <p>{{$order['basic'][0]->shipping_address_1}}</p>
                                        <p>{{$order['basic'][0]->shipping_city}}</p>
                                        <p>{{$order['basic'][0]->shipping_state}} {{$order['basic'][0]->shipping_postcode}}</p>
                                     </div>
                                </div>
                            </div>
                            <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Payment Information</h3>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Total Amount:</td>
                                                <td>${{$order['basic'][0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Method:</td>
                                                <td>Credit Card</td>
                                            </tr>
                                            <tr>
                                                <td>Transaction ID:</td>
                                                <td>{{$order['basic'][0]->api_transaction_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                <td>{{$order['basic'][0]->payment_status}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Shipping Information</h3>
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="order-list-sec">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Items Ordered</h3>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>SKU</th>
                                                <th>Costume Name</th>
                                                <th>Original Price</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order['items'] as $items)
                                            <tr>
                                                <td>{{$items->sku}}</td>
                                                <td>{{$items->costume_name}}</td>
                                                <td>$ {{number_format($items->price, 2, '.', ',')}}</td>
                                                <td>{{$items->qty}}</td>
                                                <td>$ {{number_format(($items->price*$items->qty), 2, '.', ',')}}</td>
                                            </tr>
                                            @endforeach
                                            @foreach($order['order_amount'] as $amount)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>{{$amount->title}}</td>
                                                <td></td>
                                                <td>${{number_format($amount->value, 2, '.', ',')}}</td>
                                            </tr>
                                             @endforeach
                                            <tr style="background: white">
                                                <td></td>
                                                <td></td>
                                                <td>Total Paid</td>
                                                <td></td>
                                                <td>${{number_format($order['basic'][0]->total, 2, '.', ',')}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           

                        </div>
                    </div>


                    <div class="tab-pane" id="status">
                        <h4>Pane B</h4>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                            ac turpis egestas.</p>
                    </div>
                    <div class="tab-pane" id="payment">
                        <h4>Pane C</h4>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                            ac turpis egestas.</p>
                    </div>
                    <div class="tab-pane" id="dispute">
                        <h4>Pane D</h4>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                            ac turpis egestas.</p>
                    </div>
                </div><!-- tab content -->
                <div class="container">
                    <h2>Comments History</h2>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Message</th>
                            <th>Status Change</th>
                            <th>Comment Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($order['order_comment'] as $comments)
                          <tr>
                            <td>{{$comments->comment}}</td>
                            <td>{{$comments->status}}</td>
                            <td>{{$comments->date}}</td>
                          </tr>
                        @endforeach                          
                        </tbody>
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
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/pages/order_process.js') }}"></script>

@stop
