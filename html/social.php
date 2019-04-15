<?php session_start();?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/shellStyle.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
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
    <!--TODO
    ADD BROADCAST MESSAGING
    FILTER AND SANITIZE THE DATABASE PARAMETERS 
    MAKE THE THE SCRIPTS JOINED TOGETHER
    -->

    <!-- Messaging System -->
    <p>Send Message</p>
    <div>
      <p>Send to</p>
      <input type="text" name="to" id="receiver" placeholder="username">
      <p>Message</p>
      <input type="text" name="message" id="message" placeholder="message">
      <button type="button" onclick="sendMessage()">Send Message</button>
      <p id="confirmation"></p>
    </div>

    <!-- Inbox System -->
    <p>Inbox</p>
    <button type="button" onclick="loadInbox()">Load Inbox</button>
    <div id="inbox">
      
    </div>
    <div style="height:30vh;"></div>
    <!-- Bug Report System -->
    <p>Bug Report Here</p>
    <div>
      <input type="text" name="message" id="bugMessage">
      <button type="button" onclick="bugReport()">Send Message</button>
      <p id="bugConfirmation"></p>
    </div>
  </center>
   <?php
      if($_SESSION['user_type'] == "admin"){
        echo '<button type="button" onclick="loadBugBox()">Load Bugs</button>';
	echo "<div id='bugBox' onload='loadBugBox()'></div>";
      }
    ?>
    <script>
      function loadBugBox(){
        var owner ='bugAdmin';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("bugBox").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "getInbox.php?o="+ owner, true);
        xmlhttp.send();
      }
    </script>
    <script>
      function bugReport(){
        var receiverText = "bugAdmin";
        var messageText = document.getElementById("bugMessage").value;
        var senderText = '<?php echo $_SESSION['username'];?>';

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("bugConfirmation").innerHTML = this.responseText;
          }
        };
      xmlhttp.open("GET", "sendmessage.php?m=" + messageText + "&t=" + receiverText + "&f=" + senderText, true);
      xmlhttp.send();
      }
    </script>
    <script>
      function loadInbox(){
        var owner ='<?php echo $_SESSION['username'];?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("inbox").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "getInbox.php?o="+ owner, true);
        xmlhttp.send();
      }
    </script>
    <script>
      function sendMessage(){
        var receiverText = document.getElementById("receiver").value;
        var messageText = document.getElementById("message").value;
        var senderText = '<?php echo $_SESSION['username'];?>';

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("confirmation").innerHTML = this.responseText;
          }
        };
      xmlhttp.open("GET", "sendmessage.php?m=" + messageText + "&t=" + receiverText + "&f=" + senderText, true);
      xmlhttp.send();
      }
    </script>
  </body>
</html>
