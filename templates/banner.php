<!-- Banner -->
<div class="page-header">
	<h1>Tempus</h1>
	<button id="login_button" class="btn btn-danger" style="position: absolute; right: 20; top: 10; text-align: right;" type="button" data-toggle="modal" data-target="#login">Log in</button>
</div>

<!-- Login modal for banner only-->
<div id="login" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
      	<form id="login_form" method="POST" action="php/login.php">
			<div id="email_container" class="form-group has-feedback">
			<label>Email address</label>
				<input id="login_email" name="username" type="email" class="form-control" placeholder="Enter email">
				<i class="glyphicon glyphicon-user form-control-feedback"></i>
			</div>
			<div id="password_container" class="form-group has-feedback">
			<label>Password</label>
			<input type="password" name="password" class="form-control" id="login_password" placeholder="Password">
			<i class="glyphicon glyphicon-exclamation-sign form-control-feedback"></i>
			</div>
			<button type="submit" class="btn btn-primary btn-lg">Login</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End login modal -->
