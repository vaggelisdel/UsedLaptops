<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require '../connection.php';
session_name("session3");
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $connect->escape_string($_GET['email']); 
    $hash = $connect->escape_string($_GET['hash']); 

    // Make sure user email with matching hash exist
    $result = $connect->query("SELECT * FROM users WHERE `Email`='$email' AND `Hash`='$hash'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: msg.php");
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: msg.php");  
}

	if ($_COOKIE['mystyle'] == 2){
		$style="style2.css";
		$selected = "2";
	}else{
		$selected = "1";
		$style="style.css";
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Password</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transporters web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web Designs" />

<!--// Meta tag Keywords -->

<!-- css files -->
<link rel="stylesheet" href="../css/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="../css/<?php echo $style; ?>" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="../css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->

<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body id="msg_body">
<div class="header">
		<nav class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a href="../index.php">UsedLaptops</a></h1>
					</div>
					<div class="top-nav-text">
						<div class="nav-contact-w3ls">

						</div> 
					</div>
					<!-- navbar-header -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a class="hvr-underline-from-center active" href="../index.php">Home</a></li>
							<li><a href="../list.php" class="hvr-underline-from-center">List</a></li>
						</ul>
					</div>

					<div class="clearfix"> </div>	
				</nav>
	
	</div>
	
						<center>
							<div class="msg_box resetbox">
								<p>Choose Your New Password</p><br>
          
							  <form action="reset_password.php" method="post">
								  
							  <div class="field-wrap">
								<input type="password"required name="newpassword" autocomplete="off" placeholder="New Password  *"/>
							  </div>
								  
							  <div class="field-wrap">
								<input type="password"required name="confirmpassword" autocomplete="off" placeholder="Confirm New Password  *"/>
							  </div>
							  
							  <!-- This input field is needed, to get the email of the user -->
							  <input type="hidden" name="email" value="<?= $email ?>">    
							  <input type="hidden" name="hash" value="<?= $hash ?>">    
								  
							  <button class="button button-block"/>Apply</button>
							  
							  </form>
							</div>
						</center>

<!-- js-scripts -->					
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<!-- //js-scripts -->
</body>
</html>