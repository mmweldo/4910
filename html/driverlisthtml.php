<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (sponsor) for page
	if($_SESSION['user_type'] != "sponsor" && $_SESSION['user_type'] != "admin"){
		echo "Error: User not a sponsor!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
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
			<h2>Sponsor - View Driver List</h2>
			<form class="driverlist-form" method="post" action="driverlist.php">
					<p>Company Name | Sort</p>
					<?php
						session_start();
						if($_SESSION['user_type'] == "admin"){
							echo'<input type="text" name="company_username" placeholder="company_username">';
						}
						else if ($_SESSION['user_type'] == "sponsor"){
							echo'<input type="hidden" name="company_username" placeholder="company_username" value="'.$_SESSION['username'].'">';
						}else {
							echo "You shouldn't be here!";
						}
					?>
					<select name="order">
						<option value="drivers.firstname ASC">Fname Asc</option>
						<option value="drivers.firstname DESC">Fname Desc</option>

						<option value="drivers.lastname ASC">Lname Asc</option>
						<option value="drivers.lastname DESC">Lname Desc</option>

						<option value="drivers.username ASC">Username Asc</option>
						<option value="drivers.username DESC">Username Desc</option>

						<option value="drivers.total_points ASC">Total Pts Asc</option>
						<option value="drivers.total_points DESC">Total Pts Desc</option>

						<option value="drivers.current_points ASC">Curr Pts Asc</option>
						<option value="drivers.current_points DESC">Curr Pts Desc</option>

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
