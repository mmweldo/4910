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
	<title>Driver List</title>
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
	<div class="container">
		<center>
			<h2>Admin - View User List</h2>
			<form class="userlist-form" method="post" action="userlist.php">
					<select name="order">
						<option value="users.username ASC">Username Asc</option>
						<option value="users.username DESC">Username Desc</option>

						<option value="users.email ASC">Email Asc</option>
						<option value="users.email DESC">Email Desc</option>

						<option value="users.date_created ASC">Creation Asc</option>
						<option value="users.date_created DESC">Creation Desc</option>

						<option value="users.id ASC">id Asc</option>
						<option value="users.id DESC">id Desc</option>
					</select>
					<button type="submit" name="submit">Submit</button>
			</form>
		</center>
	</div>
	<div class="container"><?php require_once('userlist.php'); ?></div>
	<footer>
		<p>Drewp, Copyright &copy; 2019</p>
	</footer>
</body>
</html>
