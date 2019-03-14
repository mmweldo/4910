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
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";

		session_start();
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
				echo "SELECT company_name, username, status FROM sponsors JOIN applications on sponsor_id = (SELECT sponsor_id FROM applications where driver_id = ".$_SESSION['user_id'].";";
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
				
				echo "<table>";
				echo "<tr>";
				echo "<th>Sponsor Company</th>";
				echo "<th>Sponsor Username</th>";
				echo "<th>Application Status</th>";
				echo "</tr>";
				
				$row=mysqli_fetch_row($result);
			    echo "<tr>"; 
			    echo "<td>".$row[0]."</td>"; 
			    echo "<td>".$row[1]."</td>"; 
			    echo "<td>".$row[2]."</td>";  
			    echo "</tr>"; 
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
				$query = "SELECT username, firstname, lastname, status FROM applications JOIN drivers on driver_id = (SELECT driver_id FROM applications where sponsor_id = ".$_SESSION['user_id'].";";
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
				echo "<h3>SPONSOR - All Applications";
				echo "<table>";
				echo "<tr>";
				echo "<th>Driver Username</th>";
				echo "<th>Driver Firstname</th>";
				echo "<th>Driver Lastname</th>";
				echo "<th>Status</th>";
				echo "</tr>";
				
				$row=mysqli_fetch_row($result);
			    echo "<tr>"; 
			    echo "<td>".$row[0]."</td>"; 
			    echo "<td>".$row[1]."</td>"; 
			    echo "<td>".$row[2]."</td>"; 
			    echo "<td>".$row[3]."</td>";  
			    echo "</tr>"; 
			    echo '</center>';
			}

		}
	?>
	</body>
</html>

<!-- 
ALTER TABLE applications ADD COLUMN status varchar(20) DEFAULT "pending";
-->
