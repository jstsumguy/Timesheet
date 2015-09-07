$(document).ready(function(){

/* STARTUP SCRIPTS  */
	$.ajax({
		type: 'get',
		url: 'php/getadmin.php',
		success: function(response){
			var data = JSON.parse(response);
			var i;
			for(i=0; i < data.length; i++)
			{
				$('#employees').append('<tr id="cell" class="cell"><td class="id" id="item' + data[i]['id'] + '">' + (i + 1) + '</td>' +
												'<td id="title">' + data[i]['title'] + '</td>' +
												'<td id="desc">' + data[i]['description'] + '</td>' +
												'<td id="completed">' + data[i]['completed'] + '</td>' +
												'<td id="start_time">' + formatTime(data[i]['start_time']) + '</td>' +
												'<td id="end_time">' + formatTime(data[i]['end_time']) + '</td>' +
												'<td id="total_time">' + getTotal(data[i]['start_time'], data[i]['end_time']) + '</td>' +
												'<td id="firstname">' + data[i]['firstname'] + '</td>' +
												'<td id="lastname">' + data[i]['lastname'] + '</td>' + '</tr>');
			}
		}
	});

	setTimeout(function() {
		var comps = $('#completed');
		var i;
		$('#employees tr').each(function() {
			if($(this).find('#completed').text() == "null")
			{
				$(this).find('#completed').text("In progress");
			}
		});

	}, 500);

	/* EDIT MODAL FUNCTIONS */
	$('#week_details_table').on('mouseover', 'tbody tr', function(event) {
		$(this).css('cursor', 'pointer');
	});

	$('#week_details_table').on('click', 'tbody tr', function(event) {
		work_id = $(this).children().first().attr('id').substring(4);
		$('#work_id').val(work_id);
		var parent = $(this);
		console.log('id ' + work_id);
		if($(this).find('#completed').text() != "null" && $(this).find('#completed').text() != "In progress")
		{
			$('#check').css('display', 'none');
		}
		else
		{
			$('#check').css('display', 'block');
		}
		$('#edit_cell_modal').modal('show');
		populateModal(parent);
	});

	$('#week_details_table').on('mouseover', 'tbody tr:odd', function(event) {
		$(this).css('color', 'white');
	});

	$('#week_details_table').on('mouseout', 'tbody tr:odd', function(event) {
		$(this).css('color', 'black');
	});

	/* Populates edit modal with values in the table */
	function populateModal(parent)
	{
		var title = $(parent).find('#title').text();
		var desc = $(parent).find('#desc').text();

		$('#edit_title').val(title);
		$('#edit_desc').val(desc);
	}

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

	function checkTime(i) 
	{
	    if (i<10) {i = "0" + i}; 
	    return i;
	}

});//document end