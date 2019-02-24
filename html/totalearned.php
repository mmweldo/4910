<link rel="stylesheet" type="text/css" href="./css/style.css">
<header>
  <div class="container">
    <div id="branding">
      <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
    </div>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="stories.html">[Stories]</a></li>
        <li><a href="">Login/Signup</a></li>
    </ul>
    </nav>
  </div>
</header>
<?php
	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	
    $query = "SELECT username FROM sponsors JOIN users ON sponsors.user_id = users.id WHERE company_name = '".$_POST['company_name']."';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "[1] Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../totalearned.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "[2] Error: Sponsor not found! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../totalearned.html?NONEXISTANT-SPONSOR';\", 3000);</script>";
		exit();
	} // else sponsor exists

    $query = "SELECT driver_username, total_points FROM driver_list WHERE sponsor_id = (SELECT user_id FROM sponsors WHERE company_name = '".$_POST['company_name']."') AND driver_username = '".$_POST['username']."';";

    $result = mysqli_query($conn, $query);
        if(!$result){
        echo "[1] Error: Driver not found! Are you sure they are on your list? Redirecting...";
        echo "<script>setTimeout(\"location.href = '../totalearned.html?NONEXISTANT-DRIVER';\", 3000);</script>";
        exit();
    }

    $resultCheck = mysqli_num_rows($result);

    if($resultCheck < 1){
        echo "[2] Error: Driver not found! Are you sure they are on your list? Redirecting...";
        echo "<script>setTimeout(\"location.href = '../totalearned.html?NONEXISTANT-DRIVER';\", 3000);</script>";
        exit();
    } // else driver exists in this sponsors driver_list

    echo "<center><table><tr><th>Username</th><th>Total Points</th></tr>";
    while($row = mysqli_fetch_row($result)){
        echo "<tr><td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td></tr>";
    }
    echo "</table></center>";
    
    mysqli_close($conn);
?>
