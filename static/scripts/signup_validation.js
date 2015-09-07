$(document).ready(function(){

	$('#create_userModal').submit(function(){
		console.log('form submitted');

		var message = {};
		message.email = $('#user_email').val();
		message.password = $('#user_password').val();

		$.ajax({
			  type: "POST",
			  url: "php/create_user.php",
			  data: JSON.stringify(message),
			  success: function(){
			  	console.log("Ajax success");
			  },
		});

	});//form submit
});//document ready
