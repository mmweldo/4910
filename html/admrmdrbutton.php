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
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");

	$query = "DELETE FROM driver_list WHERE driver_id = ".$_POST['driver_id']." AND sponsor_id = ".$_POST['sponsor_id'].";";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't remove for some reason!";
		exit();
	}
	else{
		echo "<center><h3>Removal was successful!</h3></center>";
	}
?>