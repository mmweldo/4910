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

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT id FROM users WHERE username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../deleteusershtml.php?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../deleteusershtml.php?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}

	$query = "DELETE FROM users WHERE username = '".$_POST['username']."' ;";
	
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../deleteusershtml.php?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}
	
	/*$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck < 1){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../deleteusers.html?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}*/

	echo "<center><h2>Deletion Succesful</h2><p>".$_POST['username']." is now deleted</p></center>";

	mysqli_close($conn);
?>
