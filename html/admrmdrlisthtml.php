<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (admin) for page
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User not an admin!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
?> 

<html>
<head>
	<title>List of Drivers</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<center>
		<h2>Admin - Remove Driver from Sponsor List</h2>
		<form method="post" action="admrmdrlist.php">
			<input type="text" name="username" placeholder="Driver Username">
			<button type="submit" name="submit">Submit</button>
		</form>
	</center>
</body>
</html>