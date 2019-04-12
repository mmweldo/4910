  <!--A large amount of this page was supplied by https://startbootstrap.com/templates/shop-homepage/, an equal amount of work adjusting was done as well. Credit to the unnamed authors, since this work is based on it, it also uses MIT License -->
<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  
  #$conn = new mysqli($servername, $username, $password, $dbname);
  /*$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
  $conn = mysqli_connect($endpoint, "master", "group4910", "website");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }*/
?>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="">
	  <meta name="author" content="">
	  <title>Shop Homepage - Start Bootstrap Template</title>

	  <!-- Bootstrap core CSS -->
	  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	  <!-- Custom styles for this template -->
	  <link href="css/shop-homepage.css" rel="stylesheet"> 
	</head>
	<body>

<?php
  //Header stuffs, adds the html header based on user
  if($_SESSION['user_type'] == "sponsor"){
    	include 'sponsorheader.php';
    	$_POST['username'] = $_SESSION['username'];
	$_POST['company_name'] = $_SESSION['company_name'];
	$_POST['user_id'] = $_SESSION['user_id'];
		echo '<script>setTimeout(\"location.href = \'../storepage.php?username='.$_SESSION['username'].'&user_id='.$_SESSION['user_id'].'&user_type=sponsor&company_name='.$_SESSION['company_name'].'\';", 100);</script>';
  }
  else if($_SESSION['user_type'] == "admin"){
    	include 'adminheader.php'; 
  }else if($_SESSION['user_type'] == "driver"){
    	include 'driverheader.php';
	echo '<center>';
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

  	$sql = "SELECT sponsors.company_name, sponsors.user_id, users.username FROM (sponsors JOIN users on sponsors.user_id = users.id) JOIN driver_list ON driver_list.sponsor_id = sponsors.user_id WHERE driver_list.driver_id = ".$_SESSION['user_id'].";";
	//echo $sql;
	$result = mysqli_query($conn, $sql);
	
	if(!$result){
		echo "[0] Error: Error finding sponsors";
		//echo "<script>setTimeout(\"location.href = '../storepage.php?CANT-FIND-SPONSOR';\", 3000);</script>";
		exit();
	}
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		echo "[1] Error: Sponsor not found! Redirecting...";
		//echo "<script>setTimeout(\"location.href = '../storepage.php?CANT-FIND-SPONSOR';\", 3000);</script>";
		exit();
	}

	echo "<h2>Your sponsors and their store links</h2>";
	echo "<table>";
	echo "<tr>";
	echo "<th>Company</th>";
	echo "<th>Username</th>";
	echo "<th>Store</th>";
	echo "</tr>";
	while($row=mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[0]."</td>"; 
		echo "<td>".$row[2]."</td>"; 
	    echo '<td><form class="profile-form" method="post" action="storepage.php"><input type="hidden" name="company_name" value="'.$row[0].'"><input type="hidden" style="width:0px;" type="text" name="username" placeholder="username" value="'.$row[2].'"><input type="hidden" style="width:0px;" type="text" name="user_id" placeholder="user_id" value="'.$row[1].'"><input type="hidden" style="width:0px;" type="text" name="user_type" placeholder="user_type" value="sponsor"><button type="View" name="submit">'.$row[0].'\'s Store</button></form><td>'; 

	}
	echo '</center>';
  }
?>
		</center>
	</body>
</html>

