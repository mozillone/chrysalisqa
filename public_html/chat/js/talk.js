$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#talkSendMessage').on('submit', function(e) {
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
            
            request = $.ajax({
                method: "post",
                url: url,
                data: data
            });

            request.done(function (response) {
                if (response.status == 'success') {
                    $('#talkMessages').append(response.html);
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
