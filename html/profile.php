<html>
<?php
	session_start();
	if($_SESSION['user_type'] == "sponsor"){
		include 'sponsorheader.php';
	}else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else if($_SESSION['user_type'] == "driver"){
		include 'driverheader.php';
	}
	echo '<body><center>';
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?> 

    <div class="row profile">
            <div class="profile-content">
            </div>
		</div>
		<div class="col-md-2">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
<?php
	if($_POST['user_type'] == "sponsor"){
		$sql = "select profile_img from sponsors where user_id = ".$_POST['user_id'];
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		echo '<img src="'.$row[0].'" class="img-circle" alt="Profile Image" style="width:125px;height:125px;">';
	}else if($_POST['user_type'] == "driver"){
		$sql = "select profile_img from drivers where user_id = ".$_POST['user_id'];
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		echo '<img src="'.$row[0].'" class="img-circle" alt="Profile Image" style="width:125px;height:125px;">';
	}else if($_POST['user_type'] == "admin"){
		$sql = "select profile_img from admins where user_id = ".$_POST['user_id'];
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		echo '<img src="'.$row[0].'" class="img-circle" alt="Profile Image" style="width:125px;height:125px;">';
	}
?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<p>
						<?php
							if(isset($_POST['user_type'])){
								$sql = "select username from users where id = ".$_POST['user_id'];
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_row($result);
								echo $row[0]."<br>";
							}
						?>
						</p>
					</div>
					<div class="profile-usertitle-job">
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Message</button>
<?php	
	if($_SESSION['user_type'] == "sponsor"){
		//echo '<button type="submit" name="submit" class="btn btn-danger btn-sm">Remove</button>';
		echo '<td><form class="profile-form" method="post" action="removedrivers.php"><input type="hidden" name="company_name" value="'.$_SESSION['company_name'].'"><input type="hidden" name="username" placeholder="username" value="'.$_POST['username'].'"><button type="submit" name="submit" class="btn btn-danger btn-sm">Remove</button></form><td>';
	}
	
	//Check if user on this page is logged in and if they are a driver
	if(isset($_SESSION['user_id']) && $_SESSION['user_type'] == "driver"){
		$sql = "SELECT * from driver_list where driver_id = ".$_SESSION['user_id']." AND sponsor_id = "._POST['user_id'].";";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) < 1){
			echo '<form style="color:white;"class="application-form" method="post" action="application_to.php"><input type="hidden" type="text" name="username" placeholder="username" value="'.$_POST['username'].'"><input type="hidden" type="text" name="user_id" placeholder="user_id" value="'.$_POST['user_id'].'"><input type="hidden" type="text" name="user_type" placeholder="user_type" value="'.$_POST['user_type'].'"><button class="btn btn-info btn-sm" type="View" name="submit"><a style="color:white;"><i style="color:white;" class="glyphicon glyphicon-road"></i> Apply </a></button></form>';
		}else{
			echo '<form style="color:white;"class="remove-form" method="post" action="removedrivers.php"><input type="hidden" type="text" name="username" placeholder="username" value="'.$_POST['username'].'"><input type="hidden" type="text" name="user_id" placeholder="user_id" value="'.$_POST['user_id'].'"><input type="hidden" type="text" name="user_type" placeholder="user_type" value="'.$_POST['user_type'].'"><button class="btn btn-info btn-sm" type="View" name="submit"><a style="color:white;"><i style="color:white;" class="glyphicon glyphicon-road"></i> Remove </a></button></form>';
		}
	}
?>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
<?php 
	if($_SESSION['user_type'] == "sponsor" && $_POST['user_type'] == "driver"){
		$sql = "SELECT total_points, current_points from driver_list WHERE driver_id = ".$_POST['user_id']." AND sponsor_id = ".$_SESSION['user_id'].";";
		//echo "SELECT total_points, current_points from driver_list WHERE driver_id = ".$_POST['user_id']." AND sponsor_id = ".$_SESSION['user_id'].";";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);		
		if(!(mysqli_num_rows($result) == 0)){ 
			echo '<h3>Total Points:</h3><p>'.$row[0].'</p>';
			echo '<h3>Current Points:</h3><p>'.$row[1].'</p>';
		}
	}
?>
						</li>
						<!--<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li> -->
					</ul>
				</div>
				<!-- END MENU -->
			</div>
	</div>
<br>
<br>

<?php $conn->close();?>
</center>
</body>
</html>
