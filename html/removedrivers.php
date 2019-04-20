<?php  
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}

	if($_SESSION['user_type'] != "sponsor"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
		exit();
	}

	include 'sponsorheader.php';
	echo '<a style="position:relative; left:0px; float:left;" href="/viewsponsorshtml.php"><button class="btn btn-success btn-sm">Sponsor Management Page</button></a>';

	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
	$query = "SELECT driver_id FROM driver_list WHERE sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."') AND driver_username = '".$_POST['username']."';";

	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_row($result);
	if(!$result){
		echo "[1] Error: Driver-Sponsor pair not found! Redirecting...";
		#echo "<script>setTimeout(\"location.href = '../removedrivers.html?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "[2] Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../viewsponsorshtml.php?NONEXISTANT-PAIR';\", 3000);</script>";
		exit();
	}

	$query = 'DELETE FROM driver_list WHERE driver_id = '.$row[0].' AND sponsor_id = '.$_SESSION['user_id'].';';

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "[3] Error: Couldn't remove driver from list...";
		echo "<script>setTimeout(\"location.href = '../viewsponsorshtml.php?COULDNT-DELETE';\", 3000);</script>";
		exit();		
	}

	echo "<center>";
	echo "<h3>Removed driver ".$_POST['username']."</h3>";
	echo "</center>";

	mysqli_close($conn);
?>
