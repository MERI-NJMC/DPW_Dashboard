<html>
	<head>
		<title>Manhole Form</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/basin.css">
		<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
	</head>
	<body>
		<div class="container">
		<h1><p class="attrHead">Storm Water Manhole Report(s)</p></h1>

		<?php
			
			main();
			function main() {
				require('dbConnection.php');
				$ip = ipCon();
				$uName = uName();
				$pwd = pwd();
				$dbName = dbName();
				$mysqli = mysqli_connect($ip,$uName,$pwd,$dbName) or die(mysql_error());
				$mid =  $_POST["mid"];
				$content = '<div style="width: 960px;"><div class="attrBlock"><h2><p class="attrHead">Manhole ID: <span id="manholeID">'. $_POST["mid"] .'</span></p></h2><br>';
				$content .= '<h3><p class="attrHead">Manhole Attributes</p></h3>';
				
				$query = 'SELECT * FROM `man_attributes` WHERE `facilityid` ="' . $mid . '";';
				$results = mysqli_query($mysqli, $query);
				$row = mysqli_fetch_assoc($results);
				if($row != null) {
					
					$accDia = $row['AccessDiameter'];
					$accDia = floor($accDia) . " (ft) " . (($accDia-floor($accDia))*12) . " (in)";
					$hpe = $row['HighPipeElevation'];
					$hpe = floor($hpe) . " (ft) " . (($hpe-floor($hpe))*12) . " (in)";
					$rimEl = $row['RimElevation'];
					$rimEl = floor($rimEl) . " (ft) " . (($rimEl-floor($rimEl))*12) . " (in)";
					$inver = $row['InvertElevation'];
					$inver = floor($inver) . " (ft) " . (($inver-floor($inver))*12) . " (in)";
					$inter = $row['InteriorDrop'];
					$inter = floor($inter) . " (ft) " . (($inter-floor($inter))*12) . " (in)";
					$content .= '
									<p class="attr"><b>Address: </b>' . $row['address'] . ' </p>
									<p class="attr"><b>Top Rim Elevation: </b>' . $row['topRimEl'] . ' </p>
									<p class="attr"><b>Condition: </b>' . $row['condition'] . ' </p>
									<button type="button" id="addAtt">Addtional Atrributes <span class="glyphicon glyphicon-plus-sign"></span></button><br><br>
									<p id="testTogAtt" style="display: none">
									<b class="attr">Owned By: </b>' . $row['OwnedBy'] . '<br>
									<b class="attr">Municipality: </b>' . $row['Municipality'] . '<br>
									<b class="attr">Location Description: </b>' . $row['LocationDescription'] . '<br>
									<b class="attr">Access Diameter: </b>' . $accDia . '<br>
									<b class="attr">Access Type: </b>' . $row['AccessType'] . '<br>
									<b class="attr">Ground Type: </b>' . $row['GroundType'] . '<br>
									<b class="attr">High Pipe Elevation: </b>' . $hpe . '<br> 
									<b class="attr">Rim Elevation: </b>' . $rimEl . '<br> 
									<b class="attr">Invert Elevation: </b>' . $inver . '<br> 
									<b class="attr">Manhole Drop: </b>' . $row['ManholeDrop'] . '<br>
									<b class="attr">Interior Drop: </b>' . $inter . '<br> 
									<b class="attr">Wall Material: </b>' . $row['WallMaterial'] . '<br>
									<b class="attr">Structural Shape: </b>' . $row['StructuralShape'] . '<br>
									<b class="attr">Manhole Type: </b>' . $row['ManholeType'] . '<br>
									<b class="attr">Metered: </b>' . $row['Metered'] . '<br> 
									<b class="attr">Comments: </b>' . $row['Comments'] . '<br>
									</p>
								 </div>
								 <div style="float: left; width="100%"><img class="basinImg" src="../images/' . $mid . '.jpg" alt=""></div><br style="clear: both;"/></div>';
				} else {
					$content .= '<p>There aren\'t any attributes associated with this manhole</p>'; 					
				} 

				//Operations Log data
				$time = $_POST['time'];
				if ($time != "null") {
					
					$queryOP = 'SELECT * FROM `man_operations_log` WHERE `facilityid` ="' . $mid . '" AND  `time` = "'. $time .'" ;';
				} else {
					$queryOP = 'SELECT * FROM `man_operations_log` WHERE `facilityid` ="' . $mid . '" ORDER BY  `man_operations_log`.`time` DESC ;';
				}
				
				$resultsOP = mysqli_query($mysqli, $queryOP);
				$content .= '<h2>Operations Log</h2>';
				$isCon = false;
					while($rowOP = $resultsOP->fetch_assoc()){
						$content .= '<div class="singleLog">
								<form action="manhole.php" method="post"><p class="singleLogHead"><b>Date/Time: '. $rowOP["time"] .'   </b><input type="hidden" value="' . $mid .'" name="mid"></p><input type="hidden" value="' . $rowOP["time"] .'" name="time"><p class="buttontext"><button class="singleButton">>></button></p></form>
								<h4>Author:  ' . $rowOP["author"] . '</h4>
								<h4>Response Type: '. $rowOP["response_type"] .'</h4>
								<h4>Debris Collected: '. $rowOP["debris_collected"] .'(ft&sup3;)</h4>
								<h4>Response Notes: </h4><p>' . $rowOP["response_notes"] .'</p><br></div>';
						$isCon = true;		
						
					}
					if ($isCon) {
						echo $content; 
					} else {
						$content .= '<p>There are no operations log for this manhole.</p>';
						echo $content;
					}
		
				echo mysqli_error($mysqli);
				
				

			}

		?>
		
	</div>
	</body>
</html>