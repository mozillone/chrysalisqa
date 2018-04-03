<!DOCTYPE html>
<html>
<head>
	<title>Activation Email</title>
</head>
<body>
<table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
	<tbody>
		<tr>
			<td colspan="4" style="border-collapse:collapse;border:0;margin:0;padding:0;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:26px;background-color:#fff;border-bottom:1px solid #fff" valign="top">
	<h1 style="margin:10px 35px;color:#333;font-size:25px;font-weight:normal"><span class="sg-image"><img  src="{{asset('assets/frontend/img/brand.png')}}" style="width: 206px;" /></span></h1>
			<a style="text-decoration:none!important"> </a></td>
		</tr>
		<tr>
			<td style="border-collapse:collapse;border:0;margin:0;border: 2px solid #e0e0e0 !important;padding:20px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:26px;vertical-align:top;background-color:#eeeeee;" valign="top">
			<table style="width:100%;font-weight:normal;border-collapse:collapse;border:0;margin:0;padding:0;font-familfffffl,sans-serif;margin-top:0">
				<tbody>
					<tr>
						<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#eeeeee;">
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi {{$order['basic'][0]->buyer_name}},<br />
						</h1>

						<div>
							Your order #{{$order['basic'][0]->order_id}} status({{$order['basic'][0]->status}}) changed to {{$order['status']}}
							<p>Comment: {{ $order['comment'] }}</p>

						</div>
						</td>
					</tr>
				</tbody>
			</table>

			<table style="width:100%">
				<tbody>
					<tr>
						<td style="width:100%;border-collapse:collapse;border:0;margin:0;padding:0 18px;color:#555559;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#eeeeee">&nbsp;</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
