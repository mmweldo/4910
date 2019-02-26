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
	<form method="post" action="driveroutput.php"> 
		<table bgcolor="#C4C4C4" align="center" width="380" border="0">   
		<tr> 
			<td  align="center"colspan="2"><font color="#0000FF" size="5">Create Driver Account</font></td>   
			</tr>   
			<tr> 
			<td width="312"></td> 
			<td width="172"> </td>   
		</tr>   
		<tr> 
			<td>Enter User's Email </td> 
			<td><input type="email" name="email" required/></td>   
		</tr>   
			<tr> 
			<td>Enter User's Password </td> 
			<td><input type="password" name="password" required /></td>   
		</tr>   
		<tr> 
			<td>Enter User's Username </td> 
			<td><input type="text" name="username" required/></td>   
		</tr>   
		<tr> 
			<td>Enter User's First Name </td> 
			<td><input type="text" name="firstname" required/></td>   
		</tr>
		<tr> 
			<td>Enter User's Last Name </td> 
			<td><input type="text" name="lastname" required/></td>   
		</tr>
			<td>Enter User's Street Address </td> 
			<td><input type="text" name="street_address" required/></td>   
		</tr>
			<td>Enter User's Country </td> 
			<td><input type="text" name="country" required/></td>   
		</tr>
			<td>Enter User's Postal Code </td> 
			<td><input type="text" pattern="[0-9]{5}" name="postal_code" title="Five digit zip code" required/></td>   
		</tr>
		</tr>
			<td>Enter User's Sponsor ID </td> 
			<td><input type="sponsor_id" name="sponsor_id"  /></td>   
		</tr>
			<td><sup> * Indicates Required Field</sup></td> 
			<td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td> 
		</table>
	</form> 
		<footer>
	      		<p>Drewp, Copyright &copy; 2019</p>
	    	</footer>

	</body> 
</html>
