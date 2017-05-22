@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


<style>
#customer_edit1 .form-group.has-feedback {
    clear: left;
}
      </style>

 <script type="text/javascript">
  $( function() {
    $( "input#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
   </script>
   
   <script type="text/javascript">
   	$(function () { 
  
  //$("#txttime").val("8:00 AM"); //*** initial time here
  
  $('#datetimepicker1').datetimepicker({
    format: 'hh:mm A' //12 hour format
    //format: 'HH:mm'     //24 hour format
  });

  $('#datetimepicker1 .input-group-addon').mousedown(function(){
    if (!$.trim($('#txttime').val())) $('#txttime').val('08:00');
  });

  } );
   </script>
@stop


{{-- Page content --}}
@section('content')

<form>
<div>
	Event Information<hr>
	Event Name<br>
	<input type="text" name="eventName"><br>
	Event URL<br>
	<input type="text" name="eventUrl"><br>
	Event Image<br>
	<input type="file" name="eventImage" value="UploadImage">
	<table>
		<tr>
			<td>From Date</td>
			<td>From Time</td>
		</tr>
		<tr>
			<td><input type="text" name="date" id="datepicker"></td>
			<td>
			<div class="input-group date" id="datetimepicker1">
    <input type="text" class="form-control" placeholder="From Time" id="txttime" name="txttime" value="">
    <span class="input-group-addon" id="">
      <span class="glyphicon glyphicon-time"></span>
    </span>
  </div>
</div>
			</td>
		


		</tr>
		<tr>
			<td>To Date</td>
			<td>To Time</td>
		</tr>
		<tr>
			<td><input type="text" name="date" id="datepicker"></td>
			<td>
				<div class="input-group date" id="datetimepicker1">
    <input type="text" class="form-control" placeholder="To Time" id="txttime" name="txttime" value="">
    <span class="input-group-addon" id="">
      <span class="glyphicon glyphicon-time"></span>
    </span>
  </div>
</div>
			</td>
			
		</tr>
	</table>
	Event Description<br>
	<textarea rows="10" cols="30"></textarea><br>
	Event Tags<br>
	<input type="text" name="eventTags"><br>
</div>
<div>
	Event Address<hr>
	Location Name<br>
	<input type="text" name="locationName"><br>
	Address 1<br>
	<input type="text" name="address1"><br>
	Address 2<br>
	<input type="text" name="address2"><br>
	City<br>
	<input type="text" name="city"><br>
	State<br>
	<select>
		<option>Select</option>
		<option>State 1</option>
		<option>State 2</option>
		<option>State 3</option>
	</select><br>
	Zip Code<br>
	<input type="text" name="locationName"><br>
</div>
</form>
 
 
@stop