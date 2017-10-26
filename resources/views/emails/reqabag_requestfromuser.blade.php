@extends('/frontend/email_main')
@section('content')

<table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
	<tbody>
		<tr>
			<td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#fff;">

				<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Dear @if(isset($username) && !empty($username)) {{$username}} @else Admin @endif,<br />
				</h1>
			
				@if(isset($bag_url) && !empty($bag_url))
	        		<div>You have received request a bag from {{ $cus_name }}. <a href="{{url('/')}}{{ $bag_url }}" target="_blank">Click here</a> to view.</div>
	        	@else
	        		<div>Your bag is on the way!</div>
	        	@endif
			
			</td>
		</tr>
	</tbody>
</table> 

@endsection