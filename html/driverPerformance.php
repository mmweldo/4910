<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	echo "<center>";

	$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$query2 = "SELECT sponsor_id from driver_list where driver_username ='".$_POST['username']."';";
	$result2 = mysqli_query($conn, $query2);
	if (!$result2) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}
	while($row=mysqli_fetch_row($result2)){
		$sponsorID=  $row[0];
	}
	$query1 = "SELECT driver_username, total_points from driver_list where sponsor_id ='".$sponsorID."';";
	$result1 = mysqli_query($conn, $query1);
	if (!$result1) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}	
	echo "<h2>Driver Leaderboard</h2>";
	while($row=mysqli_fetch_row($result1)){
		echo "<p>";
		echo " " .$row[0]. " " .$row[1]. " ";
		echo "</p>";
	}
			

	echo "</center>";
	mysqli_close($conn);
?>
