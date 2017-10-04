@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
<div id="your_bag_on_itsway" >
	<div class="container">
		<div class="row">
		     <div class= "col-md-12">
                <div class="progressbar_main request-bag">
                    <h2>REQUEST A BAG</h2><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-md-12 request-success">
                <img src="{{URL::asset('assets/frontend/img/bag-sucess.png')}}">
<<<<<<< HEAD
                <h4>Hang in There!</h4>
=======
                <h4>Hand in There!</h4>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                <p>Your bag is on it's way</p>
                <a type="button" id="average_payouts_next" href="{{URL::to('/')}}" class="btn-rm-nxt nxt">Browse Costumes</a>
			</div>
		</div>
	</div>
</div>
	</section>
		@stop
{{-- page level scripts --}}
@section('footer_scripts')

@stop