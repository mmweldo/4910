<html>
	<head>	  
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<body>
	<?php
		session_start();
		if(!isset($_SESSION['username'])){
			echo "Error: User not logged in.";
			echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGEDIN';\", 3000);</script>";
			exit();
		}
		if($_SESSION['user_type'] != "driver"){
			echo "Error: Only drivers can apply to be under a sponsor. You are a ".$_SESSION['user_type']." not a driver.";
			echo "<script>setTimeout(\"location.href = '../index.php?NOT-DRIVER';\", 3000);</script>";
			exit();
		}
		if($_POST['user_type'] != "sponsor"){
			echo "Error: Only sponsors can be applied to. This user is a ".$_POST['user_type']." not a sponsor.";
			echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
			exit();
		}

		//Checks if already applied ----------------
		$query "SELECT * FROM applications WHERE sponsor_id = ".$_POST['user_id']." AND driver_id = ".$_SESSION['user_id'].";";

		$result = mysqli_query($conn, $query);
	
		if(!$result){
			echo "Error: Couldn't check if applied already.";
			echo "<script>setTimeout(\"location.href = '../login.php?PASSWORD-MISSING;\", 3000);</script>";
			exit();
		}

		$resultCheck = mysqli_num_rows($result);

		if($resultCheck > 0){
			echo "Error: You've already applied!";
			echo "<script>setTimeout(\"location.href = '../index.php?APPLIED-ALREADY';\", 3000);</script>";
			exit();
		}

		//Applies --------------------------------
		$query "INSERT INTO applications (sponsor_id, driver_id) VALUES ".$_POST['user_id'].",".$_SESSION['user_id'].";";
		$result = mysqli_query($conn, $query);
	
		if(!$result){
			echo "Error: Couldn't apply.";
			echo "<script>setTimeout(\"location.href = '../index.php?CANT-APPLY;\", 3000);</script>";
			exit();
		}

		$resultCheck = mysqli_num_rows($result);

		if($resultCheck > 1){
			echo "[2] Error: Couldn't apply.";
			echo "<script>setTimeout(\"location.href = '../index.php?CANT-APPLY';\", 3000);</script>";
			exit();
		}

		echo '<h1>Application succesful</h1>';
		echo 'Redirecting...';
		echo "<script>setTimeout(\"location.href = '../index.php?APPLICATION-SUCCESSFUL';\", 3000);</script>";
	?>
	</body>
</html>
