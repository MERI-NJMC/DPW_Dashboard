<?php
	
	require('dbConnection.php');
	$ip = ipCon();
	$uName = uName();
	$pwd = pwd();
	$dbName = dbName();
	$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
	if(isset($_POST['oid'])) {
		echo '<h1>Utility Approved! Please close this tab/window.</h1>';

		$query = 'SELECT * FROM `outfall_attributes` WHERE `facilityid` = "' .mysqli_real_escape_string($mysqli, $_POST['oid']). '";';
		$results =  mysqli_query($mysqli,$query);
		$row = mysqli_fetch_assoc($results);

		if($row != null) {
			$query = "UPDATE `outfall_attributes` SET  `facilityid` = '".mysqli_real_escape_string($mysqli, $_POST['oid'])."' , `WaterType` = 'null' , `OwnedBy` = '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality` = '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `LocationDescription` = '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , `Material` = '".mysqli_real_escape_string($mysqli, $_POST['material'])."' , `ReceivingWater` = '".mysqli_real_escape_string($mysqli, $_POST['recWater'])."' , `Diameter` = '".mysqli_real_escape_string($mysqli, $_POST['dia'])."' , `Comments` = '".mysqli_real_escape_string($mysqli, $_POST['comments'])."'  WHERE `facilityid`='".mysqli_real_escape_string($mysqli, $_POST['oid'])."' ;"; 
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		} else {
			$query = "INSERT INTO `outfall_attributes` (`facilityid`, `WaterType`, `OwnedBy`, `Municipality`, `LocationDescription`, `Material`, `ReceivingWater`, `Diameter`, `Comments`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['oid'])."','nul', '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."', '".mysqli_real_escape_string($mysqli, $_POST['muni'])."', '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."', '".mysqli_real_escape_string($mysqli, $_POST['material'])."', '".mysqli_real_escape_string($mysqli, $_POST['recWater'])."', '".mysqli_real_escape_string($mysqli, $_POST['dia'])."', '".mysqli_real_escape_string($mysqli, $_POST['comments'])."');"; 
			mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	} else {
		$form = '<form action="updateOutfall.php" method="POST">
					<h3>Outfall Approval Form</h3><br>
					Facility ID: <input type="text" name="oid" value="'.$_GET['oid'].'"><br>
					Owned By: <select name="ownedBy" id="ownedBy"><option value="'.$_GET['ownedBy'].'">'.$_GET['ownedBy'].'</option><option value="Municipality">Municipality</option><option value="County">County</option><option value="State">State</option><option value="Private">Private</option></select><br>
					Location Description: <input type="text" name="locDesc" value="'.$_GET['locDesc'].'"><br>
					Material: <select name="material" id="material"><option value="'.$_GET['material'].'">'.$_GET['material'].'</option><option value="Asbestos Concrete Pipe">Asbestos Concrete Pipe</option><option value="Cast Iron Pipe">Cast Iron Pipe</option><option value="Ductile Iron Pipe">Ductile Iron Pipe</option><option value="Reinforced Concrete Pipe">Reinforced Concrete Pipe</option><option value="Vitrified Clay Pipe">Vitrified Clay Pipe</option><option value="Unknown">Unknown</option><option value="Other">Other</option><option value="Polyvinyl Chloride">Polyvinyl Chloride</option><option value="High Density Polyethylene Pipe">High Density Polyethylene Pipe</option><option value="Corrugated Metal Pipe">Corrugated Metal Pipe</option><option value="Concrete Pipe">Concrete Pipe</option><option value="Concrete Cylinder Pipe">Concrete Cylinder Pipe</option><option value="Elliptical Corrugated Metal Pipe">Elliptical Corrugated Metal Pipe</option></select><br>
					Receiving Water: <input type="text" name="recWater" value="'.$_GET['recWater'].'"><br>
					Access Diameter (in): <input type="text" name="dia" value="'.$_GET['dia'].'"><br>
					Comments: <br><textarea name="comments" id="comments" cols="30" rows="10" style="height: 150px;">'.$_GET['comments'].'</textarea><br><br>
					<button type="submit">Approve</button>
				</form>';

		echo $form;
	}

?>