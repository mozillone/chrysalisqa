<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
  <style type="text/css">.cstm-alrt {
    padding: 15px;    margin-bottom: 30px;}
.alrt-div{clear: left;}
    </style>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('content'); ?>
<div class="container speciality-themes">
    <h3>Specialty Themes!</h3>
    <div class="special-types">
        <div class="row">
            
            
            
                <?php $__currentLoopData = $cosplaycategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
               
                <div class="col-md-4 col-sm-12">
               
                <div class="special-caterories">
  <a href="#<?php echo e($category->name); ?>">
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
                        <h3><?php echo e(strtoupper($category->name)); ?></h3>
                    </div>
                    <?php } 
                     if($categoryid=="78") { ?>
                    <div class="bg-liteblue">
                        <h3><?php echo e(strtoupper($category->name)); ?></h3>
                    </div>
                    <?php }
                     if($categoryid=="143") { ?>
                    <div class="bg-yellow">
                        <h3><?php echo e(strtoupper($category->name)); ?></h3>
                    </div>
                    <?php } ?>
   </a>
                </div>
        
            </div>
             
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            
          
        </div>
    </div>
  
    <?php $__currentLoopData = $cosplaycategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <div class="cosplay-sec" id="<?php echo e($category->name); ?>">
        <div class="row">
            <div class="col-md-12">
                <?php $categoryid=$category->categoryid;
                  if($categoryid=="147") { ?>

                <div class="progressbar_main purple-border request-bag">
                    <h2><?php echo e(strtoupper($category->name)); ?></h2>
                </div>
                <?php } 
                 if($categoryid=="78") { ?>

                <div class="progressbar_main liteblue-border request-bag">
                    <h2><?php echo e(strtoupper($category->name)); ?></h2>
                </div>
                <?php } 
                 if($categoryid=="143") { ?>

               <div class="progressbar_main yellow-border request-bag">
                    <h2><?php echo e(strtoupper($category->name)); ?></h2>
                </div>
                <?php } 
                ?>

            </div>
        </div>
        <?php  if($categoryid=="147") { ?>
        <div class="row">
            <?php $count=count($cosplay_subcategories);
            if($count > 0){ ?>
            <?php $__currentLoopData = $cosplay_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cosplay_category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                    <?php 
                    if($cosplay_category->image!="") { 
                    $image = URL::asset('category_images/Normal/').'/'.$cosplay_category->image; 
               } else { 
                 $image = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                    <a href="/<?php echo e($cosplay_category->type); ?><?php echo e($cosplay_category->urlkey); ?>">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/<?php echo e($cosplay_category->type); ?><?php echo e($cosplay_category->urlkey); ?>"><?php echo e($cosplay_category->name); ?></a></h4>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            
        </div>
        <?php }   else { ?>
        <div class="col-md-12 text-center">No Results Found</div>
        <?php }  }?>
          <?php  if($categoryid=="78") { ?>
          <div class="row">
             <?php $count=count($filmtheatrecategories);
            if($count > 0){ ?>
              <?php $__currentLoopData = $filmtheatrecategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $film_theatre): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <?php 
                    if($film_theatre->image!="") { 


                    $image_film = URL::asset('category_images/Normal/').'/'.$film_theatre->image; 
               } else { 
                 $image_film = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
             
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                   <a href="/<?php echo e($film_theatre->type); ?><?php echo e($film_theatre->urlkey); ?>">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image_film; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/<?php echo e($film_theatre->type); ?><?php echo e($film_theatre->urlkey); ?>"><?php echo e($film_theatre->name); ?></a></h4>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            
        </div>
           
          <?php }   else { ?>
           <div class="col-md-12 text-center">No Results Found</div>
          <?php }  } ?>
          <?php  if($categoryid=="143") { ?>
          <div class="row">
             <?php $count=count($filmtheatrecategories);
            if($count > 0){ ?>
             <?php $__currentLoopData = $uniquefashion_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unique_fashion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
             <?php 
                 if($unique_fashion->image!="") { 
                 $image_unique = URL::asset('category_images/Normal/').'/'.$unique_fashion->image;  
               } else { 
                 $image_unique = URL::asset('category_images/Normal/small.png');   ?>
                <?php } ?>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="cosplay-type">
                     <a href="/<?php echo e($unique_fashion->type); ?><?php echo e($unique_fashion->urlkey); ?>">
                    <div class="cosplay-bg-img" style="background: url(<?php echo $image_unique; ?>)">

                    </div>
                </a>
                    <div class="speciality-label">
                        <h4><a href="/<?php echo e($unique_fashion->type); ?><?php echo e($unique_fashion->urlkey); ?>"><?php echo e($unique_fashion->name); ?></a></h4>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            
        </div>
           
          <?php } else { ?>
              <div class="col-md-12 text-center">No Results Found</div>
          <?php } } ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
   
    
         
    </div>


</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>