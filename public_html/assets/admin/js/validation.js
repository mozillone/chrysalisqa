

jQuery.validator.addMethod("alphaNumeric", function(value, element) {
	return this.optional(element) || value == value.match(/^[a-zA-Z 0-9]+$/);
	},"Only Characters Allowed.");

$("#val_form").validate({
	rules: {  
		email: {
			required: true,
			email: true,
			remote: {url: "/emailValidation",type: "post"}
			}, 
		password: {
			required: true,
			minlength: 5, 
		},  
		first_name: {
			required: true,
			maxlength: 50,
			alphaNumeric: true
		}, 
		last_name: {
			required: true,
			maxlength: 50,
			alphaNumeric: true
		}, 
		state:{
			required: true,
		}, 
		zip_code:{
			required: true,
			maxlength: 10,
			alphaNumeric: true
		},
		order_date:{
			required: true,
		}, 
		order_time:{
			required: true,
		},
		phone_number:{
			required: true, 
		},
		role:{
			required: true, 
		},
		company_name:{
			required: true, 
			maxlength: 50,
		},
		contact_name:{ 
			maxlength: 50,
		},
		job_title:{
			maxlength: 50,
		},
		state:{
			required: true 
		},
		city:{
			required: true 
		},
		address1:{
			required: true 
		}
	},
	messages: { 
		password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long"
		}, 
		email:{
			required:"Email is required.",
			email: "Please enter a valid email address",
			remote: jQuery.validator.format("{0} is already taken.")
		},
		first_name:{
			 required:"First Name is required.",
			 maxlength: "Allows 50 characters only "
			
		},
		last_name: {
			 required:"Last Name is required.",
			 maxlength: "Allows 50 characters only "
			
		},
		zip_code:{
			required:"Zip code is required.",
			maxlength: "Zip code maximum allows 10 numbers only" 
		},
		order_date:{
			required:"Order date is required.",
		},
		order_time:{
			required:"Order time is required.",
		},
		phone_number:{
			required:"Phone number is required."
		},
		role:{
			required:"Role number is required."
		},
		company_name:{
			required:"Company Name is required.",
			maxlength: "Allows 50 characters only "
		},
		contact_name:{
			maxlength: "Allows 50 characters only "
		},
		job_title: { 
			 maxlength: "Allows 50 characters only "
			
		},
		address1:{
			required:"Address is required."
		},
		state:{
			required:"State is required."
		},
		city:{
			required:"City is Required."
		}
	}

});
$("#val_edit_form").validate({
	rules: { 
		email: {
			required: true,
			remote: {url: "/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"}
			}, 
		password: { 
			minlength: 5, 
		},  
		first_name: {
			required: true,
			maxlength: 50,
			alphaNumeric: true 
		}, 
		last_name: {
			required: true,
			maxlength: 50,
			alphaNumeric: true
		}, 
		state:{
			required: true,
		}, 
		zip_code:{
			required: true, 
			maxlength: 10,
			alphaNumeric: true
		}, 
		phone_number:{
			required: true
		},
		role:{
			required: true, 
		},
		company_name:{
			required: true, 
		},
		contact_name:{ 
			maxlength: 50,
		},
		job_title:{
			maxlength: 50,
		}, 
		address1:{
			required: true 
		},
		state:{
			required: true 
		},
		city:{
			required: true 
		}
		/*avatar:{
			
		}*/
	},
	messages: { 
		password: { 
			minlength: "Your password must be at least 5 characters long"
		}, 
		email:{
			required:"Email is required.",
			email: "Please enter a valid email address",
			remote: jQuery.validator.format("{0} is already taken.")
		},
		first_name:{
			 required:"First Name is required.",
			 maxlength: "Allows 50 characters only "
			
		},
		last_name: {
			 required:"Last Name is required.",
			 maxlength: "Allows 50 characters only "
			
		},
		zip_code:{
			required:"Zip code is required.",
			maxlength: "Zip code maximum allows 10 numbers only",
			 
		}, 
		phone_number:{
			required:"Phone number is required."
		},
		role:{
			required:"Role number is required."
		},
		company_name:{
			required:"Company Name is required."
		},
		contact_name:{
			maxlength: "Allows 50 characters only "
		},
		job_title: { 
			 maxlength: "Allows 50 characters only "
			
		},
		address1:{
			required:"Address is required."
		},
		state:{
			required:"State is required."
		},
		city:{
			required:"City is required."
		}
		
		/*avatar:{
			 
		}*/
	}

});

$("#role_val_form").validate({
	rules: {  
		role: {
			required: true,
			maxlength: 20,
			alphaNumeric: true,
			remote: {url: "/roleNameValidation",type: "post"}
		},
		description: {
			maxlength: 100,
		}

	},
	messages: { 
		role: {
			required: "Please provide a Role Name",
			maxlength: "Allows 20 characters only ",
			remote: jQuery.validator.format("{0} is already taken.")
		}, 
		description: { 
			maxlength: "Allows 100 characters only "
		}, 
		 
	}

});

$("#role_edit_val_form").validate({
	rules: {  
		role: {
			required: true,
			maxlength: 20,
			alphaNumeric: true ,
			remote: {url: "/roleNameValidation",data: {"id":$('input[name="id"]').val()},type: "post"}
		},
		description: {
			maxlength: 100,
		}

	},
	messages: { 
		role: {
			required: "Please provide a Role Name",
			maxlength: "Allows 20 characters only ",
			remote: jQuery.validator.format("{0} is already taken.")
			 
		}, 
		description: { 
			maxlength: "Allows 100 characters only "
		}, 
		 
	}

});


$("#login_val_form").validate({
	rules: {  
		email: {
			required: true,
			email: true,
		},
		password: {
			required: true,
			minlength: 5, 
		}

	},
	messages: { 
		email: {
			email: "Please enter a valid email address",
			remote: jQuery.validator.format("{0} is already taken.")
			 
		}, 
		password: {  
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long"
		}, 
		 
	}

});


$("#reset_val_form").validate({
rules: {
	email: {
		 required: true,
		 email: true,
	},
    password: {
        required: true,
        minlength: 5
    },
    password_confirmation : {
        equalTo: "#password",
        minlength: 5,
    }
},

messages:
{
	email: {
		email: "Please enter a valid email address",
		remote: jQuery.validator.format("{0} is already taken.")
		 
	}, 
    password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
    },
    password_confirmation :" Enter Confirm Password Same as Password"
},


});



