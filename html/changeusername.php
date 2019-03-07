<?php  
	session_start();
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	
	if(!isset($_SESSION['username'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	#Check if user exists
	$query = "SELECT id FROM users WHERE username = '".$_SESSION['username']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: User not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?NONEXISTANT-USER';\", 3000);</script>";
		exit();
	}

	#Check if new username exists already
	$query = "SELECT id FROM users WHERE username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);

	/**echo $result;
	if($result){
		echo "Error: Username ".$_POST['username']." is taken! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?USERNAME-TAKEN';\", 3000);</script>";
		exit();
	}**/
	if($resultCheck > 0){
		echo "Error: Username taken! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?USERNAME-TAKEN';\", 3000);</script>";
		exit();
	}

	$query = "UPDATE users SET username = '".$_POST['username']."' WHERE username = '".$_SESSION['username']."';";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't change username. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../changeusername.html?CHANGEUSERNAME-FAILURE';\", 3000);</script>";
		exit();		
	}

	echo "<center><h1>Username Changed for ".$_SESSION['username']."</h1>";
	echo "<p>New username is ".$_POST['username']."</p></center>";
	$_SESSION['username'] = $_POST['username'];

	mysqli_close($conn);

?>
