@extends('/frontend/app')
@section('styles')
@endsection
@section('content')
 	<section class="content create_section_page" ng-controller="ListingsController">
     <div class="container">
    	<div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
	        	<h1>Dashboard</h1>
	        </div>
        </div>
     </div>
   </section>    
       
@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop
