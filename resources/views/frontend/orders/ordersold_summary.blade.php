@extends('frontend.app')

{{-- Web site Title --}}
@section('title') View Order #{{$order_id}} @parent @endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/pages/order_summary.css')}}">

@stop
{{-- Content --}}
@section('content')
<section class="container content-header view-order_tl_div">
  	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
<nav class="breadcrumb ">
  <a class="breadcrumb-item" href="{{url('dashboard')}}">Dashboard &nbsp;></a>
  <a class="breadcrumb-item" href="/my/costumes-slod">Sold Orders > &nbsp;</a>
  <span class="breadcrumb-item active">View Order #{{$order_id}}</span>
</nav>
</div>
</div>
</section>
<div class="view-order">
<section class="container content">
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
			<div class="viewTabs_rm">
                <ul class="nav nav-tabs viewTabs order-summery-tabs">
                    <li class="active"><a href="#summery" data-toggle="tab">Summary</a></li>
                   
                </ul>
			</div>
                <div class="tab-content">
                    <div class="tab-pane active" id="summery">
                        <div class="summery-details">
                            <div class="summery-info">
                                <div class="row">
                                <div class="col-md-4">
								<div class="rencemt_order_table table-responsive">
                                    <h2>Order Summary</h2>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>Order #</td>
                                            <td>{{$order['basic'][0]->order_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ordered Date:</td>
                                            <td>{{$order['basic'][0]->date}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$order['basic'][0]->status}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
									</div>
                                </div>
                                <div class="col-md-4">
								<div class="rencemt_order_table table-responsive">
                                    <h2>Buyer Information</h2>
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
                                </div>
                                <div class="col-md-4">
								<div class="rencemt_order_table table-responsive">
                                    <h2>Seller Information</h2>
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
                            </div>
                            <div class="address-sec">
                                <div class="row">
                                    <div class="col-md-6">
									<div class="rencemt_order_table">
									<ul>
											<li>
												<h2>Billing Address :</h2>
											</li>
											<li>
												<p>{{$order['basic'][0]->pay_username}}</p>
												<p>{{$order['basic'][0]->pay_address_1}} {{$order['basic'][0]->pay_address_2}}</p>
												<p>{{$order['basic'][0]->pay_city}}</p>
												<p>{{$order['basic'][0]->pay_state}} {{$order['basic'][0]->pay_zipcode}}</p>
											</li>
									</ul>
                                        
                                        
                                    </div>
									</div>
                                    <div class="col-md-6">
									<div class="rencemt_order_table">
									<ul>
										<li><h2>Shipping Address :</h2></li>	
										<li>
											<p>{{$order['basic'][0]->ship_username}}</p>
											<p>{{$order['basic'][0]->shipping_address_1}} {{$order['basic'][0]->shipping_address_2}}</p>
											<p>{{$order['basic'][0]->shipping_city}}</p>
											<p>{{$order['basic'][0]->shipping_state}} {{$order['basic'][0]->shipping_postcode}}</p>
										</li>
									</ul>
                                        
                                        
                                     </div>
									 </div>
                                </div>
                            </div>
                            <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6">
									<div class="rencemt_order_table table-responsive">
                                        <h2>Payment Information</h2>
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
									</div>
                               

                             <div class="col-md-6">
                                    <div class="rencemt_order_table table-responsive ship_info_rsp">
                                        <h2>Shipping Information</h2>

                                        <h4>Shipping Info</h4>
                                           <table class="table">
                                            <thead>
                                              <tr>
                                                <th>Track#</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($order['order_shipping']))
                                            @foreach($order['order_shipping'] as $shipping)
                                              <tr>
                                                <td>{{$shipping->track_no}}</td>
                                                <td><a href="/sold/order/track-info/download/{{$shipping->track_no}}" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Download">Download</a> <a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels={{$shipping->track_no}}" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Track">Track</a></td>
                                              </tr>
                                            @endforeach    
                                            @else
                                                <tr>
                                                  <td>No Track information found</td>
                                              </tr>
                                            @endif                      
                                            </tbody>
                                          </table>
                                        <form action="/seller/orders/genaate-label" method="POST" id="shipping_process">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                                        <input type="hidden" name="user_id" value="{{$order['basic'][0]->buyer_id}}">
                                         <input type="hidden" name="transation_api_id" value="{{$order['basic'][0]->api_transaction_no}}">
                                        <input type="hidden" name="transation_id" value="{{$order['basic'][0]->transaction_id}}">
                                         <input type="hidden" name="status" value="{{$order['basic'][0]->payment_status}}">
                                         <input type="submit" value="Generate Label" class="btn btn-primary"/>
                                        </form>
                                       
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="order-list-sec">
                                <div class="row">
                                    <div class="col-md-12">
									<div class="rencemt_order_table item_orders table-responsive">
                                        <h2>Items Ordered</h2>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>SKU</th>
                                                <th>Costume Name</th>
                                                <th>Weight (lbs)</th>
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
                                                <td>{{$items->weight*$items->qty}} (lbs)</td>
                                                <td>$ {{number_format($items->price, 2, '.', ',')}}</td>
                                                <td>{{$items->qty}}</td>
                                                <td>$ {{number_format(($items->price*$items->qty), 2, '.', ',')}}</td>
                                            </tr>
                                            @endforeach
                                            <?php $total=0;?>
                                            @foreach($order['order_amount'] as $amount)
											@if($amount->title!="Store Credits" && $amount->title!="Coupon code")
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{$amount->title}}</td>
                                                <td></td>
                                               <td><?php $total+=$amount->value;?>${{number_format($amount->value, 2, '.', ',')}}</td>
                                            </tr>
											@endif
                                             @endforeach
                                            <tr style="background: white">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total Paid</td>
                                                <td></td>
                                                <td>${{number_format($total, 2, '.', ',')}}</td>
                                            </tr>
											
                                            </tbody>
                                        </table>
										</div>
                                    </div>
									<div class="col-md-12">
									<div class="rencemt_order_table table-responsive">
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
                    </div>

                </div><!-- tab content -->
              
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
