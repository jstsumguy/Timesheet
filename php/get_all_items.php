<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		if ($stmt = $mysqli->prepare("SELECT id, title, description, due_date, completed, start_time, end_time FROM work_item WHERE user_id = ?")) 
		{
		    $stmt->bind_param('s', $username);
		    $stmt->execute(); 
		    $results = $stmt->get_result();

    		while ($row = $results->fetch_array(MYSQLI_NUM))
    		{
    			$data = array('id' => $row[0], 'title' => $row[1], 'desc' => $row[2], 'date' => $row[3], 'complete' => $row[4], 'start' => $row[5], 'end' => $row[6]);
    			echo(json_encode($data));	
    		}
		}
		else
		{
			echo(json_encode("fail"));
		}
	}
	else
	{
		echo(json_encode("session not set"));
	}
?>