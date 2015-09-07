
<html>
<head>
<?php include '../templates/header.html'; ?>
<link rel="stylesheet" type="text/css" href="../static/css/index_style.css">
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
<style>
#signup_complete
{
  padding: 7px;
  text-align: center;
  border-radius: 12px;
}
</style>
</head>
<body>
<div class="page_container">
<?php include '../templates/banner.php'; ?>

<!-- Signup was successful -->
  <div id="signup_complete" class="jumbotron">
    <h1>Congradulations, you are now signed up!</h1>
    <p>You can now login with your new credentials</p>
    <p style="font-size: .9em;">You are being redirect to the homepage</p>
  </div>

</div>
</body>
<script>
$(document).ready(function(){
	setTimeout(function(){
		document.location.href = "../index.php";
	}, 3000);
});
</script>
</html>