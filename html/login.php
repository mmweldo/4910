<?php 
	if("" == trim($_POST['login']) || "" == trim($_POST['password'])){
		echo "Error: Missing entries.";
		echo "<script>setTimeout(\"location.href = '../login.html?PASSWORD-MISSING';\", 3000);</script>";
		exit(); //User didn't enter either a login or password
	}

	#$conn = mysqli_connect("127.0.0.1", "root", "", "test");
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$hash = password_hash($_POST['password'], PASSWORD_DEFAULT); //hashes password

	$query = "SELECT * FROM users WHERE username = '".$_POST['login']."' AND username = '".$_POST['login']."';";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "[1] Error: incorrect username/password";
		echo "<script>setTimeout(\"location.href = '../login.html?PASSWORD-MISSING;\", 3000);</script>";
		exit();
	}

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck < 1){
		echo "[2] Error: incorrect username/password";
	    //echo "original password: ".$_POST['password']."<br>";
	    //echo "hashed password: ".$hash."<br>";
		echo "<script>setTimeout(\"location.href = '../login.html?PASSWORD-MISSING';\", 3000);</script>";
		exit();
	}
	if($row = mysqli_fetch_assoc($result)){
		
		$hashedPwdCheck = password_verify($_POST['password'], $row['password']);
		if($hashedPwdCheck == false){
			echo "password hash didn't match.";
			echo "<script>setTimeout(\"location.href = '../login.html?login=error';\", 1500);</script>";
			exit();
		}else{
			session_start();
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['user_type'] = $row['user_type'];
			if($_SESSION['user_type'] == "sponsor"){
				$query = "SELECT company_name FROM sponsors WHERE user_id = '".$_SESSION['user_id']."' ;";
				$result = mysqli_query($conn, $query);
				if($row = mysqli_fetch_assoc($result)){
					$_SESSION['company_name'] = $row['company_name'];
				}
			}
			header("Location:../shell.php?login=success");
			exit();
		}
	}

	#echo "Wow, correct password!";
	#echo "original password: ".$_POST['password']."<br>";
	#echo "hashed password: ".$hash."<br>";
	mysqli_close($conn);
?>
