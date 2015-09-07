<html>
<head>
<?php include 'templates/header.html'; ?>
<link rel="stylesheet" type="text/css" href="static/css/timestyle.css" >
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'templates/main_navigation.html'; ?>

<div class="page_container">	
<?php include 'templates/banner.php'; ?>
<div class="day">
	<h1>
		<?php 
		date_default_timezone_set('America/New_York');
		$jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y")); 
		echo(jddayofweek($jd,1)); 
		?>
		<p id="time_detail" style="font-size: 0.5em;"></p>
	</h1>
</div>

<!-- Start / Stop Buttons -->
<div id="time_container">
	<p id="time_status" style="text-align: center; font-size: 3.1em; color: white;">Start recording now!</p>
    <button id="start_button" type="button" class="btn btn-success btn-lg center-block" data-toggle="modal" data-target="#start_modal" style="width: 300px; font-size: 2.1em;">Start</button>
    <button id="stop_button" type="button" class="btn btn-danger btn-lg center-block" data-toggle="modal" data-target="#stop_modal" style="width: 300px; font-size: 2.1em;">Stop</button>
</div>

<!-- Confirm start modal -->
<div id="start_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Start</h4>
      </div>
      <div class="modal-body">
    	<h1 class="fa fa-warning">Warning, once you press start your time will start recording</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="start" type="submit" class="btn btn-success btn-lg">Start</button>
      </div>
    </div>
  </div>
</div>
<!-- end confirm -->

<!-- Confirm stop modal -->
<div id="stop_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Stop</h4>
      </div>
      <div class="modal-body">
    	<h1 class="fa fa-warning">Warning, only continue if you are finished for the day</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="stop" type="submit" class="btn btn-danger btn-lg">Stop</button>
      </div>
    </div>
  </div>
</div>
<!-- end confirm -->

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
    	 <form id="edit_cell_form" method="POST" action="php/edit_item.php">
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

<hr>
<div id="totals_banner">
  <h1>My Totals</h1>
</div>
 <!-- Scroll tabs -->
<div class="panel panel-default">
<table class="table table-bordered table-striped table-hover" style="margin-top: 10px;">
  <thead>
    <tr id="total_head">
      <th id="total_day" data-field="work-item">Today's Hours</th>
      <th id="total_week" data-field="start">Total Hours this Week</th>
      <th id="total_year" data-field="end">Total Hours YTD</th>
      <th id="total_tasks" data-field="complete">Completed Tasks</th>
    </tr>
  </thead>
</table>
</div>

<!-- Details table -->
<div id="details_table" style="background: #00AFF0">
	<!-- Get's the current day -->
	<h1 style="text-align: center;">
		Week's Totals</h1>
	<table id="week_details_table" class="table table-bordered table-striped" 
	style="margin-top: 10px;">
	    <thead>
	        <tr>
	            <th data-field="id" style="color: white;">Work Item</th>
	            <th data-field="title" style="color: white;">Title</th>
	            <th data-field="desc" style="color: white;">Details</th>
	            <th data-field="start" style="color: white;">Start</th>
	            <th data-field="end" style="color: white;">End</th>
	            <th data-field="total" style="color: white;">Total</th>
	        </tr>
	    </thead>
	    <tbody id="week_data">
	  		<!-- Weekly timesheet data goes here -->
	    </tbody>
	</table>

<!--   <div id="close_detail_container">
    <h1>Title:</h1>
    <p>Description:</p>
    <p>Start:</p>
    <p>End:</p>
  </div> -->

	<!-- Daily progress bar -->
	<h2>My Hours</h2>
	<div class="progress">
  		<div id="progressbar" class="bar"
       style="width: 0%;"></div>
	</div>
	<!-- If the user hasn't worked any hours for the day -->
	<span id="worked" style="color: white; font-size: 1.2em;"></span>
</div>
<hr>
<!-- end details table -->

<!-- Visualizations charts -->
<h1 id="week_totals_heading" style="text-align:center; margin-top: 55px; margin-bottom: 40px;">Weekly Totals</h1>
<div id="week_chart" style="margin-bottom: 90px;"></div>
<hr>

<h1 style="text-align:center; margin-top: 55px; margin-bottom: 40px;">Yearly Totals</h1>
<div id="year_chart" style="margin-bottom: 90px;"></div>
<!-- end of visualizations -->
<hr>
<!-- Completed Tasks -->
<div id="completed_tasks">
  <h1 id="task_header" >Completed Tasks for this Day</h1>
  <!-- Task filter -->
  <select id="filter" style="float: right; margin-right: 30px;">
      <option selected>Day</option>
      <option>Week</option>
      <option>Year</option>
  </select>

  <div id="task_container">
  <!-- Tasks go here -->
  </div>
</div>
<!-- end tasks -->

</div><!-- page container -->
</body>
<script type="text/javascript" src="static/scripts/script.js"></script>
<!-- D3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<!-- Data Visualizations -->
<script type="text/javascript" src="static/scripts/visualization.js"></script>
<script type="text/javascript" src="static/scripts/time_scripts.js"></script>
<script>
$(document).ready(function()
{
	makeChart('#week_chart', 7);
	makeChart('#year_chart', 100);
});
</script>
</html>
