<?php
	require('dbConnection.php');
	$ip = ipCon();
	$uName = uName();
	$pwd = pwd();
	$dbName = dbName();
	$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
	
	if(isset($_POST['slid'])) {
		echo '<h1>Utility Approved! Please close this tab/window.</h1>';
		$query = 'SELECT * FROM `stormline_attributes` WHERE `FacilityID` = "' .mysqli_real_escape_string($mysqli, $_POST['slid']). '";';
		$results =  mysqli_query($mysqli,$query);
		$row = mysqli_fetch_assoc($results);

		if($row != null) {
			$query = "UPDATE `stormline_attributes` SET  `FacilityID` = '".mysqli_real_escape_string($mysqli, $_POST['slid'])."' , `OwnedBy` = '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality` = '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `Material` = '".mysqli_real_escape_string($mysqli, $_POST['material'])."' , `CrossSectionShape` = '".mysqli_real_escape_string($mysqli, $_POST['css'])."' , `Diameter` = '".mysqli_real_escape_string($mysqli, $_POST['dia'])."' , `Height` = '".mysqli_real_escape_string($mysqli, $_POST['height'])."' , `Width` = '".mysqli_real_escape_string($mysqli, $_POST['width'])."', `UpStreamInvert` = '".mysqli_real_escape_string($mysqli, $_POST['usi'])."', `DownStreamInvert` = '".mysqli_real_escape_string($mysqli, $_POST['dsi'])."'  WHERE `FacilityID`='".mysqli_real_escape_string($mysqli, $_POST['slid'])."' ;"; 
			mysqli_query($mysqli, $query) or die("0");
		} else {
			var_dump($_POST);
			$query = "INSERT INTO `stormline_attributes` (`FacilityID`, `OwnedBy`, `Municipality`, `Material`, `CrossSectionShape`, `Diameter`, `Height`, `Width`, `UpStreamInvert`, `DownStreamInvert`) VALUES ('". mysqli_real_escape_string($mysqli, $_POST['slid']) ."','". mysqli_real_escape_string($mysqli, $_POST['ownedBy']) ."','". mysqli_real_escape_string($mysqli, $_POST['muni']) ."','". mysqli_real_escape_string($mysqli, $_POST['material']) ."','". mysqli_real_escape_string($mysqli, $_POST['css']) ."','". mysqli_real_escape_string($mysqli, $_POST['dia']) ."','". mysqli_real_escape_string($mysqli, $_POST['height']) ."','". mysqli_real_escape_string($mysqli, $_POST['width']) ."','". mysqli_real_escape_string($mysqli, $_POST['usi']) ."','". mysqli_real_escape_string($mysqli, $_POST['dsi']) ."');";
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	} else {
		$form = '<form action="updateSline.php" method="POST">
					<h3>Stormline Approval Form</h3><br>
					Facility ID: <input type="text" name="slid" value="'.$_GET['slid'].'"><br>
					Municipality: <input type="text" name="muni" value="'.$_GET['muni'].'"><br>
					Material: <input type="text" name="material" value="'.$_GET['material'].'"><br>
					Cross Section Shape: <input type="text" name="css" value="'.$_GET['css'].'"><br>
					Access Diameter (in): <input type="text" name="dia" value="'.$_GET['dia'].'"><br>
					Height (ft): <input type="text" name="height" value="'.$_GET['height'].'"><br>
					Width (ft): <input type="text" name="width" value="'.$_GET['width'].'"><br>
					Upstream Invert (ft): <input type="text" name="usi" value="'.$_GET['usi'].'"><br>
					Downstream Invert (ft): <input type="text" name="dsi" value="'.$_GET['dsi'].'"><br>
					<button type="submit">Approve</button>


				</form>';
		echo $form;
	}

?>