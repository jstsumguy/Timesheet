<?php
	include_once('db_connection.php');
	
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		if ($stmt = $mysqli->prepare("SELECT title, description, due_date, start_time, end_time FROM work_item WHERE user_id = ? LIMIT 1")) 
		{
		    $stmt->bind_param('s', $username);
		    $stmt->execute();  
		    $stmt->store_result();

		    $stmt->bind_result($title, $desciption, $due_date, $start, $end);
		    $stmt->fetch();
		    if($stmt->num_rows == 1)
	    	{
	    		echo(json_encode($title, $desciption, $due_date, $start, $end));
	    	}
	    	else
	    	{
	    		echo(json_encode("fail"));
	    	}
		}
	}
?>