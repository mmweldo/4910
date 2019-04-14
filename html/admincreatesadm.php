<?php
	/*session_start();
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
	}*/
?>

<html>

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
<form method="post" action="adminoutput.php"> 
<table bgcolor="#C4C4C4" align="center" width="380" border="0">   
<tr> 
<td  align="center"colspan="2"><font color="#0000FF" size="5">Create Admin Account</font></td>   
</tr>   
<tr> 
<td width="312"></td> 
<td width="172"> </td>   
</tr>   
<tr> 
<td>Enter User's Email* </td> 
<td><input type="email" name="email" required /></td>   
</tr>   
<tr> 
<td>Enter User's Password* </td> 
<td><input type="password" name="password" required /></td>   
</tr>   
<tr> 
<td>Enter User's Username* </td> 
<td><input pattern="[a-zA-Z0-9]{1,30}" type="text" name="username" required /></td>   
</tr>   
<tr> 
<td>Enter User's First Name* </td> 
<td><input pattern="[a-zA-Z]{1,30}" type="text" name="firstname" required /></td>   
</tr>
<tr> 
<td>Enter User's Last Name* </td> 
<td><input pattern="[a-zA-Z]{1,30}" type="text" name="lastname" required /></td>   
</tr>
<td><sup> * Indicates Required Field</sup></td> 
<td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td> 
</table>
</form> 
</body> 
</html>
