<?php
	require('dbConnection.php');
	$ip = ipCon();
	$uName = uName();
	$pwd = pwd();
	$dbName = dbName();
	$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
	if(isset($_POST['oid']))
	{
		$query = "INSERT INTO `outfall_operations_log` (`facilityid`, `response_type`, `debris_collected`, `response_notes`, `author`) VALUES ('".mysqli_real_escape_string($mysqli, $_POST['oid'])."', '".mysqli_real_escape_string($mysqli, $_POST['type'])."', '".mysqli_real_escape_string($mysqli, $_POST['debris'])."', '".mysqli_real_escape_string($mysqli, $_POST['note'])."' , '" . mysqli_real_escape_string($mysqli, $_POST['user']) ."');";
		mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		echo mysqli_error($mysqli);
	}


?>