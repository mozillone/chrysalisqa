<!DOCTYPE html>
<html>
<style type="text/css">
@media screen {
  @font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 400;
    src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
  }
  body {
    font-family: "Lato", "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
  }
  .left img{max-width:100%;}
 
</style>
<body style="margin:0; padding:0; box-sizing:border-box; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; font-size:14px;">
<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<?php $count=0;$subtotal_amount=0;$shipping_amount=0;$store_credits=0;$total=0;?>
    
@foreach($mail_order as $orders)
<table style="text-align:center;  padding:20px 40px 40px 40px; width:800px; margin:0px auto 0px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; background: url('https://image.ibb.co/kDBD5v/bg.png');    background-size: 100% 100%;">
<tr>
    <th style="color:#000; font-size:50px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;"><a href="{{URL::to('/')}}"><img class="img-responsive" src="{{asset('assets/frontend/img/brand.png')}}"  width="150px;"></a></th>
</tr>
<tr>
    <th style="color:#000; font-size:15px; padding:0px;"><h4 style="margin:20px auto 0px; display:block;">Hey, {{Auth::user()->first_name}}!</h4></th>
</tr>
<tr>
    <th style="color:#6a2b7c;"><h5 style="margin:0px auto 20px; padding:0px; font-size:22px; display:block;">Your order has been received.</h5></th>
</tr>
<tr>
    <td style="color:#000;"><p style="margin:0px auto 20px; padding:0px; font-size:16px; display:block;">The Seller <span style="text-decoration:underline; color:#f53d68;"> {{$orders['seller_name']}}</span> has been notified and we will update you as soon as they respond.<br/>You can view your order status and history at any time by visiting Your <a href="{{URL::to('/login')}}"style="text-decoration:underline; color:#f53d68;">Account.</a></p></td>
</tr>
<tr>
    <td style="color:#000;">
        <p style="margin:10px auto 0px; padding:0px; font-size:20px; font-weight:bold; display:block;">Your Order Number is:</p>
        <p class="pricetag" style="margin:0px auto 20px; padding:0px; font-size:30px; font-weight:bold; color:#f53d68; display:block;">{{$orders['order_id']}}</p>
    </td>
</tr>
</table>
<table style="text-align:center;  padding:40px; width:800px; margin:0px auto; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;">
    <thead>
    <tr>
        <th style="color:#61c4ab; font-size:18px;">Address</th>
        <th style="color:#61c4ab;  font-size:18px;">Payment Method</th>
        <th style="color:#61c4ab;  font-size:18px;">Date Ordered</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td valign="middle">{{$orders['address']['shipping_firstname']}} {{$orders['address']['shipping_lastname']}}<br/>{{$orders['address']['shipping_address_1']}}<br/>{{$orders['address']['shipping_address_2']}}<br/>{{$orders['address']['shipping_city']}}, {{$orders['address']['shipping_state']}} {{$orders['address']['shipping_postcode']}} US</td>
        <td valign="middle"><br/>{{$orders['card_details']->card_type}} ending in {{$orders['card_details']->last_digits}}</td>
        <td valign="middle">{{date('M d, Y')}}</td>
</tr>
        </tbody>
</table>

<table style="text-align:center;  padding:0px 10px; width:600px; margin:0px auto 40px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; box-shadow:0px 0px 10px #ccc; ">
    <thead>
    <tr style="padding:20px;">
        <th style="color:#61c4ab; font-size:20px; padding:20px;">Here's what's shipping soon:</th>
    </tr>
    </thead>
    <tbody style="padding:20px 10px;">
     <?php $subtotal_amount+=$orders['subtotal'];
           $shipping_amount+=$orders['shipping'];
           if(!empty($orders['store_credits'])){
            $store_credits=$orders['store_credits'];
           }
           if(!empty($orders['coupon_amount'])){
            $coupon_amount=$orders['coupon_amount'];
           }
     ?>
        @foreach($orders['items'] as $items)
        <?php $count++;?>
         <tr>
       
            <td style="border-top:1.5px solid #ccc; text-align:left;">
                <div class="shipping" style="background:#f6f9fb; padding:0px 10px; display: block;
margin: 20px 0px;">
                    <p style="padding: 8px 0px 0px;margin: 0px;">{{$orders['location_from']}}</p>
                    
                </div>
                <div class="main_shop" style="width:100%; float:left; padding-bottom:30px;">
                <div class="left" style="width:25%; float:left; margin-right:20px;">
                    <img class="img-responsive" style="max-width:100%;" src="{{asset('/costumers_images/Medium/'.$items["image"].'')}}
                    ">
                </div>
                <div class="right" style="width:70%; float:left;">
                    <h3 style="line-height:10px; padding: 0px;margin: 0px; width:100%; float:left;">{{$items['costume_name']}}</h3>
                    @if($items['is_film']=="Yes")<span class="fil_qualu" style="background:#ffd255; border-radius:10px;  padding:5px 10px 5px 30px; font-size:12px; margin:20px auto; display:inline-block;">Film Quality</span> @else <span class="fil_qualu" style="border-radius:10px;  padding:5px 10px 5px 30px; font-size:12px; margin:0px auto; display:inline-block;"></span> @endif
                    <div class="desc">
                        <p  style="padding: 0px 0px 3px;margin: 0px;"><b>Item Condition:</b> <span>@if($items['condition']=="brand_new") Brand New @elseif($items['condition']=="like_new") Like New @else {{ucfirst($items['condition'])}} @endif</span></p>
                        <p  style="padding: 0px  0px 3px;margin: 0px;"><b>Size:</b> <span>@if($items['size']=="s") small @elseif($items['size']=="m") medium @elseif($items['size']=="l") large @else {{strtoupper($items['size'])}} @endif</span></p>
                        <p  style="padding: 0px  0px 3px;margin: 0px;"><b>Shipping:</b> <span>{{$items['shipping']}}</span></p>
                    </div>
                    <div class="main_shop_price" style="color:#f53d68; font-size:20px; font-weight:bold; margin-top:50px;">$ {{number_format(($items['price']*$items['qty']), 2, '.', ',')}}
                </div>
                </div>
            </td>   
       </tr>
       @endforeach
        
       
</tbody>
</table>
@endforeach
<?php  $total=$subtotal_amount+$shipping_amount;
        if(!empty($store_credits)){
            $total=$total-$store_credits;
        }
         if(!empty($coupon_amount)){
            $total=$total-$coupon_amount;
        }
?>
<table style="border-top:4px solid #61c4ab; padding:0px 10px; width:600px; margin:0px auto 40px; font-family: 'Lato', 'LucidaGrande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; box-shadow:0px 0px 10px #ccc; ">
<tbody style="width:100%; float:left; font-size:15px;">
    <tr style="border-bottom:1px solid #ddd; padding:5px 0px; width:100%; float:left;">
        <th style="padding:5px 0px; font-size:13px;">Order Summary</th>
        <th style="padding:5px 0px;"></th>
    </tr>   
    <tr style="padding:5px 0px; width:100%; float:left;">
            <td style="width:80%; float:left;">Subtotal:<span style="width:100%; text-align:left; display:block;">({{$count}} items)</span></td>
            <td style="text-align:right; width:auto; float:right; font-weight:bold;">${{number_format($subtotal_amount, 2, '.', ',')}}</td>
        </tr>
        <tr style="padding:5px 0px; width:100%; float:left;">
            <td  style="width:80%; float:left;">Shipping to {{$orders['shipping_to']}}:<span style="width:100%; text-align:left; display:block;">(For all items)</span></td>
            <td  style="text-align:right;  width:auto; float:right; font-weight:bold;">${{number_format($shipping_amount, 2, '.', ',')}}</td>
        </tr>
        @if(!empty($store_credits))
         <tr style="padding:5px 0px; width:100%; float:left;">
            <td  style="width:80%; float:left;">Store Credit Applied:</td>
            <td style="color:#f53d68; text-align:right;  width:auto; float:right; font-weight:bold;">-${{number_format($store_credits, 2, '.', ',')}}</td>
        </tr> 
        @endif
         @if(!empty($coupon_amount))
         <tr style="padding:5px 0px; width:100%; float:left;">
            <td  style="width:80%; float:left;">Discount Amount:</td>
            <td style="color:#f53d68; text-align:right;  width:auto; float:right; font-weight:bold;">-${{number_format($coupon_amount, 2, '.', ',')}}</td>
        </tr> 
        @endif
    

        <tr style="border-top:1px solid #ddd; padding:10px 0px; margin:10px auto 0px; width:100%; float:left;">
            <td  style="width:80%; float:left;"><b>Total:</b></td>
            <td  style="text-align:right;  width:auto; float:right; font-weight:bold;">${{number_format($total, 2, '.', ',')}}</td>
         </tr>
    </tbody>
</table> 


<table style="margin:0 auto; font-size:13px; margin-bottom:30px;">
    <tr>
        <td>If you have any questions, do not hesitate to<a href="{{URL::to('/contact-support')}}"><span style="color:#f53d68; text-decoration:underline;">reach out!</span></a></td>
    </tr>
</table>
<table style="text-align:center;margin:0 auto; padding:15px 0px; font-size:13px; margin-bottom:0px; background:#f6f9fb; width:600px; border-bottom:1.5px solid #ddd;">
<tbody>
    <tr>
        <td><a style="padding:0px 10px" href="https://www.facebook.com/Chrysalis-Costumes-1571674966183606/"><img src="https://image.ibb.co/iPORQv/group_211.png" alt="group_211" border="0"></a>
        <a style="padding:0px 10px" href="https://imgbb.com/"><img src="https://image.ibb.co/jCEpdF/group_212.png" alt="group_212" border="0"></a>
        <a style="padding:0px 10px" href="https://www.instagram.com/chrysaliscostumes/?hl=en%2F"><img src="https://image.ibb.co/mGSWsa/group_214.png" alt="group_214" border="0"></a>
        <a  style="padding:0px 10px" href="https://imgbb.com/"><img src="https://image.ibb.co/kABfkv/group_233.png" alt="group_233" border="0"></a></td>
    </tr>   
</tbody>
</table>
<table style="text-align:center;margin:0 auto; padding:5px 0px; font-size:13px; margin-bottom:30px; background:#f6f9fb; width:600px;">
<tbody>
    <tr>
        <td>&copy; 2017 <span style="padding:0px 10px;">|</span> Chrysalis</td>
    </tr>   
</tbody>
</table>


</body>
</html>