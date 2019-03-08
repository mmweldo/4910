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

<!DOCTYPE html>
<html>
<head>
	<title>Admin - Search Sponsor</title>
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
	<div class="container" style="height:70vh;">
		<center>
			<h2>Admin - Search Sponsor by Name</h2>
			<form class="adminsearchsponsors-form" method="post" action="adminsearchsponsors.php">
					<p>Company Name</p><input type="text" name="company_name" placeholder="Comany Name">
					<button type="submit" name="submit">Submit</button>
			</form>
		</center>
	</div>
	<footer>
      		<p>Drewp, Copyright &copy; 2019</p>
    </footer>
</body>
</html>
