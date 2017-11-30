@extends('/frontend/email_main')
@section('content')

<table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
				<tbody>
					<tr>
						<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-size:16px;line-height:24px;background-color:#fff;">
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi {{$name}},<br />
						</h1>

						<div>You have created a costume named as <strong>{{$costume_name}}</strong></div>
						</td>
					</tr>
				</tbody>
			</table> 

@endsection