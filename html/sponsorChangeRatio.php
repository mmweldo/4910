<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	echo "<center>";
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$query2 = "update sponsors set dollar_ratio = '".$_POST['ratio']."' where sponsors.company_name ='".$_POST['username']."';";
	$result2 = mysqli_query($conn, $query2);
	if (!$result2) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}
	else{
		echo "updated";
	}
	echo "</center>";
	mysqli_close($conn);
?>
