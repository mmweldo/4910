<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (driver) for page
	if($_SESSION['user_type'] != "driver"){
		echo "Error: User not an driver!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-DRIVER';\", 3000);</script>";
		exit();
	}else{
		include 'driverheader.php';
	}
?>
<html>
<head></head>
<body>
	<?php
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	// Create connection
	#$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT current_points, total_spent, total_points, company_name FROM driver_list join drivers on driver_id = user_id join sponsors on driver_list.sponsor_id = sponsors.user_id WHERE driver_id = ".$_SESSION['user_id']." and drivers.user_id = ".$_SESSION['user_id'].";";
	$result = mysqli_query($conn, $sql);
	$counter = 0;
	$spent;
	echo '<table class="table">';
	echo '<tr>';
	echo '<th>Company</th>';
	echo '<th>Current Points</th>';
	echo '<th>Total Earned Points</th>';
	echo '</tr>';

	if(!result){
		echo "didn't work!";
	}
	else while($rows=mysqli_fetch_row($result)){
		if($counter == 0) $spent =$rows[1];
		echo '<tr>';
		echo '<td>For Company: '.$rows[3].'</td>';
		echo '<td>Total Current Points: '.$rows[0].'</td>';
		echo '<td>Total Earned Points:'.$rows[2].'</td>';
		$counter = $counter + 1;
		echo '</tr>';
	}
	echo '</table>';
	echo '<h2>Total Spent Points: '.$spent.'</h2><br>';
	/*
	$sql = "select current_points from driver_list where driver_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Current Points: <?php echo $row[0]."<br>"?></h3>
	
	<?php $sql = "select total_spent from drivers where user_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Spent Points: <?php echo $row[0]."<br>"?></h3>
	
	<?php $sql = "select total_points from driver_list where driver_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Earned Points: <?php echo $row[0]."<br>"?></h3>*/
	
	$conn->close();?>
	
	<!--<center><div id="line_top_x"></div></center>-->
</body>
</html>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
	
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Month');
      data.addColumn('number', 'Current Points');

      data.addRows([
        [1,  37.8],
        [2,  30.9],
        [13,  25.4],
        [4,  11.7],
        [20,  11.9],
        [21,   8.8],
        [31,   7.6],
        [31,  12.3],
        [31,  16.9],
        [10, 12.8],
        [11,  5.3],
        [12,  6.6],
      ]);
	data.sort({column: 0, desc: true}, {column: 1, desc: false});

      var options = {
        chart: {
          title: 'Current Points Over Time',
          subtitle: 'Shown by Month'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
