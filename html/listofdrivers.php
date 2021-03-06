<?php  
	//This is an admin page to see all drivers that are present on the website. Sponsors have the driverlist page to see alll of their drivers
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

	$query = "SELECT drivers.firstname, drivers.lastname, drivers.username, driver_list.total_points, driver_list.current_points, users.date_created, sponsors.company_name FROM users JOIN (drivers LEFT JOIN (driver_list JOIN sponsors ON driver_list.sponsor_id = sponsors.user_id) ON driver_list.driver_id = drivers.user_id) ON users.id = drivers.user_id ORDER BY ".$_POST['order'].";";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Empty driver list. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../listofdrivershtml.php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}
	
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "Error: Empty driver list. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../listofdrivershtml.php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}

	echo "<center>";
	echo "<h3>Admin - List of All Drivers</h3>";
	echo "<p>Ordered By: ";

	switch($_POST['order']){	
		case "drivers.firstname ASC":
			echo "Firstname Ascending</p>";
			break;
		case "drivers.firstname DESC":
			echo "Firstname Descending</p>";
			break;
		case "drivers.lastname ASC":
			echo "Lastname Ascending</p>";
			break;
		case "drivers.lastname DESC":
			echo "Lastname Descending</p>";
			break;
		case "sponsors.company_name ASC":
			echo "Sponsor Name Ascending</p>";
			break;
		case "sponsors.company_name DESC":
			echo "Sponsor Name Descending</p>";
			break;
		case "drivers.username ASC":
			echo "Username Ascending</p>";
			break;
		case "drivers.username DESC":
			echo "Username Descending</p>";
			break;
		case "driver_list.total_points ASC":
			echo "Total Points Ascending</p>";
			break;
		case "driver_list.total_points DESC":
			echo "Total Points Descending</p>";
			break;
		case "driver_list.current_points ASC":
			echo "Current Points Ascending</p>";
			break;
		case "driver_list.current_points DESC":
			echo "Current Points Descending</p>";
			break;
		case "users.date_created ASC":
			echo "User Creation Ascending</p>";
			break;
		case "users.date_created DESC":
			echo "User Creation Descending</p>";
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
	echo "<th>Sponsor Name</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>"; 
	    echo "<td>".$row[4]."</td>";
	  	echo "<td>".$row[5]."</td>"; 
	  	echo "<td>".$row[6]."</td>"; 
	    echo "</tr>"; 
	}
	echo "</table>";
	echo "</center>";


	mysqli_close($conn);

?>
