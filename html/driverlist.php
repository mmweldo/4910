<?php  
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.html\">About</a></li><li><a href=\"stories.html\">[Stories]</a></li><li><a href=\"\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."';";
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

	$query = "SELECT drivers.firstname, drivers.lastname, drivers.username, driver_list.total_points, driver_list.current_points FROM driver_list join drivers on driver_list.driver_id = drivers.user_id WHERE driver_list.sponsor_id = ".mysqli_fetch_row($result)[0]." ORDER BY ".$_POST['order'].";";

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
	echo "<h3>Driver List for Sponsor: ".$_POST['company_name']."</h3>";
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
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>"; 
	    echo "<td>".$row[4]."</td>"; 
	    echo "</tr>"; 
	}
	echo "</center>";

	mysqli_close($conn);

?>
