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
<form method="post" action="sponsoroutput.php"> 
<table bgcolor="#C4C4C4" align="center" width="380" border="0">   
<tr> 
<td  align="center"colspan="2"><font color="#0000FF" size="5">Create Sponsor Account</font></td>   
</tr>   
<tr> 
<td width="312"></td> 
<td width="172"> </td>   
</tr>   
<tr> 
<td>Enter User's Email </td> 
<td><input type="email" name="email" required /></td>   
</tr>   
<tr> 
<td>Enter User's Password </td> 
<td><input type="password" name="password" required /></td>   
</tr>   
<tr> 
<td>Enter User's Username </td> 
<td><input pattern="[a-zA-Z0-9]{1,30}" type="username" name="username" required /></td>   
</tr>   
<tr> 
<td>Enter User's Comapny Name </td> 
<td><input pattern="[a-zA-Z0-9]{1,30}" type="company_name" name="company_name" required /></td>   
</tr>
<td><sup> * Indicates Required Field</sup></td> 
<td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td> 
</table>
</form> 
</body> 
</html>
