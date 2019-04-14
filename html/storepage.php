  <!--A large amount of this page was supplied by https://startbootstrap.com/templates/shop-homepage/, an equal amount of work adjusting was done as well. Credit to the unnamed authors, since this work is based on it, it also uses MIT License -->
<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  
  #$conn = new mysqli($servername, $username, $password, $dbname);
  /*$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
  $conn = mysqli_connect($endpoint, "master", "group4910", "website");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }*/
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
    echo '<div class="container">
      <div class="row">
      <div class="col-lg-3">
      <h1 class="my-4">'.$_GET['company_name'].'</h1>';
    echo '<a style="position:relative; right:0px; float:right;" href="/cart.php"><button class="btn btn-success btn-sm">Cart</button></a>';
    echo '<a style="position:relative; right:0px; float:right;" href="/ebayfetch.php"><button class="btn btn-success btn-sm">Add to Store</button></a>';
    echo '</div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
      <br><br>
    <div class="row">';

    $sql = 'SELECT title, subtitle, pic, link, price, company_name, dollar_ratio FROM products join sponsors on sponsor_id = user_id WHERE sponsor_id = '.$_GET['user_id'].';';
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_row($result)){
    $item_img = $row[2];//'http://placehold.it/700x400';
    $item_link = $row[3];//'#';
    $item_price = (double)$row[4] * $row[6];//'250';
    $item_name = $row[0];//'item one';
    $item_rating = '<div class="card-footer">
      <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
    </div>';
    echo '
      <div class="col-lg-4 col-md-6 mb-4" style="height:auto;">
        <div class="card h-1">
          <a href="#"><img class="card-img-top" src="'.$item_img.'" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="'.$item_link.'">'.$item_name.'</a>
            </h4>
            <h5>'.$item_price.' points</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
          </div>
        </div>
      </div>
    ';
    }
  }
  else if($_SESSION['user_type'] == "admin"){
    include 'adminheader.php'; 
  }else{
    include 'driverheader.php';
    echo '<div class="my-4"><a style="position:relative; left:0px; float:left;" href="/cart.php"><button class="btn btn-success btn-sm">Cart</button></a>';
  }
?>

  <!-- Page Content -->
    <div class="container">
    <div class="row">
    <div class="col-lg-3">
<?php
  if($_SESSION['user_type'] == "driver"){
    echo '<h1 class="my-4">'.$_POST['company_name'].'</h1>';
  }
  //echo '<table id="cart"></table><button class="btn btn-success btn-sm" form="cart">Cart</button>';
?>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
        <br><br>
        <div class="row">
          <?php
          if(!empty($_POST)){
            //echo "made it here!<br>";
            $sql = 'SELECT title, subtitle, pic, link, price, company_name, dollar_ratio FROM products join sponsors on sponsor_id = user_id WHERE sponsor_id = '.$_POST['user_id'].';';
            //echo $sql;
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_row($result)){
              $item_img = $row[2];//'http://placehold.it/700x400';
              $item_link = $row[3];//'#';
              $item_price = (double)$row[4] * $row[6];//'250';
              $item_name = $row[0];//'item one';
              $item_rating = '<div class="card-footer">
                      <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>';
              echo '
                <div class="col-lg-4 col-md-6 mb-4" style="height:auto;">
                  <div class="card h-1">
                    <a href="#"><img class="card-img-top" src="'.$item_img.'" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="'.$item_link.'">'.$item_name.'</a>
                      </h4>
                      <h5>'.$item_price.' points</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                    <center><form action="cart.php" method="POST">
                      <input style="width:auto;" name="amount" type="number" min="0" placeholder="1"></input>
                      <input type="hidden" name="sponsor_id" value="'.$_POST['user_id'].'"></input>
                      <input type="hidden" name="driver_id" value="'.$_SESSION['user_id'].'"></input>
                      <input type="hidden" name="title" value="'.$row[0].'"></input>
                      <input type="hidden" name="price" value="'.(double)$row[4].'"></input>
                      <button type="submit" class="btn btn-success btn-sm" value="submit">Add to Cart</button>
                    </form></center>
                    '.$item_rating.'
                  </div>
                </div>
              ';

            }
          }
          ?>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Footepr -->
  <!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js">
  
</script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js">
  
</script>

</body>

</html>
