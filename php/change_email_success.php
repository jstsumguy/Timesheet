<html>
<head>
<?php include 'templates/header.html'; ?>
<link rel="stylesheet" type="text/css" href="static/css/index_style.css">
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
<?php include 'templates/main_navigation.html'; ?>

<div class="page_container">
<?php include 'templates/banner.php'; ?>
<!-- Signup was successful -->
  <div id="email_complete" class="jumbotron">
    <h1>Congradulations, your email was changed!</h1>
    <p>Please login with your new email.</p>
  </div>
</div>
<!-- End page container -->
<!-- Begin page level scripts -->
<script type="text/javascript" src="static/scripts/script.js"></script>
</body>
<?php include 'templates/footer.html' ?>
</html>