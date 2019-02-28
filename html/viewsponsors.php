<?php  
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT sponsors.company_name, users.email, username, sponsors.user_id, users.date_created FROM sponsors join users ON sponsors.user_id = users.id";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Error: Error finding sponsors";
		echo "<script>setTimeout(\"location.href = '../viewsponsors.html?CANT-FIND-SPONSOR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../viewsponsors.html?CANT-FIND-SPONSOR';\", 3000);</script>";
		exit();
	}

	echo "<center>";
	echo "<h3>List of Sponsors</h3>";
	echo "<p>Ordered By: ";

	switch($_POST['order']){	
		case "sponsors.company_name ASC":
			echo "Company Ascending</p>";
			break;
		case "sponsors.company_name DESC":
			echo "Company Descending</p>";
			break;
		case "sponsors.email ASC":
			echo "Email Ascending</p>";
			break;
		case "sponsors.email DESC":
			echo "Email Descending</p>";
			break;
		case "sponsors.username ASC":
			echo "Username Ascending</p>";
			break;
		case "sponsors.username DESC":
			echo "Username Descending</p>";
			break;
		case "sponsors.user_id ASC":
			echo "User ID Ascending</p>";
			break;
		case "sponsors.user_id DESC":
			echo "User ID Descending</p>";
			break;
		case "users.date_created ASC":
			echo "Creation Date Ascending</p>";
			break;
		case "users.date_created DESC":
			echo "Creation Date Descending</p>";
			break;
		default:
			echo "<p>Error finding ordering";
			break;
	}
	
	echo "<table>";
	echo "<tr>";
	echo "<th>Company</th>";
	echo "<th>Email</th>";
	echo "<th>Username</th>";
	echo "<th>User ID</th>";
	echo "<th>Creation Date</th>";
	echo "<th>Profile</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>"; 
	    echo "<td>".$row[4]."</td>";
	    echo '<td><form class="profile-form" method="post" action="profile.php"><input type="hidden" style="width:0px;" type="text" name="username" placeholder="username" value="'.$row[2].'"><button type="View" name="submit">'.$row[2].'</button></form><td>'; 
	    echo "</tr>"; 
	}
	echo "</center>";

	mysqli_close($conn);

?>
