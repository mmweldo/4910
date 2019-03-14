<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Assign Drivers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="Affordable and professional Driver Rewards">
	<meta name="keywords" content="Driver Rewards, affordable, professional Driver Rewards">
	<meta name="author" content="Brad Traversy">
	<title>Drewp | Welcome</title>
	<link rel="stylesheet" href="./css/style.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<center>
		<h1>Admin - Assign Drivers to Sponsors</h1>
		<form class="adminassign-form" method="post" action="adminassign.php">
					<p>Company Name | Driver Username</p><input type="text" name="company_name" placeholder="Comany Name">
					<input type="text" name="username" placeholder="Driver Username">
					<button type="submit" name="submit">Submit</button>
		</form>
	</center>
</body>
</html>