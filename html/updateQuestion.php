<?php 
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$u = $_REQUEST['u'];
	$q = $_REQUEST['q'];
	$a = $_REQUEST['a'];
	$updateQuery = "UPDATE users SET question = '".$q."', answer = '".$a."' WHERE username = '".$u."';";

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if(mysqli_query($conn, $updateQuery)){
		echo "Question updated";    
	}
	else{
		echo "Try A Different Question";	
	}
	mysqli_close($conn);
	
?>
