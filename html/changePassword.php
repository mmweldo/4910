<?php
	$newPassword = 'password'; 
	$username = 'bugAdmin';
	$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
	$conn = mysqli_connect($endpoint, "master", "group4910", "website");
	$hash = password_hash($newPassword, PASSWORD_DEFAULT); //hashes password



?>
