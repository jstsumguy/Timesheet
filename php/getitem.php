<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$query = "SELECT id, title, description, due_date, completed, start_time, end_time, total_time, updated_at FROM work_item WHERE user_id = $user AND updated_at > ADDDATE(NOW(), INTERVAL -1 WEEK) LIMIT 100";
		$result = mysqli_query($mysqli, $query);

		if(!$result)
		{
			die('Database error');
		}
		else
		{
			$data = array();
			while($row = mysqli_fetch_assoc($result))
			{
				array_push($data, $row);
			}
			echo(json_encode($data));
		}
	}
	else
	{
		json_encode("fail");
	}
	include_once('db_close.php');
?>