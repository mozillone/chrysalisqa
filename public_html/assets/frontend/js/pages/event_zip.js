$(document).ready(function () {
    $('.event-link').on('click', function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });
});