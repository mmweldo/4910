<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (driver) for page
	if($_SESSION['user_type'] == "driver"){
		//echo "Error: User not an driver!";
		//echo "<script>setTimeout(\"location.href = '../index.php?NOT-DRIVER';\", 3000);</script>";
		//exit();
        include 'driverheader.php';

        $endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
        $conn = mysqli_connect($endpoint, "master", "group4910", "website");
    
        if(isset($_POST['SUBMIT'])){
            echo 'Cancellation in progress for order '.$POST['order_id'].'...<br>';

            //First get the sponsor id for the amount of points to refund
            $sql = "SELECT sponsor_id, total_cost_points FROM purchase JOIN products_bought ON purchase.order_id = products_bought.order_id WHERE purchase.order_id = ".$_POST['order_id'].";";
            //echo $sql."<br>";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);

            //Refund 
            $sql = 'UPDATE points_history SET comment = "canceled", point_amount = 0 WHERE date_created = "'.$_POST['date'].'";';
            //echo $sql."<br>";
            $result = mysqli_query($conn, $sql);
            
            $sql = "UPDATE drivers SET total_spent = total_spent - ".$row[1]." WHERE user_id = ".$_SESSION['user_id'].";";
            $result = mysqli_query($conn, $sql);
            //echo $sql."<br>";

            $sql = "UPDATE driver_list SET current_points = current_points + ".$row[1]." WHERE driver_id = ".$_SESSION['user_id']." AND sponsor_id = ".$row[0].";";
            $result = mysqli_query($conn, $sql);
            //echo $sql."<br>";

            //Cancel Order
            $sql = "UPDATE purchase SET status = 'canceled' WHERE order_id = ".$_POST['order_id'].";";
            $result = mysqli_query($conn, $sql);
            //echo $sql."<br>";
            echo "<script>setTimeout(\"location.href = '../driverpurchases.php';\", 100);</script>";
        }
        $sql = "SELECT date_created, total_cost_points, street_address, country, postal_code, order_id, status FROM purchase WHERE driver_id = ".$_SESSION['user_id'].";";
        $result = mysqli_query($conn, $sql);

        date_default_timezone_set("America/New_York");

        while($row=mysqli_fetch_row($result)){
            
            echo '<table class="table">';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Cost in Points</th>';
            echo '<th>Street Address</th>';
            echo '<th>Country</th>';
            echo '<th>Postal Code</th>';
    
            echo '<th>Status</th>';
            echo '</tr>';

            echo '<tr>';

            
            $current_date = date("Y-m-d H:i:s");
            $current_date = strtotime($current_date);
            $purchase_date = strtotime($row[0]);
            
            $difference = (int)$current_date - (int)$purchase_date;
            // Three days = 259200
            if((int)$difference > 259200){ //Larger than three days

                echo '<td>'.$row[0].'</td>';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
               
                if($row[6] == 'normal')echo '<td>'.'Shipped'.'</td>';
                else echo '<td>Canceled</td>';
                echo '</tr>'; 
                echo '</table>';   
            }else{ //Less than three days
                
                echo '<td>'.$row[0].'</td>';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
                //echo '<td>'.'Pending'.'</td>';
                if($row[6] == 'normal'){
                    echo '<form method="POST" action="driverpurchases.php">';
                    echo '<input type="hidden" name="order_id" value = "'.$row[5].'">';
                    echo '<input type="hidden" name="date" value= "'.$row[0].'">';
                    echo '<td><button class="btn btn-link" TYPE="SUBMIT" VALUE="Submit" NAME="SUBMIT" style="padding:0px 0px 0px 0px; margin:0px 0px 0px 0px;">Cancel</button></td>';
                }else{
                    echo '<td>'.$row[6].'</td>';
                }
                echo '</form>';
                echo '</tr>'; 
                echo '</table>';
            }
        } 
    }



?>

Total Spent Points: 317.37

For Company: lemon
Total Current Points: 1237.6299999999999
Total Earned Points:1555

Total Spent Points: 233.37

For Company: lemon
Total Current Points: 1321.6299999999999
Total Earned Points:1555