<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Wrong user or not logged in!";
		echo "<script>setTimeout(\"location.href = '../checkapplications.php?NOT-LOGGEDIN';\", 3000);</script>";
	}
	if($_SESSION['user_type'] != "sponsor"){
		echo "Error: Wrong user!";
		echo "<script>setTimeout(\"location.href = '../checkapplications.php?Wrong-User';\", 3000);</script>";
	}


	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");

	$query = "SELECT user_id FROM drivers WHERE username = '".$_POST['driver_username']."';";	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Driver Couldn't be found or accepted...";
		echo "<script>setTimeout(\"location.href = '../checkapplications.php?NONEXISTANT-DRIVERS';\", 3000);</script>";
		exit();
	}

	$row = mysqli_fetch_row($result);

	$query = "UPDATE applications SET status = '".$_POST['status']."' WHERE driver_id = ".$row[0].";";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: [1] Driver Couldn't be found or accepted...";
		echo "<script>setTimeout(\"location.href = '../checkapplications.php?NONEXISTANT-DRIVERS';\", 3000);</script>";
		exit();
	} else{
		echo "<center><h3>".$_POST['driver_username']."'s new application status: ".$_POST['status']."<h3></center>";
	}
?>
