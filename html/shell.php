<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "<script>setTimeout(\"location.href = '../index.php';\", 100);</script>";
	}
?>
<html>

	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/shellStyle.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
	</head>
	<body>
		<div class="topnav">
			<!--<header>
				<div class="container">
					<div id="branding">
						<h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
					</div>
					<nav>
						<ul>
							<li><a href="/">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="stories.php">[Stories]</a></li>
							<li><a href="login.html">Login/Signup</a></li>
						</ul>
					</nav>
				</div>
			</header> -->
		</div>
		<div class="tab">
			<button class="tablinks" onclick="openCity(event, 'Home')" id="defaultOpen"><p><span class="glyphicon glyphicon-home"></span></p></button>
			<button class="tablinks" onclick="openCity(event, 'Profile')"><p><span class="glyphicon glyphicon-user"></span></p></button>
			<button class="tablinks" onclick="openCity(event, 'Points')"><p><span class="glyphicon glyphicon-piggy-bank"></span></p></button>
			<button class="tablinks" onclick="openCity(event, 'Catalog')"><p><span class="glyphicon glyphicon-credit-card"></span></p></button>
			<button class="tablinks" onclick="openCity(event, 'Drivers')"><p><span class="glyphicon glyphicon-th-list"></span></p></button>
			<button class="tablinks" onclick="openCity(event, 'Help')"><p><span class="glyphicon glyphicon-flag"></span></p></button>

		</div>

		<div id="Home" class="tabcontent">
			  <iframe src="index.php" style="width:100%;height:100%;"></iframe>
		</div>
		<div id="Profile" class="tabcontent">
			<iframe src="ownprofile.php" style="width:100%;height:100%;"></iframe>
		</div>
		<div id="Points" class="tabcontent">
			<iframe src="addpoints.html" style="width:100%;height:100%;"></iframe>
		</div>
		<div id="Catalog" class="tabcontent">
			  <iframe src="storeconnector.php" style="width:100%;height:100%;"></iframe>
		</div>
		<div id="Drivers" class="tabcontent">
			  <iframe src="viewsponsorshtml.php" style="width:100%;height:100%;"></iframe>
		</div>
		<div id="Help" class="tabcontent">
			<iframe src="help.php" style="width:100%;height:100%;"></iframe>
		</div>

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
	<footer>
      	<p>Drewp, Copyright &copy; 2019</p>
    </footer>
	</body>
</html> 
