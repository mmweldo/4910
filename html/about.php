<!--Code modified from a template provided by Traversy Media. Modified by Mitch -->
<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Driver rewards program">
	  <meta name="keywords" content="professional driver management">
  	<meta name="author" content="Brad Traversy, Mitchell Weldon">
    <title>Drewp | About</title>
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
            <li class="current"><a href="about.php">About</a></li>
            <li><a href="stories.php">[Stories]</a></li>
            <?php 
              if(isset($_SESSION['username'])){
                echo '<li><a href="">Welcome, '.$_SESSION['username'].'</a></li>';
              } else{
                echo '<li><a href="signup.php">Signup</a></li>';
                echo '<li><a href="login.html">Login</a></li>';
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
          <h1 class="page-title">About Us</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius auctor lacus nec feugiat. Phasellus sit amet ex ipsum. Praesent pharetra tincidunt tempor. Etiam velit eros, dapibus eget porta in, lacinia et magna. Nam eget eros non orci consectetur congue at ac augue. Proin eget arcu in enim feugiat ultricies. Curabitur maximus metus nec metus pretium viverra at et orci. Integer hendrerit ante ut placerat cursus.
          </p>
          <p class="dark">
Aliquam eget pharetra diam. Nulla placerat lorem at turpis tempor, vel ultrices dui tincidunt. Proin quis egestas lorem. Mauris vehicula lectus odio, sit amet dictum justo feugiat a. Praesent id dictum lacus. Sed ullamcorper id erat ut dictum. Fusce porttitor lorem sapien, in aliquet sapien convallis et. Donec nec mauris nulla. Curabitur cursus semper odio, et hendrerit ante. Nunc at cursus ante. Maecenas gravida ligula ut efficitur suscipit. Nulla id turpis varius, pretium nunc sed, fermentum sem. Sed lacinia nunc non interdum pellentesque.
          </p>
        </article>

        <aside id="sidebar">
          <div class="dark">
            <h3>What We Do</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius auctor lacus nec feugiat. Phasellus sit amet ex ipsum. Praesent pharetra tincidunt tempor. Etiam velit eros, dapibus eget porta in, lacinia et magna</p>
          </div>
        </aside>
      </div>
    </section>

    <footer id="footer">
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