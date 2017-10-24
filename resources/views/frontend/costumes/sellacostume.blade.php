@extends('/frontend/app')
@section('styles')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
@endsection
@section('content')
<div class="container">
	<?php echo $pageData->description ?>
	<div class="row">
		<div class="col-md-12 upload_page_accordians">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				@if(count($faqs))
				<?php $counter = 0; ?>
				@foreach($faqs as $faq)
				<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne-{{$faq->id}}">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-{{$faq->id}}" <?php echo (($counter == 0) ? "aria-expanded='true'" : "aria-expanded='false'") ?> aria-controls="collapseOne{{$faq->id}}" class="clps">
									{{ $faq->title }}
									<span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-bottom"></i></span>
								</a>
							</h4>
						</div>
					<div id="collapseOne-{{$faq->id}}" class="panel-collapse collapse @if($counter==0) @endif" role="tabpanel" aria-labelledby="headingOne-{{$faq->id}}">
						<div class="panel-body">
							{{ $faq->description }}
						</div>
					</div>
				</div>
				<?php $counter++; ?>
				@endforeach
				@else
				<div>No Results Found</div>
				@endif
			</div><!-- panel-group -->
		</div>
	</div>
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
	});
    function toggleIcon(e) {
        $(e.target)
		.prev('.panel-heading')
		.find(".more-less")
		.toggleClass('glyphicon-triangle-bottom glyphicon-triangle-top');
	}
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
@stop