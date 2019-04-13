<?php 
	session_start();
?>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="">
	  <meta name="author" content="">
	  <title>Shop Homepage - Start Bootstrap Template</title>

	  <!-- Bootstrap core CSS -->
	  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	  <!-- Custom styles for this template -->
	  <link href="css/shop-homepage.css" rel="stylesheet"> 
	</head>
	<body>
<?php
	//Header stuffs, adds the html header based on user
	if($_SESSION['user_type'] == "sponsor"){
		include 'sponsorheader.php';
	}else if($_SESSION['user_type'] == "admin"){
		include 'adminheader.php'; 
	}else if($_SESSION['user_type'] == "driver"){
        include 'driverheader.php';
        //Two Cases, one is checkout all, another is checkout individual item
        if($_POST['checkout'] == "individual"){

        }else if($_POST['checkout'] == "all"){
            
        }
    }else{ //Not logged in
        echo "<script>window.top.location.href=\"http://52.55.244.84/\"</script>";//setTimeout(\"location.href = '../index.php?LOGGED-OUT;\",100);
    }
?>

    </body>
</html>