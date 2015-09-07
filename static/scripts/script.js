$(document).ready(function(){
	//console.log('document ready');
	var url = document.URL;
	var admin;
	$('#logout_button').hide();
	
	//Display current page
	if(url.indexOf("/") > -1)
	{
		$('#home').addClass('active');
		$('#profile').removeClass('active');
		$('#about').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#contact').removeClass('active');
		$('#settings').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("profile") > -1)
	{
		$('#profile').addClass('active');
		$('#about').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#contact').removeClass('active');
		$('#home').removeClass('active');
		$('#settings').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("timesheet") > -1)
	{

		$('#timesheet').addClass('active');
		$('#profile').removeClass('active');
		$('#about').removeClass('active');
		$('#contact').removeClass('active');
		$('#home').removeClass('active');
		$('#settings').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("settings") > -1)
	{
		$('#settings').addClass('active');
		$('#profile').removeClass('active');
		$('#about').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#contact').removeClass('active');
		$('#home').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("about") > -1)
	{
		$('#about').addClass('active');
		$('#profile').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#contact').removeClass('active');
		$('#home').removeClass('active');
		$('#settings').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("contact") > -1)
	{
		$('#contact').addClass('active');
		$('#profile').removeClass('active');
		$('#about').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#home').removeClass('active');
		$('#settings').removeClass('active');
		$('#admin').removeClass('active');
	}
	if(url.indexOf("admin") > -1)
	{
		$('#admin').addClass('active');
		$('#contact').removeClass('active');
		$('#profile').removeClass('active');
		$('#about').removeClass('active');
		$('#timesheet').removeClass('active');
		$('#home').removeClass('active');
		$('#settings').removeClass('active');
	}

/* LOGIN STATUS CHECK */
	$.ajax({
		type: 'GET', 
		url: 'php/check_user_status.php',
		success: function(data)
		{
			if(JSON.parse(data) == "fail")
			{
				$('#admin').css('display', 'none');
				logged_in = false;
				$('#login_button').removeClass('btn-danger');
				$('#login_button').removeClass('btn-success');
				$('#login_button').addClass('btn-danger');
				
				console.log("user is not logged in");
				// Pages in which user must be logge in, in order to see
				var secure_pages = ['timesheet', 'profile', 'settings'];
				
				console.log("URL: " + url);
				if(url.indexOf('index') > -1)
				{
					console.log("index loaded");
				}
				else if(url.indexOf(secure_pages[0]) > -1)
				{
					console.log("Must be logged in to view this page");
					window.location.replace('index.php');
				}
				else if(url.indexOf(secure_pages[1]) > -1)
				{
					console.log("Must be logged in to view this page");
					window.location.replace('index.php');
				}
				else if(url.indexOf(secure_pages[2]) > -1)
				{
					console.log("Must be logged in to view this page");
					window.location.replace('index.php');
				}
			}
			else
			{
				logged_in = true;
				console.log("user is logged in");
				$('#logout_button').show();
				$('#login_button').hide();
				$('#login_button').removeClass('btn-danger');
				$('#login_button').addClass('btn-success');
				checkAdmin();
			}
		}
	});//ajax end

/* LOGOUT SCRIPT */
	$('#logout_form').submit(function(){
		$.ajax({
			type: 'GET', 
			url: 'php/logout.php',
			success: function(data)
			{
				console.log("LOGOUT RESPONSE: " + data);
				if(JSON.parse(data) == "success")
				{
					logged_in = true;
					console.log("USER IS LOGGED OUT");
					$('#login_button').removeClass('btn-danger');
					$('#login_button').removeClass('btn-success');
					$('#login_button').addClass('btn-danger');
				}
			}
		});
	});

/* CHECK IF USER IS ADMIN */
function checkAdmin()
{
	$.ajax({
		type: 'post',
		url: 'php/check_admin.php',
		success: function(response){
			var data = JSON.parse(response);
			u_t = data[0]['user_type'];
			// Type 1 == Manager, Type 2 == CEO
			if(u_t == 1 || u_t == 2)
			{
				admin = true;
				$('#admin').css('display', 'block');
			}
			else
			{
				admin = false;
			}
			console.log('admin status ' + admin);
		},
	});
}

});









