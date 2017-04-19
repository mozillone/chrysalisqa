$(function(){
	$(document).on('click','.add-cart',function(){
		var costume_id=$(this).attr('data-costume-id');
		var _token=$('input[name="_token"]').val();
	
		$.ajax({
			type: 'POST',
			url: '/addToCart',
			data: {costume_id:costume_id,_token:_token},
			success: function(response){

			}
			});	

	 });
	
})