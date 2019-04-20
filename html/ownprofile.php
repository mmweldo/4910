	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/profileStyle.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<!------ Include the above in your HEAD tag ---------->

<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<?php session_start();
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "test";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
$conn = mysqli_connect($endpoint, "master", "group4910", "website");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 

    <div class="row profile">
		<div class="col-md-10">
            <div id="Home" class="tabcontent">
			  <iframe src="overview.php" style="width:100%;height:100%;"></iframe>
			</div>
			<div id="Profile" class="tabcontent">
				<?php 
					session_start();
					if(isset($_SESSION['user_type'])){
						if($_SESSION['user_type'] == "driver"){
							echo '<iframe src="profilesettings.php" style="width:100%;height:100%;"></iframe>';
						}
						else if($_SESSION['user_type'] == "admin"){
							echo '<iframe src="admprofilesettings.php" style="width:100%;height:100%;"></iframe>';
						}else{
							echo '<iframe src="sponsorprofilesettings.php" style="width:100%;height:100%;"></iframe>';
						}
					}
				?>
				
			</div>
			<div id="Recover" class="tabcontent">
			  <iframe src="setQuestion.php" style="width:100%;height:100%;"></iframe>
			</div>
			<div id="Messages" class="tabcontent">
			  <iframe src="social.php" style="width:100%;height:100%;"></iframe>
			</div>
			<div id="Points" class="tabcontent">
				<iframe src="addpoints.html" style="width:100%;height:100%;"></iframe>
			</div>
			<div id="Catalog" class="tabcontent">
				<h3>Catalog page Here</h3>
			</div>
			<div id="Drivers" class="tabcontent">
				<h3>Drivers page Here</h3>
			</div>
			<div id="Help" class="tabcontent">
				<h3>Help page Here</h3>
			</div>
			<div id="Applications" class="tabcontent">
				<iframe src="checkapplications.php" style="width:100%;height:100%;"></iframe>
			</div>
		</div>
		<div class="col-md-2">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<?php
							session_start();
							if($_SESSION['user_type'] == "admin"){
								$sql = "select profile_img from admins where user_id = ".$_SESSION['user_id'];
							}else if($_SESSION['user_type'] == "sponsor"){
								$sql = "select profile_img from sponsors where user_id = ".$_SESSION['user_id'];
							}else{
								$sql = "select profile_img from drivers where user_id = ".$_SESSION['user_id'];
							}
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
							session_start();
							$sql = "select username from users where id = ".$_SESSION['user_id'];
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_row($result);
							echo $row[0]."<br>";
						?>
					</div>
					<div class="profile-usertitle-job">
						<?php session_start();
						echo $_SESSION['user_type'];?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="tab">
					<button class="tablinks" onclick="openCity(event, 'Home')" id="defaultOpen"><p><span class="glyphicon glyphicon-home"></span> Overview</p></button>
					<button class="tablinks" onclick="openCity(event, 'Messages')" id="defaultOpen"><p><span class="glyphicon glyphicon-comment"></span> Messages</p></button>
					<button class="tablinks" onclick="openCity(event, 'Profile')"><p><span class="glyphicon glyphicon-user"></span> Account Settings</p></button>
					<button class="tablinks" onclick="openCity(event, 'Recover')"><p><span class="glyphicon glyphicon-question-sign"></span>Recovery Settings</p></button>
					<!--<button class="tablinks" onclick="openCity(event, 'Points')"><p><span class="glyphicon glyphicon-ok"></span> Tasks</p></button>
					<button class="tablinks" onclick="openCity(event, 'Drivers')"><p><span class="glyphicon glyphicon-flag"></span> Help</p></button>
					-->
					<?php
						
					
						session_start();
						
						if(!$_SESSION['username']) exit();
						if($_SESSION['user_type'] == "sponsor" || $_SESSION['user_type'] == "driver"){
							$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
							$conn = mysqli_connect($endpoint, "master", "group4910", "website");
							
							$sql = "select count(*) as total from applications where sponsor_id =".$_SESSION['user_id']." AND status='pending'";
							if($_SESSION['user_type'] == "driver"){
								$sql = "select count(*) as total from applications where driver_id = ".$_SESSION['user_id']." AND status='pending'";
							}
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_row($result);
							echo '<button class="tablinks" onclick="openCity(event, \'Applications\')"><p><span class="glyphicon glyphicon-user"></span> Applications';
							echo ' ['.$row[0].']';
							echo '</p></button>';
						}
					?>
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
