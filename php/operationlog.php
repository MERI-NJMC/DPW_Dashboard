<?php
//===================
//Author: Jose BAez
//Date: 16 MAy 2014
////===================
//This file inserts operations logs into the database
require('dbConnection.php');
$ip = ipCon();
$uName = uName();
$pwd = pwd();
$dbName = dbName();
$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
if(isset($_POST['basin']))
{
	$query = "INSERT INTO `operations_log` (`facilityid`, `response_type`, `debris_collected`, `response_notes`, `author`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['basin'])."', '".mysqli_real_escape_string($mysqli, $_POST['type'])."', '".mysqli_real_escape_string($mysqli, $_POST['debris'])."', '".mysqli_real_escape_string($mysqli, $_POST['note'])."' , '" . mysqli_real_escape_string($mysqli, $_POST['user']) ."');";
	mysqli_query($mysqli, $query) or die(0);
	echo "1";
}
?>
