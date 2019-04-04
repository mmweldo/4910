<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and professional Driver Rewards">
	  <meta name="keywords" content="Driver Rewards, affordable, professional Driver Rewards">
  	<meta name="author" content="Brad Traversy">
    <!--<title>Drewp | Welcome</title>-->
    <link rel="stylesheet" href="./css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <?php
        session_start();
        if(isset($_SESSION['username'])) echo '
          <form position="relative";  style="width=5%; float:right;"action="logout.php" method="POST"><button name="submit" type="submit" class="btn btn-danger">Log Out</button></form><style> .btn-danger{position:relative; right:20px; top: 20px;} </style>'; ?>
    <header>
      <?php
        if(isset($_SESSION['username'])){ 
          $endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
          $conn = mysqli_connect($endpoint, "master", "group4910", "website");
              
          $sql = "SELECT profile_img FROM drivers WHERE user_id = ".$_SESSION['user_id'].";";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_row($result);
		
          echo '<div style=" font-size: 1.1rem; font-weight: 400; height: 4vh; position: relative; left: 10px; top: -10px;">
            <img style="border-radius: 50%;" src="'.$row[0].'" width="28" height="28" class="img-circle"></a>
            <p style="float:left;">&nbsp&nbsp'.$_SESSION['username'].'</p></div>';
        }
      ?>

      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
        </div>
        <nav>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="stories.php">[Stories]</a></li>
            <?php 
              if(isset($_SESSION['username'])){
                echo '<li><a href="">Welcome, '.$_SESSION['username'].'</a></li>';
              } else{
                echo '<li><a href="login.html">Login/Signup</a></li>';
              }
            ?>
          </ul>
        </nav>
      </div>
    </header>
  </body>
</html>
