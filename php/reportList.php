<html>
	<head>
		<title>Operations Log Report</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/basin.css">
		<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
	</head>

	<body>
		<div class="container">
		<h1><p class="attrHead"><?php echo $_POST['util'] ?> Report(s) for <?php echo $_POST['muni'] ?></p></h1>
		<?php 
			main();
			function main(){
			require('dbConnection.php');
				$ip = ipCon();
				$uName = uName();
				$pwd = pwd();
				$dbName = dbName();
				$time = $_POST['time'];
				$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
				if ($_POST['util'] === "Catch Basin") {
					if ($time != null) {
						$query = 'SELECT * FROM `operations_log` WHERE `time` = "'. $time .'";';
					} else {
						$query = 'SELECT `operations_log`.* FROM `operations_log` INNER JOIN `basin_attributes` ON `operations_log`.facilityid = `basin_attributes`.facilityid WHERE `basin_attributes`.Municipality = "'.$_POST['muni'].'"  ORDER BY  `operations_log`.`time` DESC ;';
					}
				} else if ($_POST['util'] == "Storm Water Manhole") {
					if ($time != null) {
						$query = 'SELECT * FROM `man_operations_log` WHERE `time` = "'. $time .'";';
					} else {
						$query = 'SELECT `man_operations_log`.* FROM `man_operations_log` INNER JOIN `man_attributes` ON `man_operations_log`.facilityid = `man_attributes`.facilityid WHERE `man_attributes`.Municipality = "'.$_POST['muni'].'"  ORDER BY  `man_operations_log`.`time` DESC ;';
					}
				} else if ($_POST['util'] == "Storm Water Line") {
					if ($time != null) {
						$query = 'SELECT * FROM `operations_log` WHERE `time` = "'. $time .'";';
					} else {
						$query = 'SELECT `operations_log`.* FROM `operations_log` INNER JOIN `stormline_attributes` ON `operations_log`.facilityid = `stormline_attributes`.facilityid WHERE `stormline_attributes`.Municipality = "'.$_POST['muni'].'"  ORDER BY  `operations_log`.`time` DESC ;';
					}
				} else if ($_POST['util'] == "Outfall") {
					if ($time != null) {
						$query = 'SELECT * FROM `outfall_operations_log` WHERE `time` = "'. $time .'";';
					} else {
						$query = 'SELECT `outfall_operations_log`.* FROM `outfall_operations_log` INNER JOIN `outfall_attributes` ON `outfall_operations_log`.facilityid = `outfall_attributes`.facilityid WHERE `outfall_attributes`.Municipality = "'.$_POST['muni'].'"  ORDER BY  `outfall_operations_log`.`time` DESC ;';
					}
				}
				$results = mysqli_query($mysqli, $query);

				$cont = '<h2>Operations Log(s)</h2>';
				$isCon = false;
				echo mysql_error($query);
				while ($row = $results->fetch_assoc()) {

					$cont .= '<div class="singleLog">
								<form action="reportList.php" method="post"><p class="singleLogHead"><b>Date/Time: '. $row["time"] .'   </b></p><input type="hidden" value="' . $row["time"] .'" name="time"><input type="hidden" value="' . $_POST["util"] .'" name="util"><input type="hidden" value="' . $_POST["muni"] .'" name="muni"><p class="buttontext"><button class="singleButton">>></button></p></form>
								<h4>Facility ID#:  ' . $row["facilityid"] . '</h4>
								<h4>Author:  ' . $row["author"] . '</h4>
								<h4>Response Type: '. $row["response_type"] .'</h4>
								<h4>Debris Collected: '. $row["debris_collected"] .'(ft&sup3;)</h4>
								<h4>Response Notes: </h4><p>' . $row["response_notes"] .'</p><br></div>';
					$isCon = true;
				}
				if ($isCon) {
					echo $cont;
				} else {
					echo '<p>Sorry no operations logs</p>';
				}

			}

		?>	
		</div>
	</body>

</html>