<?php
	include_once('db_connection.php');

if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];	
	$password = $_POST['password'];

	if ($stmt = $mysqli->prepare("SELECT id, username, password FROM members WHERE username = ? LIMIT 1")) 
	{
	    $stmt->bind_param('s', $username);
	    $stmt->execute();  
	    $stmt->store_result();

	    $stmt->bind_result($user_id, $dbusername, $db_password);
	    $stmt->fetch();

	    if($stmt->num_rows == 1)
	    {
	    	if(password_verify($password, $db_password))
	    	{
	    		session_start();
        		$_SESSION['username'] = $user_id;
        		header('Location: '. '../index.php');
	    	}
	    	else
	    	{
	    		if ($stmt = $mysqli->prepare("INSERT INTO  login_attempts (user_id) VALUES(?) "))
	    		{
					$stmt->bind_param('s', $user_id);
	    			$stmt->execute();  
					header('Location: '. '../index.php');
				}
	    	}
	    }
	}
}
else
{
	echo("Username and password not set");
}

	include_once('db_close.php');
?>