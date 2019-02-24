<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.html\">About</a></li><li><a href=\"stories.html\">[Stories]</a></li><li><a href=\"\">Login/Signup</a></li></ul></nav></div></header>";
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
