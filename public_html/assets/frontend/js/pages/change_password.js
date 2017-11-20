 $("#changePassword_form").validate({
			rules: {
				password: {
					required: true,
					minlength: 8,
					maxlength: 15,
				},
				cpassword: {
					required: true,
					equalTo: '#password',
				},
			},
			messages: {
				email:
                 {
                    required: "Enter a valid  user email",
                    email: "Please enter a valid email address.",
                    remote: "This email is already registered."
                 },
                 messages: {
						equalTo: "Passwords don't match."
	  			}
			}
		});