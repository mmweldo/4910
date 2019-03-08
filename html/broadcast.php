<?php 
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";
	echo "<center>";
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	#$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	
	if($_POST['message-type'] == 'all-sponsors' ||$_POST['message-type'] == 'all-users'){
		$query = "Select user_id from admins where username = '".$_POST['username']."';";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) < 1) {
			printf("[2]Error: %s\n", mysqli_error($conn));
			exit();
		}
		else{
			$query="select user_id from sponsors;";	
			$result=mysqli_query($conn, $query);
			while($row=mysqli_fetch_row($result)){
				$query1 = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$_POST['username']."'), ".$row[0].", '".$_POST['message']."' , DEFAULT);";
				$result1 = mysqli_query($conn, $query1);
			}
			if($_POST['message-type'] == 'all-users'){
				$query="select user_id from drivers;";	
				$result=mysqli_query($conn, $query);	
				while($row=mysqli_fetch_row($result)){
					$query1 = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$_POST['username']."'), ".$row[0].", '".$_POST['message']."' , DEFAULT);";
					$result1 = mysqli_query($conn, $query1);
				}
			}
		}
	}
	else{
		$query="select driver_id from driver_list where sponsor_id = (SELECT id from users where username = '".$_POST['username']."');";
		$result = mysqli_query($conn, $query);
		$resultCheck = mysqli_num_rows($result);
		
		while($row=mysqli_fetch_row($result)){
			$query1 = "INSERT INTO messages(sender_id, receiver_id, message, sent_date) VALUES ((SELECT id from users where username = '".$_POST['username']."'), ".$row[0].", '".$_POST['message']."' , DEFAULT);";
			$result1 = mysqli_query($conn, $query1);
		}
	}
	echo "messages sent";
	echo "</center>";
	mysqli_close($conn);
?>
