  <!--A large amount of this page was supplied by https://startbootstrap.com/templates/shop-homepage/, an equal amount of work adjusting was done as well. Credit to the unnamed authors, since this work is based on it, it also uses MIT License -->
<?php 

	session_start();

  
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
		
		//echo $_POST['title'];
		//echo $_POST['sponsor_id'];
		//echo $_POST['driver_id'];
		//echo $_POST['price'];

		$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
		$conn = mysqli_connect($endpoint, "master", "group4910", "website");
		
		//Check if an existing cart item was added to cart
		$sql = "SELECT title, amount, price FROM cart WHERE driver_id = ".$_SESSION['user_id']." AND title = '".$_POST['title']."';";
		//echo $sql;

		$result = mysqli_query($conn, $sql);
		$in_cart_already = "false";
		$temp=mysqli_fetch_row($result);

		if($result->num_rows != 0) $in_cart_already="true";
		//echo $in_cart_already;

		//Check if user is trying to remove from cart
		if(!empty($_POST['remove']) && isset($_POST['remove'])){
			//echo "in remove";
			$sql = "DELETE FROM cart WHERE title = '".$_POST['remove_title']."' AND driver_id = ".$_SESSION['user_id']." AND sponsor_id =".$_POST['remove_sponsor'].";";
			$result = mysqli_query($conn, $sql);
		}
		
		if(isset($_POST['amount']) && $in_cart_already != "true"){
			//echo "in adding new item";
			$cart_total = 0;
			$sql = "INSERT INTO cart (sponsor_id, driver_id, title, amount, price) VALUES (".$_POST['sponsor_id'].",".$_POST['driver_id'].",'".$_POST['title']."',".$_POST['amount'].",".$_POST['price'].");";
			//echo $sql;
			$result = mysqli_query($conn, $sql);
		}else if($in_cart_already == "true"){
			//echo "in adding old item";
			$sql = "SELECT amount from cart WHERE driver_id = ".$_SESSION['user_id']." AND title = '".$_POST['title']."';";
			$result = mysqli_query($conn, $sql);
			$result = mysqli_fetch_row($result);

			$sql = "UPDATE cart SET amount = amount + ".$_POST['amount'].";";			
			$result = mysqli_query($conn, $sql);
		}
		
		$sql = "SELECT title, amount, price, sponsor_id, dollar_ratio FROM cart JOIN sponsors ON sponsors.user_id = cart.sponsor_id WHERE driver_id = ".$_SESSION['user_id'].";";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "<br>error<br>";
			echo $sql;
		}echo $sql."<br>";
		$row = mysqli_fetch_row($result);
		$title = $row[0];
		$amount = $row[1];
		$price = $row[2];
		$sponsor_id = $row[3];
		$dollar_ratio = $row[4];
		

		$sql = "SELECT current_points FROM driver_list join sponsors ON driver_list.sponsor_id = sponsors.user_id WHERE driver_id = ".$_SESSION['user_id']." AND driver_list.sponsor_id = ".$sponsor_id.";";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "<br>error<br>";
			echo $sql;
		}echo $sql."<br>";
		$row = mysqli_fetch_row($result);
		$current_points = $row[0];
		
		echo '<a style="position:relative; left:0px; float:left;" href="/storeconnector.php"><button class="btn btn-success btn-sm">Store</button></a>';
		echo '<center><h3>Your Cart</h3>';
		echo '<table><tr>';
		echo '<th>Title</th>';
		echo '<th>Cost Per</th>';
		echo '<th>Amount</th>';
		echo '<th>Total Cost</th>';
		echo '<th>Your Points</th>';
		echo '</tr>';
		while($row=mysqli_fetch_row($result)){
			$cost = (double)$row[1] * (double)$row[2];
			echo "<tr>";
			echo "<td>".$title."</td>";
			echo "<td>".$price*$dollar_ratio."</td>"; 
			echo "<td>".$amount."</td>"; 
			echo "<td>".$cost*$dollar_ratio."</td>";
			echo "<td>".$current_points."</td>";		
			echo '<td>
				<form action="cart.php" method="POST" id="remove_item">
					<input type="hidden" name="remove" value="remove">
					<input type="hidden" name="remove_sponsor" value="'.$sponsor_id.'">
					<input type="hidden" name="remove_title" value="'.$title.'">
					<input type="submit" value="Remove All">
				</form>
			</td>';
			
			echo '<td>
				<form action="checkout.php" method="POST" id="checkout_item">
					<input type="hidden" name="checkout" value="individual">
					<input type="hidden" name="title" value="'.$title.'">
					<input type="hidden" name="sponsor_id" value="'.$sponsor_id.'">
					<input type="hidden" name="cost" value="'.$cost.'">
					<input type="submit" value="Checkout All '.$amount.'">
				</form>
			</td>';
			echo "</tr>";
			$cart_total += (double)$amount * (double)$price * $dollar_ratio;
		}
		echo "</table>";
		echo "<br><br>";
		echo "<h3>Cart Total: ".$cart_total."</h3>";

		/*echo '<form action="checkout.php" method="POST" id="checkout_items">
			<input type="hidden" name="checkout" value="all">
			<input type="submit" value="Checkout Everything">
		</form>';*/
		
  	}
		$_POST = array();
?>

		</center>
	</body>
</html>

