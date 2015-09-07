<?php
	include_once('db_connection.php');

	session_start();
	$first = $_POST['first'];
	$last = $_POST['last'];

	if(isset($_SESSION['username']))
	{
		$user_id = $_SESSION['username'];

		if ($stmt = $mysqli->prepare("UPDATE members SET firstname = ?, lastname = ? WHERE id = ? ")) 
		{
		    $stmt->bind_param('sss', $first, $last, $user_id);
		    $stmt->execute();  
		    $stmt->store_result();
		    header('Location: '. '../settings.php');
		}
		else
		{
			echo "DATABASE ERROR: " . $mysqli->error;
			//header('Location: '. 'error_page.php');
		}
	}
	include_once('db_close.php');
?>