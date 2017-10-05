$(document).ready(function() {

jQuery(document).ready(function($) {

  if (window.history && window.history.pushState) {

    window.history.pushState('forward', null, './#forward');

    $(window).on('popstate', function() {
     window.location.href = "/";
    });

  }
});
  	$("#order-charity").validate({
  			ignore: ":hidden",
            rules: {
                suggest_charity:{
                        required: true,
                        maxlength:100
                    }

           }
 	
        });
	//$("input[name='charity']").rules("add", {required:true});
	//$("#suggest_charity").rules("add", {required:true});
	
	$('#suggest_charity').change(function(){
		if($(this).is(":checked")){
            $("#charity").remove("remove");
            $("input[name='charity']").prop('checked', false);
			$('.thankyou-rms').removeClass('hide');
		}else{
            $("#charity").rules("add", {required:true});
			$('.thankyou-rms').addClass('hide');
		}
	})
	$(document).on('change','#charity',function(){
		$('#suggest_charity').prop('checked',false);
		$('.thankyou-rms').addClass('hide');
	})
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
      var amount=$('input[name="amount"]').val();
      if(amount=="0"){
         $('.crt-amount').html('Donation should not be $0.00');
         return false;
      }
     
});
})