<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php

session_start();
	if(!isset($_SESSION['username'])){
		echo "Error: Please log in first!";
		echo "<script>setTimeout(\"location.href = '../login.html?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//Check if appropriate user (driver) for page
	if($_SESSION['user_type'] != "admin"){
		echo "Error: User not an admin!";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection*/

$endpoint = "db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com";
$conn = mysqli_connect($endpoint, "master", "group4910", "website");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 

<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   <form class="well form-horizontal" method="post">
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Profile Image</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select profile_img from admins where user_id = ".$_SESSION['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="profimg" name="profimg" placeholder="Profile Image URL" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select email from users where id = ".$_SESSION['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control" required="true" value="<?php echo $row[0]?>" type="email"></div>
                            </div>
                         </div>
						 <input type="submit" name="submit" value="Update">
						 <?php 
						 if(isset($_POST["submit"])){
								$sql = "UPDATE admins profile_img = '".$_POST['profimg']."' WHERE user_id = ".$_SESSION['user_id'];
								
								if ($result=mysqli_query($conn, $sql)) {
									echo "<script>setTimeout(\"location.href = '../admprofilesettings.php';\", 3000);</script>";
								} else {
									echo "Error updating record: " . $conn->error;
								}
						 }
						 ?>
                      </fieldset>
                   </form>
                </td>
             </tr>
          </tbody>
       </table>
    </div>