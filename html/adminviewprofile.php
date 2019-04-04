	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/profileStyle.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
	</head>
<!------ Include the above in your HEAD tag ---------->

<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<?php session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (driver) for page
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User not an admin!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
	
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
}
?> 

    <div class="row profile">
		<div class="col-md-10">
            <div id="Home" class="tabcontent">
			  <iframe src="overview.php" style="width:100%;height:100%;"></iframe>
			</div>
			<div id="Profile" class="tabcontent">
				<iframe src="admdvrprofilesettings.php" style="width:100%;height:100%;"></iframe>
			</div>
		</div>
		<div class="col-md-2">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<?php
							$sql = "select profile_img from ".$_POST['user_type']." where user_id = ".$_POST[user_id];
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_row($result);
							echo "<img src=".$row[0]." class='img-circle' alt='Profile Image' style='width:125px;height:125px;'>";
					?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php
							$sql = "select username from users where id = ".$_POST[user_id];
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_row($result);
							echo $row[0]."<br>";
						?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo ".$_POST['user_type']."?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="tab">
					<button class="tablinks" onclick="openCity(event, 'Home')" id="defaultOpen"><p><span class="glyphicon glyphicon-home"></span> Overview</p></button>
					<button class="tablinks" onclick="openCity(event, 'Profile')"><p><span class="glyphicon glyphicon-user"></span> Account Settings</p></button>
				</div>
				<!-- END MENU -->
				
					<script>
				function openCity(evt, cityName) {
					var i, tabcontent, tablinks;
					tabcontent = document.getElementsByClassName("tabcontent");
					for (i = 0; i < tabcontent.length; i++) {
						tabcontent[i].style.display = "none";
					}
					tablinks = document.getElementsByClassName("tablinks");
					for (i = 0; i < tablinks.length; i++) {
						tablinks[i].className = tablinks[i].className.replace(" active", "");
					}
					document.getElementById(cityName).style.display = "block";
					evt.currentTarget.className += " active";
				}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
	</script>
			</div>
		</div>
	</div>
<br>
<br>

<?php $conn->close();?>
</html>