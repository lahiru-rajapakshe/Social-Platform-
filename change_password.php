<!DOCTYPE html>
<?php 
session_start();
include("connect.php");

if(!isset($_SESSION['email'])){
	// header("location: index.php");
}
?>
<html>
<head>
	
	<title>Forgotten Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
	body{
		overflow-x: hidden;
	}
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border:2px solid #e6e6e6;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;

	}
	#signup{
		width: 60%;
		border-radius: 30px;
	}
</style>
<body>
	<div class="row">
			<div class="col-sm-12">
				<div class="well">
					<center><h1 style="color: white;"><strong>CodeMO</strong></h1></center>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="main-content">
					<div class="header">
						<h3 style="text-align: center;"><strong>Change Your Password</strong></h3><hr>
					</div>
					<div class="l_pass">
						<form action="" method="post">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="Password" type="Password" class="form-control" name="pass" placeholder="New Password" required>
							</div><br>
							
							
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="Password" type="Password" class="form-control" placeholder="Re-enter the new Password" name="pass1" required>
							</div><br>
							
							<center><button id="signup" class="btn btn-info btn-lg" name="change">Change Password</button></center>
						</form>
						
					</div>
				</div>
			</div>
		</div>
</body>
</html>
<?php

	if(isset($_POST['change'])){

	$user = $_SESSION['email'];
	$get_user = "select * from user where email='$user'";
	$run_user = mysqli_query($conn, $get_user);
	$row = mysqli_fetch_array($run_user);

	$user_id = $row['user_id'];

	$pass = htmlentities(mysqli_real_escape_string($conn, $_POST['pass']));
		$pass1 = htmlentities(mysqli_real_escape_string($conn, $_POST['pass1']));

		if($pass == $pass1){
		if(strlen($pass) >=6 && strlen($pass) <= 60){
		$update = "update users set user_pass ='$pass' where user_id='$user_id'";

		$run = mysqli_query($conn, $update);
		echo "<script>alert('Your password is changed a moment ago!')</script>";
		echo "<script>window.open('home.php', '_self')</script>";
	}
	else{
		echo "<script>alert('Your password must be greater than 6 letters!')</script>";
	}
}
	else{
		echo "<script>alert('Your password did not mathed!')</script>";
		echo "<script>window.open('change_password.php', '_self')</script>";
}
	}


?>