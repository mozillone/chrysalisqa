$(document).on('click','.like_costume',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'POST',
      url: '/costume/like',
      data: {costume_id:costume_id,_token:token},
      context: this,
      success: function(response){
        if(response.is_user_like){
          $(this).find('span').addClass('active');
        }else{
          $(this).find('span').removeClass('active');
        }
        $(this).find('span').html('<i aria-hidden="true" class="fa fa-thumbs-up"></i>'+response.count);
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})


$(document).on('click','.like_costume_view',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'POST',
      url: '/costume/like',
      data: {costume_id:costume_id,_token:token},
      context: this,
      success: function(response){
        if(response.is_user_like){
          $('.like-span1').addClass('active');
        }else{
           $('.like-span1').removeClass('active');
        }
         $('.like-span1').html('<i aria-hidden="true" class="fa fa-thumbs-up"></i> '+response.count);
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})

