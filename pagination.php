<?php  
 //pagination.php  
require_once 'connection.php'; $record_per_page = 6;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }   
 $start_from = ($page - 1)*$record_per_page;  
 
 $query = "SELECT YEAR(ReleaseDate) AS ReleaseYear, ads.*, adimages.* FROM ads,adimages WHERE ads.UserID = adimages.UserID AND adimages.DefaultImage = 1 "; 
 if(isset($_POST["brand"]))  
 {  
      $brand = $_POST["brand"];  
	  $query .= "AND ads.Brand = '$brand' ";
 }
 if(isset($_POST["damage"]))  
 {  
      $damage = $_POST["damage"];  
	  $query .= "AND ads.Damage = '$damage' ";
 }
 if(isset($_POST["os"]))  
 {  
      $os = $_POST["os"];  
	  $query .= "AND ads.OperatingSystem = '$os' ";
 }
 if(isset($_POST["cores"]))  
 {  
      $cores = $_POST["cores"];  
	  $query .= "AND ads.CpuCores = '$cores' ";
 }
 if(isset($_POST["ram"]))  
 {  
      $ram = $_POST["ram"];  
	  $query .= "AND ads.RamSize = '$ram' ";
 }
 if(isset($_POST["fromsize"]))  
 {  
      $fromsize = $_POST["fromsize"];  
	  $query .= "AND ads.StorageSize >= '$fromsize' ";
 }
 if(isset($_POST["tosize"]))  
 {  
      $tosize = $_POST["tosize"];  
	  $query .= "AND ads.StorageSize <= '$tosize' ";
 }
 $query .="ORDER BY `LastUpdate` DESC LIMIT $start_from, $record_per_page"; 
 
 $result = mysqli_query($connect, $query);  
 
 
 
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
           <div class="col-lg-4">
					<a href="item.php?adid='.$row['AdID'].'&userid='.$row['UserID'].'" class="card">
						<img class="gallery-item" alt="'.$row["ImageDescription"].'" src="'.$row["ImagePath"].'"/>
						<div class="ad_info">
							<p>'.$row["Brand"].' '.$row["Model"].' ('.$row[("ReleaseYear")].')</p>
							<p>Damage: '.$row[("Damage")].'</p>
							<p>Price: '.$row[("Price")].'€</p>
						</div>
					</a>
				</div>  
      ';  
 }  
 $page_query = "SELECT YEAR(ReleaseDate) AS ReleaseYear, ads.*, adimages.* FROM ads,adimages WHERE ads.UserID = adimages.UserID AND adimages.DefaultImage = 1 ";  
 if(isset($_POST["brand"]))  
 {   
	  $page_query .= "AND ads.Brand = '$brand' ";
 }
 if(isset($_POST["damage"]))  
 {   
	  $page_query .= "AND ads.Damage = '$damage' ";
 }
 if(isset($_POST["os"]))  
 {   
	  $page_query .= "AND ads.OperatingSystem = '$os' ";
 }
 if(isset($_POST["cores"]))  
 {   
	  $page_query .= "AND ads.CpuCores = '$cores' ";
 }
 if(isset($_POST["ram"]))  
 {   
	  $page_query .= "AND ads.RamSize = '$ram' ";
 }
 if(isset($_POST["fromsize"]))  
 {   
	  $page_query .= "AND ads.StorageSize >= '$fromsize' ";
 }
 if(isset($_POST["tosize"]))  
 {   
	  $page_query .= "AND ads.StorageSize <= '$tosize' ";
 }
  $page_query .= "ORDER BY `LastUpdate` DESC";
  
 $page_result = mysqli_query($connect, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
 $output .= "<div class='col-lg-12 pagination_nums'>";
 for($i=1; $i<=$total_pages; $i++)  
 {  
	  if ($page == $i){
		  $output .= "<span class='pagination_link' style='' id='".$i."'>".$i."</span>";
	  }else{
		  $output .= "<span class='pagination_link' style='background:transparent;color:black;cursor:pointer;' id='".$i."'>".$i."</span>";
	  }
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?>