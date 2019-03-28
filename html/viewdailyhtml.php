<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "admin" && $_SESSION['user_type'] != "driver"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Daily Points</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
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
	<div class="container">
		<center>
			<form class="viewdaily-form" method="post" action="viewdaily.php">
				<p>Drivers Points by Day</p> <input type="text" name="username" placeholder="Driver Username">
				  <select name="order">
				    <option value="date_created DESC">Date Desc</option>
				    <option value="date_created ASC">Date Asc</option>
				    <option value="point_amount ASC">Points Asc</option>
				    <option value="point_amount DESC">Points Desc</option>
				  </select>
				<button type="submit" name="submit">Submit</button>
			</form>
		</center>
	</div>
	<footer>
		<p>Drewp, Copyright &copy; 2019</p>
	</footer>
</body>
</html>
