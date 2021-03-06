
<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add values</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" href="./css/style.css">

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
	<center>
		<h1>Admin - View total Points</h1>
		<form class="points-form" method="post" action="pointstotal.php">
			<p>Driver Username</p> <input type="text" name="username" placeholder="Username">
			<button type="submit" name="submit">Submit</button>
		</form>
	</center>
    <footer>
      <p>Drewp, Copyright &copy; 2019</p>
    </footer>

</body>
</html>

<style>
	p, input, form{
		margin: 10px 10px 10px 10px;
		displaly:inline-block;
		position: center;
	}
	*{
		tab-size: 16px;
	}
</style>
