@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert">&times;</button>	
	Please check the form below for errors
</div>
@endif @if ($message = Session::get('success'))
<div class="alert alert-success alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('error'))
<div class="alert alert-danger alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif @if ($message = Session::get('info'))
<div class="alert alert-info alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	@if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
	@else {{ $message }} @endif
</div>
@endif
