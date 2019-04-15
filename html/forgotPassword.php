<html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>DREWP | Login</title>
  </head>

  <body>
<?php 
  session_start();
  if($_SESSION['user_type'] == "admin"){
    include 'adminheader.php'; 
  }else if($_SESSION['user_type'] == "sponsor"){
    include 'sponsorheader.php';
  }else {
    include 'driverheader.php'; 
  }
?>
 <center>
    <div>
      <p>Enter Username</p>
      <input type="text" name="uname" id="username">
      <button type="button" onclick="test()">Answer Security Question</button>
    <div>
    <div>
      <p id="question">needs Change</p>
      <input type="text" name="answer" id="answer">
      <p>New Password</p>
      <input type="text" name="newPasssword" id="newPassword">
      <button type="button" onclick="verify()">Submit</button>
      <p id="confirmation"></p>
    </div>
  </center>

  <script>
      function test(){
	var username = document.getElementById("username").value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("question").innerHTML = this.responseText;
          }
	};
	xmlhttp.open("GET", "loadQuestion.php?u=" + username, true);
	xmlhttp.send();
      }
      
   </script>
   <script>
      function verify(){
	var answer = document.getElementById("answer").value;
	var newPassword = document.getElementById("newPassword").value;
	var username = document.getElementById("username").value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("confirmation").innerHTML = this.responseText;
          }
	};
	xmlhttp.open("GET", "verify.php?u=" + username + "&p=" + newPassword +"&a=" + answer, true);
	xmlhttp.send();
      }
      
   </script>




  </body>


</html>
