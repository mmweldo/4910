<?php 


	$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$query = "select total_points from drivers where username = '".$_POST['username']."';";
	$result = mysqli_query($conn, $query);
    
	while($row=mysqli_fetch_row($result)){
		echo "".$row[0]."";
	}
	mysqli_close($conn);
?>
