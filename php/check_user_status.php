<?php
	//If the username is not set (user is not logged in), then return a failure
	session_start();
	if(!isset($_SESSION['username']))
	{
		echo(json_encode("fail"));
	}
	else
	{
		echo(json_encode("success"));
	}
?>