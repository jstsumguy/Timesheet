<?php
	include_once('db_connection.php')
	/* type 1 = start, type 2 = stop  */
	session_start();
	if($_SESSIOSN['username'])
	{
		$username = $_SESSIOSN['username'];
	}

	if($_POST['type'] == 1)
	{
		if ($stmt = $mysqli->prepare("INSERT INTO work_item (start_time) VALUES(DATE_FORMAT(NOW(),'%d %b %Y %T:%f')) WHERE user_id = ? ON DUPLICATE KEY UPDATE start_time = VALUES (DATE_FORMAT(NOW(),'%d %b %Y %T:%f'))")) 
		{
		    $stmt->bind_param('s', $username);
		    $stmt->execute();  
		    $stmt->store_result();
		    echo(json_encode("success"));
		}
		else
		{
		    echo(json_encode("SQL ERROR"));
		}
	}
	else if($_POST['type'] == 2)
	{
		if ($stmt = $mysqli->prepare("INSERT INTO work_item (end_time) VALUES(DATE_FORMAT(NOW(),'%d %b %Y %T:%f')) WHERE user_id = ? ON DUPLICATE KEY UPDATE end_time = VALUES (DATE_FORMAT(NOW(),'%d %b %Y %T:%f'))")) 
		{
		    $stmt->bind_param('s', $username);
		    $stmt->execute();  
		    $stmt->store_result();
		    echo(json_encode("success"));
		}
		else
		{
		    echo(json_encode("SQL ERROR"));
		}
	}
	else
	{
		echo "An unknown error occured";
	}
?>