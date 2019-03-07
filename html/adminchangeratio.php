<?php  
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	if((double)$_POST['dollar_ratio'] <= 0){
		echo "Error: Please enter a value of 0 or larger!";
		echo "<script>setTimeout(\"location.href = '../adminchangeratio.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$query = "SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../adminchangeratio.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../adminchangeratio.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$query = "UPDATE sponsors SET dollar_ratio = ".$_POST['dollar_ratio']." WHERE company_name = '".$_POST['company_name']."';";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't change ratio. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../adminchangeratio.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}

	echo "<center><h1>Ratio Changed for ".$_POST['company_name']."</h1>";
	echo "<p>New ratio is ".$_POST['dollar_ratio']."</p></center>";

	mysqli_close($conn);

?>
