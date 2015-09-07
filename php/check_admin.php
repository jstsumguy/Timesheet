<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$query = "SELECT user_type FROM members WHERE id = $user LIMIT 1";
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