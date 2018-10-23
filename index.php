<?php
require_once 'connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_active'] == 1){
	$username = $_SESSION["username"];
}

	if ($_COOKIE['mystyle'] == 2){
		$style="style2.css";
		$selected = "2";
	}else{
		$selected = "1";
		$style="style.css";
	}

	
	$query = $connect->query("SELECT ads.*, adimages.* FROM ads, adimages WHERE ads.UserID = adimages.UserID AND DefaultImage = 1 ORDER BY AdID DESC LIMIT 3");
			
	$result = $connect->query("SELECT count(*) as totalads FROM ads");
	$ads = $result->fetch_assoc();	
	
	$result1 = $connect->query("SELECT count(*) as totalusers FROM users");
	$users = $result1->fetch_assoc();		
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>UsedLaptops</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transporters web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web Designs" />

<!--// Meta tag Keywords -->

<!-- css files -->
<link rel="stylesheet" href="css/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="css/<?php echo $style; ?>" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
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
						<h1><a href="index.php">UsedLaptops</a></h1>
					</div>
					<div class="top-nav-text">
						<div class="nav-contact-w3ls">
						
						<?php
							if ( $_SESSION['user_active'] == 0 ) {
						?>
							<button class="login_btn" onclick="location.href='login'">Login/Register</button>
						<?php 
							}else{
						?>
						<div class="dropdown">
						  <button class="login_btn_1"><?= $username; ?> &nbsp; <i class="fa fa-chevron-circle-down" id="icodrpodn"></i></button>
						  <div class="dropdown-content">
							<a href="login/logout.php">Logout</a>
						  </div>
						</div>
						<?php 
							} 
						?>
						
						</div> 
					</div>
					<!-- navbar-header -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a class="hvr-underline-from-center active" href="index.php">Home</a></li>
							<li><a href="list.php" class="hvr-underline-from-center">List</a></li>
							<?php
							if ( $_SESSION['user_active'] == 1 ) {
						?>
							<li><a href="dashboard/create.php" class="hvr-underline-from-center">Dashboard</a></li>
						<?php 
							}
						?>
							<li><a href="" class="hvr-underline-from-center" data-toggle="modal" data-target="#personalize"><i class="fa fa-gear personilize_icon"></i> Styles</a></li>
						</ul>
					</div>

					<div class="clearfix"> </div>	
				</nav>
	
	</div>

<div class="slider">
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
			<a href="styles.php?style=1">
				<img src="images/template1.jpg" class="img_style" alt="style1"/>
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
		  <a href="styles.php?style=2">
				<img src="images/template2.jpg" class="img_style" alt="style2"/>
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
  
</div>
	
	
				<div class="w3layouts-banner-top w3layouts-banner-top1">
					<div class="banner-dott">
					<div class="container">
						<div class="slider-info">
							<div class="col-md-7 slogan_index">
								<h2>Sell & Buy laptops now with</h2>
								<h4>UsedLaptops</h4>
								<div class="w3ls-button">
									<a href="list.php">Click Here to find our stuff!</a>
								</div>
								
							</div>
							
							<div class="col-md-4 bannerbottomright">
								<h3>How Does We Work?</h3>
								<p>In this website you can buy or sell a laptop from a big stuff in few steps!</p>
								<h4><i class="fa fa-user-plus" aria-hidden="true"></i>Register in the website.</h4>
								<h4><i class="fa fa-file" aria-hidden="true"></i>Complete a form to make an ad.</h4>
								<h4><i class="fa fa-info" aria-hidden="true"></i>Add more details about your laptop.</h4>
								<h4><i class="fa fa-money" aria-hidden="true"></i>When you find a client you sell it.</h4>
							</div>
							
						</div>
					</div>
					</div>
				</div>
			
	</div>
	<div class="clearfix"></div>
</div>

<!-- our blog -->
<section class="blog" id="blog">
	<div class="container">
		<div class="heading">
			<h3>Latest Added Laptops</h3>
		</div>
		<div class="blog-grids">
		<?php
			while($r = $query->fetch_assoc()) 
			{
		?>
			<div class="col-md-4 blog-grid">
			<a href="item.php?adid=<?= $r["AdID"]; ?>&userid=<?= $r["UserID"]; ?>" target="blank"><img src="<?= $r["ImagePath"]; ?>" alt="" /></a>
			<center>
				<h4><a href="item.php?adid=<?= $r["AdID"]; ?>&userid=<?= $r["UserID"]; ?>" target="blank"><?= $r['Brand']; ?> <?= $r['Model']; ?></a></h4>
				<p>Damage: <span style="text-transform:capitalize;"><?= $r['Damage']; ?></span></p>
				<p>Price: <?= $r['Price']; ?>€</p>
				<p>Release Date: <?= $r['ReleaseDate']; ?></p>
				<div class="readmore-w3">
					<a class="readmore" href="item.php?adid=<?= $r["AdID"]; ?>&userid=<?= $r["UserID"]; ?>" target="blank">View Details</a>
				</div>
			</center>
		</div>
		<?php
			}
		?>
		<div class="clearfix"></div>
		</div>
	</div>
</section>
<!-- //our blog -->




<!-- Counter -->
	<div class="col-md-12 services-bottom">
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="fa fa-laptop" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter"><?php echo $ads["totalads"];?></p> 
					<h3>Total Laptops</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="fa fa-users" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter"><?php echo $users["totalusers"];?></p> 
					<h3>Total Users</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
	</div>
			<div class="clearfix"> </div>
<!-- //Counter -->

<!-- team -->
<center>
	<div class="team" id="team">
		<div class="container">
				<div class="col-md-3 wthree_team_grid">
					<div class="hovereffect">
						<img src="images/myprofile.jpg" alt=" " class="img-responsive" />
						<div class="overlay">
							<div class="rotate">
								<p class="group1">
									<a href="http://www.twitter.com">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="https://www.facebook.com/profile.php?id=1639508668">
										<i class="fa fa-facebook"></i>
									</a>
								</p>
									<hr>
									<hr>
								<p class="group2">
									<a href="http://www.instagram.com">
										<i class="fa fa-instagram"></i>
									</a>
									<a href="http://www.dribbble.com">
										<i class="fa fa-dribbble"></i>
									</a>
								</p>
							</div>
						</div>
					</div>
					<h4>Vaggelis Dellios</h4>
					<p>Undergraduate Student</p>
				</div>
				<div class="clearfix"> </div>
		</div>
	</div>
</center>
<!-- //team -->


<!-- footer -->
	<footer>
		<div class="agileits-w3layouts-footer">
			<div class="container">
				<div class="col-md-6 w3-agile-grid">
					<h5>About Us</h5>
					<p>This site is a web-based platform that you can add your used laptop to find someone that want to buy it.</p>
				</div>
				
				<div class="col-md-6 w3-agile-grid">
					<h5>Address</h5>
					<div class="w3-address">
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Email Address</h6>
								<p>Email :<a href="mailto:example@email.com"> cs4415035@teilar.gr</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Location</h6>
								<p> TEI of Thessaly, Periferiakos Larisas, Larisa 413 34 
								</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<p>© 2018 UsedLaptops. All rights reserved | Created by Vaggelis Dellios</a></p>
			</div>
		</div>
	</footer>
	<!-- //footer -->



<!-- js-scripts -->					

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 




<!-- Stats-Number-Scroller-Animation-JavaScript -->
				<script src="js/waypoints.min.js"></script> 
				<script src="js/counterup.min.js"></script> 
				<script>
					jQuery(document).ready(function( $ ) {
						$('.counter').counterUp({
							delay: 100,
							time: 1000
						});
					});
				</script>
<!-- //Stats-Number-Scroller-Animation-JavaScript -->

<!-- //js-scripts -->
</body>
</html>