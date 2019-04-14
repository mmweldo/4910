<?php 
    session_start();
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
	}else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else if($_SESSION['user_type'] == "driver"){
        include 'driverheader.php';
        echo '<a style="position:relative; left:0px; float:left;" href="/cart.php"><button class="btn btn-success btn-sm">Cart</button></a>';
        echo '<a style="position:relative; left:0px; float:left;" href="/storeconnector.php"><button class="btn btn-success btn-sm">Store</button></a>';
        
        $endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
        $conn = mysqli_connect($endpoint, "master", "group4910", "website");
        echo "<center>";
        
        //Two Cases, one is checkout all, another is checkout individual item
        if($_POST['checkout'] == "individual"){
            //echo " individual if<br> ";
            $sql = "SELECT current_points FROM driver_list join sponsors ON driver_list.sponsor_id = sponsors.user_id WHERE driver_id = ".$_SESSION['user_id']." AND driver_list.sponsor_id = ".$_POST['sponsor_id'].";";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $current_points = $row[0];
            //echo $row[0];
            
            $sql = "SELECT dollar_ratio FROM sponsors WHERE user_id = ".$_POST['sponsor_id'].";";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }
            $row = mysqli_fetch_row($result);
            $dollar_ratio = $row[0];

            //If you don't have enough, don't come here lookin' to buy!
            if($current_points < $_POST['cost']*$dollar_ratio){
                echo "<h3>Not enough points to check out!</h3>";
                echo "Current Points: ".$row[0]." Cost of Purchase: ".$_POST['cost'];
                //echo "<script>window.top.location.href=\"http://52.55.244.84/cart.php\"</script>";
                //echo '<a href="..." target="_top">link</a>';
                echo "<script>setTimeout(\"location.href = '../cart.php?NotEnoughPoints';\", 3000);</script>";
            }//else let's checkout!
            
            //Several changes need to be made
            //Update the points tracking stuffs in driver_list, drivers, and point_history
            
            //Update points_history------------------------------------------------------------------------------
            $deduction = $_POST['cost'] * -1;
            $sql = "INSERT INTO points_history (sponsor_id, driver_id, date_created, point_amount) VALUES (".$_POST['sponsor_id'].",".$_SESSION['user_id'].", DEFAULT, ".$deduction." );";
            /*$result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }*/echo $sql."<br>";

            //Update driver_lists current points to reflect purchase
            $sql = "UPDATE driver_list SET current_points=current_points - ".$_POST['cost']." WHERE driver_username = '".$_SESSION['username']."' AND sponsor_id = ".$_POST['sponsor_id'].";";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>";

            //Update drivers total spent points
            $sql = "UPDATE drivers SET total_spent = total_spent + ".$_POST['cost']." WHERE user_id = ".$_SESSION['user_id'].";";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>";

            //Update the purchase tracking stuffs in purchase, and products_bought------------------------------
            $sql = "SELECT street_address, country, postal_code FROM drivers WHERE user_id = ".$_SESSION['user_id'].";";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }echo $sql."<br>";
            $row = mysqli_fetch_row($result);
            $street = $row[0];
            $country = $row[1];
            $postal = $row[2];

            $sql = "SELECT dollar_ratio FROM sponsors WHERE user_id = ".$_POST['sponsor_id'].";";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }
            $row = mysqli_fetch_row($result);
            $cost_points = $_POST['cost'] * $row[0];
            echo $sql."<br>";
            

            $sql = "INSERT INTO purchase (driver_id, total_cost_points, total_cost_dollars, street_address, country, postal_code) VALUES (".$_SESSION['user_id'].",".$cost_points.",".$_POST['cost'].",'".$street."','".$country."','".$postal."');";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                 echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>";

            $sql = "SELECT order_id FROM purchase WHERE driver_id = ".$_SESSION['user_id']." ORDER BY order_id desc;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $orderid=$row[0];
            if(!$result){
                 echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>".$row[0]."<br>";
            
            $sql = "SELECT amount FROM cart WHERE driver_id = ".$_SESSION['user_id'].' AND title = \''.$_POST['title'].'\';';
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $amount = $row[0];
            if(!$result){
                 echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>"."amount = ".$amount."<br>";

            $sql = 'SELECT price FROM products WHERE sponsor_id = '.$_POST['sponsor_id'].' AND title = \''.$_POST['title'].'\';';
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $price = $row[0];
            if(!$result){
                 echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>"."amount = ".$amount."<br>";
            
            $pointcost = $price * $dollar_ratio;
            $sql = "INSERT INTO products_bought (order_id, sponsor_id, driver_id, price, point_cost, title, amount) VALUES (".$orderid.",".$_POST['sponsor_id'].",".$_SESSION['user_id'].",".$price.",".$pointcost.',\''.$_POST['title'].'\','.$amount.");";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            if(!$result){
                 echo "<br>error<br>";
                echo $sql;
            }//echo $sql."<br>";

            //Remove from cart the things that were added--------------------------------------------------------
            $sql = "DELETE FROM cart WHERE driver_id = ".$_SESSION['user_id'].' AND title = \''.$_POST['title'].'\';';
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "<br>error<br>";
                echo $sql;
            }//echo $sql;

        }else if($_POST['checkout'] == "all"){
            echo " all if<br> ";

        }
    }else{ //Not logged in
        echo "<script>window.top.location.href=\"http://52.55.244.84/\"</script>";//setTimeout(\"location.href = '../index.php?LOGGED-OUT;\",100);
    }
?>
        </center>
    </body>
</html>