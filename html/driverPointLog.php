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

	if($_SESSION['user_type'] == "sponsor"){
		include 'sponsorheader.php';
	}else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else if($_SESSION['user_type'] == "driver"){
		include 'driverheader.php';
	}
	echo "<center>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	//$query = "select points_history.date_created, points_history.point_amount, drivers.username from driver inner join points_history on points_history.driver_id = drivers.user_id where drivers.username = '".$_POST['username'].";";
	$query = "select points_history.date_created, points_history.point_amount, drivers.username from drivers inner join points_history on points_history.driver_id = drivers.user_id where drivers.username = '".$_POST['username']."';";
	$result =mysqli_query($conn, $query); 

	if (!$result) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}

	while($row=mysqli_fetch_row($result)){
		echo "<p>";
		echo " ".$row[0]." ";
		echo " ".$row[1]." ";
		echo "</p>";
	}
	echo "</center>";
	mysqli_close($conn);
?>
