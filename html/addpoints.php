<?php
	/*if(isset($_POST['submit'])){
		#include_once 'dbh.inc.php';
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$points = mysqli_real_escape_string($conn, $_POST['points']);

		//if anything empty then error
		if(empty($username) || empty($points)){
			#header("Location: ../addpoints.html?addpoints=empty");
			exit();
		}//character checking
		else{
			if(preg_match("/^[a-zA-Z]*$/", $username)){
				//header("Location: ../addpoints.html?addpoints=invalid");
				exit();
			}else {
				$sql = "select _user.id from _user join driver on _user.id=driver.user_id where _user.username = '$username'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck != 1) { // user not found
					exit();
				}
				#$sql = "INSERT into driver () VALUES ();";
				$sql = "UPDATE driver SET points_total=points_total+'$points' points_current=points_current+'$points' WHERE _user.id=".$result['id'];
				mysqli_query($conn, $sql);
				#header("Location: /../addpoints.html?addpoints=success");
				exit();
			}
		}
	}else{
		#header("Location: ../addpoints.html");
		exit();
	}*/
	
	//echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.php\">About</a></li><li><a href=\"stories.php\">[Stories]</a></li><li><a href=\"login.html\">Login/Signup</a></li></ul></nav></div></header>";

	//Check if user should be here
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
	  //Header stuffs, adds the html header based on user
	  if($_SESSION['user_type'] == "driver"){
	    include 'driverheader.php';
	  }
	  else if($_SESSION['user_type'] == "sponsor"){
	    include 'sponsorheader.php';
	  }
	  else if($_SESSION['user_type'] == "admin"){
	    include 'adminheader.php'; 
	  }

	if($_POST['points'] < 0){
		echo "Error, no negative points allowed! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../addpointshtml?NO-NEGATIVE-POINTS';\", 3000);</script>";
		exit();
	}
	
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");

	$query = "select * from drivers where username = '".$_POST['username']."';"; 	
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: No such user, try again.";
		exit();
	}

	$query= "select * from driver_list join sponsors on driver_list.sponsor_id = sponsors.user_id where sponsors.user_id = (select user_id from sponsors where company_name = '".$_POST['company_name']."') AND driver_list.driver_id = (select user_id from drivers where username = '".$_POST['username']."');"; 	
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1 || !$result){
		echo "Error:";
		echo "[1] Cannot find sponsor's driverlist. Is this a valid sponsor?";
		echo "[2] Is this driver in your driver list?";
		exit();
	}


	$query = "INSERT INTO points_history (sponsor_id, driver_id, date_created, point_amount) VALUES ((SELECT user_id from sponsors where company_name = '".$_POST['company_name']."'), (SELECT user_id from drivers where username = '".$_POST['username']."'), DEFAULT, ".$_POST['points']." );";

	$result = mysqli_query($conn, $query);

	if(!$result){
		echo "Error: User not in your driverlist, try again.";
		exit();
	}

	# ADD TO TOTAL POINTS
	$query = "UPDATE driver_list SET total_points=total_points+ ".$_POST['points']." WHERE driver_username = '".$_POST['username']."' AND sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."');";
	$result = mysqli_query($conn, $query);
	if (!$result) {
	    printf("[1]Error: %s\n", mysqli_error($conn));
	    exit();
	} 
	
	# ADD TO CURRENT POINTS
	$query = "UPDATE driver_list SET current_points=current_points+ ".$_POST['points']." WHERE driver_username = '".$_POST['username']."' AND sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."');";
	$result = mysqli_query($conn, $query);

	if (!$result) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
	    exit();
	}
	else{
		echo "<center>Points Updated.";
		$query = "SELECT drivers.username, driver_list.total_points, driver_list.current_points FROM drivers JOIN driver_list ON drivers.user_id = driver_list.driver_id WHERE username = '".$_POST['username']."' AND driver_list.sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."');";
		$result = mysqli_query($conn, $query);
		if (!$result) {
		    printf("[3]Error: %s\n", mysqli_error($conn));
		    exit();
		}
		echo "<table>";
		echo "<tr>";
		echo "<th>username</th>";
		echo "<th>total_points</th>";
		echo "<th>current_points</th>";
		echo "</tr>";

		while($row=mysqli_fetch_row($result)){
			    echo "<tr>"; 
	            echo "<td>".$row[0]."</td>"; 
	            echo "<td>".$row[1]."</td>"; 
	            echo "<td>".$row[2]."</td>"; 
	            echo "</tr>"; 
		}
		echo "</table></center>";
	}

	mysqli_close($conn);
?>

