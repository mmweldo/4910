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
		<h1>Point Editor</h1>
		<form class="points-form" method="post" action="addpoints.php">
			<?php
				session_start();
				if($_SESSION['user_type'] == "admin"){
					echo'<p>Company Name</p> <input type="text" name="company_name" placeholder="company_name">';
				}
				if($_SESSION['user_type'] == "sponsor"){
					echo'<p>Company Name - '.$_SESSION['company_name'].'</p> <input type="hidden" name="company_name" placeholder="company_name" value="'.$_SESSION['company_name'].'">';
					
					echo'<p>Driver Username</p><select placeholder="Username" name="username">';
					
					$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
					$conn = mysqli_connect($endpoint, "master", "group4910", "website");
					$sql = "SELECT driver_username FROM driver_list WHERE sponsor_id = ".$_SESSION['user_id'].";";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_row($result);

					while($row=mysqli_fetch_row($result)){
						echo'<option value="'.$row[0].'">'.$row[0].'</option>';
					}
					echo'</select>';
				}else{
					echo '<p>Driver Username</p> <input type="text" name="username" placeholder="Username">';
				}
			?>			
			<p>Points</p> <input type="text" name="points" placeholder="Points Change"> <br>
			<button type="submit" name="submit">Submit</button>
		</form>
	</center>
	<center>
		<h1>Sponsor Total Points</h1>
		<form class="points-form" method="post" action="sponsorChangeRatio.php">
			<?php
				session_start();
				if($_SESSION['user_type'] == "admin"){
					echo'<p>Sponsor Username</p> <input type="text" name="username" placeholder="Username">';
				}
				if($_SESSION['user_type'] == "sponsor"){
					echo'<p>Sponsor Username: '.$_SESSION['username'].'</p> <input type="hidden" name="username" placeholder="Username" value="'.$_SESSION['username'].'">';

					$sql = "SELECT dollar_ratio FROM sponsors WHERE user_id = ".$_SESSION['user_id'].";";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_row($result);
					echo '<p>Ratio Dollar (decimal)</p> <input type="text" name="ratio" placeholder="Ratio" value="'.$row[0].'">';
				}else{
					echo '<p>Ratio Dollar (decimal)</p> <input type="text" name="ratio" placeholder="Ratio">';
				}
			?>
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
