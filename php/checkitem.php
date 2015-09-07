<?php
	include_once('db_connection.php');
	session_start();

	if($_SESSION['username'])
	{
		$username = $_SESSION['username'];

		if ($stmt = $mysqli->prepare("SELECT id, title FROM work_item WHERE user_id = ? AND DATE(updated_at) = CURDATE() LIMIT 1")) 
		{
			// Work item has been created
		    $stmt->bind_param('s', $username);
		    $stmt->execute();  
		    $stmt->store_result();
		    $stmt->fetch();
		    if($stmt->num_rows == 1)
		    {
		    	echo(json_encode("success"));
		    }
		    else
		    {
		    	echo(json_encode("fail"));	
		    }
		}
	}
	else
	{
		// Work item has not yet been created
		echo(json_encode("fail"));
	}
?>