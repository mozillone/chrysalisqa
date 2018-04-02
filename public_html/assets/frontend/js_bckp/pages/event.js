$(document).ready(function () {

    // custom method for url validation with or without http://
    $.validator.addMethod("event_url", function(value, element) { 
        if(value.substr(0,7) != 'http://'){
            value = 'http://' + value;
        }
        if(value.substr(value.length-1, 1) != '/'){
            value = value + '/';
        }
        return this.optional(element) || /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(value); 
    }, "Not valid url.");


     
    $("#save-event").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            event_name:{
                required: true,
                minlength: 5,
                maxlength: 255
            },
            event_url:{
                required: true,
                event_url: true
            },
            from_date:{
                required: true
            },
            from_time:{
                required: true
            },
            to_date:{
                required: true
            },
            to_time:{
                required: true
            },
            location:{
                required: true
            },
            event_desc: {
                required: true,
                minlength: 5,
                maxlength: 350
            },
            user_email: {
                required: true,
                maxlength: 160,
                email: true
            },
        },
        highlight: function(element) {
            $(element).closest('.form-control').addClass('error');
        },
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }
        },
        messages: {
            event_name:{
                required: "Enter Event Name",
            },
            event_url:{
                required: "Enter Event URL",
                url: "Enter Valid URL"
            },
            from_date:{
                required: "Enter From Date",
            },
            from_time:{
                required: "Enter From Time",
            },
            to_date:{
                required: "Enter To Date",
            },
            to_time:{
                required: "Enter To Time",
            },
            location:{
                required: "Enter Location",
            },
            event_desc:{
                required: "Enter Event Description",
            },
            user_email:{
                required: "Enter Email Address",
                email: 'Please enter a valid email address.'
            },
        },
        errorElement: 'span',
        errorClass: 'error',
    });


    $('.event-link').on('click', function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });

    $('#event-from-date').datetimepicker({
        format: 'MM-DD-YYYY',
        minDate: new Date()
    });
    $('#event-to-date').datetimepicker({
        format: 'MM-DD-YYYY',
        useCurrent: false
    });
    $("#event-from-date").on("dp.change", function (e) {
        $('#event-to-date').data("DateTimePicker").minDate(e.date);
    });
    $("#event-to-date").on("dp.change", function (e) {
        $('#event-from-date').data("DateTimePicker").maxDate(e.date);
    });

    $('#event-from-date,#event-to-date').on('keydown', function (e) {
        e.preventDefault();
    });

    $('#event-from-time,#event-to-time').clockpicker({
        autoclose: true
    });

    $('#event-from-time,#event-to-time').on('keydown', function (e) {
        e.preventDefault();
    });

});

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {

    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {
            types: ['geocode'],
            componentRestrictions: {country: 'us'}
        }
    );

    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {

    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}