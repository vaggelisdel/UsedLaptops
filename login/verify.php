<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
require '../connection.php';
session_name("session3");
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $connect->escape_string($_GET['email']); 
    $hash = $connect->escape_string($_GET['hash']); 
    
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $connect->query("SELECT * FROM users WHERE `Email`='$email' AND `Hash`='$hash' AND `Active`='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: msg.php");
    }
    else {        
        // Set the user status to active (active = 1)
        $connect->query("UPDATE users SET `Active`='1' WHERE `Email`='$email'") or die($connect->error);
        $_SESSION['active'] = 1;
        
		 $_SESSION['message'] = "Your account has been activated successfully!";
        header("location: msg.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: msg.php");
}     
?>