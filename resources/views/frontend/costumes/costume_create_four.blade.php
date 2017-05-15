@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chrysalis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css links Start -->
<link href="css/styles.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Karla|Lato:300,400,700,900|Open+Sans:300,400,600,700" rel="stylesheet">
	
<!-- Script links Start -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</head>
<body>


<div class="container">
<div class="row">
<div class="col-md-12">
<!--- progressbar section starts -->
<div class="progressbar_main">
<h2>UPLOAD A COSTUME</h2>
<ul id="progressbar" class="progressbar_rm">  
	 <li class="active"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
	 <li class="active"><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
     <li class="active"><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
     <li class="active"><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
     </ul>
</div>	

	 
<!--- progressbar section End -->

<p class="prog-txt">Lorem Ipsum is simply dummy text of <span>the printing and typesetting</span> industry.</p>
<h2 class="prog-head">Review Your Preferences</h2>
</div>	

<div class="prog-form-rm">
<div class="col-md-6">

<div class="form-rms">
<p class="form-rms-que">01. Item Location</p>
<p class="form-rms-input"><input type="text"></p>
</div>

<div class="form-rms">
<p class="form-rms-que">02. Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
<p class="form-rms-input">
<select name="handlingtime" id="handlingtime">
<option value="">Select Handling Time</option>
@foreach($handlingtime as $index=>$handlingtime)
<option value="{{$handlingtime->optionid}}">{{$handlingtime->value}}</option>
@endforeach
</select>
</p>
</div>


<div class="form-rms">
<p class="form-rms-que">03. Return Policy</p>
<p class="form-rms-input">
<select name="returnpolicy" id="returnpolicy" >
<option value="">Select Return Policy</option>
@foreach($returnpolicy as $index=>$returnpolicy)
<option value="{{$returnpolicy->optionid}}">{{$returnpolicy->value}}</option>
@endforeach
</select>
</p>
</div>

</div>

<div class="col-md-6">
<div class="form-rms column-align">
<p class="form-rms-que form-rms-que1">04. Donate a Portion to Charity</p>
<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However,if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
<p class="ct3-rms-text">By Choosing to donate,I agree and accept Chrysalis Terms & Conditions.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1"><select class="cst2-select80"><option>10%</option><option>20%</option><option>30%</option></select></p>
<p class="cst3-textl2"><i class="fa fa-usd" aria-hidden="true"></i>5.90</p></div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
@foreach($charities as $index=>$charity)
<li><img src="images/cst3.png" alt="{{$charity->name}}" /><input type="radio" name="{{$charity->name}}" /></li>
@endforeach
</ul>
<p class="cst2-rms-chck"><input type="checkbox"> I would like to suggest another charity organization</p>
</div>

<div class="form-rms">
<p class="ct3-rms-head">Please Specify:</p>
<p class="form-rms-input"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"></p>
</div>





<div class="form-rms-btn">
<button type="button" class="btn-rm-nxt">I'm Finished!</button>
<button type="button" class="btn-rm-back"><span>Back</span></button>
</div>
</div>
</div>

</div>	
</div>	
	
	</body>
</html>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jPages.js') }}"></script>


	
@stop