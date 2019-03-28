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

	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");

	$query = "SELECT sponsor_id, driver_id, driver_username, company_name FROM driver_list join sponsors on driver_list.sponsor_id = sponsors.user_id WHERE driver_username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Couldn't find any sponsors.";
		exit();
	}
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "[2] Error: Couldn't find sponsors.";
		echo "<script>setTimeout(\"location.href = '../index.php?NO-SPONSORS';\", 3000);</script>";
		exit();
	}
	echo "<center>";
				echo "<h3>Driver - All Sponsors";
				
				echo "<table>";
				echo "<tr>";
				echo "<th>Sponsor id</th>";
				echo "<th>Company Name</th>";
				echo "<th>Remove from Sponsor</th>";
				echo "</tr>";
				
				while($row=mysqli_fetch_row($result)){
					echo "<tr>"; 
					echo "<td>".$row[0]."</td>"; 
					echo "<td>".$row[3]."</td>"; 
					echo '<td><form class="profile-form" method="post" action="admrmdrbutton.php"><input type="hidden" style="width:0px;" type="text" name="sponsor_id" placeholder="sponsor_id" value="'.$row[0].'"><input type="hidden" style="width:0px;" type="text" name="driver_id" placeholder="driver_id" value="'.$row[1].'"><button type="View" name="submit">Remove</button></form><td>'; 
	      
					echo "</tr>"; 
				}
				echo '</center>';

?> 