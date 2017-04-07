$(document).on('click','.fav_costume',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'POST',
      url: '/costume/favourite',
      data: {costume_id:costume_id,_token:token},
      context: this,
      success: function(response){
        if(response.is_user_fav){
          $(this).find('span').addClass('active');
          $(this).find('span').html('<i aria-hidden=true class="fa fa-heart"></i>');
          //ohSnap('Costume is successfully added into your wishlist', 'green');
        }else{
          $(this).find('span').removeClass('active');
          $(this).find('span').html('<i aria-hidden=true class="fa fa-heart-o"></i>');
          //ohSnap('Costume is removed successfully from your wishlist', 'red');
        }
        
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})