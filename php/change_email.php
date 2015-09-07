<?php
	include_once('db_connection.php');

	session_start();

	$new_email = $_POST['change_email'];

	if(isset($_SESSION['username']))
	{
		//Username is email
		$old_username = $_SESSION['username'];
		echo(var_dump($_SESSION));

		if(isset($new_email))
		{
			echo "out of query";
			if ($stmt = $mysqli->prepare("UPDATE members SET username = ? WHERE username = ? LIMIT 1")) 
			{
				echo "in query";
			    $stmt->bind_param('ss', $new_email, $old_username);
			    $stmt->execute();  
			    $stmt->store_result();

			    //force login after change
			    unset($_SESSION['username']);
			    header('Location: '. 'change_email_success.php');
			}
			else
			{
				echo "DATABASE ERROR: " . $mysqli->error;
				//Load the error page
				header('Location: '. 'error_page.php');

			}
		}
	}
	include_once('db_close.php');
?>