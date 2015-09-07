$(document).ready(function(){
	/* Change username */
	$("#change_email_form").validate({
		  rules: {

		    email: {
		    required: true,
		    email: true
		    }

		  },
		  messages: {

		    email: {
		    required: "This is a required field",
		    email: "Your email address must be in the format of name@domain.com"
		    }
		  }
  	});//end of validation

});//end of doc