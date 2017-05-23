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
                                            <a href="javascript::void(0);" data-toggle="modal" data-target="#billing_popup">Edit</a>
                                        </h3>
                                        <p>{{$order['basic'][0]->pay_username}}</p>
                                        <p>{{$order['basic'][0]->pay_address_1}}</p>
                                        <p>{{$order['basic'][0]->pay_city}}</p>
                                        <p>{{$order['basic'][0]->pay_state}} {{$order['basic'][0]->pay_zipcode}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Shipping Address
                                            <a href="javascript::void(0);" data-toggle="modal" data-target="#shipping_popup">Edit</a>
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
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="shipping">Carrier</label>
                                                <select class="form-control" name="" id="shipping">
                                                    <option value="">USPS</option>
                                                    <option value="">UPS</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="sel1">Method</label>
                                                <select class="form-control" id="sel1">
                                                    <option value="None">None</option>
                                                    <option value="Priority Mail Express">Priority Mail
                                                        Express
                                                    </option>
                                                    <option value="Priority Mail">Priority Mail</option>
                                                    <option value="First-Class Mail">First-Class Mail</option>
                                                    <option value="USPS Retail Ground">USPS Retail Ground
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="usr">Weight (lbs)</label>
                                                <input type="text" class="form-control" id="usr">
                                            </div>
                                        </div>

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
                                            <label for="update-status">Updtate Status</label>
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
                                            <label><input type="checkbox" value="">Notify Customer By Email</label>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary"/>
                                    </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Transaction</h3>
                                        <div class="form-inline">
                                            <label >Amount</label>
                                            <input type="email" class="form-control" id="email" placeholder="$0.00" name="email">
                                        </div>
                                        <div class="form-inline">
                                            <label for="transaction">Transaction Type</label>
                                            <select class="form-control" id="transaction">
                                                <option value="Charge">Charge</option>
                                                <option value="Refund">Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment1">Comment:</label>
                                            <textarea class="form-control" rows="5" id="comment1"></textarea>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">Notify Customer By Email</label>
                                        </div>
                                        <a href="#" class="btn btn-primary">Submit</a>

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
                                            <input type="text" class="form-control" id="shipping_address_1" placeholder="Address1 *" name="address_1" value="{{$order['basic'][0]->shipping_address_1}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_address_2" placeholder="Address2" name="address_2" value="{{$order['basic'][0]->shipping_address_2}}">
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
                                                <select class="form-control state_dropdown" name="shipping_state_dropdown" id="shipping_state_dropdown">
                                                    <option value="" selected>State</option>
                                                    @foreach($order['states'] as $st)
                                                    <option value="{{$st->name}}" @if($st->name==$order['basic'][0]->shipping_state) selected @endif>{{$st->name}}</option>
                                                    @endforeach

                                                </select>
                                                <input type="text" class="form-control normal-states hide" id="shipping_state" placeholder="State *" name="state">
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="country" id="shipping_country">
                                                    <option value="" selected> Select</option>
                                                    @foreach($order['countries'] as $cnt)
                                                    <option value="{{$cnt->country_name}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
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
                                                <input type="text" class="form-control" id="billing_address_1" placeholder="Address1 *" name="address_1" value="{{$order['basic'][0]->pay_address_1}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="billing_address_2" placeholder="Address2" name="address_2" value="{{$order['basic'][0]->pay_address_2}}">
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
                                                <select class="form-control state_dropdown" name="billing_state_dropdown" id="billing_state_dropdown">
                                                    <option value="" selected>State</option>
                                                    @foreach($order['states'] as $st)
                                                    <option value="{{$st->name}}" @if($st->name==$order['basic'][0]->pay_state) selected @endif>{{$st->name}}</option>
                                                    @endforeach

                                                </select>
                                                <input type="text" class="form-control normal-states hide" id="billing_state" placeholder="State *" name="state">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" name="country" id="billing_country">
                                                        <option value="" selected> Select</option>
                                                        @foreach($order['countries'] as $cnt)
                                                        <option value="{{$cnt->country_name}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
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
