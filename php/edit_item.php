<?php
	include_once('db_connection.php');
	/* type 1 = start, type 2 = stop  */
	date_default_timezone_set("America/New_York");
	session_start();
	$title = $_POST['title'];
	$description = $_POST['description'];
	$work_id = $_POST['id'];

	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];

		if ($stmt = $mysqli->prepare("UPDATE work_item SET title = ?, description = ?, updated_at = ? 
			WHERE user_id = ? AND id = ? ")) 
		{
			$now = date('Y-m-d H:i:s');
		    $stmt->bind_param('sssss', $title, $description, $now, $username, $work_id);
		    $stmt->execute();  
		    $stmt->store_result();
		    header('Location: '. '../timesheet.php');
		}
	}
?>