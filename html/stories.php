<!--Code modified from a template provided by Traversy Media. Modified by Mitch -->
<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and professional web design">
	  <meta name="keywords" content="web design, affordable web design, professional web design">
    <title>Drewp | Stories</title>
    <link rel="stylesheet" href="./css/style.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
        </div>
        <?php if(isset($_SESSION['username'])) echo '<form style="width=5%; float:right;"action="logout.php" method="POST"><button type="submit" name="submit">Log Out</button></form>'; ?>
        <nav>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li class="current"><a href="stories.php">[Stories]</a></li>
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

    <!-- <section id="newsletter">
      <div class="container">
        <h1>Subscribe To Our Newsletter</h1>
        <form>
          <input type="email" placeholder="Enter Email...">
          <button type="submit" class="button_1">Subscribe</button>
        </form>
      </div>
    </section> -->

    <section id="main">
      <div class="container">
        <article id="main-col">
          <div>
            <h2 class="page-title">Stories</h2>
            <p>Here is a link page for putting <u>independent webpages that are user stories</u>. It's easiest to test our work here in this consolidated area.</p>
          </div>
          <h1 class="page-title">Iteration One </h1>
          <ul name="iteration1" id="stories">
            <li>
              <h4>Sponsor - View Their Driver</h4>
              <a href="driverlist.html">Link</a>
              <p>Completed iteration one. User story 28,144,23. Mitch did this one.</p>
            </li>
            <!-- <li>
              <h4>Admin - Create Driver Accounts</h4>
              <a href="">Link</a>
              <p>Completed iteration ___. User story 86. Seth did this one.</p>
            </li> -->
            <li>
              <h4>Admin - Create Sponsor Accounts</h4>
              <a href="admincreatespn.php">Link</a>
              <p>Completed iteration one. User story 89. Seth did this one.</p>
            </li>
            <!-- <li>
              <h4>Admin - Delete Sponsor Accounts</h4>
              <a href="">Link</a>
              <p>Completed iteration ___. User story 91. Seth did this one.</p>
            </li>
            <li>
              <h4>Admin - Delete Driver Accounts</h4>
              <a href="">Link</a>
              <p>Completed iteration ___. User story 87. Seth did this one.</p>
            </li> -->
            <li>
              <h4>Sponsor - Add Points to Drivers</h4>
              <a href="addpoints.html">Link</a>
              <p>Completed iteration one. User story 6. Mitch did this one.</p>
            </li>
          </ul>
        </article>

        <!-- <aside id="sidebar">
          <div class="dark">
            <h3>Get A Quote</h3>
            <form class="quote">
  						<div>
  							<label>Name</label><br>
  							<input type="text" placeholder="Name">
  						</div>
  						<div>
  							<label>Email</label><br>
  							<input type="email" placeholder="Email Address">
  						</div>
  						<div>
  							<label>Message</label><br>
  							<textarea placeholder="Message"></textarea>
  						</div>
  						<button class="button_1" type="submit">Send</button>
					</form>
          </div>
        </aside> -->
      </div>
      <div class="container">
        <h1 class="page-title">Iteration Two </h1>
          <ul name="iteration2" id="stories">
            <li>
              <h4>Admin - View all users</h4>
              <a href="userlist.html">Link</a>
              <p>Completed iteration two. User story 15. Mitch did this one.</p>
            </li>
            <li>
              <h4>Driver - Can view Points per Day</h4>
              <a href="viewdaily.html">Link</a>
              <p>Completed iteration two. User story 9. Mitch did this one.</p>
            </li>
            <li>
              <h4>Admin - Create drivers </h4>
              <a href="admincreatesdvr.php">Link</a>
              <p>Completed iteration two. User story 86. Seth did this one.</p>
            </li>
	    <li>
              <h4>Driver - View Point Log </h4>
              <a href="viewpointlog.html">Link</a>
              <p>Completed iteration two. User story 19. Logan did this one.</p>
            </li>
	    <li>
              <h4>Driver - View Total Points</h4>
              <a href="driverpoints.html">Link</a>
	      <p>Completed iteration two. User story 3. Logan did this one. </p>
	    </li> 
	   </ul>
      </div>
            <div class="container">
        <h1 class="page-title">Iteration Three </h1>
          <ul name="iteration3" id="stories">
            <li>
              <h4>Sponsor - View Drivers Daily Points</h4>
              <a href="sponsorviewdaily.html">Link</a>
              <p>Completed iteration two. User story 26. Mitch did this one.</p>
            </li>
            <li>
              <h4>_</h4>
              <a href="">Link</a>
              <p>Completed iteration two. User story xx. __ did this one.</p>
            </li>
            <li>
              <h4>_</h4>
              <a href="">Link</a>
              <p>Completed iteration two. User story xx. __ did this one.</p>
            </li>
          </ul>
      </div>
            <div class="container">
        <h1 class="page-title">Iteration Four </h1>
          <ul name="iteration4" id="stories">
            <li>
              <h4>_</h4>
              <a href="">Link</a>
              <p>Completed iteration two. User story xx. __ did this one.</p>
            </li>
            <li>
              <h4>_</h4>
              <a href="">Link</a>
              <p>Completed iteration two. User story xx. __ did this one.</p>
            </li>
            <li>
              <h4>_</h4>
              <a href="">Link</a>
              <p>Completed iteration two. User story xx. __ did this one.</p>
            </li>
          </ul>
      </div>
    </section>

    <footer>
      <p>Drewp, Copyright &copy; 2019</p>
    </footer>
  </body>
</html>
<style>
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
</style>
