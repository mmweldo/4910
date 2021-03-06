<html>
	<head>	  
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<title>Check Applications</title>
	</head>
	<body>
	<?php
		session_start();
		if($_SESSION['user_type'] == "sponsor"){
			include 'sponsorheader.php';
		}else if($_SESSION['user_type'] == "admin"){
			include 'adminheader.php'; 
		}else if($_SESSION['user_type'] == "driver"){
			include 'driverheader.php';
		}
		if(!isset($_SESSION['username']) || $_SESSION['user_type'] == "admin"){
			echo "Error: Wrong user or not logged in!";
			echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGEDIN';\", 3000);</script>";
		}

		// Create connection
		#$conn = new mysqli($servername, $username, $password, $dbname);
		$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
		$conn = mysqli_connect($endpoint, "master", "group4910", "website");

		
		//Display the applications page for users
		if($_SESSION['user_type'] == "driver"){
			$query = "SELECT sponsor_id FROM applications WHERE driver_id = ".$_SESSION['user_id'].";";
			
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Error: Couldn't find any applications.";
				exit();
			}
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				echo "[2] Error: Couldn't find any applications.";
				echo "<script>setTimeout(\"location.href = '../index.php?NO-APPS';\", 3000);</script>";
				exit();
			} else {
				$query = "select company_name, status FROM applications join sponsors on applications.sponsor_id = sponsors.user_id WHERE applications.driver_id = ".$_SESSION['user_id'].";";
				$result = mysqli_query($conn, $query);
				if(!$result){
					echo "Error: Sponsor Apps not found! Redirecting...";
					echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-SPONSORS';\", 3000);</script>";
					exit();
				}

				$resultCheck = mysqli_num_rows($result);
				if($resultCheck < 1){
					echo "Error: Sponsor Apps not found! Redirecting...";
					echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-SPONSORS';\", 3000);</script>";
					exit();
				}

				echo "<center>";
				echo "<h3>Driver - All Applications";
				
				echo '<table class="table" style="tab-size:4px;">';
				echo '<tr style="tab-size:4px;">';
				echo '<th style="tab-size:4px;">Sponsor Company  </th>';
				echo "<th>Application Status  </th>";
				echo "</tr>";
				
				while($row=mysqli_fetch_row($result)){
					echo "<tr>"; 
					echo '<td style="tab-size:4px;">'.$row[0].'</td>'; 
					echo "<td>".$row[1]."</td>"; 
					echo "<td>".$row[2]."</td>";  
					echo "</tr>"; 
				}
				echo '</center>';
			}	

		}

		//Applies --------------------------------
		if($_SESSION['user_type'] == "sponsor"){
			$query = "SELECT driver_id FROM applications WHERE sponsor_id = ".$_SESSION['user_id'].";";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Error: Couldn't find any applications.";
				exit();
			}
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				echo "[2] Error: Couldn't find any applications.";
				echo "<script>setTimeout(\"location.href = '../index.php?NO-APPS';\", 3000);</script>";
				exit();
			} else {
				#$query = "SELECT username, firstname, lastname, status FROM applications JOIN drivers on applications.driver_id = (SELECT driver_id FROM applications where sponsor_id = ".$_SESSION['user_id'].";";
				$query = "SELECT username, firstname, lastname, status FROM applications join drivers on applications.driver_id = drivers.user_id WHERE applications.sponsor_id = ".$_SESSION['user_id'].";";	
				
				$result = mysqli_query($conn, $query);
				if(!$result){
					echo "Error: Driver Apps not found! Redirecting...";
					echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-DRIVERS';\", 3000);</script>";
					exit();
				}

				$resultCheck = mysqli_num_rows($result);
				if($resultCheck < 1){
					echo "Error: Driver Apps not found! Redirecting...";
					echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-DRIVERS';\", 3000);</script>";
					exit();
				}

				echo "<center>";
				echo "<h3>Sponsor - View All Applications";
				echo '<table class="table" style="tab-size:4px;">';
				echo '<tr stlye="tab-size:4px;">';
				echo '<th style="tab-size:4px;">Driver Username  </th>';
				echo "<th>Driver Firstname  </th>";
				echo "<th>Driver Lastname  </th>";
				echo "<th>Status  </th>";
				echo "<th>Approve </th>";
				echo "<th>Deny </th>";
 				echo "</tr>";
				
				while($row=mysqli_fetch_row($result)){
					echo '<tr style="tab-size:4px;">'; 
					echo '<td style="tab-size:4px;">'.$row[0]."</td>"; 
					echo "<td>".$row[1]."</td>"; 
					echo "<td>".$row[2]."</td>"; 
					echo "<td>".$row[3]."</td>";
					if($row[3] == "pending"){
						echo '<td><form class="profile-form" method="post" action="application_from.php"><input type="hidden" style="width:0px;" type="text" name="driver_username" placeholder="driver_username" value="'.$row[0].'"><input type="hidden" style="width:0px;" type="text" name="status" placeholder="status" value="approved"><button type="View" name="submit">Accept</button></form><td>'; 

						echo '<td><form class="profile-form" method="post" action="application_from.php"><input type="hidden" style="width:0px;" type="text" name="driver_username" placeholder="driver_username" value="'.$row[0].'"><input type="hidden" style="width:0px;" type="text" name="status" placeholder="status" value="denied"><button type="View" name="submit">Deny</button></form><td>';
					}
					else{//In case that the application has already been approved/denied
						echo "<td>/ </td>";
						echo "<td>/ </td>";
					}
					echo "</tr>"; 
				}
				echo '</center>';
			}

		}
	?>
	</body>
</html>

<!-- 
ALTER TABLE applications ADD COLUMN status varchar(20) DEFAULT "pending";
-->
