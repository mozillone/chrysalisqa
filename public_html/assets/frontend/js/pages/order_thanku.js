$(document).ready(function() {

jQuery(document).ready(function($) {

  if (window.history && window.history.pushState) {

    window.history.pushState('forward', null, './#forward');

    $(window).on('popstate', function() {
     window.location.href = "/";
    });

  }
});


	 var $range = $(".js-range-slider"),
        min = 0,
        max = 100;

    function colorBoxUpdate(val) {

        $('.outer #first-box').width(val * 4);
        $('.outer #second-box').width(val * 4);

    }
     var reverse = function (num) {
        se.update({from: (num), to: max - num});
        colorBoxUpdate(num);
        if(num==0){
        	$('.my-donation').html('$0.00');
        	$('.chrysalis-donation').html('$0.00');
        	$('.total-donation').html('$0.00');
        	$('input[name="amount"]').val('0.00');
            $('.crt-amount').html('Donation should not be $0.00');
          
        }
        if(num==25){
            $('span.crt-amount').empty();
        	$('.my-donation').html('$0.25');
        	$('.chrysalis-donation').html('$0.25');
        	$('.total-donation').html('$0.50');
        	$('input[name="amount"]').val('0.50');
        }
        if(num==50){
            $('span.crt-amount').empty();
        	$('.my-donation').html('$0.50');
        	$('.chrysalis-donation').html('$0.50');
        	$('.total-donation').html('$1.00');
        	$('input[name="amount"]').val('1.00');
        }

        //  if(num==37.5){
        // 	$('.my-donation').html('$0.75');
        // 	$('.chrysalis-donation').html('$0.75');
        // 	$('.total-donation').html('$1.50');
        // 	$('input[name="amount"]').val('1.50');
        // }
        // if(num==50){
        // 	$('.my-donation').html('$1.00');
        // 	$('.chrysalis-donation').html('$1.00');
        // 	$('.total-donation').html('$2.00');
        // 	$('input[name="amount"]').val('2.00');
        // }
    };

    var se = $range.ionRangeSlider({
        type: "double",
        min: min,
        max: max,
        from: 0,
        to: 100,
        step: 25,
        prefix: "$",
        to_fixed: true,
        onChange: function (data) {
            if (data.from <= 50) {
                reverse(data.from);
            }
            else if (data.from > 50) {
                reverse(50);
            }
        }
    }).data('ionRangeSlider');

$('#order-charity').submit(function(e){
    var err = 1;
    var charity = $("input[name='charity']:checked").val();
    if(charity == '' || charity == null){
        $('.charity_err').html('Select any of the Charity');
        err = 0; 
    }
    var amount = $('input[name="amount"]').val();
    if(amount == "0"){
        $('.crt-amount').html('Donation should not be $0.00');
        err = 0; 
    }
    
    if(err == 0){
        return false;
    }
     
    });
})