$(function(){
	$(document).on('change','#price', function(){
        var number = $('#price').val();
        var present_val = '';
        present_val = $(this).val()+".00";
        
        if(number.indexOf('.') == "-1"){
            $(this).val($(this).val()+".00");
            $("#price").val(present_val);
        }


var donate_percent = $('#donate_charity').val();
var cuurent_one = donate_percent.replace("%",'');
var str = cuurent_one.replace(/\s/g, ''); 
var price = $('#price').val();
var total = (price*str)/100;
if (donate_percent=="none") {
var total = 0.00;
}
var amount = parseFloat(total).toFixed(2);
$('#hidden_donation_amounts').val(amount);
$('#dynamic_percent_amounts').html("$"+amount);

    });
	
	
        $("#customer_create").validate({
        	onfocusout: function(element) { $(element).valid(); },
			rules: {
				first_name:{
					 	required: true,
						maxlength: 50,
				},
				last_name:{
					 	required: true,
						maxlength: 50,
				}, 
				phone_number:{
					required: true,
					//number:true,
					//maxlength: 10,
					//remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				username:{
					required: true,
					maxlength: 50,
					remote: {url: "/usernameValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				email: {
      				required: true,
      				email: true,
      				remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
	   				},
				password: {
					required: true,
					minlength: 8,
					maxlength: 15,
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
			   first_name:
			   {
			    required: "Enter First Name",
			   },
			   last_name:
			   {
			    required: "Enter Last Name",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   password:{
			   required: "Enter Password",
			   },
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already registered."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },

			},
			errorElement: 'span',
       		errorClass: 'error',
		});
/*	 $("#customer_edit").validate({
        	onfocusout: function(element) { $(element).valid(); },
			rules: {
				first_name:{
					 	required: true,
						maxlength: 50,
				},
				last_name:{
					 	required: true,
						maxlength: 50,
				}, 
				phone_number:{
					required: true,
					//number:true,
					//maxlength: 10,
					//remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				username:{
					required: true,
					maxlength: 50,
					remote: {url: "/usernameValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				email: {
      				required: true,
      				email: true,
      				remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
	   				},
	   				password: {
					minlength: 8,
					maxlength: 15,
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
			   first_name:
			   {
			    required: "Enter First Name",
			   },
			   last_name:
			   {
			    required: "Enter Last Name",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already registered."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
		});*/
	    sub_cos_counter = 0;

			$("#customer_edit1").validate({
			rules: {
				customer_name:{
						required: true,
						maxlength: 50,
				},
				gender:{
					required: true,
				},
				costumecondition:{
					required: true,
				},
				costume_name:{
					 	required: true,
						maxlength: 50,
				},
				costume_cost:{
					 	required: true,
						maxlength: 50,
						number: true
				},
				category:{
					 	required: true,
						maxlength: 50,
				},
				pounds:{
					required: true,
				},
				ounces:{
					required: true,
				},	
				size:{
					required: true,
				},
				price:{
					required: true,
					number: true
				},
				quantity:{
					required: true,
				},
				shipping_option:{
					required: true,
				},
				costume_desc:{
					required: true,
				},
				faq:{
					required: false,
				},
				weight_package_items:{
				 	required: true,
				},
				dimensions:{
				  	required: true,
				},
				type:{
				  	required: true,
				},
				service:{
				  	required: true,
				},
				location:{
				  	required: true,
				},
				handling_time:{
				  	required: true,
				},
				return_policy:{
				  	required: true,
				},
				donate_charity:{
				  	required: {
		                depends: function(element) {
		                	if($('#charity_name').val() != "")
	                		{
	                			$("#don_err").html('This field is required.');
	                			return true;
	                		}
		                }
		            }
				},
				charity_name:{
				  	required: {
		                depends: function(element) {
		                    return parseInt($('#donate_charity').val()) != 0
		                }
		            }
				},
				/*cleaned:{
					required:{
						depends:function(element)
						{
							var cleaned = $("#cleaned").val();
							var condition_val =  $('input[name=condition]:checked').val();
							if(condition_val == 'good' || condition_val == 'like_new')
							{
								if(cleaned == "")
								{
									$("#cleanederror").html('This field is required.');
	                				return true;
								}
							}
						}
					}
				},*/
				img_chan:{
				  	required: true,
				  	accept: "jpg|jpeg|png|gif",
				},
				img_chan1:{
				  	required: false,
				  	accept: "jpg|jpeg|png|gif",
				},
				"files[]":{
					accept: "jpg|jpeg|png|gif",
				},
				heightft:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				heightin:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				weightlbs:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom' 
		                }
		            }
				},
				chestin:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				waistlbs:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom' 
		                }
		            }
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
				customer_name:{
					required: "Select Customer Name",
				},
			   costume_name:
			   {
			    required: "Enter Costume Name",
			   },
			   costume_cost:
			   {
			    required: "Enter Costume cost",
			   },
			   category:
			   {
			    required: "Select Category",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   autocomplete:{
				  required: "Enter Item Location",
				},
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already registered."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
       		submitHandler: function(form) {
       			var flag = 1; 
				if(sub_cos_counter == 0){
					sub_cos_counter = 1;
					flag = 1;
					//form.submit();
				}
				var condition_val =  $('input[name=costumecondition]:checked').val();
				var cleaned = $("#cleaned").val();
				if($('#charity_name').val() != "" && parseInt($("#donate_charity").val()) == 0 )
        		{
        			$("#don_err").text('This field is required.');
        			flag = 0;
        			//return true;
        		}else{
			     	$("#don_err").text('');
			     	flag = 1;
			     	//form.submit();
				}

				if(condition_val != 'good' ||  condition_val != 'like_new')
        		{
        			if(cleaned == "")
        			{
        				$("#cleanederror").text('This field is required.');
        				flag = 0;
        			}
        	 
        		}else{
			     	$("#cleanederror").text('');
			     	flag = 1;
			     	//form.submit();
				}

				if(condition_val == 'brand_new')
				{
					if(cleaned == "")
					{
						$("#cleanederror").text('');
			     		flag = 1;
					}
				}


				if(flag == 1){
					form.submit();
				}
			}
			
			});

	/*$('#submit').on('click', function(e){
		if($(this).val() != "" && parseInt($("#donate_charity").val()) == 0){
			$("#donate_err").html("This field is required.");
			return false;
		}else{
			$("#donate_err").html("");
			return true;
		}
	});*/
	$("#customer_edit2").validate({
        	//onfocusout: function(element) { $(element).valid(); },
			rules: {
				customer_name:{
						required: true,
						maxlength: 50,
				},
				gender:{
					required: true,
				},
				costume_name:{
					 	required: true,
						maxlength: 50,
				},
				costume_cost:{
					 	required: true,
						maxlength: 50,
						number: true
				},
				category:{
					 	required: true,
						maxlength: 50,
				}, 
				pounds:{
					required: true,
				},
				ounces:{
					required: true,
				},
				size:{
					required: true,
					
				},
				price:{
					required: true,
					number: true
				},
				quantity:{
					required: true,
					
				},
				shipping_option:{
					required: true,
					
				},
				costume_desc:{
					required: true,
					
				},
				fun_fact:{
					required: false,
					
				},
				faq:{
					required: false,
					
				},
				weight_package_items:{
				 required: true,
				},
				dimensions:{
				  required: true,
				},
				type:{
				  required: true,
				},
				service:{
				  required: true,
				},
				location:{
				  required: true,
				},
				handling_time:{
				  required: true,
				},
				return_policy:{
				  required: true,
				},
				donate_charity:{
				  	required: {
		                depends: function(element) {
		                	// if($('#charity_name').val() != "")
	                		// {
	                		// 	//$("#don_err").html('This field is required.');
	                		// 	return true;
	                		// }
	                		return $('#charity_name').val() != ""
		                }
		            }
				},
				charity_name:{
				  	required: {
		                depends: function(element) {
		                    return parseInt($('#donate_charity').val()) != 0
		                }
		            }
				},

				/*cleaned:{
				  	required: {
		                depends: function(element) {
		                    var cleaned = $("#cleaned").val();
		                    var condition_val =  $('input[name=condition]:checked').val();
							if(condition_val == 'good' || condition_val == 'like_new')
							{
								if(cleaned == "")
								{
									return $('#cleaned').val() != '';								 
								}
							}
		                }
		            }
				},*/

 
				cosplay:{
					required: true,
				},
				fashion:{
					required: true,
				},
				activity:{
					required: true,
				},
				make_costume:{
					required: true,
				},
				fimquality:{
					required: true,
				},
				img_chan:{
				  accept: "jpg|jpeg|png|gif",
				},
				img_chan1:{
				  accept: "jpg|jpeg|png|gif",
				},
				"files[]":{
					accept: "jpg|jpeg|png|gif",
				},
				heightft:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				heightin:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				weightlbs:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom' 
		                }
		            }
				},
				chestin:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom'
		                }
		            }
				},
				waistlbs:{
					required: {
		                depends: function(element) {
		                    return $('#size').val() == 'custom' 
		                }
		            }
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
				customer_name:{
					required: "Select Customer Name",
				},
			   costume_name:
			   {
			    required: "Enter Costume Name",
			   },
			   costume_cost:
			   {
			    required: "Enter Costume Cost",
			   },
			   category:
			   {
			    required: "Select Category",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   autocomplete:{
				  required: "Enter Item Location",
				},
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already registered."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
       		submitHandler: function(form) {
			     //form.submit();
			     var flag = 1; 
				if(sub_cos_counter == 0){
					sub_cos_counter = 1;
					flag = 1;
					//form.submit();
				}
			     var condition_val =  $('input[name=costumecondition]:checked').val();
			  
			     var cleaned = $("#cleaned").val();

			    if($('#charity_name').val() != "" && parseInt($("#donate_charity").val()) == 0 )
        		{
        			$("#don_err").text('This field is required.');
        			return;
        			flag = 0;
        		}else{
			     	$("#don_err").text('');
			     	flag = 1;
				}

				if(condition_val != 'good' || condition_val != 'like_new')
        		{
        			 if(cleaned == "")
        			 {
        			 	$("#cleanederror").text('This field is required.');
        				flag = 0;
        			 }
        		}else{
			     	$("#cleanederror").text('');
			     	flag = 1;
			     	//form.submit();
				}

				if(condition_val == 'brand_new')
				{
					if(cleaned == "")
					{
						$("#cleanederror").text('');
			     		flag = 1;
					}
				}



				if(flag == 1){
					form.submit();
				}
        	}
		});

		$("#phone,#contact_phone,#phone_number,#aaa,#search.phone").on("keyup paste", function() {

  // Remove invalid chars from the input

  var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");

  var inputlen = input.length;

  // Get just the numbers in the input

  var numbers = this.value.replace(/\D/g,'');

  var numberslen = numbers.length;

  // Value to store the masked input

  var newval = "";    // Loop through the existing numbers and apply the mask

  for(var i=0;i<numberslen;i++){

      if(i==0) newval="("+numbers[i];

      else if(i==3) newval+=") "+numbers[i];

      else if(i==6) newval+="-"+numbers[i];

      else newval+=numbers[i];

  }    // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.

  if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";

  else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";

  else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=")";

  else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";

  else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";    $(this).val(newval.substring(0,14));

});

	   $("#profile_logo").on('change', function(){
		//Get count of selected files
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $("#img-chan");
		image_holder.empty();
		var size = parseFloat($("#profile_logo")[0].files[0].size / 1024).toFixed(2);
		if (extn == "jpg" || extn == "jpeg" || extn == "png") {
			if(size<10000)
            {
			if (typeof(FileReader) != "undefined") {
			
				for (var i = 0; i < countFiles; i++) 
				{
					var reader = new FileReader();
					reader.onload = function(e) {
						
						$('#img-chan').attr('src',e.target.result);
						$('.pic').after('<span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span>');
					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
				} else {
				swal("This browser does not support FileReader.");
			}
			
            } else {

                  
                    $("#profile_logo").val("");
                    swal({   
                        title: "File doesn't Support",   
                        text: "Upload Below 10MB Size Only",   
                        type: "warning",   
                        showCancelButton: false,
                        fieldset:false,
                        confirmButtonColor: "#DD6B55 ",   
                        confirmButtonText: "Ok",   
                    closeOnConfirm: true });
                }
			} else {
			//swal("");
			swal({   
				title: "File doesn't Support",   
				text: "Upload .JPG, .JPEG, .PNG Images only.!",   
				type: "warning",   
				showCancelButton: false,
				fieldset:false,
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ok",   
			closeOnConfirm: true });
			$('input[type="file"]').val('');
		   	$('input[name="avatar"]').val("1");
			}
		 }); 
		 $("#profile_logo1").on('change', function(){
		//Get count of selected files
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $("#img-chan1");
		image_holder.empty();
		var size = parseFloat($("#profile_logo1")[0].files[0].size / 1024).toFixed(2);
		if (extn == "jpg" || extn == "jpeg" || extn == "png") {
			if(size<10000)
            {
			if (typeof(FileReader) != "undefined") {
			
				for (var i = 0; i < countFiles; i++) 
				{
					var reader = new FileReader();
					reader.onload = function(e) {
						
						$('#img-chan1').attr('src',e.target.result);

					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
				} else {
				swal("This browser does not support FileReader.");
			}
			
            } else {

                  
                    $("#profile_logo1").val("");
                    swal({   
                        title: "File doesn't Support",   
                        text: "Upload Below 10MB Size Only",   
                        type: "warning",   
                        showCancelButton: false,
                        fieldset:false,
                        confirmButtonColor: "#DD6B55 ",   
                        confirmButtonText: "Ok",   
                    closeOnConfirm: true });
                }
			} else {
			//swal("");
			swal({   
				title: "File doesn't Support",   
				text: "Upload .JPG, .JPEG, .PNG Images only.!",   
				type: "warning",   
				showCancelButton: false,
				fieldset:false,
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ok",   
			closeOnConfirm: true });
			$('input[type="file"]').val('');
		   	$('input[name="avatar1"]').val("1");
			}
		 }); 
		 $("#profile_logo2").on('change', function(){
		//Get count of selected files
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $("#img-chan2");
		image_holder.empty();
		var size = parseFloat($("#profile_logo2")[0].files[0].size / 1024).toFixed(2);
		if (extn == "jpg" || extn == "jpeg" || extn == "png") {
			if(size<10000)
            {
			if (typeof(FileReader) != "undefined") {
			
				for (var i = 0; i < countFiles; i++) 
				{
					var reader = new FileReader();
					reader.onload = function(e) {
						
						$('#img-chan2').attr('src',e.target.result);

					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
				} else {
				swal("This browser does not support FileReader.");
			}
			
            } else {

                  
                    $("#profile_logo2").val("");
                    swal({   
                        title: "File doesn't Support",   
                        text: "Upload Below 10MB Size Only",   
                        type: "warning",   
                        showCancelButton: false,
                        fieldset:false,
                        confirmButtonColor: "#DD6B55 ",   
                        confirmButtonText: "Ok",   
                    closeOnConfirm: true });
                }
			} else {
			//swal("");
			swal({   
				title: "File doesn't Support",   
				text: "Upload .JPG, .JPEG, .PNG Images only.!",   
				type: "warning",   
				showCancelButton: false,
				fieldset:false,
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ok",   
			closeOnConfirm: true });
			$('input[type="file"]').val('');
		   	$('input[name="avatar2"]').val("1");
			}
		 }); 
		$(document).on("click",".remove_pic",function(){
		$('#img-chan').attr('src',"/img/default.png");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });
	  $(".remove_pic1").on("click",function(){
		$('#img-chan1').attr('src',"/img/default.png");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });
	  $(".remove_pic2").on("click",function(){
		$('#img-chan2').attr('src',"/img/default.png");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });

});

//key words hash tag


 //key words hash tag

    $('#keywords_tag').keydown(function(e){

        if(e.keyCode === 13){
        	e.preventDefault();
                keywords();
         }  
    });

   
    $("#keywords_add").click(function(){
         keywords();
    });     

    function keywords()
    {
        var val = $('#keywords_tag').val();
        if(val != ""){
            var div_cont= $('#count').html().split(' ');
            var total =10-$(".keywords_p").length;
            if (total > 0) {
                if (val.indexOf(',') !== -1) {
                    var segments = val.split(',');
                    var count=segments.length;
                    $('#count').html(total-count+ " left");
                    if (total == 1) {
                        var hashtag = '#'+segments[0];
                        $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                        $('#keywords_tag').prop('value','');
                        $('#input_'+total+'').val(hashtag);
                        $('#count').html(total-1+ " left");
                    }else{
                        $.each(segments,function(i){
                            var hashtag = '#'+segments[i];
                            $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                            $('#input_'+total+'').val(hashtag);
                            $('#keywords_tag').prop('value','');
                            total--;
                        });
                    }
                }else{
                    var hashtag = '#'+val;
                    $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                    $('#keywords_tag').prop('value','');
                    $('#input_'+total+'').val(hashtag);
                    $('#count').html(total-1+ " left");
                }
            }else{
                $('#keywords_add').hide();
            }
        }
    }
    




/*$("#keywords_add").click(function(){

  var val = $('#keywords_tag').val();
	if (val != "") {
  var div_cont= $('#count').html().split(' ');
  var total =div_cont[0];
  if (total > 0) {
    if (val.indexOf(',') !== -1) { 
      var segments = val.split(',');
      var count=segments.length;
      $('#count').html(total-count+ " left");
      if (total == 1) {
        var hashtag = '#'+segments[0];
        $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
        $('<input>').attr({
          id:'input_'+total+'',
            type: 'hidden',
            name: 'keyword[]',
            value:''+hashtag+''
        }).appendTo('#div');
        $('#keywords_tag').prop('value','');
        $('#count').html(total-1+ " left");
      }else{
        $.each(segments,function(i){
        var hashtag = '#'+segments[i];
        $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
        $('<input>').attr({
          id:'input_'+total+'',
            type: 'hidden',
            name: 'keyword[]',
            value:''+hashtag+''
        }).appendTo('#div');
        $('#keywords_tag').prop('value','');
        total--;
        });
      }
    }else{
      var hashtag = '#'+val;
      $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
      $('<input>').attr({
        id:'input_'+total+'',
          type: 'hidden',
          name: 'keyword[]',
          value:''+hashtag+''
      }).appendTo('#div');
      $('#keywords_tag').prop('value','');
      $('#count').html(total-1+ " left");
    }
  }else{
    $('#keywords_add').hide();
  }
	}
  });*/





  $(document).on('click', '[id^="remove_"]', function(e){
    e.preventDefault();
    var this_id = $(this).attr('id');
    var split   = this_id.split('_');
    var target = $(e.target).closest( ".p_"+split[1]+"" ).remove();

    var target = $("#input_"+split[1]+"").remove();
    var div_cont= $('#count').html().split(' ');
    var total = div_cont[0];
    $('#count').html(+total+1 + " left");
    if (total == 0) {
      $('#keywords_add').show();
    }
  });
