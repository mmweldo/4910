<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<body> 
	<header>
	  <div class="container">
	    <div id="branding">
	      <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
	    </div>
	    <nav>
	      <ul>
	        <li><a href="/">Home</a></li>
	        <li><a href="about.php">About</a></li>
	        <li><a href="stories.php">[Stories]</a></li>
	        <li><a href="login.html">Login/Signup</a></li>
	    </ul>
	    </nav>
	  </div>
	</header>
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
/*
$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
// Create connection
$conn = mysqli_connect($endpoint, "master", "group4910", "website");
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "update users set username='$_POST[username]', email='$_POST[email]' where id='$_SESSION[user_id]";
$query = mysqli_query($conn, $sql);

$sql = "update admins set firstname='$_POST[firstname]', lastname='$_POST[lastname]' where user_id='$_SESSION[user_id]';";
$query = mysqli_query($conn, $sql);

$conn->close();
?>
</form> 
</body> 
</html>