<?php
require_once 'connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


if ($_SESSION['user_active'] == 1){
	$username = $_SESSION["username"];
	$userid = $_SESSION["userid"];
}

if ($_COOKIE['mystyle'] == 2){
		$style="style2.css";
		$selected = "2";
	}else{
		$selected = "1";
		$style="style.css";
	}

if(isset($_GET['adid']) || isset($_GET['userid'])) {
	$adid = $connect->escape_string($_GET['adid']);
	$userid = $connect->escape_string($_GET['userid']);
	
	$result = $connect->query("SELECT * FROM users WHERE `UserID` ='$userid';");
	$user = $result->fetch_assoc();
	
	$result1 = $connect->query("SELECT YEAR(ReleaseDate) AS ReleaseYear, DATE(LastUpdate) AS LastUpdateDate, ads.* FROM ads WHERE `AdID` ='$adid'");
	$ad = $result1->fetch_assoc();
	
	$result2 = $connect->query("SELECT * FROM adimages WHERE `UserID` ='$userid' AND `DefaultImage` = '1';");
	$defaultimg = $result2->fetch_assoc();
}else{
	header("index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Ad</title>
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
						  <button class="login_btn_1"><?= $username; ?> <i class="fa fa-chevron-circle-down" id="icodrpodn"></i></button>
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


<div class="main_column">

<p id="lastupdate">Last Update: &nbsp;<?= $ad['LastUpdateDate'] ?></p><br>

<div class="item_header">
<img class="defaultimg_item" src="<?= $defaultimg['ImagePath'] ?>">

	<div class="basic_info">
		<h1><?= $ad['Brand']; ?> <?= $ad['Model']; ?> (<?= $ad['ReleaseYear']; ?>)&nbsp; <?= $ad["Price"]; ?>€</h1>
		<p>Seller Name:&nbsp; <?= $user['Username'] ?></p>
		<p>Seller Phone:&nbsp; <?= $user['Phone'] ?></p>
		<p>Seller Email:&nbsp; <?= $user['Email'] ?></p>
	</div>
	
</div>
	
<br><br><br>

<center>


<table class="info_table">
<h2>Item Features:</h2><br><br>
  <tr>
    <td>Brand:</td>
    <td><?= $ad["Brand"]; ?></td>
  </tr>
  <tr>
    <td>Model:</td>
    <td><?= $ad["Model"]; ?></td>
  </tr>
  <tr>
    <td>Cpu Model:</td>
    <td><?= $ad["CpuModel"]; ?></td>
  </tr>
  <tr>
    <td>Cpu Cores:</td>
    <td><?= $ad["CpuCores"]; ?></td>
  </tr>
  <tr>
    <td>Cpu Frequency:</td>
    <td><?= $ad["CpuFrequency"]; ?> Ghz</td>
  </tr>
  <tr>
    <td>Ram Size:</td>
    <td><?= $ad["RamSize"]; ?> GB</td>
  </tr>
  <tr>
    <td>Storage Size:</td>
    <td><?= $ad["StorageSize"]; ?> GB</td>
  </tr> 
  <tr>
    <td>Damage:</td>
    <td style="text-transform:capitalize;"><?= $ad["Damage"]; ?></td>
  </tr> 
  <tr>
    <td>Operating System:</td>
    <td><?= $ad["OperatingSystem"]; ?></td>
  </tr> 
  <tr>
    <td>Release Date:</td>
    <td><?= $ad["ReleaseDate"]; ?></td>
  </tr>
</table>

</center>


<br><br><br>

<center>
<h2>Item Images:</h2><br>
</center>
<br>

<?php
			$query = $connect->query("SELECT * FROM adimages WHERE `UserID` ='$userid'");
			
			while($r = $query->fetch_assoc()) 
			{
				
				if ($r["DefaultImage"] == 1){
					continue;
				}		
?>
				
				<div class="col-lg-3 imgitem">
					<img class="gallery-item" alt="<?= $r["ImageDescription"]; ?>" src="<?= $r["ImagePath"]; ?>"/>							
				</div>
				
<?php
			}
?>

	
</div>






		
		
		
		
		
		
		
		
		

		






<!-- js-scripts -->					

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
	
<!-- //js-scripts -->
</body>
</html>