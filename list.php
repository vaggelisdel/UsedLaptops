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

$query = $connect->query("SELECT DISTINCT `Brand` FROM ads GROUP BY `Brand` ASC");
$query1 = $connect->query("SELECT DISTINCT `CpuCores` FROM ads GROUP BY `CpuCores` ASC");
$query2 = $connect->query("SELECT DISTINCT `OperatingSystem` FROM ads GROUP BY `OperatingSystem` ASC");
$query3 = $connect->query("SELECT DISTINCT `RamSize` FROM ads GROUP BY `RamSize` ASC");

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

<link rel="stylesheet" href="css/jquery-ui.css">

<!-- //css files -->

<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body id="list_body">
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
	

<div class="col-sm-3 left_column" id="content">
	<form class="cf">
			<section class="plan cf">
				<h2>Brand:</h2>
				<select class="select_list" id="brand">
					<option selected disabled value="">--Select Brand--</option>
					<?php
					while($row = $query->fetch_assoc()) 
					{
						echo "<option value='".$row["Brand"]."'>".$row["Brand"]."</option>";
					}
					?>
				</select>
			</section>
			<section class="plan cf">
				<h2>Operating System:</h2>
				<select class="select_list" id="os">
					<option selected disabled value="">--Select OS--</option>
					<?php
					while($row = $query2->fetch_assoc()) 
					{
						echo "<option value='".$row["OperatingSystem"]."'>".$row["OperatingSystem"]."</option>";
					}
					?>
				</select>
			</section>
			<section class="plan cf">
				<h2>Cpu Cores:</h2>
				<select class="select_list" id="cores">
					<option selected disabled value="">--Select Cores--</option>
					<?php
					while($row = $query1->fetch_assoc()) 
					{
						echo "<option value='".$row["CpuCores"]."'>".$row["CpuCores"]." Cores</option>";
					}
					?>
				</select>
			</section>
			<section class="plan cf">
				<h2>Ram Size:</h2>
				<select class="select_list" id="ram">
					<option selected disabled value="">--Select Ram--</option>
					<?php
					while($row = $query3->fetch_assoc()) 
					{
						echo "<option value='".$row["RamSize"]."'>".$row["RamSize"]." GB</option>";
					}
					?>
				</select>
			</section>
			<section class="plan cf">
				<h2>Storage Size:</h2>
				
				<span class="storage_gb" id="fromsize"></span> - 
				<span class="storage_gb" id="tosize"></span>
				
				<div id="slider-range"></div>
				
			</section>
			<section class="plan cf">
				<h2>Damage:</h2>
				<input type="radio" name="radio1" id="damage_yes" value="yes"><label class="damage_yes-label four col" for="damage_yes">Yes</label>
				<input type="radio" name="radio1" id="damage_no" value="no"><label class="damage_no-label four col" for="damage_no">No</label>
			</section>
			<br>
			<input class="clear_filters" type="submit" id="clearall" value="Clear Filters"/>			
		</form>
</div>


<style>

</style>


<div class="col-sm-9 right_column">
    <div id="pagination_data">  
    </div>  
</div>





<!-- js-scripts -->	
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
	
	<script type="text/javascript" src="js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
	<script>  
 $(document).ready(function(){  
 
      pagination_load();  
	  
	 
	  
	  $("#damage_yes").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
	  });
	  $("#damage_no").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
	  });
	  $("#brand").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  $("#os").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  $("#cores").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  $("#ram").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  
	  
	  
	  $("#from_size").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  $("#to_size").change(function(){	
			var page = $('.pagination_link').attr("id");
			action(page);
      });
	  
	  
	  
	   $( function() {
		$( "#slider-range" ).slider({
		  range: true,
		  min: 0,
		  max: 2000,
		  values: [ 0, 1500 ],
		  slide: function( event, ui ) {
			document.getElementById('fromsize').innerHTML = ui.values[ 0 ] + ' GB';
			document.getElementById('tosize').innerHTML = ui.values[ 1 ] + ' GB';
			var page = $('.pagination_link').attr("id");
			action(page);
		}
		});
			document.getElementById('fromsize').innerHTML = $( "#slider-range" ).slider( "values", 0 ) + ' GB';
			document.getElementById('tosize').innerHTML = $( "#slider-range" ).slider( "values", 1 ) + ' GB';
			var page = $('.pagination_link').attr("id");
			action(page);
	  } );
	  
	  
	  
	  
function action(page){
	if(document.getElementById('damage_yes').checked) {
		var damage = $('#damage_yes').attr("value");
	}
	if(document.getElementById('damage_no').checked) {
		var damage = $('#damage_no').attr("value");
    }
	if(document.getElementById('brand').selectedIndex != 0){
		var brandid = document.getElementById("brand");
		var brand = brandid.options[brandid.selectedIndex].value;
	}
	if(document.getElementById('os').selectedIndex != 0){
		var osid = document.getElementById("os");
		var os = osid.options[osid.selectedIndex].value;
	}
	if(document.getElementById('cores').selectedIndex != 0){
		var coresid = document.getElementById("cores");
		var cores = coresid.options[coresid.selectedIndex].value;
	}
	if(document.getElementById('ram').selectedIndex != 0){
		var ramid = document.getElementById("ram");
		var ram = ramid.options[ramid.selectedIndex].value;
	}
	if(document.getElementById('fromsize').innerHTML != "") {
		var fromsize = document.getElementById('fromsize').innerHTML;
	}
	if(document.getElementById('tosize').innerHTML != "") {
		var tosize = document.getElementById('tosize').innerHTML;
	}
	
	pagination_load(page,damage,cores,brand,os,ram,fromsize,tosize);
}

	  
	  
	  
	  
	  
	  
	  
      function pagination_load(page,damage,cores,brand,os,ram,fromsize,tosize)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page, damage:damage, cores:cores, brand:brand, os:os, ram:ram, fromsize:fromsize ,tosize:tosize},  
                success:function(data){  
                     $('#pagination_data').html(data);  
                }  
           })  
      }  
	  
	  
	  
	    
	 $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");
		   action(page); 
      });
	  
	  
	  
	  
	  
       
 });  
 </script>
 

<!-- //js-scripts -->
</body>
</html>