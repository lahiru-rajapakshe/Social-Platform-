<!DOCTYPE html>

<html>
<head>
	
	<title>Forgotten Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- google fonts -->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
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







	body{
		overflow-x: hidden;
		
		background-color: black;
	}
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		
		padding: 40px 50px;


		background-color: rgba(255,255,255,0.1);
		
		border-radius: 5px;
		backdrop-filter:blur(30px);
		border:2px solid transparent;
		background-clip: padding-box;
		box-shadow: 10px 10px 10px rgba(45,55,68,0.30);
		line-height: 1.5;
		color: #000;
	}
	.header{
		border:0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		 	background-color: #187FAB;
		 }
		  #signin{
		 	width: 60%;
		 	border-radius: 30px;
		 }
		 .overlap-text{
		 	position: relative;
		 }
		 .overlap-text a{
		 	position: absolute;
		 	top: 8px;
		 	right: 10px;
		 	font-size: 14px;
		 	text-decoration: none;
		 	font-family: 'Overpass Mono',monospace;
		 	letter-spacing: -1px;
		 	margin-right: 28px;
		 }
		 #signup{
		 width: 60%;
		 border-radius: 8px;
		 background-color: #1DA1F2;
		 color: black;
		 	font-family: 'Montserrat', sans-serif;
		

	}
	#signup:hover{
		background-color: transparent;
		transition: .5s ease-in-out;
		color: white;

	}
</style>
<body>
	<!-- <div class="row">
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
						<h3 style="text-align: center;"><strong>Forgot password</strong></h3><hr>
					</div>
					<div class="l_pass">
						
						
					</div>
				</div>
			</div>
		</div> -->






	<div class="ro" style="padding-top: 120px;">
		<div class="co">
			<div class="main-content">
				<div class="header">
					<h3 style="text-align: center;"><strong style="font-family: 'Montserrat', sans-serif;color: #EFEEED;">Forgotten Password ? </strong></h3><br>
				</div>
				<div class="l-part">
					<form action="" method="post">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
							</div><br>
							<hr>
							<pre class="text" style="font-family: 'Montserrat', sans-serif;font-weight: bold;">Enter your Mother or Father's name here</pre>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
								<input id="msg" type="text" class="form-control" placeholder="Someone" name="recovery_account" required>
							</div><br>
							<a href="start.php" style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin">Back to Sign in?</a><br><br>
							<center><button id="signup" class="btn btn-info btn-lg" name="submit">Submit</button></center>
						</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
session_start();

include("connect.php");

if(isset($_POST['submit'])){

	$email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
	$recovery_account = htmlentities(mysqli_real_escape_string($conn, $_POST['recovery_account']));

	$select_user = "select * from user where email='$email' AND cover='$recovery_account'";

	$query = mysqli_query($conn, $select_user);
	$check_user = mysqli_num_rows($query);

	if($check_user == 1){
		$_SESSION['email'] = $email;

		echo "<script>window.open('change_password.php','_self')</script>";
	}else{
				echo "<script>alert('Your Email or Best friend name is incorrect!')</script>";
	}

}
?>