<?php
require '../connection.php';
session_name("session3");
session_start();

if (isset($_POST['create_ad_btn'])) {
	
	$userid = $_POST["userid"];
	$brand = $_POST["brand"];
	$model = $_POST["model"];
	$model_cpu = $_POST["model_cpu"];
	$cores_cpu = $_POST["cores_cpu"];
	$frequency_cpu = $_POST["frequency_cpu"];
	$ram_size = $_POST["ram_size"];
	$storage_size = $_POST["storage_size"];
	$damage = $_POST["damage"];
	$os = $_POST["os"];
	$price = $_POST["price"];
	$release_date = $_POST["release_date"];
	
	$sql = "INSERT INTO `ads` (`UserID`,`Brand`,`Model`,`CpuModel`,`CpuCores`,`CpuFrequency`,`RamSize`,`StorageSize`,`Damage`,`OperatingSystem`,`Price`,`ReleaseDate`)
						VALUES ('$userid','$brand','$model','$model_cpu','$cores_cpu','$frequency_cpu','$ram_size','$storage_size','$damage','$os','$price','$release_date');";
	$connect->query($sql);
	
	$sql = "UPDATE `users` SET `NumOfAds` = 1 WHERE `UserID` = '$userid';";
	$connect->query($sql);
		
	$_SESSION["msg_success"] = "New Ad Created Successfully!";
	header("location: create.php");
	
}
	
	
	
	if (isset($_POST['save_info_btn'])) {
	
	$userid = $_POST["userid"];
	$brand = $_POST["brand"];
	$model = $_POST["model"];
	$model_cpu = $_POST["model_cpu"];
	$cores_cpu = $_POST["cores_cpu"];
	$frequency_cpu = $_POST["frequency_cpu"];
	$ram_size = $_POST["ram_size"];
	$storage_size = $_POST["storage_size"];
	$damage = $_POST["damage"];
	$os = $_POST["os"];
	$price = $_POST["price"];
	$release_date = $_POST["release_date"];
	
	$sql = "UPDATE `ads` SET `Brand` = '$brand',`Model` = '$model',`CpuModel` = '$model_cpu',`CpuCores` = '$cores_cpu',`CpuFrequency` = '$frequency_cpu',`RamSize` = '$ram_size',`StorageSize` = '$storage_size',`Damage` = '$damage',`OperatingSystem` = '$os',`Price` = '$price',`ReleaseDate` = '$release_date' WHERE `UserID` = '$userid';";
	$connect->query($sql);
		
	$_SESSION["msg_success"] = "Ad Updated Successfully!";
	header("location: create.php");
	
}
	

	
if (isset($_POST['addnewad'])) {
	
$userid = $_POST["userid"];
$imgdescription = $_POST["imgdescription"];
	
$file = $_FILES['file'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 204800) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = '../images/items/'.$fileNameNew;
				$filedest = 'images/items/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$result = $connect->query("INSERT INTO `adimages` (`UserID`, `ImagePath`, `ImageDescription`) VALUES ('$userid', '$filedest', '$imgdescription');");
			} else {
				$_SESSION["msg_warning"] = "Your file is too big!";
			}
		} else {
			$_SESSION["msg_warning"] = "There was an error uploading your file!";
		}
	} else {
		$_SESSION["msg_warning"] = "You cannot upload files of this type!";
	}
	
	
	$query = $connect->query("SELECT * FROM adimages WHERE `UserID` ='$userid' AND `DefaultImage` = '1';");		
	$numberOfRows = mysqli_num_rows($query);
			
	if ($numberOfRows == 0){
		$result = $connect->query("UPDATE adimages SET `DefaultImage` = '1' WHERE UserID = '$userid';");		
	}
	
	$_SESSION["msg_success"] = "Image Uploaded!";
	header("location: create.php");
	
}



if (isset($_POST['deleteimg'])) {
	
	$imageid = $_POST["imageid"];
	$imagepath = "../".$_POST["imagepath"];
	$result1 = $connect->query("DELETE FROM adimages WHERE `ImageID`='$imageid';");
	unlink ($imagepath);
	$_SESSION["msg_success"] = "Image Deleted!";
	header("location: create.php");
	
}


if (isset($_POST['defaultimg'])) {
	$imageid = $_POST["imageid"];
	$userid = $_POST["userid"];
	$sql = "UPDATE `adimages` SET `DefaultImage` = '0' WHERE `UserID` = '$userid';";
	$connect->query($sql);
	$sql = "UPDATE `adimages` SET `DefaultImage` = '1' WHERE `ImageID` = '$imageid';";
	$connect->query($sql);
	
	$_SESSION["msg_success"] = "Default Image Chanhed Successfully!";
	header("location: create.php");
}
