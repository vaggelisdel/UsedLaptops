<?php
/* Password reset process, updates database with new user password */
require '../connection.php';
session_name("session3");
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $connect->escape_string($_POST['email']);
        $hash = $connect->escape_string($_POST['hash']);
        
        $sql = "UPDATE users SET `Password`='$new_password', `Hash`='$hash' WHERE `Email`='$email'";

        if ( $connect->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: msg.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: msg.php");    
    }

}
?>