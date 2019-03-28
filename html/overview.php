<html>

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
	}
	
?>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
	
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Guardians of the Galaxy');

      data.addRows([
        [1,  37.8],
        [2,  30.9],
        [3,  25.4],
        [4,  11.7],
        [5,  11.9],
        [6,   8.8],
        [7,   7.6],
        [8,  12.3],
        [9,  16.9],
        [10, 12.8],
        [11,  5.3],
        [12,  6.6],
        [13,  4.8],
        [14,  4.2]
      ]);

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
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
</head>
<body>
  <div id="line_top_x"></div>
<html>
	<?php
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "select current_points from drivers where user_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Current Points: <?php echo $row[0]."<br>"?></h3>
	
	<?php $sql = "select total_spent from drivers where user_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Spent Points: <?php echo $row[0]."<br>"?></h3>
	
	<?php $sql = "select total_points from drivers where user_id = ".$_SESSION['user_id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result); ?>
	<h3>Total Earned Points: <?php echo $row[0]."<br>"?></h3>
	<?php $conn->close();?>
</html>
</body>
</html>