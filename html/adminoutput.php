<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (admin) for page
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User not an admin!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<body> 
<?php
	if($_SESSION['user_type'] == "sponsor"){
		include 'sponsorheader.php';
	}
	else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else{
    include 'driverheader.php';
  }
?>
<form method="post" action="sponsoroutput.php"> 
<table bgcolor="#C4C4C4" align="center" width="380" border="0">  
<tr>    
<td  align="center"colspan="2"><font color="#0000FF">Creation Complete</font></td>  
</tr>    
<tr/>
<td>Log in using username:<td/><?php echo $_POST['username']; ?></td>     
</tr>  
</table>
<?php

$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
// Create connection
$conn = mysqli_connect($endpoint, "master", "group4910", "website");

// Create connection
#$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$hash = password_hash($_POST['password'], PASSWORD_DEFAULT); //hashes password
$sql = "insert into users(username, password, email, user_type) values('$_POST[username]', '$hash', '$_POST[email]', 'admin')";
$query = mysqli_query($conn, $sql);

$sql = "select MAX(id) from users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$sql = "insert into admins (user_id, username, password, firstname, lastname) values( '$row[0]', '$_POST[username]', '$hash', '$_POST[firstname]', '$_POST[lastname]')";
$query = mysqli_query($conn, $sql);

$conn->close();
?>
</form> 
</body> 
</html>
