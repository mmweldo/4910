<?php
	if(isset($_POST['submit'])){
		session_start();
		session_unset();
		session_destroy();
		echo "<script>window.top.location.href=\"http://52.55.244.84/\s"</script>";//setTimeout(\"location.href = '../index.php?LOGGED-OUT;\",100);
		exit();
	}
	
?>