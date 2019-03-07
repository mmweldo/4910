<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
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
<?php
#$servername = "localhost";
#$username = "root";
#$password = "";
#$dbname = "test";

$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
// Create connection
$conn = mysqli_connect($endpoint, "master", "group4910", "website");
// Create connection
#$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<form method="post" action="adminoutput.php"> 
<table bgcolor="#C4C4C4" align="center" width="380" border="0">   
<tr> 
<td  align="center"colspan="2"><font color="#0000FF" size="5">Update Admin Account</font></td>   
</tr>   
<tr> 
<td width="312"></td> 
<td width="172"> </td>   
</tr>   
<tr> 
<?php
echo
'</tr>
<tr>
<td>Enter Users Email* </td>
<td><input type="email" name="email" value="'.$_SESSION[email].'" required /></td>   
</tr>   
<tr> 
<tr> 
<td>Enter Users Username* </td> 
<td><input type="text" name="username" value="'.$_SESSION[username].'" required /></td>   
</tr>   
<tr> 
<td>Enter Users First Name* </td> 
<td><input type="text" name="firstname" value="'.$_SESSION[firstname].'" required /></td>   
</tr>
<tr> 
<td>Enter Users Last Name* </td> 
<td><input type="text" name="lastname" value="'.$_SESSION[lastname].'" required /></td>   
</tr>
<tr>'; 
//<td>Enter Users Picture URL </td> 
//<td><input name="profile_img" type="url" pattern="https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)(.jpg|.png|.gif)" value="'.$_SESSION[].'" required /></td>  
//</tr>

echo '<td><sup> * Indicates Required Field</sup></td> 
<td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td> 
</table>
</form> 
</body> 
</html>';
