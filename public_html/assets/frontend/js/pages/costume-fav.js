$(document).on('click','.fav_costume',function(){
  var costume_id=$(this).attr('data-costume-id');
  var token=$('input[name="_token"]').val();
  $.ajax({
      type: 'POST',
      url: '/costume/favourite',
      data: {costume_id:costume_id,_token:token},
      context: this,
      success: function(response){
        console.log(response);
       if(response.is_user_fav=="1"){
          $(this).find('span').addClass('active');
          $(this).find('span').html('<i aria-hidden=true class="fa fa-heart"></i>');
          Lobibox.notify.closeAll();
          Lobibox.notify('success', {
                    size: 'mini',
                    title: 'Added To favorites',
                    msg: 'This costume is added to your favorites list ',
                });
        }else{
          $(this).find('span').removeClass('active');
          $(this).find('span').html('<i aria-hidden=true class="fa fa-heart-o"></i>');
          //ohSnap('Costume is removed successfully from your wishlist', 'red');
            Lobibox.notify('success', {
                    size: 'mini',
                    title: 'Removed from favorites',
                    msg: 'This costume is removed from your favorites list ',
                });
        }
        $('.fav_count').html(response.fav_count);
        
      },
         complete: function(jqXHR, textStatus) {
           $("#itemContainer").removeClass("search_icn_load");
          },

    });
})


 $(document).on('click', '.delete', function(){ 
      var id=$(this).attr('data-costume-id');
      swal({   
              title: "Are you sure want to remove this costume from your favorites?",   
                        text: "You will not be able to recover this costume",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/remove/wishlist/"+id;
                      }); 
         
    });