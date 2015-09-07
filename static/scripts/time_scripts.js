$(document).ready(function(){

/* GLOBAL VARIABLES GO HERE */
	var work_id;
	var m_id;
	var temp;
	var disabled = false;

/* STARTUP FUNCTIONS */

	startTime();
	$('#week_data').empty();
	checkItem();
	getDayHours();
	$('#stop_button').css('display', 'none');
	getTasks();
	checkFinish();


/* EVENT HANDLERS AND DEFAULT FUNCTIONS */
	function findRecent()
	{
		m_id = $('#week_details_table tbody tr').last().children().first().attr('id').substring(4);
	}


	$('#start').click(function(){
		console.log('start clicked');
		findRecent();
		$.ajax({
			type: 'post',
			url: 'php/start_time.php',
			data: { id: m_id },
			success: function(response){
				console.log('START RESPONSE ' + response);
				$('#start_button').css('display', 'none');
				$('#stop_button').css('display', 'block');
				$('#time_status').text("");
				$('#time_status').text("Whenever your're ready...");
				$('#start_modal').modal('hide');
				getItems();
			},
		});
	});

	$('#stop').click(function(){
		console.log('stop clicked');
		$.ajax({
			type: 'post',
			url: 'php/stop_time.php',
			success: function(response){
				console.log('stop response ' + response);
				$('#stop_button').css('display', 'none');
				$('#time_container').empty();
				$('#time_container').append('<p style="text-align: center; font-size: 3.3em; color: white; margin-top: 30px;">Your time was recored!</p>');
				$('#stop_modal').modal('hide');
				checkFinish();
				getItems();
			},
		});
	});

	$('#total_head th').on('mouseover', function(){
		$(this).addClass('success');
		$(this).css('cursor', 'pointer');
	});
	$('#total_head th').on('mouseout', function(){
		$(this).removeClass('success');
	})

/* SCROLL FUNCTIONS */

	/* Scrolls to specific location on page */
	$.fn.scrollView = function () {
	  return this.each(function () {
	    $('html, body').animate({
	      scrollTop: $(this).offset().top
	    }, 1000);
	  });
	}

	$('#total_week').click(function(){
		$(this).css('cursor', 'pointer');
		$('#week_totals_heading').scrollView();
	});

	$('#total_year').click(function(){
		$(this).css('cursor', 'pointer');
		$('#year_chart').scrollView();
	})
	$('#total_day').click(function(){
		$(this).css('cursor', 'pointer');
		$('#details_table').scrollView();
	});
	$('#total_tasks').click(function(){
		$(this).css('cursor', 'pointer');
		$('#completed_tasks').scrollView();
	})


/* EDIT MODAL FUNCTIONS */

	$('#week_details_table').on('mouseover', 'tbody tr', function(event) {
		$(this).css('cursor', 'pointer');
	});

	$('#week_details_table').on('click', 'tbody tr', function(event) {
		work_id = $(this).children().first().attr('id').substring(4);
		$('#work_id').val(work_id);
		var parent = $(this);
		console.log('id ' + work_id);
		$('#edit_cell_modal').modal('show');
		populateModal(parent);
	});

	$('#week_details_table').on('mouseover', 'tbody tr:odd', function(event) {
		$(this).css('color', 'white');
	});

	$('#week_details_table').on('mouseout', 'tbody tr:odd', function(event) {
		$(this).css('color', 'black');
	});

/* COMPLETED TASK FUNCTIONS */

	$('select').on('change', function(){
		$('#task_header').text("");
		var option_text = $('#filter option:selected').text();
		$('#task_header').text('Completed Tasks for this ' + option_text);
		$('#task_container').empty();
		getTasks();
	});

	
/* MYSQL FUNCTIONS AND TIMESHEET DATA FUNCTIONS */

	function checkFinish()
	{
			$.ajax({
			type: 'get',
			url: 'php/check_finish.php',
			success: function(response)
			{
				var data = JSON.parse(response);
				console.log('finish response ' + data);
				if(data.indexOf("success") > -1)
				{
					disabled = true;
					console.log('hiding...');
					$('#time_container').empty();
					$('#time_container').append('<p style="text-align: center; font-size: 3.3em; color: white; margin-top: 30px;">You are now clocked out!</p>');
				}
			}
		});
	}


	/* Get all tasks based on filter value */
	function getTasks(filter)
	{
		filter = $('select option:selected').val();

		$.ajax({
			type: 'get',
			data: { filter: filter },
			url: 'php/get_tasks.php',
			success: function(response){
				var data = JSON.parse(response);
				var i;
				if(data == "")
				{
					console.log('no task data to display');
					$('#task_container').append('<h1 style="margin-top: 60px;">You have zero completed tasks</h1>');
				}
				else
				{
					for(i=0; i < data.length; i++)
					{
						$('#task_container').append('<div class="taskitem">'
							+ '<p id="tasktitle">Task ' + (i+1) + '</p>'
							+ '<p>' + formatTime(data[i]['end_time']) + '</p>'
							+ '<p>Title: ' + data[i]['title'] + '</p>'
							+ '<p>Description: ' + data[i]['description'] + '</p>'
							+ '<p>Total: ' + getTotal(data[i]['start_time'], data[i]['end_time']) + '</p>'
							+ '</div>');
					}
				}
			}
		});
	}

	/* Populates edit modal with values in the table */
	function populateModal(parent)
	{
		var title = $(parent).find('#title').text();
		var desc = $(parent).find('#desc').text();
		console.log('title ' + title);
		console.log('desc ' + desc);

		$('#edit_title').val(title);
		$('#edit_desc').val(desc);
	}

	/* Gets total hours worked for the current day */
	function getDayHours()
	{
		var now = new Date();
			$.ajax({
			type: 'GET',
			url: 'php/gethours.php',
			success: function(response){
				if(!response.indexOf("fail") > -1)
				{
					var data = JSON.parse(response);
					var i;
					var start;
					var stop;
					for(i=0; i < data.length; i++)
					{
						start = new Date().getTime(data[i]['start_time']);
						stop = new Date().getTime(data[i]['end_time']);
					}

					/* Update the progress bar in hours */
					var total_diff = stop - start;
					var diffHrs = Math.floor((total_diff % 86400000) / 3600000);
					console.log('Total hour diff ' + diffHrs);

					/* Calculate percentage in relation to 8 hours (max) */
					if(diffHrs != 0)
					{
						var m_width = (diffHrs / 8) * 100;
						$('.bar').css('width', m_width + '%').css('background', '#00FF7F');
						$('.bar').children().remove();
						$('#worked').text('You  have' + Math.round(diffHrs) + 'hours');
					}
					else
					{
						$('.bar').css('width', '0%').css('background', '#00FF7F');
						$('.bar').children().remove();
						$('#worked').text('You  have zero hours');
					}
				}
				else
				{
					console.log('An error occured');
				}
			},
		});	
	}

	/* Returns true if a user has created a time log for the current day */
	function checkItem()
	{
		$.ajax({
			type: 'GET',
			url: 'php/checkitem.php',
			success: function(response){
				console.log('check item response ' + JSON.parse(response));
				if(JSON.parse(response) == "success")
				{
					getItems();
				}
				if(JSON.parse(response) == "fail")
				{
					createDefaultItem();
					getItems();
				}
			},
		});	
	}

	/* Creates default timesheet data instance */
	function createDefaultItem()
	{
		$.ajax({
			type: 'POST',
			url: 'php/createitem.php',
			success: function(response){
				console.log('create default response ' + response);
				if(response == "success")
				{
					console.log("default item created");
				}
				if(response == "fail")
				{
					console.log("An error occured");
				}
			},
		});	
	}

	/* Retrieves timesheet data in the order: item_id, title, description, date, completed, start, end */
	function getItems()
	{
		$('#week_data').empty();
		$.ajax({
			type: 'GET',
			url: 'php/getitem.php',
			success: function(response){
				if(JSON.parse(response) != "fail")
				{
					var data = JSON.parse(response);
					console.log('RESPONSE ' + response);
					var i;
					for(i=0; i < data.length; i++)
					{
						$('#week_data').append('<tr id="cell" class="cell"><td class="id" id="item' + data[i]['id'] + '">' + (i + 1) + '</td>' +
												'<td id="title">' + data[i]['title'] + '</td>' +
												'<td id="desc">' + data[i]['description'] + '</td>' +
												'<td id="start_time">' + formatTime(data[i]['start_time']) + '</td>' +
												'<td id="end_time">' + formatTime(data[i]['end_time']) + '</td>' +
												'<td id="total_time">' + getTotal(data[i]['start_time'], data[i]['end_time']) + '</td>' + '</tr>');
					}
				}
			},
		});	
	}

/* DIGITAL TIME FUNCTIONS AND FORMAT TIME FUNCTIONS */

	function getTotal(s, e)
	{
		var diff = (new Date(e)) - (new Date(s));
		return formatTotalTime(diff);
	}

	/* Takes UTC month (int) and returns the month */
	function getFormattedMonth(month)
	{
		var formatted_month;
		var month_keys = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
		var month_values = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
		var i;
		for(i=0; i < month_keys.length; i++)
		{
			if(month == month_keys[i])
			{
				formatted_month = month_values[i];
			}
		}
		return formatted_month;
	}

	/* Converts seconds to hh:mm:ss */
	String.prototype.toHHMMSS = function () {
	    var sec_num = parseInt(this, 10); // don't forget the second param
	    var hours   = Math.floor(sec_num / 3600);
	    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	    var seconds = sec_num - (hours * 3600) - (minutes * 60);

	    if (hours   < 10) {hours   = "0"+hours;}
	    if (minutes < 10) {minutes = "0"+minutes;}
	    if (seconds < 10) {seconds = "0"+seconds;}
	    var time    = hours+':'+minutes+':'+seconds;
	    return time;
	}

	/* Takes the milliseconds since EPOCH and converts to seconds */
	function formatTotalTime(time)
	{
		var seconds = Math.round((time)/1000);
		var formatted_total_time = seconds.toString().toHHMMSS();
		return formatted_total_time;
	}

	/* Takes the milliseconds since EPOCH and converts to formatted time instance */
	function formatTime(time)
	{
		if(time == null || time == "null")
		{
			console.log('Times are null values');
			return "None"
		}
		else
		{

			var time = new Date(time);
			var hours = time.getHours();
			var minutes = time.getMinutes();
			var month = getFormattedMonth(time.getMonth());
			var day = time.getDate();
			var year = time.getFullYear();
			var seconds = time.getSeconds();
			var tod;

			if (minutes < 10) 
			{minutes = "0" + minutes;}

			if(hours > 12)
			{
				hours -= 12;
				tod = "pm";
			}
			else if(hours === 0)
			{
				hours = 12;
				tod = "am";
			}
			return month + ' ' + day + ', ' + year + '\n' + hours + ':' + minutes + ':' + seconds + ' ' + tod;
		}
	}

	/* Functions for running digital clock */
	function startTime() 
	{
	    var today = new Date();
	    var h=today.getHours();
	    var amp;

	    /* Format to non-military time */
	    if (h > 12) {
    		h -= 12;
    		amp = "pm";
		} else if (h === 0) {
   			h = 12;
   			amp = "am";
		}

	    var m=today.getMinutes();
	    var s=today.getSeconds();
	    m = checkTime(m);
	    s = checkTime(s);
	    document.getElementById('time_detail').innerHTML = h+":"+m+":"+s + " " + amp;
	    var t = setTimeout(function(){startTime()},500);
	}

	function checkTime(i) 
	{
	    if (i<10) {i = "0" + i}; 
	    return i;
	}
});