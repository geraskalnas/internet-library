<!DOCTYPE html>
 
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="topnav">
	<div>
		<a class="active" href="index.php">Pradžia</a>
		<a href="classes.php?test=1">Testing</a>
		<a href="login.php">Prisijungti</a>
		<a href="adminerC.php">Adminer</a>
	</div>
	<div>
		<p><?php echo $username; ?></p>
	</div>
</div>
