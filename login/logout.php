<?php
/* Log out process, unsets and destroys session variables */
require '../connection.php';
session_name("session3");
session_start();
$_SESSION['user_active'] = 0;
session_destroy();

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
<title>Logout User</title>
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
							<div class="msg_box">
								<p>You have been logged out!</p>     
								<center><a href="index.php"><button class="button button-block returnhome"/>Return Back</button></a></center>
							</div>
						</center>

<!-- js-scripts -->					
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<!-- //js-scripts -->
</body>
</html>
