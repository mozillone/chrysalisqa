@extends('/frontend/email_main')
@section('content')
<table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
	<tbody>
		<tr>
			<td style="border-collapse:collapse;border:0;margin:0;border: 2px solid #e0e0e0 !important;padding:20px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:26px;vertical-align:top;background-color:#eeeeee;" valign="top">
			<table style="width:100%;font-weight:normal;border-collapse:collapse;border:0;margin:0;padding:0;font-familfffffl,sans-serif;margin-top:0">
				<tbody>
					<tr>
						<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#eeeeee;">
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi Admin,<br />
						Greetings.</h1>
						<p>{{$data['fullname']}} Applied For a JOb</p>
						<p>The Below Are The Details</p>
						<p>Full Name : {{$data['fullname']}} </p>
						<p>Email : {{$data['email']}} </p>
						<p>Mobile Number : {{$data['phone']}} </p>
						<p>Linked In Url : {{$data['linkedin_url']}} </p>
						<p>Website  : {{$data['website']}} </p>
						<p>Portfolio Link : {{$data['portfolio_link']}} </p>
						
						
						<div></div>
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
@endsection
