<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$query = "SELECT id, end_time FROM work_item WHERE user_id = $user AND DATE(end_time) = CURDATE() LIMIT 1";
		$result = mysqli_query($mysqli, $query);

		if(!$result)
		{
			die('Database error');
		}
		else
		{
			$total_effected_rows = mysqli_num_rows($result);
			if($total_effected_rows <= 0)
			{
				echo(json_encode("fail"));
			}
			else
			{
				echo(json_encode("success"));
			}
		}
	}
	include_once('db_close.php');
?>