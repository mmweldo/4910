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
	
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT driver_id FROM driver_list WHERE sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."') AND driver_username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't check driver-sponsor pair!";
		#echo "<script>setTimeout(\"location.href = '../removedrivers.html?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}
	if($resultCheck > 0){
		echo "Error: Couldn't check driver-sponsor pair!";
		echo "<script>setTimeout(\"location.href = '../removedrivers.html?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}


	echo "INSERT INTO driver_list (sponsor_id, driver_id, driver_username) VALUES ((SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."'), (SELECT user_id FROM drivers WHERE username = '".$_POST['username']."'), '".$_POST['username']."');";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't insert into driver list...";
		echo "<script>setTimeout(\"location.href = '../removedrivers.html?COULDNT-INSERT';\", 3000);</script>";
		exit();		
	}
	echo "<center>";
	echo "<h3>Added driver ".$_POST['username']." to ".$_POST['company_name']."</h3>";
	echo "</center>";
	mysqli_close($conn);
?>
