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
						<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi {{$data['username']}},<br />
						Greetings.</h1>
						<p>Ticket ID {{$data['ticket_id']}} has been assigned to you.</p>
						<p>The Below Are The Details</p>
						<?php
						$status=$data['ticket_status'];
						switch($status){
							case 1:
							$status_res="opened";
							break;
							case 0:
							$status_res="pending";
							break;
							case 2:
							$status_res="closed";
							break;
						}
						?>
						<p>Status : <?php echo $status_res; ?></p>
						<?php
						$priority=$data['ticket_priority'];
						switch($priority){
							case 1:
							$priotity_res="Major";
							break;
							case 2:
							$priotity_res="Minor";
							break;
						}
						?>
						<p>OrderId: {{$data['order_id']}}</p>
						<p>Priority: <?php echo $priotity_res; ?></p>
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
