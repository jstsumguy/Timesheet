
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Bootstrap plugins -->
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- jQuery plugins go here -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<!-- Chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>
<!-- DATE JS -- >
<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
<!-- D3 Visualizations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<!-- Static pages go here -->
<link rel="stylesheet" type="text/css" href="../static/css/style.css">
<link rel="stylesheet" type="text/css" href="../static/css/index_style.css">
</head>
<body>
<?php include '../templates/main_navigation.html'; ?>

<div class="page_container">
<?php include '../templates/banner.php'; ?>

<!-- Signup form -->
<form id="signup_form" method="POST" action="signup.php" 
style="width: 600px; margin-left: auto; margin-right: auto; border: solid 2px black; padding: 15px; border-radius: 12px;">
  <div id="status">
    <h1 style="text-align: center;">Just a few clicks away...</h1>
  </div>
  <div id="email_container" class="form-group has-feedback">
    <label>Email address</label>
    <input id="email" type="email" name="username" class="form-control" placeholder="Enter email">
    <i class="glyphicon glyphicon-user form-control-feedback"></i>
  </div>
  <div id="password_container" class="form-group has-feedback">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
    <i class="glyphicon glyphicon-exclamation-sign form-control-feedback"></i>
  </div>
  <div class="radio">
  <label>
    <input type="radio" name="radio" value="employee" checked>
    Are you a employee?
    </label>
  </div>
  <div class="radio">
    <label>
    <input type="radio" name="radio" value="manager">
    Are you a manager?
    </label>
  </div>
   <div class="radio">
    <label>
    <input type="radio" name="radio" value="ceo">
    Are you the CEO?
    </label>
  </div>
  <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
</form>

</div>
<!-- End page container -->

<!-- Begin page level scripts -->
<script type="text/javascript">
$(document).ready(function(){

  $("#signup_form").validate({
  rules: {
    password: {
      required: true,
      minlength: 6,
    },

    username: {
    required: true,
    email: true
    }

  },
  messages: {
    password: {
      required: "Password is a required field",
      minlength: "Password must be at least 8 characters"
    },
    username: {
    required: "Email is a required field",
    email: "Your email address must be in the format of name@domain.com"
    }
  }
}); //end validation
});//doc
</script>
</body>
</html>