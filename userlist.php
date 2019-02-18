<?php  
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	$query = "SELECT users.username, users.email, users.date_created, users.id FROM users ORDER BY ".$_POST['order'].";";

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
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>";
	    echo "</tr>"; 
	}
	echo "</center>";

	mysqli_close($conn);

?>
