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

	}
	else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else if($_SESSION['user_type'] == "driver"){
		include 'driverheader.php';
		$sql = "SELECT title, amount, price FROM cart WHERE driver_id = ".$_SESSION['user_id'].";";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		$in_cart_already = false;
		while($row=mysqli_fetch_row($result)){
			if(in_array($_POST['title'],$row) $in_cart_already=true;
		}
		if(!empty($_POST) && !$in_cart_already){
			$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
			$conn = mysqli_connect($endpoint, "master", "group4910", "website");
			$cart_total = 0;
			$sql = "INSERT INTO cart (sponsor_id, driver_id, title, amount, price) VALUES (".$_POST['sponsor_id'].",".$_POST['driver_id'].",'".$_POST['title']."',".$_POST['amount'].",".$_POST['price'].");";
			//echo $sql;
			$result = mysqli_query($conn, $sql);
		}
		
		echo '<a style="position:relative; left:0px; float:left;" href="/storeconnector.php"><button class="btn btn-success btn-sm">Store</button></a>';
		echo '<center><h3>Your Cart</h3>';

		echo '<table><tr>';
		echo '<th>Title</th>';
		echo '<th>Amount</th>';
		echo '<th>Price Per</th>';
		echo '</tr>';
		while($row=mysqli_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[0]."</td>"; 
			echo "<td>".$row[1]."</td>"; 
			echo "<td>".$row[2]."</td>"; 
			echo "</tr>";
			$cart_total += (double)$row[1] * (double)$row[2];
		}
		echo "</table>";
		echo "<br><br>";
		echo "<h3>Cart Total: ".$cart_total."</h3>";
  	}
  
?>

		</center>
	</body>
</html>

