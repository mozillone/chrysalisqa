$(function(){
	 $(document).on('click', '.delete', function(){ 
      var item_id=$(this).attr('data-item-id');
      var cart_id=$(this).attr('data-cart_id');
      swal({   
              title: "Are you sure want to remove this costume from your cart?",   
                        text: "You will not be able to recover this costume",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/cart/delete/"+item_id+"/"+cart_id;
                      }); 
         
    });
<<<<<<< HEAD
    var sub_total=$('.sub-p').attr('data-subtotal');
   $(document).on('click','.credits-apply',function(){
      var credits=$('.store-p').text();
      if(sub_total>=parseFloat(credits)){
      var _token=$('input[name="_token"]').val();  
         $.ajax({
      type: 'POST',
      url: '/store_credits/update',
      context: this,
      data: {credits:credits,_token:_token},
      success: function(response){
        if(response.result=="1"){
           $('.store_price').addClass('strike-price');
        var total_price=sub_total-parseFloat(credits);
        $('.total-price').html(total_price.toFixed(2));
        $(this).html('Remove Credit');
        $(this).removeClass('credits-apply');
        $(this).addClass('remove-apply');
        $('.store-credits').html($('.store-p').text());
        var store_credits=$('.store-credits').text();
         }else{
          $('.credits-error').html(response.msg);
         }
      }
      });
      }else{
         $('.credits-error').html("Your store credit exceeds cart amount");
      }

   });
    $(document).on('click','.remove-apply',function(){
     var credits="0.00";
      var _token=$('input[name="_token"]').val();  
         $.ajax({
      type: 'POST',
      url: '/store_credits/update',
      context: this,
      data: {credits:credits,_token:_token},
      success: function(response){
          $('.store_price').addClass('strike-price');
          $('.store_price').removeClass('strike-price');
          $(this).html('Apply Credit');
          $(this).removeClass('remove-apply');
          $(this).addClass('credits-apply');
          $('.store-credits').html('0.00');
          var store_credits=$('.store-credits').text();
          var total_price=parseFloat(sub_total)+parseFloat(store_credits);
          $('.total-price').html(total_price.toFixed(2));
      }
      });
      
      // $('.store_price').addClass('strike-price');
      // $('.store_price').removeClass('strike-price');
      // $(this).html('Apply Credit');
      // $(this).removeClass('remove-apply');
      // $(this).addClass('credits-apply');
      // $('.store-credits').html('0.00');
      // var store_credits=$('.store-credits').text();
      // var total_price=parseFloat(sub_total)+parseFloat(store_credits);
      // $('.total-price').html(total_price.toFixed(2));
   });
	$(document).on('click','.edit-store-credits',function(){
    var credits=$('.store-p').attr('data-max-credits');
    $(this).html('<i class="fa fa-floppy-o" aria-hidden="true"></i>');
    $(this).addClass('save_credits');
    $('.save_credits').attr('data-original-title',"Save");
    $('.credits-apply').attr('disabled',true);
   // $('.credits-apply').removeClass('credits-apply');
    $(this).removeClass('edit-store-credits');
    $('.store-p').html('<input type="text" value='+credits+' class="store_credits col-md-10 pull-right"/>');
   $('.credits-error').html("Note: Your store credit is $"+credits+" and you cannot add more than your credit");
    
  })
  $(document).on('click','.save_credits',function(){
     $('.credits-error').html('');
   var credits=$('.store_credits').val();
   var _token=$('input[name="_token"]').val();
    $.ajax({
      type: 'POST',
      url: '/store_credits/update',
      context: this,
      data: {credits:credits,_token:_token},
      success: function(response){
        if(response.result=="1"){
           $(this).html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
           $(this).addClass('edit-store-credits');
           $('.edit-store-credits').attr('data-original-title',"Edit");
           $('.store-p').html(parseFloat(credits).toFixed(2));
           if($('.cpn').hasClass('remove-apply')){
             var total_price=sub_total-parseFloat(credits);
             $('.store-credits').html($('.store-p').text());
             $('.total-price').html(total_price.toFixed(2));
           }
           $(this).removeClass('save_credits');
           $(this).next().addClass('credits-apply');
           $('.credits-apply').attr('disabled',false);
         }else{
          $('.credits-error').html(response.msg);
         }
      }
      });
  })
  $('coupan_submit')
    $("#coupan_submit").validate();
  $("#coupan").rules("add", {required:true,minlength:1,maxlength:100});
=======
	
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
})