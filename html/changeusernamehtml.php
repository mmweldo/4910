<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Users - Change Username</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<header>
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
	</header>
	<div class="container">
		<center>
			<h2>Users - Change Username</h2>
			<form class="changeusername-form" method="post" action="changeusername.php">
					<p>New Username</p>
					<p><i style="font-size: 8pt;">Username is a-z or A-Z or 0-9 and [1,30] in length</i></p>
					<input type="text" name="username" placeholder="New Username" pattern="[a-zA-Z0-9]{1,30}" required>
					<button type="submit" name="submit">Submit</button>
			</form>
		</center>
	</div>
	<footer>
      		<p>Drewp, Copyright &copy; 2019</p>
    	</footer>
</body>
</html>
