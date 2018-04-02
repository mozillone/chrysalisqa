@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
  <style type="text/css">.cstm-alrt {
    padding: 15px;    margin-bottom: 30px;}
.alrt-div{clear: left;}
    </style>
 @endsection
 @section('content')
<div class="container speciality-themes">
    <h3>Specialty Themes!</h3>
    <div class="special-types">
        <div class="row">
            
            
            
                @foreach($cosplaycategories as $category)
               
                <div class="col-md-4 col-sm-12">
               
                <div class="special-caterories">
  <a href="#{{$category->name}}">
                    <?php 
                    if($category->image!="") { 
                    $cosplay_image = URL::asset('category_images/Normal/').'/'.$category->image;  
               } else { 
                 $cosplay_image = URL::asset('category_images/Normal/fff.png');   ?>
                <?php } ?>
                    <div class="special-caterories-bg-img"
                         style="background: url(<?php echo $cosplay_image; ?>)">
                    </div>
                    <?php $categoryid=$category->categoryid;
                    if($categoryid=="147") { ?>
                    <div class="bg-purple">
                        <h3>{{strtoupper($category->name)}}</h3>
                    </div>
                    <?php } 
                     if($categoryid=="78") { ?>
                    <div class="bg-liteblue">
                        <h3>{{strtoupper($category->name)}}</h3>
                    </div>
                    <?php }
                     if($categoryid=="143") { ?>
                    <div class="bg-yellow">
                        <h3>{{strtoupper($category->name)}}</h3>
                    </div>
                    <?php } ?>
   </a>
                </div>
        
            </div>
             
            @endforeach
            
          
        </div>
    </div>
  
    @foreach($cosplaycategories as $category)
    <div class="cosplay-sec" id="{{$category->name}}">
        <div class="row">
            <div class="col-md-12">
                <?php $categoryid=$category->categoryid;
                  if($categoryid=="147") { ?>

                <div class="progressbar_main purple-border request-bag">
                    <h2>{{strtoupper($category->name)}}</h2>
                </div>
                <?php } 
                 if($categoryid=="78") { ?>

                <div class="progressbar_main liteblue-border request-bag">
                    <h2>{{strtoupper($category->name)}}</h2>
                </div>
                <?php } 
                 if($categoryid=="143") { ?>

               <div class="progressbar_main yellow-border request-bag">
                    <h2>{{strtoupper($category->name)}}</h2>
                </div>
                <?php } 
                ?>

            </div>
        </div>
        <?php  if($categoryid=="147") { ?>
        <div class="row">
            <?php $count=count($cosplay_subcategories);
            if($count > 0){ ?>
            @foreach($cosplay_subcategories as $cosplay_category)

                    <?php 
                    if($cosplay_category->image!="") { 
                    $image = URL::asset('category_images/Normal/').'/'.$cosplay_category->image; 
               } else { 
                 $image = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                    <a href="/{{$cosplay_category->type}}{{$cosplay_category->urlkey}}">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/{{$cosplay_category->type}}{{$cosplay_category->urlkey}}">{{$cosplay_category->name}}</a></h4>
                    </div>

                </div>
            </div>
            @endforeach
            
        </div>
        <?php }   else { ?>
        <div class="col-md-12 text-center">No Results Found</div>
        <?php }  }?>
          <?php  if($categoryid=="78") { ?>
          <div class="row">
             <?php $count=count($filmtheatrecategories);
            if($count > 0){ ?>
              @foreach($filmtheatrecategories as $film_theatre)
              <?php 
                    if($film_theatre->image!="") { 


                    $image_film = URL::asset('category_images/Normal/').'/'.$film_theatre->image; 
               } else { 
                 $image_film = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
             
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                   <a href="/{{$film_theatre->type}}{{$film_theatre->urlkey}}">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image_film; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/{{$film_theatre->type}}{{$film_theatre->urlkey}}">{{$film_theatre->name}}</a></h4>
                    </div>

                </div>
            </div>
            @endforeach
            
        </div>
           
          <?php }   else { ?>
           <div class="col-md-12 text-center">No Results Found</div>
          <?php }  } ?>
          <?php  if($categoryid=="143") { ?>
          <div class="row">
             <?php $count=count($uniquefashion_categories);
            if($count > 0){ ?>
             @foreach($uniquefashion_categories as $unique_fashion)
             <?php 
                 if($unique_fashion->image!="") { 
                 $image_unique = URL::asset('category_images/Normal/').'/'.$unique_fashion->image;  
               } else { 
                 $image_unique = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                     <a href="/{{$unique_fashion->type}}{{$unique_fashion->urlkey}}">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image_unique; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/{{$unique_fashion->type}}{{$unique_fashion->urlkey}}">{{$unique_fashion->name}}</a></h4>
                    </div>

                </div>
            </div>
            @endforeach
            
        </div>
           
          <?php } else { ?>
              <div class="col-md-12 text-center">No Results Found</div>
          <?php } } ?>
    </div>
    @endforeach
   
    
         
    </div>


</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
/* $("#nav a").click(function(e){
    e.preventDefault();
    $(".toggle").hide();
    var toShow = $(this).attr('href');
    $(toShow).show();
});
$(document).ready(function()
{
 $(document).on('click','.nxt',function() {
 $("html, body").animate({ scrollTop: 0 }, "slow");
 return false;
});
} */
</script>
<script>
	//$(document).ready(function(){
  // Add smooth scrolling to all links
  //$(".special-caterories a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    //if (this.hash !== "") {
      // Prevent default anchor click behavior
      //event.preventDefault();

      // Store hash
     // var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
     // $('html, body').animate({
        //scrollTop: $(hash).offset().top
     // }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
      //  window.location.hash = hash;
      //});
    //} // End if
  //});
//});
</script>

@stop