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
	
})