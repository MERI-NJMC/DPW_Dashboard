<html>
	<head>
		<title>Utility Map</title>
		<meta charset="UTF-8">
		<meta name="author" content="Jose L. Baez">
		<meta name="description" content="Map only utilities">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, 
 maximum-scale=1.0">
		<link rel="stylesheet" href="http://js.arcgis.com/3.9/js/esri/css/esri.css"/>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
       
		<style>
			.extent
			{
				background-color: rgba(255, 255, 255, .8);
				background-image: url('css/img/extent.png');
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 20px;
				cursor: pointer;
				height: 30px;
				left: 20px;
				padding: 2px;
				position: absolute;
				top: 140px;
				width: 30px;
				z-index: 50;
			}
			.hover:hover
			{
				background-color: rgb(255, 255, 255);
			}
			.list
			{
				display: none;
				position: absolute;
				z-index: 50;
			}
			.layers
			{
				background-color: rgba(255, 255, 255, .8);
				background-image: url('css/img/layers.png');
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 20px;
				cursor: pointer;
				height: 30px;
				left: 20px;
				padding: 2px;
				position: absolute;
				top: 185px;
				width: 30px;
				z-index: 50;
			}
			.logoff
			{
				background-color: rgba(255, 255, 255, .8);
				background-image: url('css/img/logoff.png');
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 20px;
				cursor: pointer;
				height: 30px;
				left: 20px;
				padding: 2px;
				position: absolute;
				top: 275px;
				width: 30px;
				z-index: 50;
			}
			.map
			{
				height: 100%;
				left: 0;
				width: 100%;
				position: fixed;
				top: 50px;
				overflow: hidden;
			}
			#mapCon {
				overflow: hidden;
			}
			#search
			{
				display: block;
				margin-top: 10px;
				margin-right: 5px;
				z-index: 2;
				float: right;
			}
			#muniCon
			{
				float: left;
				margin-top: 8px;
				margin-right: 10px;

			}
			.reports
			{
				background-color: rgba(255, 255, 255, .8);
				background-image: url('css/img/reportButton.png');
				background-position: center center;
				background-repeat: no-repeat;
				background-size: 20px;
				cursor: pointer;
				height: 30px;
				left: 20px;
				padding: 2px;
				position: absolute;
				top: 230px;
				width: 30px;
				z-index: 50;
			}
			.mypop {
				z-index: 100;
				position: fixed;
				visibility: hidden;
				padding: 10px;
				width: 100%;
				height: 100%;
				background: #FFFFFF;
				overflow-y: auto;
				border-radius: 15px; 
			}
			#navBar {
				width: 100%;
				height: 50px;
				z-index: 2;
				background-color: #3c557d;
				position: absolute;
				float: left;
				margin-bottom: 10px;
				padding-left: 30px;
				padding-right: 30px;
			}

		</style>
		<script>
<?php if($_SESSION['mobile']): ?>
			var ismobile = true;
			console.log(ismobile);
<?php else: ?>
			var ismobile = false;
			console.log(ismobile);
<?php endif ?>
		</script>
	</head>
	<body>
		
		<link rel="stylesheet" href="css/style.css">
		<script src="http://js.arcgis.com/3.9compact/init.js"></script>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
       
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
      
        <script src="js/baseURL.js"></script>
        <script src="js/script.js"></script>
		<script src="js/main.js"></script>
        <div id="navBar">
        	<div id="imgCon"><img id="logo" src="css/img/logo.png" alt=""></div>
        	<div id="logoFont">DPW Dashboard</div>
        	<div style="float: right;">
	        	<div id="muniCon" >
		        	<select name="muniZoom" id="muniZoom" class="form-control">
			    		<option value="default">Municipality Zoom</option>
			    		<option value="Carlstadt">Carlstadt</option>
						<option value="East Rutherford">East Rutherford</option>
						<option value="Little Ferry">Little Ferry</option>
						<option value="Lyndhurst">Lyndhurst</option>
						<option value="Moonachie">Moonachie</option>
						<option value="North Arlington">North Arlington</option>
						<option value="Ridgefield">Ridgefield</option>
						<option value="Rutherford">Rutherford</option>
						<option value="South Hackensack">South Hackensack</option>
						<option value="Teterboro">Teterboro</option>
						<option value="Jersey City">Jersey City</option>
						<option value="Kearny">Kearny</option>
						<option value="North Bergen">North Bergen</option>
						<option value="Secaucus">Secaucus</option>
		        	</select>
	        	</div>
	        	<div id="search" class="search"></div>
	        </div>

        </div>

        <div id="mapCon">
		<div id="map" class="map">
			<div id="LocateButton" class="LocateButton hover"></div>
			<div id="extent" class="extent hover" title='Reset Extent'></div>
			<div id="layers" class="layers hover" title='Layer Selector'></div>
			<a target="_blank" href="reportSelect.html"><div id="reports" class="reports hover" title='Reports by Municipality'></div></a>
			<div id="Logoff" class="logoff hover" title="Logoff"></div>
			<div id="popup" class="popup" ></div>
			<div id="list" class="list"></div>
			<iframe style="display:none;" src="" name="myiframe"></iframe>
		</div>
		</div>
		<div id="sessionU" hidden><?php echo $_SESSION['user']; ?></div>
		<div>	
			<div id="pop" class="mypop">
			  <div style="height: 30px"><div id="selTitle" style="float: left;"></div><button type="button" id="xout" style="float: right"><b>X</b></button></div>
			  <div id="popcon"></div>
			</div>
		</div>
	</body>
</html>
