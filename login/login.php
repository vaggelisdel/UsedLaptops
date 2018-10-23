<?php
require '../connection.php';
/* User login process, checks if user exists and password is correct */


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

	


$username = $connect->escape_string($_POST['username']);
$result = $connect->query("SELECT * FROM users WHERE `Username`='$username'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that username doesn't exist!";
    header("location: msg.php");
}
else { // User exists
    $user = $result->fetch_assoc();
	

    if ( password_verify($_POST['password'], $user['Password'])) {
		
        $_SESSION['userid'] = $user['UserID'];
		$_SESSION['username'] = $user['Username'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['phone'] = $user['Phone'];
        $_SESSION['active'] = $user['Active'];
		
        // This is how we'll know the user is logged in
		
		
		
		if ($_SESSION['active'] == 0){
			$_SESSION['message'] = "This account is inactive now. Check your email for activation link!";
			header("location: msg.php");
		}else{			
			$_SESSION['user_active'] = 1;
			header("location: ../index.php");
		}
		
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: msg.php");
    }
}

}