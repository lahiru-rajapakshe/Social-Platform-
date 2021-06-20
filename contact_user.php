<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- 

google fonts -->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
<style>

	*{
		margin: 0;
		padding: 0;

	}
	.user-top-nav ul{
		list-style-type: none;
		width: 100%;
		height: 50px;
		background-color: #e9e9e9;
		overflow: hidden;

	}
	.user-top-nav li{
		float: left;
		width: 50%;
	}
	.user-top-nav li a{
		display: block;
		text-decoration: none;
		text-align: center;
		line-height: 50px;
		cursor: pointer;color: #ccc;
	}

	.user-tab.activate{
		color: black;
	}
	.user-container{
		display: none;

	}
	.user-container.user-active{
		display: inherit;
		
	}
	.user-container{
		width: 100%;
		height: 100%;

	}

	.user-follow-container{
		width: 100%;
		max-width: 768px;
		margin: auto;
		margin-top: 10px;

	}
	.follow-main-container{
		float: left;
		width: 33.33%;
		height: 50px;

	}
	.follow-image-container{
		width: 40px;
		height: 40px;
		max-width: 40px;
		margin: auto;
		overflow: hidden;
		border-radius: 25px;
	}
	img{
		width: 100%;
		height: 100%;
	}
	.follow-like-container{
		width: 80px;
		max-width: 80px;
		margin: auto;
	}
	.follow-like-container button{
		padding: 5px;
		border:none;
		border-radius: 5px;
		background-color: #3897f0;
		color: white;
	}
	.follow-main-container p{
		margin-top: 15px;
	}




	.user-following-container{
		width: 100%;
		max-width: 768px;
		margin: auto;
		margin-top: 10px;

	}
	.following-main-container{
		float: left;
		width: 33.33%;
		height: 50px;

	}
	.following-image-container{
		width: 40px;
		height: 40px;
		max-width: 40px;
		margin: auto;
		overflow: hidden;
		border-radius: 25px;
	}
	img{
		width: 100%;
		height: 100%;
	}
	.following-like-container{
		width: 80px;
		max-width: 80px;
		margin: auto;
	}
	.following-like-container button{
		padding: 5px;
		border:none;
		border-radius: 5px;
		background-color: #3897f0;
		color: white;
	}
	.following-main-container p{
		margin-top: 15px;
	}
</style>


</head>

<body>
	
	 <div class="user-top-nav">
<ul>
	<li><a class="user-tab" containerIds="following"></a></li>
	<li><a class="user-tab activate" containerIds="you" style="font-family: 'Raleway', sans-serif;font-size: 30px;padding-left: 300px;">Who to Follow ?</a></li>
</ul>
	
	</div>

	<div id="following" class="user-container">

		<div class="user-following-container">
		
			

	</div>
		
	</div>

	<div id="you" class="user-container user-active">

	<div class="user-follow-container">
		
			<div class="follow-main-container">
				
				<div class="follow-image-container">
				
					<img src="temp/profile.jpeg"/>
				</div>
		
			</div>

			<div class="follow-main-container">
				
				<p>full name</p>
		
			</div>

			<div class="follow-main-container">
				
				<div class="follow-like-container">
				
					<button>Follow</button>
				</div>
			</div>

	</div>
		
	</div>


	<script>

		$(document).ready(function(){

			$(".user-tab").click(function(){

				$(".user-tab").removeClass("activate");

				$(this).addClass("activate");

							$(".user-container").removeClass("user-active");

							var userId = $(this).attr("containerIds");

							$("#"+userId).addClass("user-active");


		});


			fetch_user();
			function fetch_user(){


				var action ='fetch_user';
				$.ajax({

					url:"contact.php",

					method:"post",


					data:{action_user:action},

					success:function(data){

						$('.user-follow').html(data);
					}
				});

			}

			$(document).on('click','.follow_button', function(){

				var followId = $(this).data('user_follow');

				var userId = $(this).data('user_id');

				var follow = $(this).data('action');

				$.ajax({

					url:"contact.php",

					method:"post",


					data:{action_follow:follow,user_id:userId,follow_id:followId},

					success:function(data){

						// $('.user-follow-container').html(data);
						// alert(data);
						fetch_user();
					}
				});

			});

		});

	</script>
</body>
</html>