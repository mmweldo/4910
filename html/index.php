<!--Code modified from a template provided by Traversy Media. Modified by Mitch -->
<!--Testing changes -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and professional Driver Rewards">
	  <meta name="keywords" content="Driver Rewards, affordable, professional Driver Rewards">
  	<meta name="author" content="Brad Traversy">
    <title>Drewp | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
	<?php
		session_start();
		//Header stuffs, adds the html header based on user
		if($_SESSION['user_type'] == "sponsor"){
			include 'sponsorheader.php';
		}
		else if($_SESSION['user_type'] == "admin"){
			include 'adminheader.php'; 
		}else{
			include 'driverheader.php';
		}
	?>
    <section id="showcase">
      <div class="container">
        <h1>Driver Rewards Program</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu luctus ipsum, rhoncus semper magna. Nulla nec magna sit amet sem interdum condimentum.</p>
      </div>
    </section>

    <!-- <section id="newsletter">
      <div class="container">
        <h1>Subscribe To Our Newsletter</h1>
        <form>
          <input type="email" placeholder="Enter Email...">
          <button type="submit" class="button_1">Subscribe</button>
        </form>
      </div>
    </section> -->

    <section id="boxes">
      <div class="container">
        <div class="box">
          <img src="./img/logo_html.png">
          <h3>HTML5 Markup</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_css.png">
          <h3>CSS3 Styling</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_brush.png">
          <h3>Graphic Design</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_html.png">
          <h3>HTML5 Markup</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_css.png">
          <h3>CSS3 Styling</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_brush.png">
          <h3>Graphic Design</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
      </div>
    </section>

    <footer>
      <p>Drewp, Copyright &copy; 2019</p>
    </footer>
  </body>
</html>

