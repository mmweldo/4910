<?php 
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$u = $_REQUEST['u'];
	#$query = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$f."'), (SELECT id from users where username = '".$t."'), '".$m."' , DEFAULT);";
	$query = "SELECT question FROM users WHERE username ='".$u."';";	

	$result =mysqli_query($conn, $query); 
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
		echo "Question: " . $row["question"]. "<br>";
	    }
	} else {
	    echo "0 results";
	}	
	mysqli_close($conn);

?>
