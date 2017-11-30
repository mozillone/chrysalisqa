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
<table style="text-align:center;  padding:20px 40px 40px 40px; width:800px; margin:0px auto 0px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; background: url('https://image.ibb.co/kDBD5v/bg.png');    background-size: 100% 100%;">
<tbody style="background:url('https://image.ibb.co/ns2mQv/path_459.png') no-repeat center right;">
<tr>
    <th style="color:#000; font-size:50px; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;"><a href="{{URL::to('/')}}"><img class="img-responsive" src="{{asset('assets/frontend/img/brand.png')}}" width="150px;"></a></th>
</tr>
<tr>
    <th style="color:#000; font-size:15px; padding:0px;"><h4 style="margin:20px auto 0px;">Hey, {{ $order_info['seller_name']}}!</h4></th>
</tr>
<tr>
    <th style="color:#6a2b7c;"><h5 style="margin:0px auto 20px; padding:0px; font-size:22px;">You have a purchase request.</h5></th>
</tr>
<tr>
    <td style="color:#000;"><p style="margin:0px auto 20px; padding:0px; font-size:16px;"><span style="text-decoration:underline; color:#f53d68; font-style:italic;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span> would like to purchase your costume(s):</p></td>
</tr>
<tr>
    <td style="color:#000;">
     @foreach($order_info['items'] as $items)
        <h2 style="margin:0px auto 20px; padding:0px; font-size:25px; color:#f53d68; font-weight:bold; text-decoration:underline;">{{$items['costume_name']}}</h2>
    @endforeach
    </td>
</tr>
</tbody>
</table>

<table style="text-align:left;  padding:40px 40px 20px 40px; width:600px; margin:0px auto; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif; background:url('https://image.ibb.co/dqaUdF/group_224.png') no-repeat -10px 60px; backgrouns-size:50px">
    <tbody>
    <tr>
        <td><p style="margin-bottom:0px;"><b>Hi {{ $order_info['seller_name']}},</b></p></td>
</tr>
    <tr>
        <td><p  style="margin-bottom:0px;">To begin your sale, hit the button below that says "Accept". This will take you to a page that will allow you to print out your shipping label.</p></td>
</tr>
    <tr>
        <td><p  style="margin-bottom:0px;">As soon as you ship out your product, please head over to Your <a href="{{URL::to('/login')}}"><span style="color:#f53d68; text-decoration:underline">Account</span></a>  and mark your order as "shipped". You can find this under "Recent Orders".</p></td>
</tr>
    <tr>
        <td><p  style="margin-bottom:0px;">Should you find that your buyer is not the right fit for you,  simply hit the "Decline" button instead and we will take care of the rest for you.</p></td>
</tr>
<tr>
        <td valign="middle"><p  style="margin-bottom:0px;">Happy Selling!</p></td>
</tr>
<tr>
        <td valign="middle"><p  style="margin-bottom:0px;"><b>The Chrysalis Team</b></p></td>
</tr>
    
        </tbody>
</table>
<table style="text-align:center;  padding:20px 20px 40px 20px; width:500px; margin:0px auto; font-family: 'Lato', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, Sans-Serif;  border-top:1.5px solid #ddd;">
    <tr>
        <td style="border:2px solid #f53d68; font-weight:bold; width:50%;  padding:15px;color:#000; border-radius:5px; cursor:pointer;"><a href="{{ URL::to('/sold/order/'.$order_info['order_id']) }}" style="text-decoration: none; color:#000; border-radius:5px; cursor:pointer;">Decline</a></td>
        <td style="border:2px solid #f53d68; font-weight:bold; width:50%;  padding:15px; background:#f53d68; color:#fff; border-radius:5px; cursor:pointer;"><a href="{{ URL::to('/sold/order/'.$order_info['order_id']) }}" style="text-decoration: none; color:#fff; border-radius:5px; cursor:pointer;">Accept</a></td>
    </tr>
</table>



<table style="margin:0 auto; font-size:13px; margin-bottom:30px;">
    <tr>
        <td>If you have any questions, do not hesitate to <a href="{{URL::to('/contact-support')}}"><span style="color:#f53d68; text-decoration:underline;">reach out!</span></a></td>
    </tr>
</table>
<table style="text-align:center;margin:0 auto; padding:15px 0px; font-size:13px; margin-bottom:0px; background:#f6f9fb; width:600px; border-bottom:1.5px solid #ddd;">
<tbody>
    <tr>
        <td><a style="padding:0px 10px" href="https://twitter.com/MaxGarweg"><img src="{{asset('/assets/frontend/img/twitter_email.png')}}" alt="twitter" border="0"></a>
            <a style="padding:0px 10px" href="https://www.facebook.com/Chrysalis-Costumes-1571674966183606/"><img src="{{asset('/assets/frontend/img/facebook_email.png')}}" alt="facebook" border="0"></a>
            <a style="padding:0px 10px" href="https://www.instagram.com/chrysaliscostumes/?hl=en%2F"><img src="{{asset('/assets/frontend/img/insta_email.png')}}" alt="instagram" border="0"></a>
            <a style="padding:0px 10px" href="https://www.youtube.com/channel/UCZgeZrAV1UCoCXSWd75DNsw"><img src="{{asset('/assets/frontend/img/youtube_email.png')}}" alt="youtube" border="0"></a></td>
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