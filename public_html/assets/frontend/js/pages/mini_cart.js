$(function(){
	$(document).on('click','.add-cart',function(){
		var costume_id=$(this).attr('data-costume-id');
		var _token=$('input[name="_token"]').val();
		 // Lobibox.notify('error', {
   //                  size: 'mini',
   //                  title: 'Lorem ipsum',
   //                  msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
   //              }); 
		$.ajax({
			type: 'POST',
			url: '/addToCart',
			data: {costume_id:costume_id,_token:_token},
			success: function(response){
				if(response=="out of stock"){
					Lobibox.notify('error', {
                    size: 'mini',
                    title: 'Out Of Stock',
                    msg: 'This is costume is Out of Stock '
                });
				}
			
			}
			});	

	 });
	
})