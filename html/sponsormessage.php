<!-- SPONSOR MESSAGES INDIVIDUAL DRIVER-->
<?php

  //Session start and make sure the proper user is here
  session_start();
  if(!isset($_SESSION['user_id'])){
    echo "Error: NOT LOGGED IN. Redirecting...";
    echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
    exit(); 
  }else if($_SESSION['user_type'] != "sponsor"){
    echo "Error: Wrong User. Redirecting...";
    echo "<script>setTimeout(\"location.href = '../index.php';\", 3000);</script>";
    exit(); 
  }

  //Header stuffs, adds the html header based on user
  if($_SESSION['user_type'] == "driver"){
    include 'driverheader.php';
  }
  else if($_SESSION['user_type'] == "sponsor"){
    include 'sponsorheader.php';
  }
  else if($_SESSION['user_type'] == "admin"){
    include 'adminheader.php'; 
  }
?>
<!DOCTYPE html>
<html>
<head>
<script>
  /*
  function showUser(str) {
    if (str=="") {
      document.getElementById("txtHint").innerHTML="";
      return;
    } 
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("txtHint").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }*/
</script>
</head>
  <body>
    <br>
    <br>
    <center>
    <div style="width:32vw;">
      <?php
        $endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
        $conn = mysqli_connect($endpoint, "master", "group4910", "website");

        
        $sql = "SELECT username, firstname, lastname FROM drivers join driver_list on driver_list.driver_id = drivers.user_id WHERE driver_list.sponsor_id = ".$_SESSION['user_id'].";";
      
        //echo "SELECT username, firstname, lastname FROM driver_list JOIN drivers on driver_list.driver_id = drivers.user_id WHERE driver_list.sponsor_id = ".$_SESSION['user_id'].";";
        
        $result = mysqli_query($conn, $sql);
        if(!$result){
          echo "[1] Error: NO USERS. Redirecting...";
          echo "<script>setTimeout(\"location.href = '../index.html?ERROR-NODRIVERS';\", 3000);</script>";
          exit();   
        }

        $resultCheck = mysqli_num_rows($result);
          if($resultCheck < 1){
          echo "[2] Error: NO USERS. Redirecting...";
          echo "<script>setTimeout(\"location.href = '../index.html?ERROR-NODRIVERS';\", 3000);</script>";
          exit();   
        }

        echo '<form><select name="driver" onchange="showUser(this.value)">';
        echo '<option value="">Select a driver:</option>';
        
        while($row=mysqli_fetch_row($result)){
          echo '<option value = "'.$row[0].'">'.$row[1].' '.$row[2].'@'.$row[0].'</option>'; 
        }
        echo '</form>';
        echo '<div id="txtHint"><b>Person info will be listed here.</b></div>';
        echo '</div>';

        mysqli_close($conn);
      ?>
      </div>
      <textarea name="message" style="min-width:33vw;"></textarea>
      <button name="submit" value="submit" style="float:right;">Submit</button>
    </center>
  </body>
</html>
