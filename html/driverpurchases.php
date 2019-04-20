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

            echo '<td>'.$row[0].'</td>';
            echo '<td>'.$row[1].'</td>';
            echo '<td>'.$row[2].'</td>';
            echo '<td>'.$row[3].'</td>';
            echo '<td>'.$row[4].'</td>';
           
            echo '<td>'.'No'.'</td>';
            echo '</tr>';
            
            echo '</table>';
            echo '<P><INPUT TYPE="SUBMIT" VALUE="Submit" NAME="Submit"></P>';

            echo '</form>';

            $format = "Y-m-d H:i:s";

            $current_date = date("Y-m-d H:i:s");
            echo 'CurrentDate: '.$current_date.'<br>';
            
            //$purchase_date = new DateTime($row[0]);
            //echo 'PurchaseDate: '.$purchase_date;
            //$purchase_date_plus_three = date_add($purchase_date->format("Y-m-d H:i:s"), 'P3d');
            //$purchase_date_plus_three = date_add($purchase_date, date_interval_create_from_date_string('3 days'));
           
            //$date = DateTime::createFromFormat($format, $row[0]);
            //$date = date_create_from_format($format, $row[0]);
            $date = strtotime($row[0]);
            $date = date($format, $date);
            echo 'PurchaseDate: '.$date.'<br>';
            echo 'DifferenceDates: '.$current_date->diff($date).'<br>';

            //echo $current_date->diff($purchase_date);
            //echo $current_date->diff($purchase_date_plus_three);
            //if()
        }

    }



?>
