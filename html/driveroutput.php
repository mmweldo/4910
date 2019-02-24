<table bgcolor="#C4C4C4" align="center" width="380" border="0">  
<tr>    
<td  align="center"colspan="2"><font color="#0000FF">Creation Complete</font></td>  
</tr>    
<tr/>
<td>Log in using username:<td/><?php echo $_POST['username']; ?></td>     
</tr>  
</table>
<?php
	//$servername = "localhost";
	//$username = "root";
	//$password = "";
	//$dbname = "test";

	// Create connection

	//$conn = new mysqli($servername, $username, $password, $dbname);
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	// Check connection
	if ($conn->connect_error) {
		exit();
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO users (username, password, email) VALUES('".$_POST['username']."', '".$_POST['password']."', '".$_POST['email']."');";
	$query = mysqli_query($conn, $sql);
	if($query){
		echo "Users table updated succesfully.";
	}
	else {
		echo "Error: Couldn't add to users table.";
	}
	
	$sql = "SELECT MAX(id) FROM users";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	echo $row[0]."<br>";

	$sql = "INSERT INTO drivers (user_id, password, firstname, lastname, street_address, country, postal_code, sponsor_id, username) VALUES ( '".$row[0]."', '".$_POST['password']."', '".$_POST['firstname']."', 
		'".$_POST['lastname']."', '".$_POST['street_address']."', '".$_POST['country']."','".$_POST['postal_code']."','".$_POST['sponsor_id']."', '".$_POST['username']."')";


	$query = mysqli_query($conn, $sql);
	if($query){
		echo "Drivers table updated successfully.";
	}
	else{
		echo "Error: Couldn't add to drivers table.";
	}
	if("" != trim($_POST['sponsor_id'])){
		$sql = "INSERT INTO driver_list (sponsor_id, driver_id, driver_username) values (".$_POST['sponsor_id'].", ".$row[0].",".$_POST['username'].");";
		$query = mysqli_query($conn, $sql);
		if($query){
			echo "Driver_list table updated succesfully.";
		}
		else {
			echo "Error: Couldn't add to driver_list table.";
		}
	}

	$conn->close();
?>
