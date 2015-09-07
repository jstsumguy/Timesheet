<?php
	include_once('db_connection.php');
	/* type 1 = start, type 2 = stop  */
	date_default_timezone_set("America/New_York");
	session_start();
	if(isset($_SESSION['username']))
	{
		$success = false;
		$username = $_SESSION['username'];

		if ($stmt = $mysqli->prepare("UPDATE work_item SET end_time = ? WHERE user_id = ? ")) 
		{
			$now = date('Y-m-d H:i:s');
		    $stmt->bind_param('ss', $now, $username);
		    $stmt->execute();  
		    $stmt->store_result();
		    $success = true;
		}
		else
		{
			echo(json_encode("fail"));
		}
		// Get the start and end times and calculate the difference
		if($success == true)
		{
			// Update the total time diff 
			if ($stmt = $mysqli->prepare("SELECT ID, START_TIME, END_TIME FROM WORK_ITEM WHERE USER_ID =  ?")) 
			{
				$stmt->bind_param('s', $username);
			    $stmt->execute();  
			    $stmt->store_result();
			    $stmt->bind_result($id, $start, $end);
	    		$stmt->fetch();

	    		// Calculate the time diff
	    		$datetime1 = new DateTime($start);
				$datetime2 = new DateTime($end);
				$interval = date_diff($datetime2, $datetime1);
				$total = $interval->format('%H:%i:%s');

				if ($stmt = $mysqli->prepare("INSERT INTO time (total, work_id) VALUES( ?, ?)")) 
				{
			        $stmt->bind_param('ss', $total, $id);
			        $stmt->execute();
			        $stmt->store_result();
			 	    $stmt->fetch();
					echo(json_encode("success"));
			 	}
			 	else
			 	{
					echo(json_encode("update total fail"));	
			 	}
			}
		}
	}

?>