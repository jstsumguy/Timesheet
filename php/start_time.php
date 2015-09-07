<?php
	include_once('db_connection.php');
	/* type 1 = start, type 2 = stop  */
	date_default_timezone_set("America/New_York");
	session_start();

	$id = $_POST['id'];
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];

		if ($stmt = $mysqli->prepare("UPDATE work_item SET start_time = ? WHERE user_id = ? AND id = ? ")) 
		{
			$now = date('Y-m-d H:i:s');
		    $stmt->bind_param('sss', $now, $username, $id);
		    $stmt->execute();  
		    $stmt->store_result();
		    echo(json_encode("success"));
		}
	}
?>