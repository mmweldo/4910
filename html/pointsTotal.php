<?php 


	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$query = "select total_points from driver_list where driver_username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
    
	while($row=mysqli_fetch_row($result)){
		echo "".$row[0]."";
	}
	mysqli_close($conn);
?>
