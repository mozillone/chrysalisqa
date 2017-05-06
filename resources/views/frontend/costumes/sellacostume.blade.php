@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="sell_page_total">
					<div class="see-page-headings">
						<h1>Selling Your Costume with Chrysalis is Easy!</h1>
						<p>Choose from the following options.</p>
						</div>
						<div class="row">
            <?php 

                  if (isset(Auth::user()->id) && !empty(Auth::user()->id)) { ?>
						<a href="{{URL::to('costume/createtwo')}}">
							<div class="col-md-6 col-sm-6 col-xs-12" >
								<div class="upload_castume-blog">
								<img class="img-responsive" src="../assets/frontend/img/upload-icon.png"/>
									<h2>Upload Your Costume!</h2>
									<p>Tell us why your costume is so<br> special? Sell it Yourself!</p>
									<span class="acnhr-link">UPLOAD MY COSTUME</span>
								</div>
								
							</div></a>
              <?php }  else{ ?>
              <a href="{{URL::to('login')}}">
              <div class="col-md-6 col-sm-6 col-xs-12" >
                <div class="upload_castume-blog">
                <img class="img-responsive" src="../assets/frontend/img/upload-icon.png"/>
                  <h2>Upload Your Costume!</h2>
                  <p>Tell us why your costume is so<br> special? Sell it Yourself!</p>
                  <span class="acnhr-link">UPLOAD MY COSTUME</span>
                </div>
                
              </div></a>
              <?php }?>
				<a href="{{URL::to('costume/request-a-bag')}}">
							<div class="col-md-6 col-sm-6 col-xs-12 ">
              
							<div class="Ship_castume-blog upload_castume-blog" >
								<img class="img-responsive" src="../assets/frontend/img/open-box-icon.png">
									<h2>Ship Us Your Costume!</h2>
									<p>Have a pile of old costumes taking <br>up space? Let us take care of it.</p>
									REQUEST A BAG
								</div>
              
							</div>
				</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-12 ">
					<div class="upload_acrdins see-page-headings">
						<h1>Not quite sure which one to do?</h1>
						<p>View our list of FAQ.</p>
					</div>
				</div>
				<div class="col-md-12 upload_page_accordians">
					 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="clps">
                       
                       01. Which option should I pick?
					 <span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-top"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                     This depends on your particular situation. If you have lots of used costumes to sell, requesting a bag is the least time intensive option. If you have a high quality costume worth $100 or more, uploading it yourself will get you the best payout. 
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed clps" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      
                        02. How do I get my items back?
						  <span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-bottom"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="clps" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      
                       03. What can I send?
					    <span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-bottom"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse clps" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
		<div class="panel panel-default">
           <div class="panel-heading" role="tab" id="headingFour">
               <h4 class="panel-title">
                   <a class="collapsed clps" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                     
                   04. How do I ship my bag?
					<span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-bottom"></i></span>
                   </a>
               </h4>
           </div>
           <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
               <div class="panel-body">
                   Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
               </div>
           </div>
       </div>
	


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