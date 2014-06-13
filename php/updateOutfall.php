<?php
	
	require('dbConnection.php');
	$ip = ipCon();
	$uName = uName();
	$pwd = pwd();
	$dbName = dbName();
	$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
	if(isset($_POST['oid'])) {
		$query = 'SELECT * FROM `outfall_attributes` WHERE `facilityid` = "' .mysqli_real_escape_string($mysqli, $_POST['oid']). '";';
		$results =  mysqli_query($mysqli,$query);
		$row = mysqli_fetch_assoc($results);

		if($row != null) {
			$query = "UPDATE `outfall_attributes` SET  `FacilityID` = '".mysqli_real_escape_string($mysqli, $_POST['oid'])."' , `WaterType` = 'null' , `OwnedBy` = '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality` = '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `LocationDescription` = '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , `Material` = '".mysqli_real_escape_string($mysqli, $_POST['material'])."' , `ReceivingWater` = '".mysqli_real_escape_string($mysqli, $_POST['recWater'])."' , `Diameter` = '".mysqli_real_escape_string($mysqli, $_POST['dia'])."' , `Comments` = '".mysqli_real_escape_string($mysqli, $_POST['comments'])."'  WHERE `facilityid`='".mysqli_real_escape_string($mysqli, $_POST['oid'])."' ;"; 
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			echo mysqli_error($mysqli);
		} else {
			$query = "INSERT INTO `utilities`.`outfall_attributes` (`FacilityID`, `WaterType`, `OwnedBy`, `Municipality`, `LocationDescription`, `Material`, `ReceivingWater`, `Diameter`, `Comments`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['oid'])."','nul', '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."', '".mysqli_real_escape_string($mysqli, $_POST['muni'])."', '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."', '".mysqli_real_escape_string($mysqli, $_POST['material'])."', '".mysqli_real_escape_string($mysqli, $_POST['recWater'])."', '".mysqli_real_escape_string($mysqli, $_POST['dia'])."', '".mysqli_real_escape_string($mysqli, $_POST['comments'])."');"; 
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			echo mysqli_error($mysqli);
		}
	}

?>