<!DOCTYPE html>
<html>
<head>
	<title>Forgot password</title>
</head>
<body>
<table style="font-weight:normal;border-collapse:collapse;border:0;margin:0;padding:0;font-family:Arial,sans-serif;width:100%">
	<tbody>
		<tr>
			<td colspan="4" style="border-collapse:collapse;border:0;margin:0;padding:0;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:26px;background-color:#fff;border-bottom:1px solid #fff" valign="top">
			<h1 style="margin:10px 35px;color:#333;font-size:25px;font-weight:normal"><img src="{{asset('assets/frontend/img/brand.png')}}" style="width: 206px;" /></span></h1>
			<a style="text-decoration:none!important"> </a></td>
		</tr>
		<tr>
			<td style="border-collapse:collapse;border:0;margin:0;border: 2px solid #e0e0e0 !important;padding:20px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:26px;vertical-align:top;background-color:#eeeeee;" valign="top">
			<table style="width:100%;font-weight:normal;border-collapse:collapse;border:0;margin:0;padding:0;font-familfffffl,sans-serif;margin-top:0">
				<tbody>
					<tr>
						<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#eeeeee;">
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi {{$data['name']}},<br />
						Welcome to Chrysalis .</h1>

						<p style="font-size:16px;color:#333;font-weight:normal;line-height:20px;margin-bottom:20px">Please click the link below to access your Chrysalis account.</p>
						</td>
					</tr>
				</tbody>
			</table>

			<table style="width:100%">
				<tbody>
					<tr>
						<td style="width:100%;border-collapse:collapse;border:0;margin:0;padding:0 18px;color:#555559;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#eeeeee"><a href="{{$data['activation_link']}}" style="background-color: #35bbed;
    border-radius: 3px;
    text-decoration: none;
    font-weight: bold;
    font-weight: normal;
    font-size: 16px;
    padding: 10px 10px;
    color: #fff;" target="_blank">Activate</a></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
