 $("#changePassword_form").validate({
			rules: {
				password: {
					required: true,
<<<<<<< HEAD
					minlength: 8,
=======
					minlength: 5,
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
                    remote: "This email is already registered."
                 },
                 messages: {
						equalTo: "Password doesn't matches."
=======
                    remote: "This email is already taken."
                 },
                 messages: {
						equalTo: "Enter same as password"
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	  			}
			}
		});