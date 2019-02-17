<?php 


	$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	//$query = "select points_history.date_created, points_history.point_amount, drivers.username from driver inner join points_history on points_history.driver_id = drivers.user_id where drivers.username = '".$_POST['username'].";";
$query = "select points_history.date_created, points_history.point_amount, drivers.username from drivers inner join points_history on points_history.driver_id = drivers.user_id where drivers.username = '".$_POST['username']."';";
	$result =mysqli_query($conn, $query); 

	if (!$result) {
	    printf("[2]Error: %s\n", mysqli_error($conn));
		exit();
	}

	while($row=mysqli_fetch_row($result)){
		echo "<p>";
		echo " ".$row[0]." ";
		echo " ".$row[1]." ";
		echo "</p>";
	}
	mysqli_close($conn);


?>
