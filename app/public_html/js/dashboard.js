
$("#edit_customer").validate({
            rules: {
                title:{
                        required: true 
                    },
                first_name:{
                        required: true
                },
                last_name:{
                        required: true
                },
                username:{
                       required:true,
                       remote: {url: "/usernameValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"}
                    },
                email:{
                    required: true,
                    email:true,
                    remote: {
                        url: "/emailcheck",
                        data: {"user_id":$('input[name="user_id"]').val()},
                        type: "post"
                 }
                },
                avatar:{ 
                    accept: "jpg|jpeg|png|gif",
                },
                password:{
                    minlength: 8
                }

                },
                messages: {
                    email: {
                    remote: "Email is already in use!"
            },username:{
                       remote: "This Username is already taken."
                    }
        }
 	
        }); 


$("[id^='cc_radio_']").click(function(){
    $('.ng-scope').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
    var dynamic_id = $('input[name=cc_radio]:checked').attr('id');
    var res = dynamic_id.split("_");
    var cc_id = res[2];
    $.ajax({
             url: "/ccupdate",
             type: "POST",
             data: {'cc_id':cc_id},
             success: function(data){
                if (data == "success") {
                    location.reload();
                }
             }
         });
});


$("#shipping_address").validate({
            rules: {
                firstname:{
                        required: true 
                    },
                lastname:{
                        required: true
                },               
                address_2:{
                        required: true
                },
                city:{
                    required: true
                },
                postcode:{
                    required: true,
                    number: true
                },
                shiping_state_dropdown:{
                    required: true
                }
            }
        });

$("#shipping_address1").validate({
            rules: {
                firstname:{
                        required: true 
                    },
                lastname:{
                        required: true
                },
                address_2:{
                        required: true
                },
                city:{
                    required: true
                },
                postcode:{
                    required: true,
                    number: true
                },
                state:{
                    required: true
                }
            }
        });
$("#billing_address").validate({
            rules: {
                firstname:{
                        required: true 
                    },
                lastname:{
                        required: true
                },
                address_2:{
                        required: true
                },
                city:{
                    required: true
                },
                postcode:{
                    required: true,
                    number: true
                },
                billing_state_dropdown:{
                    required: true
                }
            }
        });
$("#billing_address1").validate({
            rules: {
                firstname:{
                        required: true 
                    },
                lastname:{
                        required: true
                },
                address_2:{
                        required: true
                },
                city:{
                    required: true
                },
                postcode:{
                    required: true,
                    number: true
                },
                billing_state_dropdown:{
                    required: true
                }
            }
        });
$("#edit_shipping").validate({
            rules: {                
                paypal_email:{
                        required: true,
                        email: true
                }
            }
        });