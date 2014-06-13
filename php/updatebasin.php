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
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		echo "1";
	}
}
?>
