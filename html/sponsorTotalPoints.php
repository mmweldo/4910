<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	echo "<center>";
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$query2 = "SELECT driver_list.driver_username, driver_list.current_points from sponsors join driver_list on driver_list.sponsor_id = sponsors.user_id where sponsors.company_name ='".$_POST['username']."';";
	$result2 = mysqli_query($conn, $query2);
	if (!$result2) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}
	$pointsSum = 0;
	while($row=mysqli_fetch_row($result2)){
		echo "<p>";
		echo " " .$row[0]." " .$row[1]." ";
		$pointsSum = $pointsSum + $row[1];
	}

	echo "<p> Your Drivers Currently have " .$pointsSum. " Points</p>";
	echo "</center>";
	mysqli_close($conn);
?>
