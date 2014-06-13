<?php
	session_start();
	require_once('../ERIS/validate.php');
	require_once('php/classes/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	if($detect->isMobile() && !$detect->isTablet()) {
		$_SESSION['mobile'] = true;
	} else {
		$_SESSION['mobile'] = false;
	}
?>
<!DOCTYPE html>
<?php if(!validateERIS() && empty($_POST)): ?>
<html>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<head>
	
		 <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  
	</head>
	<body>
		<div class="container">
			<div style="float: left; margin: auto;">
				<h1>Municipal DPW Dashboard</h1>
				<form role="form" action="" method="post">
					<div class="form-group">
						<label>Username:   </label>
						<input type="text" class="form-control" name="userName" autofocus="on" autocomplete="off">
					</div>
					<div class="form-group">
						<label>&nbsp;Password:   </label>
						<input type="password" class="form-control" name="password">
					</div>
					<div class="form-group">
						<input type="submit" value="login">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
<?php endif; ?>
<?php
if(!validateERIS() && !empty($_POST))
{
	$_SESSION['user'] = $_POST['userName'];
	require_once('../ERIS/authenticate.php');
	header('Location: '.$_SERVER['REQUEST_URI']);
}
else if(validateERIS())
{

	require_once('php/page/UtilityMap.php');
}
?>
