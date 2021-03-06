<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

/* The grid: Three equal columns that floats next to each other */
.column {
  float: left;
  width: 50.0%;
  padding: 20px;
  text-align: center;
  font-size: 15px;
  cursor: pointer;
  color: white;
}

.containerTab {
  padding: 20px;
  color: white;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Closable button inside the container tab */
.closebtn {
  float: right;
  color: white;
  font-size: 35px;
  cursor: pointer;
}
</style>
</head>
<body style="background:#e85764;">
    <!--<header>
      <div class="container">
        <nav>
          <li><a href="login.html">Log In</a></li>
        </nav>
        <div id="branding">
          <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</    u>rogram</h1>
        </div>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="stories.php">[Stories]</a></li>
            <li class="current"><a href="signup.html">Signup</a></li>
          </ul>
        </nav>
      </div>
    </header> -->
<?php if($_SESSION['user_type'] == "sponsor"){
      include 'sponsorheader.php';
    }
    else if($_SESSION['user_type'] == "admin"){
      include 'adminheader.php'; 
    }else{
      include 'driverheader.php';
    }
?>
    <div class="wrapper fadeIn first"  style="width:100%; text-align: center; display: inline-block;">
      <form style="margin: 0 auto; max-width:300px; display: inline-block;" method="post" action="driveroutput.php"> 
          <table align="center" width="380" border="0">
            <tr><td  align="center"colspan="2"><h1>Driver Signup</h1></td></tr>   
            <tr><td align="center"width="312"></td><td width="172"></td></tr>
            <tr><td><input pattern="[a-zA-Z]{1,30}" placeholder="Firstname" type="firstname" name="firstname"/></td></tr>
            <tr><td><input pattern="[a-zA-Z]{1,30}" placeholder="Lastname" type="lastname" name="lastname"/></td></tr>   
            <tr><td><input pattern="{1,30}" placeholder="Street Address" type="street_address" name="street_address"  /></td></tr>
            <tr><td><input pattern="{1,30}" placeholder="Country" type="country" name="country"/></td></tr> 
            <tr><td><input pattern="[0-9]{5}" placeholder="Postal Code" type="postal_code" name="postal_code"  /></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9\s]+" placeholder="Security Question" type="text" name="question"/></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9\s]+" placeholder="Security Answer" type="text" name="answer"/></td></tr>
            <tr><td><input placeholder="Email" type="email" name="email"/></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9]{1,30}" placeholder="Username" type="username" name="username"/></td></tr>   
            <tr><td><input placeholder="Password" type="password" name="password" /></td></tr>
            <!--<tr><td><input placeholder="Sponsor iD" type="sponsor_id" name="sponsor_id"  /></td></tr> -->
            <tr><td align="center" colspan="2"><input type="submit" value="submit" name="submit" /></td></tr>
          </table>
        </form>
        <form style="margin: 0 auto; max-width:300px; display: inline-block;" method="post" action="sponsoroutput.php"> 
          <table align="center" width="380" border="0">   
            <tr><td  align="center"colspan="2"><h1>Sponsor Signup</h1></td></tr>
            <tr><td width="312"></td><td width="172"> </td></tr>   
            <tr><td><input placeholder="Email" type="email" name="email"/></td></tr>
            <tr><td><input pattern="{1,30}" placeholder="Company Name"type="company_name" name="company_name"/></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9]{1,30}" placeholder="Username" type="username" name="username"/></td></tr>   
            <tr><td><input placeholder="Password" type="password" name="password"/></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9\s]+" placeholder="Security Question" type="text" name="question"/></td></tr>
            <tr><td><input pattern="[a-zA-Z0-9\s]+" placeholder="Security Answer" type="text" name="answer"/></td></tr>   
            <tr><td align="center" colspan="2"><input type="submit" value="Submit" name="submit" /></td></tr>
          </table>
        </form> 
      </div>
     <!-- <div class="row">
      <div class="column" onclick="openTab('b1');" style="background:#e85764; border: solid;">Driver</div>
      <div class="column" onclick="openTab('b2');" style="background:#e85764; border: solid;">Sponsor</div>
    </div>
    <div id="b1" class="containerTab" style="display:none;background:gray">
      <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

    </div>
    <div id="b2" class="containerTab" style="display:none;background:gray">
      <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
    </div>

    <script>
    function openTab(tabName) {
      var i, x;
      x = document.getElementsByClassName("containerTab");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      document.getElementById(tabName).style.display = "block";
    }
    </script> -->
    
    <footer style="  position:relative; width:100%; min-height: 50px; max-height: 50px; height:50px; padding:15px; margin-top: 30px; color:#ffffff; background-color:#e85764; text-align: center; float:right;">
      <p>Drewp, Copyright &copy; 2019</p>
    </footer>

  </body>

</html> 
<style>
html {
  background-color: #e85764;
}body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}a,td,tr {
  width:100%;
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px;
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 100%;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #e85764;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #2c2c2c;
  border: none;
  color: white;
  padding: 15px 40px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 20px 20px 20px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #757575;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=text], input[type=password], input[type=postal_code], input[type=email], input[type=username], input[type=firstname], input[type=lastname], input[type=street_address],input[type=country],input[type=sponsor_id], input[type=company_name] {
  margin: 0 auto;
  min-width:250px;
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px 5px 5px 5px;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #e85764;
}

input[type=text]:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #e85764;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
}

#icon {
  width:60%;
}
</style>
