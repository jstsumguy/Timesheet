<?php

include_once('glb_conf.php');

//Login start
function login($email, $password, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        $stmt->bind_result($user_id, $username, $db_password);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        //$password = hash('sha512', $password);
        if ($stmt->num_rows == 1) {
 
            if (checkbrute($user_id, $mysqli) == true) {
                return false;
            } else {
                
                if ($db_password == $password) {
      
                    return true;
                } else {
                    // Password is not correct
                    // Log attempts
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}

//Returns true or false if user has exceeded maximum login attempts
function checkbrute($user_id, $mysqli) {
    $now = time();
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
 
        //Located in global config file
        if ($stmt->num_rows > ALLOWED_FAILURES) {
            return true;
        } else {
            return false;
        }
    }
}


?>







