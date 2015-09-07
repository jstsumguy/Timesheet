<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<link rel="stylesheet" type="text/css" href="../static/css/style.css">
<link rel="stylesheet" type="text/css" href="../static/css/index_style.css">
<style>
#email_complete
{
  padding: 7px;
  text-align: center;
  border-radius: 12px;
}
</style>
</head>
<body>
<?php include '../templates/main_navigation2.html'; ?>

<div class="page_container">
<?php include '../templates/banner.php'; ?>
<!-- Signup was successful -->
  <div id="email_complete" class="jumbotron">
    <h1>Congradulations, your message was sent!</h1>
    <p>We appreciate your feedback</p>
  </div>
</div>
<!-- End page container -->
<!-- Begin page level scripts -->
</body>
<?php include '../templates/footer.html'; ?>
</html>