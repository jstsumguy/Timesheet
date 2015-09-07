<?php
	include_once('db_connection.php');

	session_start();

	$filter = $_GET['filter'];
	//echo($filter);
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$fquery;
		if($filter == "Day")
		{
			$fquery = " = DATE(NOW())";
		}
		else if ($filter == "Week")
		{
			$fquery = " > ADDDATE(NOW(), INTERVAL -1 WEEK)";
		}
		else if ($filter == "Year")
		{
			$fquery = ">= DATE_SUB(NOW(),INTERVAL 1 YEAR)";
		}

		$query = "SELECT id, title, description, due_date, completed, start_time, end_time, total_time FROM work_item WHERE user_id = $user AND DATE(end_time) $fquery LIMIT 100";
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
			// echo(json_encode($data));
		}
	}
	else
	{
		json_encode("fail");
	}
	include_once('db_close.php');
?>