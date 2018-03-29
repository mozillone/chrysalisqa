$(document).on('click','.like_costume',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'GET',
      url: '/costume/like/'+costume_id,
      context: this,
      success: function(response){
        if(response.is_user_like=="1"){
          $(this).find('span').addClass('active');
        }else{
          $(this).find('span').removeClass('active');
        }
        $(this).find('span').html('<i aria-hidden="true" class="fa fa-thumbs-o-up"></i>'+response.count);
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
      type: 'GET',
      url: '/costume/like/'+costume_id,
      context: this,
      success: function(response){
        if(response.is_user_like=="1"){
          $('.like-span1').addClass('active');
        }else{
           $('.like-span1').removeClass('active');
        }
         $('.like-span1').html('<i aria-hidden="true" class="fa fa-thumbs-o-up"></i> '+response.count);
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})

