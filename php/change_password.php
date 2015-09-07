<?php
	include_once('db_connection.php');

	session_start();

	$new_password = $_POST['password'];

	if(isset($_SESSION['username']))
	{
		$old_username = $_SESSION['username'];

		if(isset($new_password))
		{
			if ($stmt = $mysqli->prepare("UPDATE members SET password = ? WHERE username = ? LIMIT 1")) 
			{
			    $stmt->bind_param('ss', $new_password, $old_username);
			    $stmt->execute();  
			    $stmt->store_result();

			    //force login after change
			    unset($_SESSION['username']);
			    header('Location: '. 'change_password_success.php');
			}
			else
			{
				echo "DATABASE ERROR: " . $mysqli->error;
				//Load the error page
				header('Location: '. 'error_page.php');

			}
		}
	}

?>