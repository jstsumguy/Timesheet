<html>
<head>
<?php include 'templates/header.html'; ?>
</head>
<body>
<?php include 'templates/main_navigation.html'; ?>
<link rel="stylesheet" type="text/css" href="static/css/index_style.css">

<div class="page_container">
	<?php include 'templates/banner.php'; ?>
	<h1 style="text-align: center;">Let us know how we can help you</h1>
<!-- contact form -->
<form id="contact_form" method="POST" action="php/send_mail.php">
	<div id="email_container" class="form-group has-feedback">
	<label>Your email address</label>
		<input id="contact_email" name="email" type="email" class="form-control" placeholder="Enter email">
		<i class="glyphicon glyphicon-user form-control-feedback"></i>
	</div>
	<div id="subject_container" class="form-group has-feedback">
	<label>Subject</label>
		<input id="subject" name="subject" type="text" class="form-control" placeholder="Subject">
		<i class="glyphicon glyphicon-user form-control-feedback"></i>
	</div>
	<div id="message_container" class="form-group has-feedback">
	<label>Message</label>
		<input id="message" name="message" type="text" class="form-control" placeholder="Enter your message here">
		<i class="glyphicon glyphicon-user form-control-feedback"></i>
	</div>
	<button type="submit" class="btn btn-primary btn-lg">Send</button>
</form>
<!-- end contact form -->

</div>
<!-- End page container -->
</body>
<?php include 'templates/footer.html' ?>
<script type="text/javascript" src="static/scripts/script.js"></script>
<script>
$(document).ready(function(){
	//Handle validations
  $("#contact_form").validate({
  rules: {

    email: {
    required: true,
    email: true
    },
    message: {
    	required: true,
    	minlength: 10,
    	maxlength: 400,
    }

  },
  messages: {

    email: {
    required: "We need your email address to contact you",
    email: "Your email address must be in the format of name@domain.com"
    },
    message: {
    	required: "This field is required",
    	minlength: "Must be at least 10 characters",
    	maxlength: "Cannot exceed 400 characters"
    }
  }

  }); //end validation
});//end doc
</script>
<?php include 'templates/footer.html' ?>
</html>












