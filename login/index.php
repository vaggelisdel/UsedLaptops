<?php
require_once '../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


if ($_SESSION['user_active'] == 1){
	header( "location: ../index.php" );
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
<title>Login - Register</title>
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
<body>
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
							<li><a href="" class="hvr-underline-from-center" data-toggle="modal" data-target="#personalize"><i class="fa fa-gear personilize_icon"></i> Styles</a></li>
						</ul>
					</div>

					<div class="clearfix"> </div>	
				</nav>
	
	</div>
	
<?php 
foreach ($_POST as $key => $value) {
    echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
  }
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}

?>
	
	
<div class="callbacks_container">


<!-- Modal -->
  <div class="modal fade" id="personalize" role="dialog">
    <div class="modal-dialog personilize_modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose your style</h4>
        </div>
        <div class="modal-body modal_body_imgs">
			<div class="templatebox">
			<a href="../styles.php?style=1">
				<img src="../images/template1.jpg" class="img_style" alt="style1"/>
			</a>
				<div>
						<?php
							if ($selected == "1"){
								echo "<i class='fa fa-star change_style'></i>";
							}else{
								echo "<i class='fa fa-star-o change_style'></i>";
							}
						?>
				</div>
			</div>
          <div class="templatebox">
		  <a href="../styles.php?style=2">
				<img src="../images/template2.jpg" class="img_style" alt="style2"/>
			</a>
				<div>
						<?php
							if ($selected == "2"){
								echo "<i class='fa fa-star change_style'></i>";
							}else{
								echo "<i class='fa fa-star-o change_style'></i>";
							}
						?>
				</div>
			</div>
        </div>
      </div>
      
    </div>
  </div>



				<div class="w3layouts-banner-top w3layouts-banner-top1">
						<div class="container">
							<div class="form">
							  
							  <ul class="tab-group">
							  <li class="tab active"><a href="#login">Log In</a></li>
								<li class="tab"><a href="#signup">Sign Up</a></li>
							  </ul>
							  
							  <div class="tab-content">

								 <div id="login">   
								  <h1>Welcome To UsedLaptops!</h1>
								  
								  <form action="index.php" method="post" autocomplete="off">
								  
									<div class="field-wrap">
									<input type="text" required autocomplete="on" name="username" placeholder="Username*"/>
								  </div>
								  
								  <div class="field-wrap">
									<input type="password" required autocomplete="off" name="password" placeholder="Password*" pattern="[a-zA-Z0-9._]{10,}$" 
										   title="Must contain only numbers, uppercase and lowercase letters, underscore and at least 10 or more characters"/>
								  </div>
								  
								  <div class="field-wrap">
									<center><div class="g-recaptcha" data-sitekey="6LeWUlcUAAAAABFBqkFKwEMHKzyb4w15Ecxp1tdU"></div></center>
								  </div>
								  
								  
								  
								  <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
								  
								  <button class="button button-block" name="login" />Log In</button>
										  
								  </form>

								</div>
								  
								<div id="signup">   
								  <h1>Sign Up Here</h1>
								  
								  <form action="index.php" method="post" autocomplete="off">

								  <div class="field-wrap">
									  
									  <input type="text" required autocomplete="off" name='username'placeholder="Username*"/>
									</div>
								  
								  <div class="field-wrap">
									<input type="email" required autocomplete="off" name='email' placeholder="Email*"/>
								  </div>
								  
								  <div class="field-wrap">
									<input type="text" required autocomplete="off" name='phone' placeholder="Phone*"/>
								  </div>
								  
								  <div class="field-wrap">
									<input type="password" required autocomplete="off" name='password' placeholder="Set a Password*" pattern="[a-zA-Z0-9._]{10,}$" 
										   title="Must contain only numbers, uppercase and lowercase letters, underscore and at least 10 or more characters"/>
								  </div>
								  
								  <div class="field-wrap">
									<center><div class="g-recaptcha" data-sitekey="6LeWUlcUAAAAABFBqkFKwEMHKzyb4w15Ecxp1tdU"></div></center>
								  </div>
								  
								  
								  <button type="submit" id="register_btn" class="button button-block" name="register" />Register</button>
								  <div id="data">
								  </div>
								  </form>

								</div>  
								
							  </div><!-- tab-content -->
							  
							</div> <!-- /form -->
		
						</div>
				</div>
</div>


<!-- js-scripts -->					

	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
	<script type="text/javascript" src="../js/index.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- //js-scripts -->
</body>
</html>