<!DOCTYPE html>
<html>
<head>
	<title>Add values</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "sponsor" && $_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
		exit();
	}
	//Header stuffs, adds the html header based on user
	if($_SESSION['user_type'] == "driver"){
	include 'driverheader.php';
	}
	else if($_SESSION['user_type'] == "sponsor"){
	include 'sponsorheader.php';
	}
	else if($_SESSION['user_type'] == "admin"){
	include 'adminheader.php'; 
	}
?>
	<center>
		<h1>Sponsor - Point Editor</h1>
		<form class="points-form" method="post" action="addpoints.php">
			<?php
				session_start();
				if($_SESSION['user_type'] == "admin"){
					echo'<p>Company Name</p> <input type="text" name="company_name" placeholder="company_name">';
				}
				if($_SESSION['user_type'] == "sponsor"){
					echo'<p>Company Name - '.$_SESSION['company_name'].'</p> <input type="hidden" name="company_name" placeholder="company_name" value="'.$_SESSION['company_name'].'">';
				}
			?>
			<p>Driver Username</p> <input type="text" name="username" placeholder="Username">
			<p>Points</p> <input type="text" name="points" placeholder="Points Change"> <br>
			<button type="submit" name="submit">Submit</button>
		</form>
	</center>
	<footer>
      		<p>Drewp, Copyright &copy; 2019</p>
    	</footer>
</body>
</html>

<style>
	p, input, form{
		margin: 10px 10px 10px 10px;
		displaly:inline-block;
		position: center;
	}
	*{
		tab-size: 16px;
	}
</style>
