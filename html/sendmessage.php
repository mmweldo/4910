<?php 
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$t = $_REQUEST['t'];
	$f = $_REQUEST['f'];
	$m = $_REQUEST['m'];
	#$query = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$f."'), (SELECT id from users where username = '".$t."'), '".$m."' , DEFAULT);";
	$query = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$f."'), (SELECT id from users where username = '".$t."'), '".$m."' , DEFAULT);";
	

	$result =mysqli_query($conn, $query); 

	if (!$result) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}
	else{
		echo "message sent";

	}
	mysqli_close($conn);
?>
