<?php
	require('dbConnection.php');
	$ip = ipCon();
	$uName = uName();
	$pwd = pwd();
	$dbName = dbName();
	$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
	
	if(isset($_POST['slid'])) {
		$query = 'SELECT * FROM `stormline_attributes` WHERE `FacilityID` = "' .mysqli_real_escape_string($mysqli, $_POST['slid']). '";';
		$results =  mysqli_query($mysqli,$query);
		$row = mysqli_fetch_assoc($results);

		if($row != null) {
			$query = "UPDATE `stormline_attributes` SET  `FacilityID` = '".mysqli_real_escape_string($mysqli, $_POST['slid'])."' , `OwnedBy` = '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality` = '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `Material` = '".mysqli_real_escape_string($mysqli, $_POST['material'])."' , `CrossSectionShape` = '".mysqli_real_escape_string($mysqli, $_POST['css'])."' , `Diameter` = '".mysqli_real_escape_string($mysqli, $_POST['dia'])."' , `Height` = '".mysqli_real_escape_string($mysqli, $_POST['height'])."' , `Width` = '".mysqli_real_escape_string($mysqli, $_POST['width'])."', `UpStreamInvert` = '".mysqli_real_escape_string($mysqli, $_POST['usi'])."', `DownStreamInvert` = '".mysqli_real_escape_string($mysqli, $_POST['dsi'])."'  WHERE `FacilityID`='".mysqli_real_escape_string($mysqli, $_POST['slid'])."' ;"; 
			mysqli_query($mysqli, $query) or die("0");
			echo "1";
		} else {
			var_dump($_POST);
			$query = "INSERT INTO `stormline_attributes` (`FacilityID`, `OwnedBy`, `Municipality`, `Material`, `CrossSectionShape`, `Diameter`, `Height`, `Width`, `UpStreamInvert`, `DownStreamInvert`) VALUES ('". mysqli_real_escape_string($mysqli, $_POST['slid']) ."','". mysqli_real_escape_string($mysqli, $_POST['ownedBy']) ."','". mysqli_real_escape_string($mysqli, $_POST['muni']) ."','". mysqli_real_escape_string($mysqli, $_POST['material']) ."','". mysqli_real_escape_string($mysqli, $_POST['css']) ."','". mysqli_real_escape_string($mysqli, $_POST['dia']) ."','". mysqli_real_escape_string($mysqli, $_POST['height']) ."','". mysqli_real_escape_string($mysqli, $_POST['width']) ."','". mysqli_real_escape_string($mysqli, $_POST['usi']) ."','". mysqli_real_escape_string($mysqli, $_POST['dsi']) ."');";
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			echo mysqli_error($mysqli);
		}
	}

?>