<?php 
	session_start();
	/*if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (admin) for page
	if($_SESSION['user_type'] != "sponsor"){
		echo "Error: User not a sponsor!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-SPONSOR';\", 3000);</script>";
		exit();
	}*/
?>
<HTML>
<head>
	<title>Sponsors - View Catalog</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="Affordable and professional web design">
	<meta name="keywords" content="web design, affordable web design, professional web design">
	<meta name="author" content="Brad Traversy">
	<title>Drewp | Catalog</title>
	<link rel="stylesheet" href="./css/style.css">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

<?php
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint2, "master", "group4910", "website");

	echo "SELECT title, pic, link, price FROM products WHERE sponsor_id = ".$_SESSION['user_id'].";";
	$sql = "SELECT title, pic, link, price FROM products WHERE sponsor_id = ".$_SESSION['user_id'].";";
	
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "Error: Empty catalog redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-CATALOG';\", 3000);</script>";
		exit();		
	}
	if($resultCheck < 1){
		echo "Error: Empty catalog redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NONEXISTANT-CATALOG';\", 3000);</script>";
		exit();		
	}

	echo "<center><table>";
	echo "<tr>";
	echo "<th>Title</th>";
	echo "<th>Link</th>";
	echo "<th>Price</th>";
	echo "<th>Remove</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_row($result)){
	    echo "<tr>"; 
	    echo "<td>".$row[0]."</td>"; 
	    echo "<td>$".$row[2]."</td>"; 
	    echo "<td>".$row[2]."</td>"; 
	    echo '<td><form class="catalog-form" method="post"><input type="hidden" name="sponsor_id" value="'.$_SESSION['user_id'].'"><input type="hidden" name="title" value="'.$row[0].'"><button type="View" name="submit">Remove</button></form><td>';
	    echo "</tr>"; 
	}
	echo "</table></center>";
?>


	</header>
</HTML>

<?php
	if(isset($_POST['submit'])){
		$sql = "DELETE FROM products WHERE title = ".$_POST['title'].";";
	}
	$result = mysqli_query($conn, $sql);
?>
