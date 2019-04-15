<?php 
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$u = $_REQUEST['u'];
	$p = $_REQUEST['p'];
	$a = $_REQUEST['a'];
	$hash = password_hash($p, PASSWORD_DEFAULT); //hashes password
	$query = "SELECT answer, user_type FROM users WHERE username ='".$u."';";	
	$updateQuery = "UPDATE users SET password = '".$hash."' WHERE username = '".$u."';";
	$driver = "UPDATE drivers SET password = '".$hash."' WHERE username = '".$u."';";
	$admin = "UPDATE admins SET password = '".$hash."' WHERE username = '".$u."';";
	$sponsor = "UPDATE sponsors SET password = '".$hash."' WHERE username = '".$u."';";

	$result =mysqli_query($conn, $query); 
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
		 if($row["answer"] == $a){
			echo "pass";	
			$result2 = mysqli_query($conn, $updateQuery);
			if($row["user_type"]=='admin'){
				$result3 = mysqli_query($conn, $admin);
			}
			if($row["user_type"]=='sponsor'){
				$result3 = mysqli_query($conn, $sponsor);
			}
			if($row["user_type"]=='driver'){
				$result3 = mysqli_query($conn, $driver);
			}
		}
		else{
			echo "Wrong Answer to Security Question";	
		}
	    }
	} else {
	    echo "0 results";
	}	
	mysqli_close($conn);

?>
