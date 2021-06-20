
<?php
//error_reporting(0);
include('connect.php');

$userId= $_SESSION['user_id'];

$sql="SELECT * FROM `user` WHERE `user_id`='$userId'";

	$result=mysqli_query($conn,$sql);


	while($row = mysqli_fetch_assoc($result)){

		$userImage =$row['user_image'];


}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>



*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	.comment-body-container{
		width: 100%;
		max-width: 768px;
		margin: auto;

	}

	.comment-nav-container{
		width: 100%;
		max-width: 768px;
		margin: auto;
		width: 100%;
		top: 0;
		position: fixed;
		border-bottom: 1px solid #ccc;
		background-color: #f0f0f0;

	}
	.comment-nav-container ul{
		width: 100%;
		height: 50px;
		list-style-type: none;
		overflow: hidden;
		background-color: #f0f0f0;
	}
	.comment-nav-container .comment-icon{
		float: left;
		width: 20%;
	}

	.comment-nav-container .comment-name{
		float: left;
		width: 80%;
	}

	.comment-nav-container .comment-icon a{
		display: block;
		text-align: center;
		font-size: 17px;
		line-height: 50px;
		cursor: pointer;
	}

	.comment-nav-container .comment-name a{
		display: block;
		text-align: start;
		font-size: 17px;
		line-height: 50px;
	}
	.comment-bottom-container{
		width: 100%;
		max-width: 768px;
		margin: auto;
		width: 100%;
		bottom: 0;
		position: fixed;

	}
	.comment-bottom-inner-container{
		float: left;

	}

	.comment-bottom-inner-container.image{
		width: 20%;

	}
	.comment-bottom-inner-container.comment{
		width: 60%;

	}
	.comment-bottom-inner-container.submit{
		width: 20%;

	}
	.comment-bottom-inner-container img{
		width: 40px;
		height: 40px;
		margin-top: 5px;
		margin-left: 10%;
		border-radius: 50px;
		background-color: #f0f0f0;



	}
	.comment-bottom-inner-container input[type=text]{

		width: 100%;
		padding: 8px;
		margin-top:8px;
		display: inline-block;
		box-sizing: border-box;
		font-size: 12px;
		border: none;
		background-color: #f0f0f0;
	}

	.comment-bottom-inner-container button{

		width: 100%;
		padding: 8px;

		margin-top: 5px;
		font-size: 15px;
		border:none;

		background-color: #f0f0f0;
		color: #3897f0;
	}
	.comment-main-container{
		width: 100%;margin-top: 60px;


	}
	.comment-post-container{
		width: 100%;
		height: 50px;
		border-bottom: 1px solid #ccc;


	}

	.comment-inner-container{
		float: left;

	}

	.comment-inner-container.image{
		width: 20%;

	}
	.comment-inner-container.name{
		width: 80%;

	}

	.comment-inner-container img{
		width: 40px;
		height: 40px;
		margin-top: 5px;
		margin-left: 10%;
		border-radius: 50px;



	}

	.comment-comment-container{
		width: 100%;
		height: 50px;



	}

	.comment-comment-inner-container{
		float: left;

	}

	.comment-comment-inner-container.image{
		width: 20%;

	}
	.comment-comment-inner-container.name{
		width: 70%;

	}
	.comment-comment-inner-container.like{
		width: 10%;

	}
	.comment-comment-inner-container img{
		width: 40px;
		height: 40px;
		margin-top: 5px;
		margin-left: 10%;
		border-radius: 50px;



	}
</style>

</head>

<body>

<div class="comment-body-container">

	<div class="comment-nav-container">



		<ul>
		<li class="comment-icon"><a><i class="fas fa-arrow-left"></i></a></li>
		<li class="comment-name"><a>Comments</a></li>


	</ul>
	</div>

	<div class="comment-main-container">

			<div class="comment-post-container">
					<div class="comment-inner-container image">

			<img src="temp/profile.jpeg" />


			</div>

			<div class="comment-inner-container name">


		<p style="font-size: 17px; margin-top: 5px;"><b>username</b></p>
		<p style="font-size: 17px; margin-top: 3px; color: #aaa;">time</p>

		</div>
			</div>




				<div class="comment-comment-container">
					<div class="comment-comment-inner-container image">

					<img src="temp/profile.jpeg" />


					</div>

			<div class="comment-comment-inner-container name">


		<p style="font-size: 17px; margin-top: 5px;"><b>username</b></p>

			<div class="comment-time-container" style="float: left;width: 20%;">

		<p style="font-size: 17px; margin-top: 3px; color: #aaa;">time</p>

			</div>


			<div class="comment-time-container">

		<p style="font-size: 17px; margin-top: 3px; color: #aaa;">0 Likes</p>

			</div>

			</div>

			<div class="comment-comment-inner-container like">

					<i class="far fa-heart" style="margin-top:20px;"></i>


					</div>
			</div>



	</div>
	<div class="comment-bottom-container">

		<form  method="post" id="comment_form" data-action="comment">

		<div class="comment-bottom-inner-container image">

			<img src="<?php echo $userImage; ?>" id="user_image" />


	</div>

			<div class="comment-bottom-inner-container comment">


		<input type="text" name="comment" placeholder="add a comment...">

		</div>
		<div class="comment-bottom-inner-container submit">


		<button type="submit" name="submit" id="submit">post</button>

	</div>

		</form>

	</div>
</div>

	<script>

	</script>
</body>
</html>
