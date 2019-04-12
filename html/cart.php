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
		
		$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
		$conn = mysqli_connect($endpoint, "master", "group4910", "website");
		
		//Check if an existing cart item was added to cart
		$sql = "SELECT title, amount, price FROM cart WHERE driver_id = ".$_SESSION['user_id'].";";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		$in_cart_already = "false";
		$temp=mysqli_fetch_row($result);
		if(in_array($_POST['title'],$temp)) $in_cart_already="true";
		
		//Check if user is trying to remove from cart
		if(!empty($_POST['remove']) && isset($_POST['remove'])){
			$sql = "DELETE FROM cart WHERE title = '".$_POST['remove_title']."' AND driver_id = ".$_SESSION['user_id']." AND sponsor_id =".$_POST['remove_sponsor'].";";
			$result = mysqli_query($conn, $sql);
		}
		
		//echo $in_cart_already;
		if(isset($_POST['amount']) && !$in_cart_already){
			$cart_total = 0;
			$sql = "INSERT INTO cart (sponsor_id, driver_id, title, amount, price) VALUES (".$_POST['sponsor_id'].",".$_POST['driver_id'].",'".$_POST['title']."',".$_POST['amount'].",".$_POST['price'].");";
			//echo $sql;
			$result = mysqli_query($conn, $sql);
		}else if($in_cart_already){
			$sql = "SELECT amount from cart WHERE driver_id = ".$_SESSION['user_id']." AND title = '".$_POST['title']."';";
			$result = mysqli_query($conn, $sql);
			$result = mysqli_fetch_row($result);

			$sql = "UPDATE cart SET amount = amount + ".$_POST['amount'].";";			
			echo $sql;
			$result = mysqli_query($conn, $sql);
		}
		$sql = "SELECT title, amount, price, sponsor_id FROM cart WHERE driver_id = ".$_SESSION['user_id'].";";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
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
			echo '<td><form action="cart.php" method="POST" id="remove_item"><input type="hidden" name="remove" value="remove"><input type="hidden" name="remove_sponsor" value="'.$row[3].'"><input type="hidden" name="remove_title" value="'.$row[0].'"><input type="submit" value="Submit"></form></td>';
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

