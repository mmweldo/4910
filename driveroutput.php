<table bgcolor="#C4C4C4" align="center" width="380" border="0">  
<tr>    
<td  align="center"colspan="2"><font color="#0000FF">Creation Complete</font></td>  
</tr>    
<tr/>
<td>Log in using username:<td/><?php echo $_POST['username']; ?></td>     
</tr>  
</table>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";

// Create connection
//$conn = mysqli_connect($endpoint, "master", "group4910", "website");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "insert into users(username, password, email) values('$_POST[username]', '$_POST[password]', '$_POST[email]')";
$query = mysqli_query($conn, $sql);
if($query){
	echo 'data inserted succesfully ';
}
else
	echo 'oh god why ';
$sql = "select MAX(id) from users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
echo $row[0]."<br>";

$sql = "insert into drivers (user_id, password, firstname, lastname, street_address, country, postal_code, sponsor_id, username) values( '$row[0]', '$_POST[password]', '$_POST[firstname]', 
	'$_POST[lastname]', '$_POST[street_address]', '$_POST[country]','$_POST[postal_code]','$_POST[sponsor_id]', '$_POST[username]')";

$query = mysqli_query($conn, $sql);
if($query){
	echo 'data inserted succesfully';
}
else
	echo 'ya done gooofed';

$conn->close();
?>