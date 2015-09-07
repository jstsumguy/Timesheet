<?php
session_start();

if(isset($_SESSION['username']))
{
	//User is no longer logged in
	unset($_SESSION['username']);
	echo(json_encode("success"));
}
else
{
	//User is not logged in
	echo(json_encode("fail"));
}
?>