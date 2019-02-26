<?php  
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";

	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT driver_id FROM driver_list WHERE sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."') AND driver_username = '".$_POST['username']."';";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "[1] Error: Driver-Sponsor pair not found! Redirecting...";
		#echo "<script>setTimeout(\"location.href = '../removedrivers.html?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "[2] Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../removedrivers.html?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}

	$query = "DELETE FROM users WHERE users.username = '".$_POST['username']."';";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "[3] Error: Couldn't delete driver...";
		echo "<script>setTimeout(\"location.href = '../removedrivers.html?COULDNT-DELETE';\", 3000);</script>";
		exit();		
	}

	echo "<center>";
	echo "<h3>Removed driver ".$_POST['username']."</h3>";
	echo "</center>";

	mysqli_close($conn);
?>
