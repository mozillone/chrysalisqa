$(function(){
	$(document).on('click','.add-cart',function(){
		var costume_id=$(this).attr('data-costume-id');
		var _token=$('input[name="_token"]').val();
			$.ajax({
			type: 'POST',
			url: '/addToCart',
			data: {costume_id:costume_id,_token:_token},
			success: function(response){
				if(response=="out of stock"){
					Lobibox.notify.closeAll();
					Lobibox.notify('error', {
                    size: 'mini',
                    title: 'Out Of Stock',
                    msg: 'This is costume is Out of Stock ',
                });

				}else{
					Lobibox.notify.closeAll();
					Lobibox.notify('success', {
                    size: 'mini',
                    title: 'Add To Cart',
                    msg: 'This is costume is added to cart',
              	  });

					$('span.mini_cart').html(response);
				}
			
			}
			});	

	 });
	
})