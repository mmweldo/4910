<?php  
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	$query = "SELECT users.username, users.email, users.date_created, users.id, users.user_type FROM users ORDER BY ".$_POST['order'].";";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Empty driver list. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../userlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}
	
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "Error: Empty driver list. Redirecting...";
		echo "<script>setTimeout(\"location.href = '../userlist.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}

	echo "<center>";
	echo "<h3>User List for Admins</h3>";
	echo "<p>Ordered By: ";

	switch($_POST['order']){	
		case "users.username ASC":
			echo "Username Ascending</p>";
			break;
		case "users.username DESC":
			echo "Username Descending</p>";
			break;
		case "users.email ASC":
			echo "Email Ascending</p>";
			break;
		case "users.email DESC":
			echo "Email Descending</p>";
			break;
		case "users.date_created ASC":
			echo "Creation Ascending</p>";
			break;
		case "users.date_created DESC":
			echo "Creation Descending</p>";
			break;
		case "users.id ASC":
			echo "id Ascending</p>";
			break;
		case "users.id DESC":
			echo "id Descending</p>";
			break;
		default:
			echo "<p>Error finding ordering</p>";
			break;
	}

	echo "<table>";
	echo "<tr>";
	echo "<th>Username</th>";
	echo "<th>Email</th>";
	echo "<th>Creation</th>";
	echo "<th>id</th>";
	echo "<th>User Type</th>";
	echo "<th>Profile</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>";
	    echo "<td>".$row[4]."</td>";
	    echo '<td><form class="profile-form" method="post" action="profile.php"><input type="hidden" style="width:0px;" type="text" name="username" placeholder="username" value="'.$row[0].'"><input type="hidden" style="width:0px;" type="text" name="user_id" placeholder="user_id" value="'.$row[3].'"><input type="hidden" style="width:0px;" type="text" name="user_type" placeholder="user_type" value="'.$row[4].'"><button type="View" name="submit">'.$row[0].'</button></form><td>';
	    echo "</tr>"; 
	}
	echo "</center>";

	mysqli_close($conn);

?>
