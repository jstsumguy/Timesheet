<?php
	include_once('db_connection.php');

	session_start();
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$query = "SELECT id FROM members WHERE m_id = $user LIMIT 100";
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

			$i;
			$e_id;
			$emp_data = array();

			for($i=0; $i < count($data); $i++)
			{
				$e_id = 0;
				$e_id = $data[$i]['id'];
				$query = "SELECT work_item.id, work_item.title, work_item.description, work_item.due_date,
				work_item.completed, work_item.start_time, work_item.end_time, work_item.user_id,
				work_item.total_time, work_item.updated_at, members.firstname, members.lastname
				FROM work_item 
				INNER JOIN members ON work_item.user_id = members.id WHERE members.id = $e_id";
				$result = mysqli_query($mysqli, $query);
				while($row = mysqli_fetch_assoc($result))
				{
					array_push($emp_data, $row);
				}
			}
			echo(json_encode($emp_data));
		}
	}
	else
	{
		json_encode("fail");
	}
	include_once('db_close.php');
?>