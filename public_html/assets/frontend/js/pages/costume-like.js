$(document).on('click','.like_costume',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'POST',
      url: '/costume/like',
      data: {costume_id:costume_id,_token:token},
      context: this,
      success: function(response){
        if(response.is_user_like=="1"){
          $(this).find('span').addClass('active');
        }else{
          $(this).find('span').removeClass('active');
        }
<<<<<<< HEAD
        $(this).find('span').html('<i aria-hidden="true" class="fa fa-thumbs-o-up"></i>'+response.count);
=======
        $(this).find('span').html('<i aria-hidden="true" class="fa fa-thumbs-up"></i>'+response.count);
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
        if(response.is_user_like=="1"){
          $('.like-span1').addClass('active');
        }else{
           $('.like-span1').removeClass('active');
        }
<<<<<<< HEAD
         $('.like-span1').html('<i aria-hidden="true" class="fa fa-thumbs-o-up"></i> '+response.count);
=======
         $('.like-span1').html('<i aria-hidden="true" class="fa fa-thumbs-up"></i> '+response.count);
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})

