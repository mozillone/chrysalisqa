@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/order_thanku.css')}}">
@endsection
@section('content')
 <div class="container">
		<div class="row">
		@if (Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
			<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
			{{ Session::get('error') }}
		</div>
        @elseif(Session::has('success'))
		<div class="alert alert-success alert-dismissable">
			<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
			{{ Session::get('success') }}
		</div>
		@endif
			<form action="{{route('order-charity-fund')}}" method="POST" id="order-charity">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="order_id" value="{{$order_id}}">
			<input type="hidden" name="amount" value="1">
					
			<div class="thankyou-rm">
				<div class="col-md-6">
				<h2 class="prog-head">Thank You For Your Purchase!</h2>
					<p class="thankyou-text thankyou-textR">Order No:{{$order_id}}</p>
					<p class="thankyou-text">Hang tight! You will receive an order confirmation with details of your purchase shortly!</p>

					<p class="thankyou-text">In the meantime, <br/>
					<span class="thankyou-bold">Share Your Purchase!</span></p>
					<ul class="thankyou-socio">
					<li><img src="../assets/frontend/img/thnk-fb.png" alt="thnk-fb" /></li>
					<li><img src="../assets/frontend/img/thnk-tw.png" alt="thnk-tw" /></li>
					<li><img src="../assets/frontend/img/thnk-yt.png" alt="thnk-yt" /></li>
					</ul>

				</div>

				<div class="col-md-6">
					<h2 class="prog-head">Did You know?</h2>
					<p class="thankyou-text">A portion of our profits goes to a charity of your choice. Please take a moment to select a cause you feel most passionate about. Should this field be left blank, we will choose a charity on your behalf.</p>

					<div>



					<ul class="ct3-list">
					@foreach($charities_list as $charities)
					<li>
						@if(file_exists(public_path('/charities_images/'.$charities->image)))
							<img src="/charities_images/{{$charities->image}}" alt="cst3" /><span class="crt-name">{{$charities->name}}</span><input type="radio" name="charity" id="charity" value="{{$charities->id}}"/></li>
						@else
							<img src="/charities_images/default-placeholder.jpg" alt="cst3" />{{$charities->name}}<input type="radio" name="charity" id="charity" value="{{$charities->id}}"/></li>
						@endif
					@endforeach
					</ul>
					<p class="cst2-rms-chck"><input type="checkbox"  id="suggest_charity" checked="checked"> I would like to suggest another charity organization</p>


					<div class="thankyou-rms">
					<p class="thankyou-rms-head thankyou-text"><span>Please Specify:</span>
					<input type="text" placeholder="Organization Name" name="suggest_charity" / ></p>
					</div>

					</div>
				</div>


				<div class="col-md-12">
					<div class="thankyou-doeven">
					<h2 class="thankyou-do">Do even MORE!</h2>
					<p class="thankyou-textC">Join us in our mission to see a dollar raised for every box shipped. <span class="thankyou-bold">Donate 0.50 cents below and we will match your donation!</span></p>
					<p class="thankyou-do-img"><img src="../assets/frontend/img/dollar.png" alt="dollar" /></p>

					<div class="thankyou-donate">Your Donation: <span>$0.25</span> <br/>
					Our Donation: <span>$0.25</span> <br/>
					Total Donation: <span>$0.50</span></div>
					<input type="submit" value="Submit" class="thankyou-btn"/>
					</div>
				</div>
				</form>

			</div>
	</div>	
</div>
       
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/order_thanku.js') }}"></script>
@stop
