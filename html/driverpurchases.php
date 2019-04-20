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
        
        $sql = "SELECT date_created, total_cost_points, street_address, country, postal_code FROM purchase WHERE driver_id = ".$_SESSION['user_id'].";";
        $result = mysqli_query($conn, $sql);


        date_default_timezone_set("America/New_York");
        while($row=mysqli_fetch_row($result)){
            echo '<form method="POST" action="driverpurchases.php">';
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
            if(((int)$current_date - (int)$date) > 259200){ //Larger than three days
                echo '<td>'.$row[0].'</td>';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
               
                echo '<td>'.'Shipped'.'</td>';
                echo '</tr>'; 
                echo '</table>';   
            }else{ //Less than three days
                echo '<td>'.$row[0].'</td>';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
               
                echo '<td>'.'Pending'.'</td>';
                echo '</tr>'; 
                echo '</table>';
                echo '<P><INPUT TYPE="SUBMIT" VALUE="Submit" NAME="Cancel"></P>';
            }
            echo '</form>';

            //$interval = date_diff($current_date,$datetime2);
            //echo $interval->format('%R%a days').'<br>';

            //echo $current_date->diff($purchase_date);
            //echo $current_date->diff($purchase_date_plus_three);
            //if()
        }

    }



?>
