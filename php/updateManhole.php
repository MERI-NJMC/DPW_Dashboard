<?php 

require('dbConnection.php');
$ip = ipCon();
$uName = uName();
$pwd = pwd();
$dbName = dbName();
$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
if(isset($_POST['mid'])) {
	echo '<h1>Utility Approved! Please close this tab/window.</h1>';

	$query = 'SELECT * FROM `man_attributes` WHERE `facilityid` = "' .mysqli_real_escape_string($mysqli, $_POST['mid']). '";';
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	
	if($row != null) {
		$query = "UPDATE `man_attributes` SET `address`= '".mysqli_real_escape_string($mysqli, $_POST['address'])."', `topRimEl`= 'null' , `condition`= '".mysqli_real_escape_string($mysqli, $_POST['condition'])."' , `WaterType`= 'null' , `ownedBy`= '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality`= '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `LocationDescription`= '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , `AccessDiameter`= '".mysqli_real_escape_string($mysqli, $_POST['accDia'])."' , `AccessType`= '".mysqli_real_escape_string($mysqli, $_POST['accType'])."' , `GroundType`= '".mysqli_real_escape_string($mysqli, $_POST['groundType'])."' , `HighPipeElevation`= '".mysqli_real_escape_string($mysqli, $_POST['hpe'])."' , `RimElevation`= '".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."' , `InvertElevation`= '".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."' , `ManholeDrop`= '".mysqli_real_escape_string($mysqli, $_POST['manholeDrop'])."' , `InteriorDrop`= '".mysqli_real_escape_string($mysqli, $_POST['interDrop'])."' , `WallMaterial`= '".mysqli_real_escape_string($mysqli, $_POST['wallMat'])."' , `StructuralShape`= '".mysqli_real_escape_string($mysqli, $_POST['structShape'])."' , `ManholeType`= '".mysqli_real_escape_string($mysqli, $_POST['manholeType'])."' , `Metered`= '".mysqli_real_escape_string($mysqli, $_POST['metered'])."' , `Comments`= '".mysqli_real_escape_string($mysqli, $_POST['comments'])."' WHERE `facilityid`='".mysqli_real_escape_string($mysqli, $_POST['mid'])."' ;";
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	} else {
		$query = "INSERT INTO `man_attributes` (`facilityid`, `address`, `topRimEl`, `condition`, `WaterType`, `OwnedBy`, `Municipality`, `LocationDescription`, `AccessDiameter`, `AccessType`, `GroundType`, `HighPipeElevation`, `RimElevation`, `InvertElevation`, `ManholeDrop`, `InteriorDrop`, `WallMaterial`, `StructuralShape`, `ManholeType`, `Metered`, `Comments`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['mid'])."','".mysqli_real_escape_string($mysqli, $_POST['address'])."','null', '".mysqli_real_escape_string($mysqli, $_POST['condition'])."', 'null', '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."', '".mysqli_real_escape_string($mysqli, $_POST['muni'])."', '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."', '".mysqli_real_escape_string($mysqli, $_POST['accDia'])."', '".mysqli_real_escape_string($mysqli, $_POST['accType'])."', '".mysqli_real_escape_string($mysqli, $_POST['groundType'])."', '".mysqli_real_escape_string($mysqli, $_POST['hpe'])."', '".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."', '".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."', '".mysqli_real_escape_string($mysqli, $_POST['manholeDrop'])."','".mysqli_real_escape_string($mysqli, $_POST['interDrop'])."', '".mysqli_real_escape_string($mysqli, $_POST['wallMat'])."', '".mysqli_real_escape_string($mysqli, $_POST['structShape'])."', '".mysqli_real_escape_string($mysqli, $_POST['manholeType'])."', '".mysqli_real_escape_string($mysqli, $_POST['metered'])."', '".mysqli_real_escape_string($mysqli, $_POST['comments'])."');"; 
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}


} else {
	if($_GET['metered']==0) {
		$metered = 'False';
	} else {
		$meterd = 'True';
	}

	$form = '<form action="updateManhole.php" method="POST">
				<h3>Stormwater Manhole Approval Form</h3><br>
				Facility ID: <input type="text" name="mid" value="'.$_GET['mid'].'"><br>
				Address: <input type="text" name="address" value="'.$_GET['address'].'"><br>
				Rim Elivation (ft): <input type="text" name="rimEl" value="'.$_GET['rimEl'].'"><br>
				Condition: <select name="condition" id="condition"><option value="'.$_GET['condition'].'">'.$_GET['condition'].'</option><option value="Good">Good</option><option value="Poor">Poor</option><option value="Needs Maintenance">Needs Maintenance</option></select><br>
				Owned By: <select name="ownedBy" id="ownedBy"><option value="'.$_GET['ownedBy'].'">'.$_GET['ownedBy'].'</option><option value="Municipality">Municipality</option><option value="County">County</option><option value="State">State</option><option value="Private">Private</option></select><br>
				Municipality: <input type="text" name="muni" value="'.$_GET['muni'].'"><br>
				Location Description: <input type="text" name="locDesc" value="'.$_GET['locDesc'].'"><br>
				Access Diameter (in): <input type="text" name="accDia" value="'.$_GET['accDia'].'"><br>
				Access Type: <select name="accType" id="accType"><option value="'.$_GET['accType'].'">'.$_GET['accType'].'</option><option value="Door">Door</option><option value="Grate">Grate</option><option value="Hand">Hand</option><option value="Lid">Lid</option><option value="Manhole Cover">Manhole Cover</option><option value="Other">Other</option><option value="Unkown">Unkown</option></select><br>				
				Ground Type: <input type="text" name="groundType" value="'.$_GET['groundType'].'"><br>
				High Pipe Elevation (ft): <input type="text" name="hpe" value="'.$_GET['hpe'].'"><br>
				Invert Elevation (ft): <input type="text" name="inverEl" value="'.$_GET['inverEl'].'"><br>
				Manhole Drop: <input type="text" name="manholeDrop" value="'.$_GET['manholeDrop'].'"><br>	
				Interior Drop (in): <input type="text" name="interDrop" value="'.$_GET['interDrop'].'"><br>
				Wall Material: <select name="wallMat" id="wallMat"><option value="'.$_GET['wallMat'].'">'.$_GET['wallMat'].'</option><option value="Brick">Brick</option><option value="Concrete">Concrete</option><option value="Reinforced Concrete">Reinforced Concrete</option><option value="Other">Other</option><option value="Unkown">Unkown</option></select><br>
				Structural Shape: <input type="text" name="structShape" value="'.$_GET['structShape'].'"><br>
				Manhole Type: <input type="text" name="manholeType" value="'.$_GET['manholeType'].'"><br>
				Metered: <select name="metered" id="metered"><option value="'.$_GET['metered'].'">'.$metered.'</option><option value="0">False</option><option value="1">True</option></select><br>
				Comments: <br><textarea name="comments" id="comments" cols="30" rows="10" style="height: 150px;">'.$_GET['comments'].'</textarea><br><br>
				<button type="submit">Approve</button>
			</form>';
	echo $form;
}
?>