<html>
<head>
<?php include 'templates/header.html'; ?>
<link rel="stylesheet" type="text/css" href="static/css/index_style.css">
</head>
<body>
<?php include 'templates/main_navigation.html'; ?>
<div class="page_container">
<?php include 'templates/banner.php'; ?>

<div id="welcome_header" class="jumbotron">
	<h1>Manage your time<br>Like a <strong>Boss</strong></h1>
	<span class="glyphicon glyphicon-usd"></span><p style="display: inline;">Save time, money, and heartache</p><br>
	<span class="glyphicon glyphicon-tree-conifer"></span><p style="display: inline;">Less tree paper, more green paper</p><br>
	<span class="glyphicon glyphicon-plane"></span><p style="display: inline;">Watch productivity skyrocket</p><br>
	<p><a class="btn btn-primary btn-lg" href="about.php" role="button">Learn more</a></p>
</div>

<!-- Signup column-->
<div id="signup_container">
  <h2>New to Tempus?</h2>
  <p>Sign up now for instant access</p>
  <p><a class="btn btn-primary btn-lg" href="php/signup_form.php" role="button">Sign up</a></p>
</div>

</div>
<!-- End page container -->

<!-- Begin page level scripts -->
<script type="text/javascript" src="static/scripts/script.js"></script>
<script>
$(document).ready(function(){

  $("#login_form").validate({
  rules: {
    password: {
      required: true,
      minlength: 6,
    },

    email: {
    required: true,
    email: true
    }

  },
  messages: {
    password: {
      required: "Password is a required field",
      minlength: "Password must be at least 8 characters"
    },
    email: {
    required: "We need your email address to contact you",
    email: "Your email address must be in the format of name@domain.com"
    }
  }
  }); //end validation

});
</script>
</body>
<?php include 'templates/footer.html' ?>
</html>
