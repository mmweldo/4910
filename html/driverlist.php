<?php  
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "sponsor" && $_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
		exit();
	}
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT user_id FROM sponsors join users on sponsors.user_id = users.id WHERE username = '".$_POST['company_username']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../driverlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../driverlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$query = "SELECT drivers.firstname, drivers.lastname, drivers.username, driver_list.total_points, driver_list.current_points, users.date_created FROM drivers left join (users join driver_list on driver_list.driver_id = users.id) on drivers.user_id = users.id WHERE driver_list.sponsor_id = ".mysqli_fetch_row($result)[0]." ORDER BY ".$_POST['order'].";";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Empty driver list. Redirecting...";
		#echo "<script>setTimeout(\"location.href = '../driverlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}
	
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "Error: Empty driver list. Redirecting...";
		#echo "<script>setTimeout(\"location.href = '../driverlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}

	echo "<center>";
	echo "<h3>Driver List for Sponsor: ".$_POST['company_username']."</h3>";
	echo "<p>Ordered By: ";

	switch($_POST['order']){	
		case "drivers.firstname ASC":
			echo "Firstname Ascending</p>";
			break;
		case "drivers.firstname DESC":
			echo "Firstname Descending</p>";
			break;
		case "drivers.lastname ASC":
			echo "Firstname Ascending</p>";
			break;
		case "drivers.lastname DESC":
			echo "Lastname Descending</p>";
			break;
		case "drivers.username ASC":
			echo "Username Ascending</p>";
			break;
		case "drivers.username DESC":
			echo "Username Descending</p>";
			break;
		case "drivers.total_points ASC":
			echo "Total Points Ascending</p>";
			break;
		case "drivers.total_points DESC":
			echo "Total Points Descending</p>";
			break;
		case "drivers.current_points ASC":
			echo "Current Points Ascending</p>";
			break;
		case "drivers.current_points DESC":
			echo "Current Points Descending</p>";
			break;
		case "users.date_created ASC":
			echo "Date Created Ascending</p>";
			break;
		case "users.date_created DESC":
			echo "Date Created Descending</p>";
			break;
		default:
			echo "<p>Error finding ordering";
			break;
	}
	echo "<table>";
	echo "<tr>";
	echo "<th>Firstname</th>";
	echo "<th>Lastname</th>";
	echo "<th>Username</th>";
	echo "<th>Total Points</th>";
	echo "<th>Current Points</th>";
	echo "<th>Date Created</th>";
	echo "<th>Profile</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>"; 
	    echo "<td>".$row[4]."</td>"; 
	    echo "<td>".$row[5]."</td>";
	    echo '<td><form class="profile-form" method="post" action="profile.php"><input type="hidden" name="user_type" value="driver"><input type="hidden" style="width:0px;" type="text" name="username" placeholder="username" value="'.$row[2].'"><button type="View" name="submit">'.$row[2].'</button></form><td>'; 
	    echo "</tr>"; 
	}
	echo "</center>";

	mysqli_close($conn);

?>
