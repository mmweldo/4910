<html>
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
    include 'adminheader.php';
?>

<body><center>
    <!------------------------------------------------------------------------------------------------>
    <h2>Admin - Remove Driver from Sponsor List</h2>
    <form method="post" action="admrmdrlist.php">
        <input type="text" name="username" placeholder="Driver Username">
        <button type="submit" name="submit">Submit</button>
    </form>
    <!------------------------------------------------------------------------------------------------>
    <h2>Admin - Delete Users</h2>
    <form class="deleteusers-form" method="post" action="deleteusers.php">
        <p> Username </p><input type="text" name="username" placeholder="Username">
        <button type="submit" name="submit">Submit</button>
    </form>
    <!------------------------------------------------------------------------------------------------>
    <h3>Admin - Search Sponsor by Name</h3>
    <form class="adminsearchsponsors-form" method="post" action="adminsearchsponsors.php">
        <p>Company Name</p><input type="text" name="company_name" placeholder="Comany Name">
        <button type="submit" name="submit">Submit</button>
    </form>
    <!------------------------------------------------------------------------------------------------>
    <h3>Admin - Change Ratio</h3>
    <form class="driverlist-form" method="post" action="adminchangeratio.php">
        <p>Company Name | Dollar Ratio</p>
        <p><i style="font-size: 8pt;">Format: ##.## and must be larger than > 0</i><p>
        <input type="text" name="company_name" placeholder="Comany Name" pattern="{1,}" required>
        <input type="text" name="dollar_ratio" placeholder="New Dollar Ratio" pattern="[0-9]+(\.[0-9]{0,2})?">
        <button type="submit" name="submit">Submit</button>
    </form>
    <!------------------------------------------------------------------------------------------------>
    <h3>Admin - Assign Drivers to Sponsors</h3>
    <form class="adminassign-form" method="post" action="adminassign.php">
        <p>Company Name | Driver Username</p><input type="text" name="company_name" placeholder="Comany Name">
        <input type="text" name="username" placeholder="Driver Username">
        <button type="submit" name="submit">Submit</button>
    </form>
    <!------------------------------------------------------------------------------------------------>
    <h3>Admin Creates Sponsor</h3>
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
    <!------------------------------------------------------------------------------------------------>
    <h3>Admin Creates Driver</h3>
	<form method="post" action="driveroutput.php"> 
		<table bgcolor="#C4C4C4" align="center" width="400" border="0">   
		<tr> 
			<td  align="center"colspan="2"><font color="#0000FF" size="5">Create Driver Account</font></td>   
			</tr>   
			<tr> 
			<td width="312"></td> 
			<td width="172"> </td>   
		</tr>   
		<tr> 
			<td>Enter User's Email </td> 
			<td><input type="email" name="email" required title="Email"/></td>   
		</tr>   
			<tr> 
			<td>Enter User's Password </td> 
			<td><input type="password" name="password" required title="Password"/></td>   
		</tr>   
		<tr> 
			<td>Enter User's Username </td> 
			<td><input pattern="[a-zA-Z0-9]{1,30}" type="text" name="username" required title="Username"/></td>   
		</tr>   
		<tr> 
			<td>Enter User's First Name </td> 
			<td><input pattern="[a-zA-Z]{1,30}" type="text" name="firstname" required title="First Name"/></td>   
		</tr>
		<tr> 
			<td>Enter User's Last Name </td> 
			<td><input pattern="[a-zA-Z]{1,30}" type="text" name="lastname" required title="Last Name"/></td>   
		</tr>
			<td>Enter User's Street Address </td> 
			<td><input pattern="{1,30}" type="text" name="street_address" required title="Street Address"/></td>   
		</tr>
			<td>Enter User's Country </td> 
			<td><input pattern="[a-zA-Z]{1,30}" type="text" name="country" required title="Country"/></td>   
		</tr>
			<td>Enter User's Postal Code </td> 
			<td><input type="text" pattern="[0-9]{5}" name="postal_code" title="Five digit zip code" required /></td>   
		</tr>
		</tr>
			<td>Enter User's Sponsor ID </td> 
			<td><input pattern="[0-9]{1,}" type="sponsor_id" name="sponsor_id" /></td>   
		</tr>
			<td><sup> * Indicates Required Field</sup></td> 
			<td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td> 
		</table>
    </form>
    <!------------------------------------------------------------------------------------------------> 
    <h3>Admin Creates Admin</h3>
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
    <!------------------------------------------------------------------------------------------------> 
</center></body>
</html>