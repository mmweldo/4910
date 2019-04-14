<html>
<?php
	include 'driverheader.php';
?>
<?php

	// Create connection
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	$hash = password_hash($_POST['password'], PASSWORD_DEFAULT); //hashes password

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	//$sql = "INSERT INTO users(username, password, email, user_type) VALUES ('".$_POST[username]."', '".$hash."', '".$_POST[email]."', 'sponsor')";
	$sql = "INSERT INTO users (username, password, email, user_type) VALUES ".'(\''.$_POST['username'].'\',\''.$hash.'\',\''.$_POST['email'].'\',\'sponsor\')';
	$query = mysqli_query($conn, $sql);
	
	if(!$query){ 
		echo 'Error inserting into users.';
		echo $sql."<br>";
	}
	$sql = "SELECT id FROM users WHERE username = ".$_POST[username].";";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	echo $row[0]."<br>";

	//$sql = "insert into sponsors (user_id, password, company_name) values( '".$row[0]."', '".$hash."', '".$_POST[company_name]."')";

	$sql = "INSERT INTO sponsors (user_id, password, company_name) VALUES ".'('.$row[0].',\''.$hash.'\',\''.$_POST['company_name'].'\')';
	$query = mysqli_query($conn, $sql);
	
	if($query){
		echo 'User Account Created!';
		echo '<table bgcolor="#C4C4C4" align="center" width="380" border="0">  
			<tr>    
				<td  align="center"colspan="2"><font color="#0000FF">Creation Complete</font></td>  
			</tr>    
			<tr>
				<td>Log in using username: '.$_POST['username'].'</td>     
			</tr>  
		</table>';
	} else echo 'ya done gooofed';

	$conn->close();
	echo "<script>setTimeout(\"location.href = '../index.php?CreationSuccess';\", 3000);</script>";
?>
</html>
