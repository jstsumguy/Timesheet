<html>
<head>
<?php include 'templates/header.html'; ?>
</head>
<body>
<?php include 'templates/main_navigation.html'; ?>
<link rel="stylesheet" type="text/css" href="static/css/index_style.css">

<div class="page_container">
<h1 style="text-align: center;">Welcome to the Admin Page</h1>

<div id="details_table" style="background: #00AFF0; border-radius: 15px;">
	<!-- Get's the current day -->
	<h1 style="text-align: center; color: white;">
		My Employees</h1>
	<table id="week_details_table" class="table table-bordered table-striped" 
	style="margin-top: 10px;">
	    <thead>
	        <tr>
	            <th data-field="id" style="color: white;">Item</th>
	            <th data-field="title" style="color: white;">Title</th>
	            <th data-field="desc" style="color: white;">Details</th>
	            <th data-field="comp" style="color: white;">Complete</th>
	            <th data-field="start" style="color: white;">Start</th>
	            <th data-field="end" style="color: white;">End</th>
	            <th data-field="total" style="color: white;">Total</th>
              <th data-field="first" style="color: white;">Firstname</th>
              <th data-field="last" style="color: white;">Lastname</th>
	        </tr>
	    </thead>
	    <tbody id="employees" style="font-size: .8em;">
	  		<!-- Weekly timesheet data goes here -->
	    </tbody>
	</table>
</div>

<!-- Edit cell modal for employees -->
<div id="edit_cell_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Row</h4>
      </div>
      <div class="modal-body">
    	<h1 class="fa fa-warning">These changes will be permanent</h1>
      <!-- Prevent default action -->
    	 <form id="admin_edit_cell_form" method="POST" action="php/edit_item_admin.php">
  				<div id="title_container" class="form-group has-feedback">
  				<label>Title</label>
          <input id="work_id" type="hidden" name="id" value="" > 
  					<input id="edit_title" name="title" type="text" class="form-control">
  					<i class="glyphicon glyphicon-user form-control-feedback"></i>
  				</div>
  				<div id="desc_container" class="form-group has-feedback">
  				<label>Description</label>
  				<input id="edit_desc" type="text" name="description" class="form-control">
  				<i class="glyphicon glyphicon-exclamation-sign form-control-feedback"></i>
  				</div>
  				<div id="check" class="checkbox" style="margin-bottom: 20px;">
				  <label>
				    <input type="checkbox" value="yes" name="checkbox">
				   	Completed?
				  </label>
				</div>
  				<button type="submit" class="btn btn-info btn-lg">Edit</button>
			</form>
      </div>
      <div class="modal-footer">
        <button id="edit_cell" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End edit cell modal -->

<!-- End page container -->
</div>
</body>
<?php include 'templates/footer.html' ?>
<script type="text/javascript" src="static/scripts/script.js"></script>
<script type="text/javascript" src="static/scripts/admin.js"></script>
</html>