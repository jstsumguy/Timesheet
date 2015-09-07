<?php
	include_once('db_connection.php');
	/* type 1 = start, type 2 = stop  */
	date_default_timezone_set("America/New_York");
	session_start();
	$title = $_POST['title'];
	$description = $_POST['description'];
	$work_id = $_POST['id'];
	$completed = $_POST['checkbox'];
	//echo(var_dump($_POST));

	if(isset($_SESSION['username']))
	{
		if ($stmt = $mysqli->prepare("UPDATE work_item SET title = ?, description = ?, updated_at = NOW(), completed = ? WHERE id = ? ")) 
		{
		    $stmt->bind_param('ssss', $title, $description, $completed, $work_id);
		    $stmt->execute();  
		    $stmt->store_result();
		    header('Location: '. '../admin.php');
		    //echo("success");
		}
		else
		{
			echo('fail');
		}
	}
	include_once('db_close.php');
?>