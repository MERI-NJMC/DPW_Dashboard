<?php
//===================
//Author: Jose BAez
//Date: 16 MAy 2014
//===================
//This file updates the basin attibutes or inserts them
require('dbConnection.php');
$ip = ipCon();
$uName = uName();
$pwd = pwd();
$dbName = dbName();
$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
if(isset($_POST['basin']))
{
	echo '<h1>Utility Approved! Please close this tab/window.</h1>';
	$query = 'SELECT * FROM `basin_attributes` WHERE `facilityid` = "' .mysqli_real_escape_string($mysqli, $_POST['basin']). '";';
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	var_dump($row);
	
	if($row != null)
	{

		$query = "UPDATE `basin_attributes` SET `address`='".mysqli_real_escape_string($mysqli, $_POST['address'])."', `cbwidth`='".mysqli_real_escape_string($mysqli, $_POST['width'])."', `cblength`='".mysqli_real_escape_string($mysqli, $_POST['length'])."', `depth`='".mysqli_real_escape_string($mysqli, $_POST['depth'])."', `size`='".mysqli_real_escape_string($mysqli, $_POST['size'])."', `line_size`='".mysqli_real_escape_string($mysqli, $_POST['lineSize'])."', `drains_to`='".mysqli_real_escape_string($mysqli, $_POST['drain'])."' , `condition`='".mysqli_real_escape_string($mysqli, $_POST['condition'])."' , `WaterType`='null' , `OwnedBy`='".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , `Municipality`='".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , `locationDescription`='".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , `CBType`='".mysqli_real_escape_string($mysqli, $_POST['cbType'])."' , `RimElevation`='".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."' , `AccessDiameter`='".mysqli_real_escape_string($mysqli, $_POST['accDia'])."' , `AccessMaterial`='".mysqli_real_escape_string($mysqli, $_POST['accMat'])."' , `AccessType`='".mysqli_real_escape_string($mysqli, $_POST['accType'])."' , `InvertElevation`='".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."' , `Comments`='".mysqli_real_escape_string($mysqli, $_POST['comments'])."' WHERE `facilityid`='".mysqli_real_escape_string($mysqli, $_POST['basin'])."' ;";
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		echo "1";
	}
	else
	{

		$query = "INSERT INTO `basin_attributes` (`facilityid`, `address`, `cbwidth`, `cblength`, `depth`, `size`, `line_size`, `drains_to`, `condition`, `WaterType`, `OwnedBy`, `Municipality`, `LocationDescription`, `CBType`, `RimElevation`, `AccessDiameter`, `AccessMaterial`, `AccessType`,`InvertElevation`, `Comments`) 
				VALUES('".mysqli_real_escape_string($mysqli, $_POST['basin'])."','".mysqli_real_escape_string($mysqli, $_POST['address'])."', '".mysqli_real_escape_string($mysqli, $_POST['width'])."', '".mysqli_real_escape_string($mysqli, $_POST['length'])."', '".mysqli_real_escape_string($mysqli, $_POST['depth'])."', '".mysqli_real_escape_string($mysqli, $_POST['size'])."', '".mysqli_real_escape_string($mysqli, $_POST['lineSize'])."', '".mysqli_real_escape_string($mysqli, $_POST['drain'])."','".mysqli_real_escape_string($mysqli, $_POST['condition'])."' , 'null' , '".mysqli_real_escape_string($mysqli, $_POST['ownedBy'])."' , '".mysqli_real_escape_string($mysqli, $_POST['muni'])."' , '".mysqli_real_escape_string($mysqli, $_POST['locDesc'])."' , '".mysqli_real_escape_string($mysqli, $_POST['cbType'])."' , '".mysqli_real_escape_string($mysqli, $_POST['rimEl'])."' ,'".mysqli_real_escape_string($mysqli, $_POST['accDia'])."' , '".mysqli_real_escape_string($mysqli, $_POST['accMat'])."' , '".mysqli_real_escape_string($mysqli, $_POST['accType'])."' ,'".mysqli_real_escape_string($mysqli, $_POST['inverEl'])."' ,'".mysqli_real_escape_string($mysqli, $_POST['comments'])."');";
		mysqli_query($mysqli, $query) or die("error " . mysqli_error($mysqli));
		echo "1";
	}
} else {



	$form = '<form action="updatebasin.php" method="POST">
				<h3>Catch Basin Approval Form</h3><br>
				Facility ID: <input type="text" name="basin" value="'.$_GET['basin'].'"><br>
				Address: <input type="text" name="address" value="'.$_GET['address'].'"><br>
				Length (ft): <input type="text" name="length" value="'.$_GET['length'].'"><br>
				Width (ft): <input type="text" name="width" value="'.$_GET['width'].'"><br>
				Depth (ft): <input type="text" name="depth" value="'.$_GET['depth'].'"><br>
				Volume (ft&sup3): <input type="text" name="size" value="'.$_GET['size'].'"><br>
				Line Size (ft): <input type="text" name="lineSize" value="'.$_GET['lineSize'].'"><br>
				Drain\'s To:  <select name="drain" id="drain"><option value="'.$_GET['drain'].'">'.$_GET['drain'].'</option><option value="Ackerman\'s Creek">Ackerman\'s Creek</option><option value="Bellman\'s Creek">Bellman\'s Creek</option><option value="Berry\'s Creek">Berry\'s Creek</option><option value="Berry\'s Creek Canal">Berry\'s Creek Canal</option><option value="Cromakill Creek">Cromakill Creek</option><option value="East Riser Ditch">East Riser Ditch</option><option value="Frank\'s Creek">Frank\'s Creek</option><option value="Hackensack River">Hackensack River</option><option value="Hudson River">Hudson River</option><option value="Kingsland Creek">Kingsland Creek</option><option value="Losen Slote Creek">Losen Slote Creek</option><option value="Mary Ann Creek">Mary Ann Creek</option><option value="Moonachie Creek">Moonachie Creek</option><option value="Nevertouch Creek">Nevertouch Creek</option><option value="Overpeck Creek">Overpeck Creek</option><option value="Passaic River">Passaic River</option><option value="Paunpeck Creek">Paunpeck Creek</option><option value="Peach Island Creek">Peach Island Creek</option><option value="Penhorn Creek">Penhorn Creek</option><option value="Walden Swamp Creek">Walden Swamp Creek</option><option value="West River Ditch">West River Ditch</option><option value="Wolf\'s Creek">Wolf\'s Creek</option><option value="Unnamed Tributary">Unnamed Tributary</option></select><br>
				Condition: <select name="condition" id="condition"><option value="'.$_GET['condition'].'">'.$_GET['condition'].'</option><option value="Good">Good</option><option value="Poor">Poor</option><option value="Needs Maintenance">Needs Maintenance</option></select><br>
				Owned By: <select name="ownedBy" id="ownedBy"><option value="'.$_GET['ownedBy'].'">'.$_GET['ownedBy'].'</option><option value="Municipality">Municipality</option><option value="County">County</option><option value="State">State</option><option value="Private">Private</option></select><br>
				Municipality: <input type="text" name="muni" value="'.$_GET['muni'].'"><br>
				Location Description: <input type="text" name="locDesc" value="'.$_GET['locDesc'].'"><br>
				CB Type: <input type="text" name="cbType" value="'.$_GET['cbType'].'"><br>
				Top of Structure (ft): <input type="text" name="rimEl" value="'.$_GET['rimEl'].'"><br>
				Diameter (in): <input type="text" name="accDia" value="'.$_GET['accDia'].'"><br>
				Access Material: <input type="text" name="accMat" value="'.$_GET['accMat'].'"><br>
				Access Type: <select name="accType" id="accType"><option value="'.$_GET['accType'].'">'.$_GET['accType'].'</option><option value="Door">Door</option><option value="Grate">Grate</option><option value="Hand">Hand</option><option value="Lid">Lid</option><option value="Manhole Cover">Manhole Cover</option><option value="Other">Other</option><option value="Unkown">Unkown</option></select><br>
				Invert Elevation: <input type="text" name="inverEl" value="'.$_GET['inverEl'].'"><br>
				Comments: <br><textarea name="comments" id="comments" cols="30" rows="10" style="height: 150px;">'.$_GET['comments'].'</textarea><br><br>
				<button type="submit">Approve</button>
			</form>';
	echo $form;
}

?>
