<?php
require_once '../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


if ($_SESSION['user_active'] == 0){
	header( "location: ../index.php" );
	exit();
}else{
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

$result = $connect->query("SELECT * FROM users WHERE `UserID`='$userid'");
$user = $result->fetch_assoc();

$result = $connect->query("SELECT * FROM ads WHERE `UserID`='$userid'");
$ads = $result->fetch_assoc();

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
						
						<?php
							if ( $_SESSION['user_active'] == 0 ) {
						?>
							<button class="login_btn" onclick="location.href='../login'">Login/Register</button>
						<?php 
							}else{
						?>
						<div class="dropdown">
						  <button class="login_btn_1"><?= $username; ?> <i class="fa fa-chevron-circle-down" id="icodrpodn"></i></button>
						  <div class="dropdown-content">
							<a href="../login/logout.php">Logout</a>
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
							<li><a class="hvr-underline-from-center active" href="../index.php">Home</a></li>
							<li><a href="../list.php" class="hvr-underline-from-center">List</a></li>	
							<?php
							if ( $_SESSION['user_active'] == 1 ) {
						?>
							<li><a href="create.php" class="hvr-underline-from-center">Dashboard</a></li>
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
	
	
	<center>
	<?php 
		if( isset($_SESSION['msg_warning']) AND !empty($_SESSION['msg_warning']) ){
	?>
	<div class="alert alert-danger messages" role="alert">
		<strong>Warning!!</strong> <?= $_SESSION["msg_warning"]; ?>
	</div>
	<?php
	$_SESSION["msg_warning"] = "";
		}elseif ( isset($_SESSION['msg_success']) AND !empty($_SESSION['msg_success']) ){
	?>
	<div class="alert alert-success messages" role="alert">
		<strong>Success!!</strong> <?= $_SESSION["msg_success"]; ?>
	</div>
	<?php
	$_SESSION["msg_success"] = "";
		}
	?>
	</center>
	
	
	
	
	
<form action="create_actions.php" method="post">		
		
		<input type="hidden" name="userid" value="<?= $userid; ?>"/>
		
			<div class="form">
				<div class="field col-sm-6">
					<p style="color:white;">Brand:</p>
					<input required name="brand" type="text" value="<?= $ads["Brand"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">Model:</p>
					<input required name="model" type="text" value="<?= $ads["Model"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">CPU Model:</p>
					<input required name="model_cpu" type="text" value="<?= $ads["CpuModel"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">CPU Cores:</p>
					<input required name="cores_cpu" type="number" min="0" max="20" value="<?= $ads["CpuCores"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">CPU Frequency (Ghz):</p>
					<input required name="frequency_cpu" type="number" step='0.1' min="0" max="10" value="<?= $ads["CpuFrequency"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">RAM Size (GB):</p>
					<input required name="ram_size" type="number" min="0" value="<?= $ads["RamSize"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">Storage Size (GB):</p>
					<input required name="storage_size" type="number" min="0" value="<?= $ads["StorageSize"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
				<p style="color:white;">Damage:</p>
					<select class="select_form" required name="damage">
					<?php if ($ads["Damage"] == "yes"){
					?>
						<option disabled name="" value="">--Select--</option>
						<option selected name="damage" value="yes">Yes</option>
						<option name="damage" value="no">No</option>
					<?php }elseif ($ads["Damage"] == "no"){
					?>
						<option disabled name="" value="">--Select--</option>
						<option name="damage" value="yes">Yes</option>
						<option selected name="damage" value="no">No</option>
					<?php }else{
					?>
						<option selected disabled name="" value="">--Select--</option>
						<option name="damage" value="yes">Yes</option>
						<option name="damage" value="no">No</option>
					<?php
					}
					?>
					</select><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">Operating System:</p>
					<input required name="os" type="text" value="<?= $ads["OperatingSystem"] ?>"/><br>
				</div>
				
				<div class="field col-sm-6">
					<p style="color:white;">Price (€):</p>
					<input required name="price" type="number" step='0.1' min="0" value="<?= $ads["Price"] ?>"/><br>
				</div>
			
				<div class="field col-sm-6">
					<p style="color:white;">Release Date:</p>
					<input required name="release_date" type="date" value="<?= $ads["ReleaseDate"] ?>"/><br>
				</div>
				
				
				<div class="field col-sm-6">
					<p style="color:white;">Last Update:</p>
					<input disabled name="last_update" type="text"  value="<?= $ads["LastUpdate"] ?>"/><br>
				</div>
				
				<br>
				
				<?php
					if ($user["NumOfAds"] == 0){
				?>
					<button id="create_ad_btn" name="create_ad_btn" class="btn btn-danger">Create Ad</button>		
				<?php
					}else{
				?>
					<button id="save_info_btn" name="save_info_btn" class="btn btn-danger">Save Changes</button>
				<?php
					}
				?>
			</div>

</form>		
		
		
<form action="create_actions.php" method="post" enctype="multipart/form-data">		
		
<div class="callbacks_container">

			<div class="form">
				<p style="color:white;">Max. File size: 200Kb</p>
				<p style="color:white;">Only .jpg format</p>
                <input type="hidden" name="userid" value="<?= $userid; ?>"/>        
				<input required class="uploadform" type="file" name="file"><br>
				<textarea class="textarea-ad" required name="imgdescription" type="text" placeholder="Description*"></textarea><br>
				<button id="addnewad" name="addnewad" class="btn btn-danger">Upload</button>		
						
				
			</div>
</div>

</form>


		<?php
			$query = $connect->query("SELECT * FROM adimages WHERE `UserID` ='$userid'");
			
			while($r = $query->fetch_assoc()) 
			{
				
				
		?>
				
			<form action="create_actions.php" method="post">		
				<div class="col-sm-3 image-item">
					<img class="gallery-item" alt="<?= $r["ImageDescription"]; ?>" src="../<?= $r["ImagePath"]; ?>"/>
					<input type="hidden" name="imageid" value="<?= $r["ImageID"]; ?>"/>
					<input type="hidden" name="imagepath" value="<?= $r["ImagePath"]; ?>"/>
					<input type="hidden" name="userid" value="<?= $userid; ?>"/>
					<br>
					<button class="btn-danger" id="deleteimg" name="deleteimg">Delete</button>
					
					<?php 
						if ($r["DefaultImage"] == 1){
					?>
						<button disabled type="button" id="defaultimg" name="defaultimg"><i class="fa fa-star"></i></button>
					<?php 
						}else{
					?>
						<button id="defaultimg" name="defaultimg"><i class="fa fa-star-o"></i></button>
					<?php 
						} 
					?>
					
				</div>
			</form>
				
		<?php
			}
		?>






<!-- js-scripts -->					

	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 

	<script>
	setTimeout(function() {
		$('.alert').fadeOut(1000);
	}, 4000);
	</script>
	
<!-- //js-scripts -->
</body>
</html>