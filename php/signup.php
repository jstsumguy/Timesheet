<?php
include_once('db_connection.php');
	
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['radio']))
{
	$m_username = $_POST['username'];	
	$m_password = $_POST['password'];
	$m_radio = $_POST['radio'];
	$ut = 0;

	// User type 2
	if($m_radio == "ceo")
	{
		$ut = 2;
	}
	// User type 1
	else if($m_radio == "manager")
	{
		$ut = 1;
	}
	// User type 0
	else if($m_radio == "employee")
	{
		$ut = 0;
	}
	if ($stmt = $mysqli->prepare("INSERT INTO members(username, password, user_type) VALUES (?, ?, ?)")) 
	{
		/* ASA Encryption */
		$saltHash = password_hash($m_password, PASSWORD_BCRYPT);
        $stmt->bind_param('sss', $m_username, $saltHash, $ut);
        $stmt->execute();
        $stmt->store_result();
 	    $stmt->fetch();
 	    header('Location: '. 'signup_complete.php');
	}
	else
	{
		echo "fail";
	}
}
?>