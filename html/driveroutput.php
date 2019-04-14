<html>
<?php
	include 'driverheader.php';

	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	// Check connection
	if ($conn->connect_error) {
		exit();
		die("Connection failed: " . $conn->connect_error);
	}

	$hash = password_hash($_POST['password'], PASSWORD_DEFAULT); //hashes password

	$sql = "INSERT INTO users (username, password, email, user_type) VALUES('".$_POST['username']."', '".$hash."', '".$_POST['email']."', 'driver');";
	$query = mysqli_query($conn, $sql);
	if($query){
		echo "Users table updated succesfully.<br>";
	}
	else {
		echo "Error: Couldn't add to users table.<br>";
	}
	
	$sql = "SELECT MAX(id) FROM users";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	//echo $row[0]."<br>"; //echo's maxid  
	if(!empty($_POST['sponsor_id'])){
		$sql = "INSERT INTO drivers (user_id, password, firstname, lastname, street_address, country, postal_code, sponsor_id, username) VALUES ( '".$row[0]."', '".$hash."', '".$_POST['firstname']."', 
		'".$_POST['lastname']."', '".$_POST['street_address']."', '".$_POST['country']."','".$_POST['postal_code']."','".$_POST['sponsor_id']."', '".$_POST['username']."')";
	} else{
		$sql = "INSERT INTO drivers (user_id, password, firstname, lastname, street_address, country, postal_code, username) VALUES ( '".$row[0]."', '".$hash."', '".$_POST['firstname']."', 
		'".$_POST['lastname']."', '".$_POST['street_address']."', '".$_POST['country']."','".$_POST['postal_code']."', '".$_POST['username']."')";
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		echo "Drivers table updated succesfully.<br>";
		echo '<table bgcolor="#C4C4C4" align="center" width="380" border="0">  
			<tr>    
				<td  align="center"colspan="2"><font color="#0000FF">Creation Complete</font></td>  
			</tr>    
			<tr/>
				<td>Log in using username:<td/>'.$_POST['username']."</td>     
			</tr>  
		</table>";
	}
	else{
		echo "Error: Couldn't add to drivers table.<br>";
	}
	if(!empty($_POST['sponsor_id'])){
		 $sql = "INSERT INTO driver_list (sponsor_id, driver_id, driver_username) values (".$_POST['sponsor_id'].", ".$row[0].",'".$_POST['username']."');";
		$query = mysqli_query($conn, $sql);
		if($query){
			echo "Driver_list table updated succesfully.";
		}
		else {
			echo "Error: Couldn't add to driver_list table.";
		}
	}

	$conn->close();
	echo "<script>setTimeout(\"location.href = '../index.php?CreationSuccess';\", 3000);</script>";
?>
</html>