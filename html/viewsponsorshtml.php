<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo "Error: User not logged in! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-LOGGED-IN';\", 3000);</script>";
		exit();
	}
	//For now lets allow all users to see this if they're logged in, useful for drivers trying to find a sponsor
	/*if($_SESSION['user_type'] != "admin"){
		echo "Error: User doesn't have permission to be here! Redirecting...";
		echo "<script>setTimeout(\"location.href = '../index.php?NOT-ADMIN';\", 3000);</script>";
		exit();
	}*/
?>

<html>

<?php
		if($_SESSION['user_type'] == "sponsor"){
			include 'sponsorheader.php';
			echo '<center><h2>Sponsor - View Sponsors</h2></center>';
		}else if($_SESSION['user_type'] == "admin"){
			include 'adminheader.php'; 
			echo '<center><h2>Admin - View Sponsors and their Stores</h2></center>';
		}else if($_SESSION['user_type'] == "driver"){
			include 'driverheader.php';
			echo '<center><h2>Driver - Browse Sponsors</h2></center>';
		}
?>
<body>
	<div class="container" style="height:80vh;">
		<center>
			<form class="viewsponsors-form" method="post" action="viewsponsors.php">
					<p>Company Name | Sort</p>
					<select name="order">
						<option value="sponsors.company_name ASC">Company Asc</option>
						<option value="sponsors.company_name DESC">Company Desc</option>

						<option value="sponsors.email ASC">Email Asc</option>
						<option value="drivers.email DESC">Email Desc</option>

						<option value="sponsors.username ASC">Username Asc</option>
						<option value="sponsors.username DESC">Username Desc</option>

						<option value="sponsors.user_id ASC">ID Asc</option>
						<option value="sponsors.user_id DESC">ID Desc</option>

						<option value="users.date_created ASC">Date Created Asc</option>
						<option value="users.date_created DESC">Date Created Desc</option>

					</select>
					<button type="submit" name="submit">Submit</button>
			</form>
<?php 

	if($_SESSION['user_type'] == "admin")
	echo'<h2>Admin - View User List</h2>
		<form class="userlist-form" method="post" action="userlist.php">
			<select name="order">
				<option value="users.username ASC">Username Asc</option>
				<option value="users.username DESC">Username Desc</option>
				<option value="users.email ASC">Email Asc</option>
				<option value="users.email DESC">Email Desc</option>
				<option value="users.date_created ASC">Creation Asc</option>
				<option value="users.date_created DESC">Creation Desc</option>
				<option value="users.id ASC">id Asc</option>
				<option value="users.id DESC">id Desc</option>
			</select>
			<button type="submit" name="submit">Submit</button>
		</form>';
	if($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "sponsor"){
		echo '<h2>View Driver List</h2>
			<form class="driverlist-form" method="post" action="driverlist.php">
			<p>Company Name | Sort</p>';
		
		if($_SESSION['user_type'] == "admin"){
			echo'<input type="text" name="company_username" placeholder="company_username">';
		}
		else if ($_SESSION['user_type'] == "sponsor"){
			echo'<p>'.$_SESSION['username'].'</p><input type="hidden" name="company_username" placeholder="company_username" value="'.$_SESSION['username'].'">';
		}else {
			echo "You shouldn't be here!";
		}

		echo '<select name="order">
			<option value="drivers.firstname ASC">Fname Asc</option>
			<option value="drivers.firstname DESC">Fname Desc</option>
			<option value="drivers.lastname ASC">Lname Asc</option>
			<option value="drivers.lastname DESC">Lname Desc</option>
			<option value="drivers.username ASC">Username Asc</option>
			<option value="drivers.username DESC">Username Desc</option>
			<option value="drivers.total_points ASC">Total Pts Asc</option>
			<option value="drivers.total_points DESC">Total Pts Desc</option>
			<option value="drivers.current_points ASC">Curr Pts Asc</option>
			<option value="drivers.current_points DESC">Curr Pts Desc</option>
			<option value="users.date_created ASC">Date Created Asc</option>
			<option value="users.date_created DESC">Date Created Desc</option>
		</select>
		<button type="submit" name="submit">Submit</button>';
	}
?>
		</center>
	</div>
	<footer>
      		<p>Drewp, Copyright &copy; 2019</p>
    	</footer>
</body>
</html>
