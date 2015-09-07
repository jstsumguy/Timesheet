<?php
	include_once('db_connection.php');
	session_start();
	date_default_timezone_set("America/New_York");

	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		if ($stmt = $mysqli->prepare("INSERT INTO work_item(title, description, user_id, due_date, updated_at) VALUES(?, ?, ?, ?, ?)")) 
		{
			$title = "Add a title";
			$description = "Add a description";
			$due_date = "NOW() - INTERVAL 7 DAY";
			$updated = date('Y-m-d H:i:s');


	        $stmt->bind_param('sssss', $title, $description, $username, $due_date, $updated);
	        $stmt->execute();
	        $stmt->store_result();
	 	    $stmt->fetch();
			echo(json_encode("success"));
	 	}
	 	else
	 	{
			echo(json_encode("fail"));	
	 	}
	}
?>