<?php 
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$o = $_REQUEST['o'];
	#$query = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$f."'), (SELECT id from users where username = '".$t."'), '".$m."' , DEFAULT);";
	$query = "SELECT * FROM messages WHERE receiver_id = (SELECT id from users where username='".$o."');";
	$query = "SELECT sender_id, receiver_id, message, sent_date, username from messages inner join users on messages.sender_id=users.id WHERE receiver_id = (SELECT id from users where username='".$o."') ORDER BY sent_date DESC;"; 	

	$result =mysqli_query($conn, $query); 
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<p>From: " . $row["username"]. "</p> ";
			echo "<p>Message: " . $row["message"]. "</p> ";
			echo "<p>Sent: " . $row["sent_date"]. "</p> ";
			echo "<hr style='border-top:1px solid #000000'>";
		}
	} else {
		echo "0 results";
	}
	

	mysqli_close($conn);
?>
