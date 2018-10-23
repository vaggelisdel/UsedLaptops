<?php
require '../connection.php';
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
session_start();
	
$response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LeWUlcUAAAAAESmpZTxjwPrIgAsAmhnIqyCXoi3',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		$_SESSION['message'] = "You are a bot! Go away!";
		header("location: msg.php");
	} else if ($captcha_success->success==true) {
		
// Set session variables to be used on index.php page
$_SESSION['username'] = $_POST['username'];


// Escape all $_POST variables to protect against SQL injections
$username = $connect->escape_string($_POST['username']);
$email = $connect->escape_string($_POST['email']);
$phone = $connect->escape_string($_POST['phone']);
$password = $connect->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $connect->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that username already exists
$result = $connect->query("SELECT * FROM users WHERE `Username`='$username'") or die($connect->error());

// We know user username exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this username already exists!';
    header("location: msg.php");
    
}
else { // Username doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO `users` (`Username`,`Email`, `Password`, `Phone`, `Hash`) 
	                     VALUES ('$username', '$email', '$password', '$phone', '$hash');";
						 
	
						 

    // Add user to the database
    if ( $connect->query($sql) ){
		
	$result11 = $connect->query("SELECT * FROM users WHERE `Username`='$username' AND `Email`='$email'");
	$user11 = $result11->fetch_assoc();
	$_SESSION['userid'] = $user11['UserID'];
	$userid = $_SESSION['userid'];

		$domain = $_SERVER['SERVER_NAME'];
        $_SESSION['user_active'] = 0; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification';
        $message_body = '
        Hello '.$username.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://'.$domain.'/login/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

		$_SESSION['message'] = 'Activation link has sent to your email.';
        header("location: msg.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: msg.php");
    }

}

	}
