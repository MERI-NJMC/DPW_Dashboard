<html>
	<head>
		<title>Outfall Form</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/basin.css">
		<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
	</head>
	<body>
		<div class="container">
		<h1><p class="attrHead">Outfall Report(s)</p></h1>


		<?php
			
			main();
			function main() {
				require('dbConnection.php');
				$ip = ipCon();
				$uName = uName();
				$pwd = pwd();
				$dbName = dbName();
				$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
				$oid =  $_POST["oid"];
				$content = '<div style="width: 960px;"><div class="attrBlock"><h2><p class="attrHead">Outfall ID: <span id="outfallID">'. $_POST["oid"] .'</span></p></h2><br>';
				$content .= '<h3><p class="attrHead">Outfall Attributes</p></h3>';

				$query = 'SELECT * FROM `outfall_attributes` WHERE `facilityid` ="' . $oid . '";';
				$results = mysqli_query($mysqli, $query);
				$row = mysqli_fetch_assoc($results);
				if($row != null) {
					
 					$content .= '
									<p class="attr"><b>Owned By: </b>' . $row['OwnedBy'] . '</p>
									<p class="attr"><b>Municiplaity: </b>' . $row['Municipality'] . '</p>
									<p class="attr"><b>Location Description: </b>' . $row['LocationDescription'] . '</p> 
									<p class="attr"><b>Material: </b>' . $row['Material'] . '</p>
									<p class="attr"><b>Receiving Water: </b>' . $row['ReceivingWater'] . '</p>
									<p class="attr"><b>Diameter: </b>' . $row['Diameter'] . ' (in)</p>
									<p class="attr"><b>Comments: </b>' . $row['Comments'] . '</p>
								 </div>
								 <div style="float: left; width="100%"><img class="basinImg" src="../images/' . $oid . '.jpg" alt=""></div>
								 <br style="clear: both;"/></div>';
				} else {
					$content .= '<p>There aren\'t any attributes associated with this basin</p>'; 					
				}
				//Operations Log data
				$time = $_POST['time'];
				if ($time != "null") {
					
					$queryOP = 'SELECT * FROM `outfall_operations_log` WHERE `facilityid` ="' . $oid . '" AND  `time` = "'. $time .'" ;';
				} else {
					$queryOP = 'SELECT * FROM `outfall_operations_log` WHERE `facilityid` ="' . $oid . '" ORDER BY  `outfall_operations_log`.`time` DESC ;';
				}
				
				$resultsOP = mysqli_query($mysqli, $queryOP);
				$content .= '<h2>Operations Log</h2>';
				$isCon = false;
					while($rowOP = $resultsOP->fetch_assoc()){
						$content .= '<div class="singleLog">
								<form action="outfall.php" method="post"><p class="singleLogHead"><b>Date/Time: '. $rowOP["time"] .'   </b><input type="hidden" value="' . $oid .'" name="oid"></p><input type="hidden" value="' . $rowOP["time"] .'" name="time"><p class="buttontext"><button class="singleButton">>></button></p></form>
								<h4>Author:  ' . $rowOP["author"] . '</h4>
								<h4>Response Type: '. $rowOP["response_type"] .'</h4>
								<h4>Debris Collected: '. $rowOP["debris_collected"] .'(ft&sup3;)</h4>
								<h4>Response Notes: </h4><p>' . $rowOP["response_notes"] .'</p><br></div>';
						$isCon = true;		
						
					}
					if ($isCon) {
						echo $content; 
					} else {
						$content .= '<p>There are no operations log for this basin.</p>';
						echo $content;
					}
		
				echo mysqli_error($mysqli);
				
				

			}

		?>
		
	</div>
	</body>
</html>