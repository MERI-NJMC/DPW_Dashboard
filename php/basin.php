<html>
	<head>
		<title>Basin Form</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/basin.css">
		<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
	</head>
	<body>
		<div class="container">
		<h1><p class="attrHead">Basin Report(s)</p></h1>


		<?php
			
			main();
			function main() {
				$mysqli = mysqli_connect('10.1.0.237', 'webmaps', 'my59Ld8', 'utilities') or die(mysqli_error());
				$bid =  $_POST["bid"];
				$content = '<div style="width: 960px;"><div class="attrBlock"><h2><p class="attrHead">Basin ID: <span id="basinID">'. $_POST["bid"] .'</span></p></h2><br>';
				$content .= '<h3><p class="attrHead">Basin Attributes</p></h3>';

				$queryBI = 'SELECT * FROM `basin_attributes` WHERE `facilityid` ="' . $bid . '";';
				$resultsBI = mysqli_query($mysqli, $queryBI);
				$rowBI = mysqli_fetch_assoc($resultsBI);
				if($rowBI != null) {
					$lsc = floatval($rowBI['line_size']);
					$lsc = floor($lsc) . " (ft) " . (($lsc-floor($lsc))*12) . " (in)";
					$rimEl = floatval($rowBI['RimElevation']);
					$rimEl = floor($rimEl) . " (ft) " . (($rimEl-floor($rimEl))*12) . " (in)";
					$accDia = $rowBI['AccessDiameter'];
					$accDia = floor($accDia) . " (ft) " . (($accDia-floor($accDia))*12) . " (in)";
					$inver = $rowBI['InvertElevation'];
					$inver = floor($inver) . " (ft) " . (($inver-floor($inver))*12) . " (in)";
 					$content .= '
									<p class="attr"><b>Address: </b>' . $rowBI['address'] . '</p>
									<p class="attr"><b>Length: </b>' . $rowBI['cblength'] . ' ft</p>
									<p class="attr"><b>Width: </b>' . $rowBI['cbwidth'] . ' ft</p>
									<p class="attr"><b>Depth: </b>' . $rowBI['depth'] . ' ft</p>
									<p class="attr"><b>Volume: </b>' . $rowBI['size'] . ' ft&sup3;</p>
									<p class="attr"><b>Line Size Connection: </b>' . $lsc . '</p>
									<p class="attr"><b>Drains To: </b>' . $rowBI['drains_to'] . '</p>
									<p class="attr"><b>Condition: </b>' . $rowBI['condition'] . '</p>
									<button type="button" id="addAtt">Addtional Atrributes <span class="glyphicon glyphicon-plus-sign"></span></button><br><br>
									<p id="testTogAtt" style="display: none">
									<b class="attr">Owned By: </b>' . $rowBI['OwnedBy'] . '<br>
									<b class="attr">Municipality: </b>' . $rowBI['Municipality'] . '<br>
									<b class="attr">Location Description: </b>' . $rowBI['LocationDescription'] . '<br>
									<b class="attr">CBType: </b>' . $rowBI['CBType'] . '<br>
									<b class="attr">Top of Structure: </b>' . $rimEl . '<br>
									<b class="attr">Diameter: </b>' . $accDia . '<br>
									<b class="attr">Access Material: </b>' . $rowBI['AccessMaterial'] . '<br>
									<b class="attr">Access Type: </b>' . $rowBI['AccessType'] . '<br>
									<b class="attr">Invert Elevation: </b>' . $inver . '<br>
									<b class="attr">Comments: </b>' . $rowBI['Comments'] . '<br>
									</p>
								 </div>
								 <div style="float: left; width="100%"><img class="basinImg" src="../images/' . $bid . '.jpg" alt=""></div>
								 <br style="clear: both;"/></div>';
				} else {
					$content .= '<p>There aren\'t any attributes associated with this basin</p>'; 					
				}
				//Operations Log data
				$time = $_POST['time'];
				if ($time != "null") {
					
					$queryOP = 'SELECT * FROM `operations_log` WHERE `facilityid` ="' . $bid . '" AND  `time` = "'. $time .'" ;';
				} else {
					$queryOP = 'SELECT * FROM `operations_log` WHERE `facilityid` ="' . $bid . '" ORDER BY  `operations_log`.`time` DESC ;';
				}
				
				$resultsOP = mysqli_query($mysqli, $queryOP);
				$content .= '<h2>Operations Log</h2>';
				$isCon = false;
					while($rowOP = $resultsOP->fetch_assoc()){
						$content .= '<div class="singleLog">
								<form action="basin.php" method="post"><p class="singleLogHead"><b>Date/Time: '. $rowOP["time"] .'   </b><input type="hidden" value="' . $bid .'" name="bid"></p><input type="hidden" value="' . $rowOP["time"] .'" name="time"><p class="buttontext"><button class="singleButton">>></button></p></form>
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