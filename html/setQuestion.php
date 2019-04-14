<?php session_start();?>
<html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>DREWP | Login</title>
  </head>

  <body>
    <header>
    <div class="container">
      <div id="branding">
        <h1><span class="highlight">Drewp:</span> <u>D</u>river <u>REW</u>ards <u>P</u>rogram</h1>
      </div>
      <nav>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="stories.php">[Stories]</a></li>
          <li><a href="signup.php">Signup</a></li>
          <li class="current"><a href="login.html">Login</a></li>
      </ul>
      </nav>
    </div>
  </header>
 
    <div>
      <p>Recovery Question</p>
      <input type="text" name="newQuestion" id="question">
      <p>Answer</p>
      <input type="text" name="newAnswer" id="answer">
      <br>
      <button type="button" onclick="update()">Update</button>
      <p id="confirmation"></p>
    <div>

    <script>
      function update(){
	var answer = document.getElementById("answer").value;
	var question = document.getElementById("question").value;
	var username = '<?php echo $_SESSION['username'];?>'; 
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("confirmation").innerHTML = this.responseText;
          }
	};
	xmlhttp.open("GET", "updateQuestion.php?u=" + username + "&q=" + question+"&a=" + answer, true);
	xmlhttp.send();

      }
      
   </script>




  </body>


</html>
