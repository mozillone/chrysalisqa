$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#talkSendMessage').on('submit', function(e) {
<<<<<<< HEAD
        //$('#talkSendMessage').append("<img id='ajax_loader' src='{{asset('img/ajax-loader.gif')}}' >");
        $('textarea#message-data').css('border','');    
        e.preventDefault();
        str=true;
        if($('textarea#message-data').val() != ""){
             $('textarea#message-data').css('border','');    
        var url, request, tag, data;
        $('#talkSendMessage').append('<div class="modal-backdrop fade in"></div>');
        tag = $(this);
        url = __baseUrl + '/ajax/message/send';
        data = tag.serialize();
        
=======
        e.preventDefault();
        var url, request, tag, data;
        tag = $(this);
        url = __baseUrl + '/ajax/message/send';
        data = tag.serialize();

>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        request = $.ajax({
            method: "post",
            url: url,
            data: data
        });

        request.done(function (response) {
            if (response.status == 'success') {
                $('#talkMessages').append(response.html);
<<<<<<< HEAD
                $('.modal-backdrop').remove();
                tag[0].reset();
                //location.reload();
            }
        });
        }
        else{
            $('textarea#message-data').css('border','1px solid red');
            str=false;
        }
=======
                tag[0].reset();
            }
        });
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

    });


    $('body').on('click', '.talkDeleteMessage', function (e) {
        e.preventDefault();
        var tag, url, id, request;

        tag = $(this);
        id = tag.data('message-id');
        url = __baseUrl + '/ajax/message/delete/' + id;

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }

        request = $.ajax({
            method: "post",
            url: url,
            data: {"_method": "DELETE"}
        });

        request.done(function(response) {
           if (response.status == 'success') {
                $('#message-' + id).hide(500, function () {
                    $(this).remove();
                });
           }
        });
    })
});
