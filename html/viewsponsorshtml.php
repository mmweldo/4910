<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//For now lets allow all users to see this if they're logged in, useful for drivers trying to find a sponsor
	/*if($_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin - View Sponsors</title>
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
	        <li><a href="">Login/Signup</a></li>
	    </ul>
	    </nav>
	  </div>
	</header>
	<div class="container" style="height:80vh;">
		<center>
			<h2>Admin - View Sponsors</h2>
			<form class="viewsponsors-form" method="post" action="viewsponsors.php">
					<p>Company Name | Sort</p>
					<select name="order">
						<option value="sponsors.company_name ASC">Company Asc</option>
						<option value="sponsors.company_name DESC">Company Desc</option>

						<option value="sponsors.email ASC">Email Asc</option>
						<option value="drivers.email DESC">Email Desc</option>

						<option value="sponsors.username ASC">Username Asc</option>
						<option value="sponsors.username DESC">Username Desc</option>

						<option value="sponsors.user_id ASC">ID Asc</option>
						<option value="sponsors.user_id DESC">ID Desc</option>

						<option value="users.date_created ASC">Date Created Asc</option>
						<option value="users.date_created DESC">Date Created Desc</option>

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
