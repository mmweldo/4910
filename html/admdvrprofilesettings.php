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
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8 inputGroupContainer">
							   	<?php
									$sql = "select firstname from drivers where user_id = ".$_PSOT['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="firstName" name="firstName" placeholder="First Name" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select lastname from drivers where user_id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>							
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="lastName" name="lastName" placeholder="Last Name" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Profile Image</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select profile_img from drivers where user_id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="profimg" name="profimg" placeholder="Profile Image URL" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Address Line</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select street_address from drivers where user_id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="addressLine" name="addressLine" placeholder="Address Line" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">City</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="city" name="city" placeholder="City" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">State/Province/Region</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="state" name="state" placeholder="State/Province/Region" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Postal Code/ZIP</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select postal_code from drivers where user_id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="postcode" name="postcode" placeholder="Postal Code/ZIP" class="form-control" required="true" value="<?php echo $row[0]?>" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select country from drivers where user_id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control"  value="<?php echo $row[0]?>">
										<option value="CAN">Canada</option>
										<option value="USA">United States</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
								<?php
									$sql = "select email from users where id = ".$_POST['user_id'];
									$result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_row($result);
							    ?>
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control" required="true" value="<?php echo $row[0]?>" type="email"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phoneNumber" name="phoneNumber" placeholder="Phone Number" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <input type="submit" name="submit" value="Update">
						 <?php 
						 if(isset($_POST["submit"])){
								$sql = "UPDATE drivers SET lastname = '".$_POST['lastName']."', firstname = '".$_POST['firstName']."', profile_img = '".$_POST['profimg']."', postal_code = '".$_POST['postcode']."' WHERE user_id = ".$_POST['user_id'];
								
								if ($result=mysqli_query($conn, $sql)) {
									echo "<script>setTimeout(\"location.href = '../admdvrprofilesettings.php';\", 3000);</script>";
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