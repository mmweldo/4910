<?php
	if(isset($_POST['submit'])){
		session_start();
		session_unset();
		session_destroy();
		echo "<script>setTimeout(\"location.href = '../index.php?LOGGED-OUT;\",100);</script>"
		exit();
	}
	
?>