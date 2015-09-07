<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$query = "SELECT start_time, end_time FROM work_item WHERE user_id = $user LIMIT 100";
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
				$data = array();
				while($row = mysqli_fetch_assoc($result))
				{
					array_push($data, $row);
				}
				echo(json_encode($data));
			}
			else
			{
				echo(json_encode("fail"));
			}
		}
	}
	else
	{
		echo(json_encode("fail"));
	}
	include_once('db_close.php');
?>