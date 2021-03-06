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
<!-- Admin - Delete Users -->
<!DOCTYPE html>
<html>
<head>
	<title>Delete Users</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<header>
	  <div class="container">
	    <div id="branding">
	      <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
	    </div>
	    <nav>
	      <ul>
	        <li><a href="/">Home</a></li>
	        <li><a href="about.php">About</a></li>
	        <li><a href="stories.php">[Stories]</a></li>
	        <li><a href="login.html">Login/Signup</a></li>
	    </ul>
	    </nav>
	  </div>
	</header>
	<div style="height: 70vh;">
		<center>
			<h2>Admin - Delete Users</h2>
			<form class="deleteusers-form" method="post" action="deleteusers.php">
					<p> Username </p><input type="text" name="username" placeholder="Username">
					<button type="submit" name="submit">Submit</button>
			</form>
		</center>
	</div>
	<footer>
    	<p>Drewp, Copyright &copy; 2019</p>
    </footer>
</body>
</html>
