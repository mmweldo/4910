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

	if($_SESSION['user_type'] == "driver"){
	    include 'driverheader.php';
	}
	else if($_SESSION['user_type'] == "sponsor"){
		include 'sponsorheader.php';
		echo '<a style="position:relative; left:0px; float:left;" href="/addpointshtml.php"><button class="btn btn-success btn-sm">Points Mainpage</button></a>';
	}
	else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}

	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT user_id, company_name, users.username, dollar_ratio FROM sponsors JOIN users on users.id = sponsors.user_id WHERE company_name = '".$_POST['company_name']."';";
	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../adminsearchsponsorshtml.php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../adminsearchsponsorshtml.php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	echo "<center>";
	echo "<h3>Admin - All information on ".$_POST['company_name']."</h3>";
	
	echo '<table class="table">';
	echo "<tr>";
	echo "<th>User ID</th>";
	echo "<th>Company</th>";
	echo "<th>Username</th>";
	echo "<th>Dollar Ratio</th>";
	echo "</tr>";
	
	$row=mysqli_fetch_row($result);
    echo "<tr>"; 
    echo "<td>".$row[0]."</td>"; 
    echo "<td>".$row[1]."</td>"; 
    echo "<td>".$row[2]."</td>"; 
    echo "<td>".$row[3]."</td>"; 
    echo "</tr>"; 

	$query = "SELECT drivers.firstname, drivers.lastname, drivers.username, driver_list.total_points, driver_list.current_points FROM driver_list join drivers ON driver_list.driver_id = drivers.user_id WHERE driver_list.sponsor_id = ".$row[0].";";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Empty driver list, sponsors with drivers would have their list of drivers below.";
		#echo "<script>setTimeout(\"location.href = '../adminsearchsponsorshtml.php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}
	
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "Empty driver list, sponsors with drivers would have their list of drivers below.";
		#echo "<script>setTimeout(\"location.href = '../adminsearchsponsorshtml/php?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();		
	}


	echo '<table class="table"><h4>Driver list for '.$_POST['company_name'].':<h4>';
	echo "<tr>";
	echo "<th>Firstname</th>";
	echo "<th>Lastname</th>";
	echo "<th>Username</th>";
	echo "<th>Total Points</th>";
	echo "<th>Current Points</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>".$row[1]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo "<td>".$row[3]."</td>"; 
	    echo "<td>".$row[4]."</td>"; 
	    echo "</tr>"; 
	}
	mysqli_close($conn);
	
?>
