<?php 

require('dbConnection.php');
$ip = ipCon();
$uName = uName();
$pwd = pwd();
$dbName = dbName();
$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
if(isset($_POST['mid'])) {
	
	$query = 'SELECT * FROM `man_attributes` WHERE `facilityid` = "' .mysqli_real_escape_string($mysqli, $_POST['mid']). '";';
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	var_dump($row);
	
	if($row != null) {
		$query = "UPDATE `man_attributes` SET `address`= '".mysqli_real_escape_string($mysqli, $_POST['address'])."', `topRimEl`= '".mysqli_real_escape_string($mysqli, $_POST['topRimEl'])."' , `condition`= '".mysqli_real_escape_string($mysqli, $_POST['condition'])."' , `WaterType`= 'null' , `ownedBy`= '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality`= '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `LocationDescription`= '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , `AccessDiameter`= '".mysqli_real_escape_string($mysqli, $_POST['accDia'])."' , `AccessType`= '".mysqli_real_escape_string($mysqli, $_POST['accType'])."' , `GroundType`= '".mysqli_real_escape_string($mysqli, $_POST['groundType'])."' , `HighPipeElevation`= '".mysqli_real_escape_string($mysqli, $_POST['hpe'])."' , `RimElevation`= '".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."' , `InvertElevation`= '".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."' , `ManholeDrop`= '".mysqli_real_escape_string($mysqli, $_POST['manholeDrop'])."' , `InteriorDrop`= '".mysqli_real_escape_string($mysqli, $_POST['interDrop'])."' , `WallMaterial`= '".mysqli_real_escape_string($mysqli, $_POST['wallMat'])."' , `StructuralShape`= '".mysqli_real_escape_string($mysqli, $_POST['structShape'])."' , `ManholeType`= '".mysqli_real_escape_string($mysqli, $_POST['manholeType'])."' , `Metered`= '".mysqli_real_escape_string($mysqli, $_POST['metered'])."' , `Comments`= '".mysqli_real_escape_string($mysqli, $_POST['comments'])."' WHERE `facilityid`='".mysqli_real_escape_string($mysqli, $_POST['mid'])."' ;";
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		echo "1";

	} else {
		$query = "INSERT INTO `utilities`.`man_attributes` (`facilityid`, `address`, `topRimEl`, `condition`, `WaterType`, `OwnedBy`, `Municipality`, `LocationDescription`, `AccessDiameter`, `AccessType`, `GroundType`, `HighPipeElevation`, `RimElevation`, `InvertElevation`, `ManholeDrop`, `InteriorDrop`, `WallMaterial`, `StructuralShape`, `ManholeType`, `Metered`, `Comments`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['mid'])."','".mysqli_real_escape_string($mysqli, $_POST['address'])."','".mysqli_real_escape_string($mysqli, $_POST['topRimEl'])."', '".mysqli_real_escape_string($mysqli, $_POST['condition'])."', 'null', '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."', '".mysqli_real_escape_string($mysqli, $_POST['muni'])."', '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."', '".mysqli_real_escape_string($mysqli, $_POST['accDia'])."', '".mysqli_real_escape_string($mysqli, $_POST['accType'])."', '".mysqli_real_escape_string($mysqli, $_POST['groundType'])."', '".mysqli_real_escape_string($mysqli, $_POST['hpe'])."', '".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."', '".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."', '".mysqli_real_escape_string($mysqli, $_POST['manholeDrop'])."','".mysqli_real_escape_string($mysqli, $_POST['interDrop'])."', '".mysqli_real_escape_string($mysqli, $_POST['wallMat'])."', '".mysqli_real_escape_string($mysqli, $_POST['structShape'])."', '".mysqli_real_escape_string($mysqli, $_POST['manholeType'])."', '".mysqli_real_escape_string($mysqli, $_POST['metered'])."', '".mysqli_real_escape_string($mysqli, $_POST['comments'])."');"; 
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		echo "1";
	}


}
?>