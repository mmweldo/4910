<?php
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\"><header><div class=\"container\"><div id=\"branding\"><h1><span class=\"highlight\">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1></div><nav><ul><li><a href=\"/\">Home</a></li><li><a href=\"about.html\">About</a></li><li><a href=\"stories.html\">[Stories]</a></li><li><a href=\"\">Login/Signup</a></li></ul></nav></div></header>";
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");	
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	#echo $_POST['username'];
	$query = "SELECT * FROM drivers WHERE username = '".$_POST['username']."';"; 	
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "Error: No such user, try again.";
		exit();
	} 
	else{
		$query = "SELECT date_created, point_amount FROM points_history WHERE driver_id = (SELECT user_id FROM drivers WHERE username = '".$_POST['username']."')ORDER BY date_created DESC;"; #ORDER BY ".$_POST['order'].";";
		$result = mysqli_query($conn, $query);
		if(!$result){
			printf("Error: Driver has no points history.");
			exit();
		}

		$resultCheck = mysqli_num_rows($result);
		
		if ($resultCheck < 1) {
		    printf("Error: %s\n", mysqli_error($conn));
		    printf("Driver has no points history.");
		    exit();
		}
		echo "<center>";
		echo "<h3>Points History by Day for User '".$_POST['username']."'</h3>";
		echo "<p>Ordered by: ";
		if($_POST['order'] == "date_created DESC") echo "Date Descending";
		if($_POST['order'] == "date_created ASC") echo "Date Ascending";
		if($_POST['order'] == "point_amount DESC") echo "Point Amount Descending";
		if($_POST['order'] == "point_amount ASC") echo "Point Amount Ascending";
	
		echo "<table>";
		echo "<tr>";
		echo "<th>Date of Transaciton</th>";
		echo "<th>Point Change</th>";
		echo "</tr>";

		$counter = 0;
		while($row=mysqli_fetch_row($result)){
			    if($counter == 0){
			    	$dates = array(substr($row[0], 0,10)=>$row[1]);
			    }
			    else if(array_key_exists(substr($row[0], 0, 10), $dates)){
			    	$dates[substr($row[0], 0, 10)] = $dates[substr($row[0], 0, 10)] + $row[1];
			    }else{
			    	$dates[substr($row[0], 0, 10)] = $row[1];
			    }
			    $counter = $counter + 1;
		}

		if($_POST['order'] == "date_created ASC"){
			ksort($dates);
		}else if ($_POST['order'] == "date_created DESC"){
			krsort($dates);
		}else if ($_POST['order'] == "point_amount ASC"){
			asort($dates);
		}else{
			arsort($dates);
		}
		#var_dump($dates);
		#var_dump($totals);
		foreach($dates as $key=>$value){
				echo "<tr>"; 
	            echo "<td>".$key."</td>"; 
	            echo "<td>".$value."</td>"; 
	            
	            echo "</tr>";
		}
		echo "</center>";
	}
	mysqli_close($conn);
?>	
