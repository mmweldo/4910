<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	echo "<center>";
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$query1 = "select current_points from drivers where username = '".$_POST['username']."';";
	$result1 =mysqli_query($conn, $query1); 
	$query2 = "SELECT sponsors.point_value from driver_list JOIN sponsors on driver_list.sponsor_id=sponsors.user_id WHERE driver_username ='".$_POST['username']."';";
	$result2 = mysqli_query($conn, $query2);
	if (!$result1) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}
	while($row=mysqli_fetch_row($result1)){
		$totalPoints = $row[0];
		echo "<p>";
		echo " You have ".$row[0]." total points ";
		echo "</p>";
	}
	while($row=mysqli_fetch_row($result2)){
		$sponsorValue = $row[0];
		echo "<p>";
		echo " Valued at  $".$row[0]." per point ";
		echo "</p>";
	}
		echo "<p> For a total of $" .$totalPoints * $sponsorValue. "</p>";
	echo "</center>";
	mysqli_close($conn);
?>
