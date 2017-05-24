<table bgcolor="FFFFFF" border="0" cellpadding="10" cellspacing="0" style="border:1px solid #E0E0E0; color: #3d3d3d;" width="650">
	<tbody>
		<tr>
			<td class="logo" style=" margin:0 auto;text-align:center"><a href="#"><img border="0" height="28" src="{{asset('assets/frontend/img/brand.png')}}" style="margin: 10px auto 0px; width: 206px; height: 28px;" width="206" /></a></span></td>
		</tr>
		<tr>
			<td>
			<p style=" border-top: 1px solid #ccc;">&nbsp;</p>
			</td>
		</tr>
		<!-- [middle starts here] -->
		<tr>
			<td style="padding: 10px 40px 20px;" valign="top">
			<h1 style="font-size:14px; font-weight:normal; line-height:22px; margin:0 0 20px 0;">Dear {{$transacrtion['user_name']}},<br />
			<font color="#000000" face="Times New Roman" size="3"><span style="font-weight: normal;">You have a new transaction.<br />
			Below are the details of your transaction.</span></font></h1>
			</td>
		</tr>
		<tr>
			<td style="padding: 10px 40px 20px;" valign="top">
			<h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Transaction Description</h1>

			<p style="font-size:14px; font-weight:normal;">Order#: <font color="#000000" face="Times New Roman"><span style="font-weight: normal;">{{$transacrtion['order_id']}}</span></font></p>
            <p style="font-size:14px; font-weight:normal;">Transaction #: <font color="#000000" face="Times New Roman"><span style="font-weight: normal;">{{$transacrtion['transaction_id']}</span></font></p>
			

			<p style="font-size:14px; font-weight:normal;">Amount : <font color="#000000" face="Times New Roman"><span style="font-weight: normal;"> {{$transacrtion['amount']}</span></font></p>

			<p style="font-size:14px; font-weight:normal;">Status : <font color="#000000" face="Times New Roman"><span style="font-weight: normal;">{{$transacrtion['status']}</font>/span></font></p>
			
			<p style="font-size:14px; font-weight:normal;">Comment : <font color="#000000" face="Times New Roman"><span style="font-weight: normal;">{{$transacrtion['comment']}</font>/span></font></p>

				<p style="font-size:14px; font-weight:normal;">If you have any questions about our different plans, feel free to contact us at <a href="#|DOMAIN|#/contact-us" target="_blank">contact@chrysalis.com</a></p>
			</td>
		</tr>
		
		<tr>
			<td style="padding: 0px 40px 20px;">
			<p style="font-size:12px; color: #a9a9a9; text-align: center;">This is an automated message. Please do not respond to this email.</p>
			</td>
		</tr>
		<tr>
			<td>
			<ul style="list-style: none; text-align: center; border-top: 1px solid #d9d9d9; padding-top: 10px; margin: 0px 0 10px; ">
			</ul>

			<p style="width: 100%; float:left; text-align: center; border-bottom: 1px solid #ccc; margin:0; padding-bottom: 10px; font-size: 12px; margin-bottom: 40px;">&copy; 2017 Chrysalis. All Rights Reserved |  USA</p>
			</td>
		</tr>
	</tbody>
</table>