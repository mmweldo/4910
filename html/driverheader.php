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
          <form style="position: relative; top: 10px; width=5%; float:right;" action="logout.php" method="POST">
	  <button type="submit" name="submit">Log Out</button></form><style>
              button {
              background-color: #e85764;
              border: none;
              color: white;
              padding: 5px 10px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              text-transform: uppercase;
              font-size: 13px;
              /*-webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
              box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);*/
              -webkit-border-radius: 5px 5px 5px 5px;
              border-radius: 5px 5px 5px 5px;
              margin: 5px 20px 10px 20px;
              -webkit-transition: all 0.3s ease-in-out;
              -moz-transition: all 0.3s ease-in-out;
              -ms-transition: all 0.3s ease-in-out;
              -o-transition: all 0.3s ease-in-out;
              transition: all 0.3s ease-in-out;
            }

            button:hover{
              background-color: #e85764;
            }

            button:acive {
              -moz-transform: scale(0.95);
              -webkit-transform: scale(0.95);
              -o-transform: scale(0.95);
              -ms-transform: scale(0.95);
              transform: scale(0.95);
            }
            </style>';
          ?>
	  <!-- <button id="myButton" name="submit" type="submit" class="btn btn-danger">
	  <a href="logout.php">Log Out</a>
	  </button> -->
      <header>
      <?php
        if(isset($_SESSION['username'])){ 
          $endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
          $conn = mysqli_connect($endpoint, "master", "group4910", "website");
              
          $sql = "SELECT profile_img FROM drivers WHERE user_id = ".$_SESSION['user_id'].";";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_row($result);
		
          echo '<div style=" font-size: 1.1rem; font-weight: 400; height: 4vh; position: relative; left: 10px; top: -13px;">
            <img style="border-radius: 50%; float:left;" src="'.$row[0].'" width="28" height="28" class="img-circle"></a>
            <p style="">&nbsp&nbsp'.$_SESSION['username'].'</p></div>';
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
