@extends('admin.app')

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
    <nav class="breadcrumb">
  <a class="breadcrumb-item" href="{{url('dashboard')}}">Dashboard &nbsp;&nbsp;></a>
  <a class="breadcrumb-item" href="{{url('orders')}}">Orders > &nbsp;</a>
  <span class="breadcrumb-item active">View Order #{{$order_id}}</span>
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
                @include('admin.orders.orders_menu')
                <div class="tab-content">
                    <div class="tab-pane active" id="summery">
                        <div class="summery-details">
                            <div class="summery-info">
                                <div class="row">
                                <div class="col-md-4">
                                    <h3>Order Summary</h3>
                                    <table class="table table-bordered">
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
                                <div class="col-md-4">
                                    <h3>Buyer Information</h3>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>Buyer Name:</td>
                                            <td>{{$order['basic'][0]->buyer_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{$order['basic'][0]->buyer_email}}</td>
                                        </tr>
                                       
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h3>Seller Information</h3>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>Seller Name:</td>
                                            <td>{{$order['basic'][0]->seller_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{$order['basic'][0]->seller_email}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Seller Paid:</td>
                                            <td>@if($order['basic'][0]->is_free) Yes @else No @endif</td>
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
                                            <a href="javascript::void(0);" data-toggle="modal" data-target="#billing_popup">Edit</a>
                                        </h3>
                                        <p>{{$order['basic'][0]->pay_username}}</p>
                                        <p>{{$order['basic'][0]->pay_address_1}} {{$order['basic'][0]->pay_address_2}}</p>
                                        <p>{{$order['basic'][0]->pay_city}}</p>
                                        <p>{{$order['basic'][0]->pay_state}} {{$order['basic'][0]->pay_zipcode}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Shipping Address
                                            <a href="javascript::void(0);" data-toggle="modal" data-target="#shipping_popup">Edit</a>
                                        </h3>
                                        <p>{{$order['basic'][0]->ship_username}}</p>
                                        <p>{{$order['basic'][0]->shipping_address_1}} {{$order['basic'][0]->shipping_address_2}}</p>
                                        <p>{{$order['basic'][0]->shipping_city}}</p>
                                        <p>{{$order['basic'][0]->shipping_state}} {{$order['basic'][0]->shipping_postcode}}</p>
                                     </div>
                                </div>
                            </div>
                            <div class="payment-sec" name="ordersShipping" id="ordersShipping">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Payment Information</h3>
                                        <table class="table table-bordered">
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
                                        <h4>Shipping Info</h4>
                                           <table class="table table-bordered">
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
                                                @if($shipping->carrier_type=="usps")
                                                <td><a href="/order/track-info/download/{{$shipping->track_no}}/usps" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Download">Print Label</a> <a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels={{$shipping->track_no}}" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Track">Track</a></td>
                                                @else
                                                <td><a href="/order/track-info/download/{{$shipping->track_no}}/fedex" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Download">Print Label</a> <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber={{$shipping->track_no}}&cntry_code=us" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Track">Track</a></td>
                                                @endif
                                              </tr>
                                            @endforeach    
                                            @else
                                                <tr>
                                                  <td>No Track information found</td>
                                              </tr>
                                            @endif                      
                                            </tbody>
                                          </table>
                                        <form action="/orders/genaate-label" method="POST" id="shipping_process">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                                        <input type="hidden" name="transation_api_id" value="{{$order['basic'][0]->api_transaction_no}}">
                                        <input type="hidden" name="transation_id" value="{{$order['basic'][0]->transaction_id}}">
                                        <input type="hidden" name="user_id" value="{{$order['basic'][0]->buyer_id}}">
                                        <input type="hidden" name="status" value="{{$order['basic'][0]->payment_status}}">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="shipping">Carrier</label>
                                                <select class="form-control" name="carrier_type" id="carrier_type">
                                                    <option value="USPS">USPS</option>
                                                    <option value="FedEx">FedEx</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="sel1">Method</label>
                                                <select class="form-control" id="method" name="method">
                                                    <option value="">None</option><option value="Priority">Priority</option><option value="First">Express</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="usr">Weight (lbs)</label>
                                                <input type="text" class="form-control" id="weight" name="weight">
                                            </div>
                                        </div>
                                         <input type="submit" value="Generate Label" class="btn btn-primary generate-btn"/>
                                        </form>

                                    </div>
                                </div>

                            </div>
                            <div class="order-list-sec tbls_orders">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Items Ordered</h3>
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
                                            @foreach($order['order_amount'] as $amount)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
												<td></td>
                                                <td>{{$amount->title}} @if($amount->title=="Shipping")({{ucfirst($order['basic'][0]->shipping_method)}}) @endif</td>
                                                <td>@if($amount->code=="sub")-@endif${{number_format($amount->value, 2, '.', ',')}}</td>
                                            </tr>
                                             @endforeach
                                            <tr style="background: white">
                                                <td></td>
                                                <td></td>
                                                <td></td>
												 <td></td>
                                                <td>Total Paid</td>
                                                <td>${{number_format($order['basic'][0]->total, 2, '.', ',')}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="old-orders">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Order Status Update</h3>
                                        <div class="form-inline">
                                            <label >Current Status</label>
                                            <span>{{$order['basic'][0]->status}}</span>
                                        </div>
                                        <form action="/order/status/update" method="POST" id="order_status">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                                        <div class="form-inline">
                                            <label for="update-status">Update Status</label>
                                            <select class="form-control" id="update-status" name="status_id"> 
                                                @foreach($order['status'] as $status)
                                                <option value="{{$status->status_id}}" @if($order['basic'][0]->status==$status->name) selected @endif>{{$status->name}}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Comment:</label>
                                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="is_notify" value="1">Notify Customer By Email</label>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary"/>
                                    </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Transaction</h3>
                                        <form action="/add/order/transation" method="POST" id="order_transaction">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                                        <input type="hidden" name="cc_id" value="{{$order['basic'][0]->cc_id}}">
                                        <input type="hidden" name="user_id" value="{{$order['basic'][0]->buyer_id}}">
                                        <input type="hidden" name="buyer_email" value="{{$order['basic'][0]->buyer_email}}">
                                        <input type="hidden" name="buyer_name" value="{{$order['basic'][0]->buyer_name}}">
                                        <input type="hidden" name="payment_status" value="{{$order['basic'][0]->payment_status}}">
                                         <input type="hidden" name="transation_id" value="{{$order['basic'][0]->transaction_id}}">
                                       <div class="form-inline amt">
                                            <label >Amount</label>
                                            <input type="text" class="form-control" id="transaction_amount" placeholder="0.00" name="transaction_amount">
                                        </div>
                                        <div class="form-inline">
                                            <label for="transaction">Transaction Type</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="charge">Charge</option>
                                             @if($order['basic'][0]->payment_status=="Charged")<option value="refund">Refund</option>@endif
                                             @if($order['basic'][0]->payment_status=="authorized")<option value="return">Return</option>@endif

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment1">Comment:</label>
                                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="is_notify"  value="1">Notify Customer By Email</label>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary"/>
                                         </form>
                                    </div>
                                </div>

                            </div>

                        </div>
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
                </div><!-- tab content -->
               
            </div>

        </div>
    </div>
</div>
<div class="modal fade window-popup" id="shipping_popup" tabindex="-1">
    <div class="modal-dialog shopping-address-modal">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Shipping Address</h4>
          </div>
          <div class="modal-body">
           <form class="" action="/order/shipping-address/update" method="POST" id="shipping_address">   
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                        
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="chek-out">
                                   <div class="new_address">
                                <div class="address-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="{{$order['basic'][0]->shipping_firstname}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="{{$order['basic'][0]->shipping_lastname}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_address_1" placeholder="Apt or Suite no (Optional)" name="address_1" value="{{$order['basic'][0]->shipping_address_1}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_address_2" placeholder="Street Address *" name="address_2" value="{{$order['basic'][0]->shipping_address_2}}">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_city" placeholder="City *" name="city" value="{{$order['basic'][0]->shipping_city}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="postcode" value="{{$order['basic'][0]->shipping_postcode}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control state_dropdown" name="state" id="shipping_state">
                                                    <option value="">State</option>
                                                    @foreach($order['states'] as $st)
                                                    <option value="{{$st->name}}" @if($st->name==$order['basic'][0]->shipping_state) selected @endif>{{$st->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                    </div>
                                   
                                      <div class="col-md-12 text-center">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                    </div>          
                                
                                </div>
                                </div>
            
                                    
                                
                        </div>
                        </form>
                    </div>
                  
          </div>
          <div class="modal-footer">
          </div>
        </div>

    </div>
</div>
<div class="modal fade window-popup" id="billing_popup" tabindex="-1">
    <div class="modal-dialog shopping-address-modal">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Billing Address</h4>
          </div>
          <div class="modal-body">
           <form class="" action="/order/billing-address/update" method="POST" id="billing_address">   
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="hidden" name="order_id" value="{{$order['basic'][0]->order_id}}">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="chek-out">
                                         
                                    <div class="address-form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_firstname" placeholder="First Name *" name="firstname" value="{{$order['basic'][0]->pay_firstname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_lastname" placeholder="Last Name" name="lastname" value="{{$order['basic'][0]->pay_lastname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_address_1" placeholder="Apt or Suite no (Optional)" name="address_1" value="{{$order['basic'][0]->pay_address_1}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_address_2" placeholder="Street Address *" name="address_2" value="{{$order['basic'][0]->pay_address_2}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_city" placeholder="City *" name="city" value="{{$order['basic'][0]->pay_city}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_postcode" placeholder="Zipcode *" name="postcode" value="{{$order['basic'][0]->pay_zipcode}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control state_dropdown" name="state" id="billing_state">
                                                    <option value="">State</option>
                                                    @foreach($order['states'] as $st)
                                                    <option value="{{$st->name}}" @if($st->name==$order['basic'][0]->pay_state) selected @endif>{{$st->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                  
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                    
                                        
                                    </div>
                                </div>                               
                        </div>
                        </form> 
                    </div>
          <div class="modal-footer text-center">
            
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
