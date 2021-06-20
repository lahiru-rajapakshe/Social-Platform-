<?php

 error_reporting(0);
include('connect.php');

session_start();
$userId = $_SESSION['user_id'];

// echo $_GET['userId'];
	$sql="SELECT * FROM `user` WHERE `user_id`='$userId'";

	$result=mysqli_query($conn,$sql);

	while($row = mysqli_fetch_assoc($result)){

		$fullname = $row['fullname'];
		$username = $row['username'];
		$email = $row['email'];
		$bio = $row['bio'];
		
		$profileImage = $row['user_image'];

		if($profileImage==null){
			$userProfileImage = "<img src='temp/profile.png' id='profileImage' />";


		}
		else{
			$userProfileImage = "<img src='$profileImage' id='profileImage' />";
		}
		
	}

	if(isset($_POST['submit'])){

		$target_dir = "instagram_profileimage/";

		$name = $_FILES['imagefile']['name'];

		$taraget_file_name = $target_dir .basename($name);

		$profile_image_url = 'http://localhost/insta/instagram_profileimage/'.$name;

		$fullname = $_POST['fullname'];

		$website = $_POST['website'];

		$bio = $_POST['bio'];

		$email = $_POST['email'];

		$password = $_POST['password'];

		$gender = $_POST['gender'];

	//	$cover = $_POST['gender'];


		move_uploaded_file($_FILES['imagefile']['tmp_name'], $taraget_file_name);

 			
		if($name == null ||empty($fullname) ||empty($username) ||empty($website) ||empty($bio) ||empty($email) ||empty($password) ||empty($gender)){

			$message= "<h6>"."Please fill all the fields ! "."</h6>";

		}else{
			
			$query = "UPDATE `user` SET `fullname`='$fullname',`username`='$username',`user_image`='$profile_image_url',`website`='$website',`bio`='$bio',`gender`='$gender',`password`='$password',`email`='$email' WHERE `user_id`='$userId'";

			$query_result = mysqli_query($conn,$query);

			if($query_result){

				$message = "<h6>"."update success"."</h6>";
				header('location:instagram.php');

			}else{

				$message = "<h6>"."update fail"."</h6>";

			}
		}


	}
if(isset($_POST['delete'])){

		$target_dir = "instagram_profileimage/";

		$name = $_FILES['imagefile']['name'];

		$taraget_file_name = $target_dir .basename($name);

		$profile_image_url = 'http://localhost/insta/instagram_profileimage/'.$name;

		$fullname = $_POST['fullname'];

		$website = $_POST['website'];

		$bio = $_POST['bio'];

		$email = $_POST['email'];

		$password = $_POST['password'];

		$gender = $_POST['gender'];

	//	$cover = $_POST['gender'];


		move_uploaded_file($_FILES['imagefile']['tmp_name'], $taraget_file_name);

 			
		if($name == null ||empty($fullname) ||empty($username) ||empty($website) ||empty($bio) ||empty($email) ||empty($password) ||empty($gender)){

			$message= "<h6>"."Please fill all the fields ! "."</h6>";

		}else{
			
			$query = "DELETE FROM `user` WHERE `user_id`='$userId'";

			$query_result = mysqli_query($conn,$query);

			if($query_result){

				$message = "<h6>"."update success"."</h6>";
				header('location:instagram.php');

			}else{

				$message = "<h6>"."update fail"."</h6>";

			}
		}


	}
	if(isset($_POST['delete'])){

 			
		

			
			$query = "DELETE FROM `user` WHERE `user_id`='$userId'";

			$query_result = mysqli_query($conn,$query);

			if($query_result){

				$message = "<h6>"."DELETED success"."</h6>";
				header('location:start.php');

			}else{

				$message = "<h6>"."update fail"."</h6>";

			}

		


	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<!-- google fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">


<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">

<!-- fontawesome library-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<style>


	/*loader*/

	.wrapper {
	width: 1170px;
	margin: 0 auto;
}
header {
	height: 100px;
	background: #262626;
	width: 100%;
	z-index: 10;
	position: fixed;
}
.logo {
	width: 30%;
	float: left;
	line-height: 100px;
}
.logo a {
	text-decoration: none;
	font-size: 30px;
	font-family: poppins;
	color: #fff;
	letter-spacing: 5px;
}
nav {
	float: right;
	line-height: 100px;
}
nav a {
	text-decoration: none;
	font-family: poppins;
	letter-spacing: 4px;
	font-size: 20px;
	margin: 0 10px;
	color: #fff;
}
.banner-area {
	width: 100%;
	height: 500px;
	position: fixed;
	top: 100px;
	background-image: url(https://i.postimg.cc/T3B3WFcv/2.jpg);
	-webkit-background-size: cover;
	background-size: cover;
	background-position: center center;
}
.banner-area h2 {
	padding-top: 8%;
	font-size: 70px;
	font-family: poppins;
	text-transform: uppercase;
	color: #fff;
}
.content-area {
	width: 100%;
	position: relative;
	top: 450px;
	background: #ebebeb;
	height: 1500px;
}
.content-area h2 {
	font-family: poppins;
	letter-spacing: 4px;
	padding-top: 30px;
	font-size: 40px;
	margin: 0;
}
.content-area p {
	padding: 2% 0px;
	font-family: poppins;
	line-height: 30px;
}
.loader_bg{
	position: fixed;
	z-index: 999999;
	background: #fff;
	width: 100%;height: 100%;
}
.loader{
	border:8 solid transparent;
	border-radius: 20%;
	width: 150px;height: 150px;position: absolute;
	top: calc(0vh-75px);
	left: calc(0vw-5px);
}
.loader:before,.loader:after{
	content: '';
	border:1em solid dodgerblue;
	border-radius: 50%;
	width: inherit;
	height: inherit;
	position: absolute;
	top: 0;
	left: 50px;
	margin-left: 550px;
	margin-top: 200px;
	animation: loader 2s linear infinite;
	opacity: 0;

}
.loader:before{
	animation-delay: .5s;

} 
@keyframes loader{
	0%{
		transform: scale(.5);
		opacity: 0;

	}
	50%{
		opacity: 1;
	}
	100%{
		transform: scale(.2);
		opacity: 0;
	}

}


/*loader over*/
		
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;

	}
	.edit-menu-container{
		width: 100%;

	}
	.edit-menu-container ul{
		width: 100%;
		height: 50px;
		list-style-type: none;
		overflow: hidden;
		background-color: #ccc;

		
	}
	.edit-menu-container .edit-icon{
		float: left;
		width: 15%;

	}
	.edit-menu-container .edit-name{
		float: left;
		width: 70%;
		
	}
	.edit-menu-container .edit-icon a{
		display: block;
		text-align: center;
		font-size: 17px;
		line-height: 50px;
		cursor: pointer;
	}
	.edit-menu-container .edit-name a{
		display: block;
		text-align: start;
		font-size: 17px;
		line-height: 50px;
		
	}
	.edit-main-container{
		width: 100%;
		max-width: 768px;
		margin: auto;
		/*border: 1px solid #E7EBEB;*/
		padding-top: 50px;
		border-radius: 10px;
		backdrop-filter:blur(20px);
		border:none;
		background-clip: padding-box;
		box-shadow: 1px 5px 10px rgba(45,55,68,0.30);

	}
	.edit-image-container{
		width: 100%;
		max-width: 100px;
		padding-top: 20px;
		padding-bottom: 20px;
		margin: auto;
		
	}
	.edit-image-container img{
		width: 100px;
		height: 100px;
		border-radius: 50px;
		
	}
	.edit-image-container button{
		width: 110px;
		border: none;
		margin-top: 5px;
		background-color: white;
		color: blue;
		font-size: 16px;

		
		
	}
	span input[type=file]{

		opacity: 0;


	}
	.edit-profile-detail-container{
		width: 100%;
		padding: 10px;
	}
	.edit-profile-detail-container input[type=text]{

		width: 100%;
		padding: 5px;
		margin-top: 8px;
		border: none;
		border-bottom: 1px solid #E7EBEB;
		margin-bottom: 8px;


	}
	.edit-profile-detail-container label{
		padding: 5px;
		margin-top: 5px;
	}
	.edit-tool-container{
		width: 100%;
		border: 1px solid red;
	}

	.edit-tool-container h6{
		font-size: 17px;
		text-align: center;
		padding: 5px;
		color: black;
	}
	h6{
		font-size: 17px;
		color: red;
		text-align: center;

	}
	input{
		font-family: 'Nunito', sans-serif;
		font-size: 20px;
	}
	label{
		font-weight: bold;
		font-family: 'Nunito', sans-serif;
		font-size: 15px;
	}
	select{
		font-family: 'Nunito', sans-serif;
		font-size: 14px;
		border: none;
		border-bottom: 1px solid gray;
		cursor: pointer;
	}

	 #cp{
		 width: 30%;

		 border-radius: 8px;
		 background-color: white;
		 color: black;
		 	font-family: 'Montserrat', sans-serif;
		

	}
	#cp:hover{
		background-color: transparent;
		transition: .5s ease-in-out;
		color: black;

	}
	 #okbtn{
		 width: 30%;
		 height: 30px;
		border: 1px solid #1DA1F2;
		 border-radius: 2px;
		 background-color: #1DA1F2;
		 color: white;
		 cursor: pointer;
		 margin-left: 520px;
		/* padding-left: 50px;*/

		 	font-family: 'Montserrat', sans-serif;
		

	}
	#okbtn:hover{
		background-color: transparent;
		transition: .5s ease-in-out;
		color: black;

	}
	.cm{
		font-family: 'Nunito', sans-serif;
		font-size: 15px;
		border: none;
		border-bottom: 1px solid gray;
		
	}





	}/*deactivation block over*/

.container2 {
  align-items: center;
  /*       background: #F1EEF1;
  border: 1px solid #D2D1D4;
  */      display: flex;
  height: 360px;
  justify-content: center;
  width: 360px;
  transition: .5s ease-in-out;

}
.email2 {
  background: #DEDBDF;
  border-radius: 1px;
  height: 32px;
  overflow: hidden;
  position: relative;
  width: 162px;
  -webkit-tap-highlight-color: transparent;
  transition: width 300ms cubic-bezier(0.4, 0.0, 0.2, 1),
    height 300ms cubic-bezier(0.4, 0.0, 0.2, 1),
    box-shadow 300ms cubic-bezier(0.4, 0.0, 0.2, 1),
    border-radius 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
      }
.email2:not(.expand2) {
  cursor: pointer;
}
.email2:not(.expand2):hover {
  background: #00acee;
}
.from2 {
  position: absolute;
  transition: opacity 200ms 100ms cubic-bezier(0.0, 0.0, 0.2, 1);
}
.from-contents2 {
  display: flex;
  flex-direction: row;
  transform-origin: 0 0;
  transition: transform 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
}
.to2 {
  opacity: 0;
  position: absolute;
  transition: opacity 100ms cubic-bezier(0.4, 0.0, 1, 1);
}
.to-contents2 {
  transform: scale(.55);
  transform-origin: 0 0;
  transition: transform 300ms cubic-bezier(1.4, 0.0, 0.2, 1);
}
.avatar2 {
  border-radius: 12px;
  height: 24px;
  left: 6px;
  position: relative;
  top: 4px;
  width: 24px;
}
.name2 {
  font-size: 14px;
  line-height: 32px;
  margin-left: 10px;
}
.top2 {
  background: #6422EB;
  display: flex;
  flex-direction: row;
  height: 70px;
  transition: height 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
  width: 300px;
}
.avatar-large2 {
  border-radius: 21px;
  height: 42px;
  margin-left: 12px;
  position: relative;
  top: 14px;
  width: 42px;
}
.name-large2 {
  color: #efd8ef;
  font-size: 16px;
  line-height: 70px;
  margin-left: 20px;
}
.x-touch2 {
  align-items: center;
  align-self: center;
  cursor: pointer;
  display: flex;
  height: 50px;
  justify-content: center;
  margin-left: auto;
  width: 50px;
}
.x2 {
  background: #BA87F9;
  border-radius: 10px;
  height: 20px;
  position: relative;
  width: 20px;
}
.x-touch2:hover .x {
  background: #CB9AFB;
}
.line12 {
  background: #6422EB;
  height: 12px;
  position: absolute;
  transform: translateX(9px) translateY(4px) rotate(45deg);
  width: 2px;
}
.line22 {
  background: #6422EB;
  height: 12px;
  position: absolute;
  transform: translateX(9px) translateY(4px) rotate(-45deg);
  width: 2px;
}
.bottom2 {
  background: #FFF;
  color:  #444247;
  font-size: 14px;
  height: 200px;
  padding-top: 5px;
  width: 300px;
}
.row {
  align-items: center;
  display: flex;
  flex-direction: row;
  height: 60px;
}
.twitter2 {
  margin-left: 16px;
  height: 30px;
  position: relative;
  top: 0px;
  width: 30px;
}
.medium2 {
  height: 30px;
  margin-left: 16px;
  position: relative;
  width: 30px;
}
.link {
  margin-left: 16px;
}
.link a {
  color:  #444247;
  text-decoration: none;
}
.link a:hover {
  color:  #777579;
}
.email2.expand2 {
  border-radius: 6px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.10), 0 6px 6px rgba(0,0,0,0.16);
  height: 200px;
  width: 300px;
}
.expand2 .from2 {
  opacity: 0;
  transition: opacity 100ms cubic-bezier(0.4, 0.0, 1, 1);
}
.expand2 .from-contents2 {
  transform: scale(1.91);
}
.expand2 .to2 {
  opacity: 1;
  transition: opacity 200ms 100ms cubic-bezier(0.0, 0.0, 0.2, 1);
}
.expand2 .to-contents2 {
  transform: scale(1);
}
/*deactivation block over
*/
 #dbtn{
		height: 40px;
		border: 1px solid #1DA1F2;
		 border-radius: 2px;
		 background-color: #1DA1F2;
		 color: black;
		 padding: 5px;
		 cursor: pointer;
		margin-left: 80px;
		/* padding-left: 50px;*/

		 	font-family: 'Open Sans', sans-serif;
		

	}
	#dbtn:hover{
		background-color: transparent;
		transition: .5s ease-in-out;
		color: black;

	}

	</style>
</head>
<body style="background-color: #F3F4F5;">
<!-- 
loader -->
	<div class="loader_bg">
		<div class="loader">
			
		</div>
		<p style="font-family: 'Montserrat', sans-serif;margin-top: 400px;text-align: center;font-size: 20px;margin-right: -20px;">We Extracting Your Bio Data <br> plaese Wait</p>
	</div>
	<div>

	<!-- 	staring edit profile -->
		<div class="edit-menu-container" >
	<form method="post" action="editprofile.php" enctype="multipart/form-data">
		<ul style="backdrop-filter:blur(20px);
		border:1px solid transparent;
		background-clip: padding-box;
		box-shadow: 1px 1px 1px rgba(45,55,68,0.30);
		background-color: #00acee ;border-top: 1px solid #D0D4D5;">
			<li class="edit-icon"><a href="instagram.php"><i style="font-size:20px;" class="fas fa-home"></i></a></li>
			<li style="padding-left: 370px;" class="edit-name"><a style="font-family: 'Montserrat', sans-serif;font-size: 30px;">Update My self</a></li>
				
		</ul>
		
	</div>

		<div class="edit-main-container">

		

			<div class="edit-image-container">
					<?php echo $userProfileImage; ?>

					<button class="select_image" id="cp"><i style="padding-left:50px;" class="fas fa-user-edit"></i></button>

						<span>
							<input type="file" name="imagefile" id="input_file" onchange="readUrl(this);" accept="image/*"></input>
						</span>
					
			</div>

				<?php echo $message; ?>
			<div class="edit-profile-detail-container">
				<button  id="okbtn" type="submit" name="submit">Update Profile</button><br>

					<label>name</label>
					<input type="text" name="fullname" placeholder="fullname" value="<?php echo $fullname; ?>"></input>

					<label>username</label>
					<input type="text" name="username" placeholder="username" value="<?php echo $username; ?>"></input>

					<label>Relationship status</label>
				<!-- 	<input type="text" name="website" placeholder="web"></input> -->

					<select name="website" style="margin-left: 70px">
						<option>Single</option>
						<option>In a Relationship</option>
						<option>Married</option>
						<option>It's complecated</option>
					</select><br><br>

					<label>Bio</label>
					<input type="text" name="bio" placeholder="bio" value="<?php echo $bio; ?>"></input>

			</div>

			 

			<div class="edit-profile-detail-container">
				
				<label>E-mail Address</label><br><br>
				<input class="cm" type="email" name="email" placeholder="email" value="<?php echo $email; ?>"></input><br><br>

				<label>Password</label>
				<input type="text" name="password" placeholder="Ur password"></input>

				<label>Gender</label>
				<!-- <input type="text" name="gender" placeholder="not spec"></input> -->
				<select name="gender" style="margin-left: 150px">
					
					<option>Male</option>
					<option>Female</option>
				</select>

				<!-- <button  id="okbtn" type="submit" name="delete">Deactivate my account</button><br> -->


				<!-- deactivate acc block starting -->

				 <div class="container2" style="margin-left:450px">
  <div class="email2" onclick="this.classList.add('expand2')">
    <div class="from2">
      <div class="from-contents2" >
        <div class="avatar2 me2"></div>
        <div class="name2" style="font-family: 'Open Sans', sans-serif;">Deactivate account</div>
      </div>
    </div >
    <div class="to2" >
      <div class="to-contents2" >
        <div class="top2"style="background-color:#00acee">
          <div class="avatar-large2 me2"></div>
          <div class="name-large2" style="font-family: 'Open Sans', sans-serif;color: white;">Deactivate my account</div>
          <div class="x-touch2" onclick="document.querySelector('.email2').classList.remove('expand2');event.stopPropagation();">
            <div class="x2" style="background-color:white">
              <div class="line12"></div>
              <div class="line22"></div>
            </div>
          </div>
        </div>
        <div class="bottom2">
          <div class="row">
           
          <div class="row">

          	<p style="text-align:center;font-family: 'Open Sans', sans-serif;">Are you sure ? do you continue with deactivating your account ? <br><span style="font-size:11px;color:red;font-weight:bold">Please note : when you deactivate your account, then you cannot recover your account any way</span></p>
           <div style="margin-top: 130px;">

           	<table style="margin-left:-300px">
           		<tr>
           			<td>
           					
           			</td>
           			<td>
           				  <button  id="dbtn" type="submit" name="delete">Deactivate my account</button>
           			</td>
           		</tr>
           	</table>
           
          <br>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- deactivatin my account block end -->


			</div>
			</form>
			
		</div>

   

		<script>
			$('.select_image').on('click', function(e){

				e.preventDefault();

				$('#input_file').trigger('click');


			});

			function readUrl(input){

				if(input.files && input.files[0]){

					var reader = new FileReader();

					reader.onload = function(e){

						$('#profileImage').attr('src', e.target.result);

					};
					reader.readAsDataURL(input.files[0]);


				}

			}
		</script>
	</div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		setTimeout (function(){
			$('.loader_bg').fadeToggle();
		},4500);
	</script>

	
</body>
</html>