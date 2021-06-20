<style>

</style>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
<?php

error_reporting(0);
include('connect.php');
session_start();
if(!isset($_SESSION['user_id'])){
	
	header('location:instagram_login.php');
}
	

if(isset($_POST['action'])){

	
	$userId = $_SESSION['user_id'];



	$sql="SELECT * FROM `user` WHERE `user_id`='$userId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $fullname = $row['fullname'];

			  $website = $row['website'];

			   $bio = $row['bio'];

			    $profileImage = $row['user_image'];

			    $coverImage =$row['cover'];
			    if($profileImage==null)
			    {

			    	// $userProfileImage = "<img src='temp/profile.png' />";
			    	//$usercoverImage = "<img src='temp/profile.png' />";

			    }else{

			    		$userProfileImage = "<img src='$profileImage' />";
			    		//$usercoverImage = "<img src='$coverImage' />";

			    }
			echo "<div class='profile-container box1'>


				<div class='image-container' style='width:300px;z-index:-10;border:4px solid #d62976;margin-top:20px'>
					$userProfileImage;


				</div>

				


			

		</div>

				<div class='image-container'>

			
					
				</div>
		

		<div class='profile-container box2' id='k'>

			
			<div class='edit-container' >
					<div class='follow-container' style='font-family: 'Montserrat', sans-serif;'>

						".make_post($conn,$userId)."
						<p class='follow'>Posts</p>
						
					</div>





					<div class='follow-container'>

						
							".make_followers($conn,$userId)."
						<p class='follow'>Followers</p>
					
					</div>


					<div class='follow-container'>

						
							".make_following($conn,$userId)."
						<p class='follow'>Following</p>
						
					</div>

					<div class='follow-container' style='padding-top:20px'>

						
						
					
					</div>

					<div class='follow-container' style='font-family: 'Montserrat', sans-serif;font-weight:bold'>

						
							".make_pro($conn,$userId)."
						<p class='follow' style='font-family: 'Open Sans', sans-serif;'></p>
					
					</div>
					
					<div style='padding-top:5px;'>
					
					</div>
				</div>	

		</div>
		<div class='profile-detail'>

			<p style='font-family: 'Open Sans', sans-serif;font-size:30px' class='fn'>$fullname</p>

			<p class='bo'>$bio</p>

			<p>$website</p>
			
		</div>";

		}

	}



	function make_followers($conn,$userId){

		$sql="SELECT count(*) As sum FROM `user_follow` WHERE `follow_id`='$userId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result==null){
			$output='<p><b>0</b></p>';
		}
		else{
			$output='<p><b>'.($row_result/2).'</b></p>';
		}

// followers changed by deviding 2
		return $output;

	}

	function make_pro($conn,$userId){

		$sql="SELECT count(*) As sum FROM `user_follow` WHERE `follow_id`='$userId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result<null){
			$output='<p><b></b></p>';
		}
		else{
			if($row_result>4)
			{
				$output='<p><i class="fas fa-crown" style="color:#FFD700;font-size:30px"></i><br>Pro Member</p>';
			}
		}


		return $output;

	}




	function make_following($conn,$userId){

		$sql="SELECT count(*) As sum FROM `user_follow` WHERE `user_id`='$userId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result==null){
			$output='<p><b>0</b></p>';
		}
		else{
			$output='<p><b>'.($row_result/2).'</b></p>'; 
		}

		return $output;

	}



	function make_post($conn,$userId){

		$sql="SELECT count(*) As sum FROM `user_post` WHERE `user_id`='$userId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result==null){
			$output='<p><b>0</b></p>';
		}
		else{
			$output='<p><b>'.$row_result.'</b></p>';
		}

		return $output;

	}


	// function make_lk($conn,$userId){

	// 	$sql="SELECT count(*) As sum FROM `post_like` WHERE `user_id`='$userId'";

	// $result=mysqli_query($conn,$sql);


	// 	$row = mysqli_fetch_assoc($result);

	// 	$row_result =$row['sum'];

	// 	if($row_result==null){
	// 		$output='<p><b>0</b></p>';
	// 	}
	// 	else{
	// 		$output='<p><b>'.$row_result.'</b></p>';
	// 	}

	// 	return $output;

	// }

if(isset($_POST['action_user2'])){

	
	$userId = $_SESSION['user_id'];
	


	$sql="SELECT * FROM `user` WHERE `user_id`!='$userId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $fullname = $row['fullname'];

			  $followId = $row['user_id'];


			    $profileImage = $row['user_image'];


			    if($profileImage==null)
			    {

			    	$userProfileImage = "<img src='temp/profile.jpeg' />";

			    }else{

			    		$userProfileImage = "<img src='$profileImage' />";
			    }

			 echo "<div class='following-main-container'>
				
				<div class='following-image-container'>
				
					$userProfileImage;
				</div>
		
			</div>

			<div class='following-main-container' style='font-size:11px;font-family: 'Nunito Sans', sans-serif;'>
				
				
				
				<p>$fullname</p>


			</div>

			<div class='following-main-container'>
				
				<div class='following-like-container'>
				
					

					".make_follow($conn,$userId, $followId)."
				</div>
			</div>";
			}
		}

		function make_follow($conn,$userId, $followId){

			$sql="SELECT * FROM `user_follow` WHERE `user_id` ='$userId' AND  `follow_id` ='$followId'";

			$result=mysqli_query($conn,$sql);



			if($row = mysqli_num_rows($result)>0)
			{
				$output = '<button style="background-color:white;color:black;border:1px solid #ccc;border-radius:20px;" class="follow_button" data-action="following" data-user_id="'.$userId.'" data-user_follow = "'.$followId.'">Following</button>';
			}
			else{

				$output = '<button style="background-color:#00acee;border-radius:20px;" class="follow_button" data-action="follow" data-user_id="'.$userId.'" data-user_follow = "'.$followId.'">Follow</button>';
			}
			return $output;

		}

		if($_POST['action_follow']=='follow'){

	
			$userId = $_POST['user_id'];
			$followId = $_POST['follow_id'];

			$query="INSERT INTO `user_follow`(`user_id`,`follow_id`)VALUES('$userId','$followId')";

			$query_result=mysqli_query($conn,$query);

			if($query_result)
			{
				
			}

}

		
		if($_POST['action_follow']=='following'){

	
			$userId = $_POST['user_id'];
			$followId = $_POST['follow_id'];

			$query="DELETE FROM `user_follow` WHERE `user_id` ='$userId' AND `follow_id`='$followId'";

			$query_result=mysqli_query($conn,$query);

			if($query_result)
			{
			
			}

}




if(isset($_POST['action_post'])){

	
	$userId = $_SESSION['user_id'];



	$sql="SELECT * FROM `user_post` INNER JOIN `user` ON user_post.user_id= user.user_id WHERE user_post.user_id='$userId' ORDER BY `post_id` DESC ";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $caption = $row['caption'];
			  $username = $row['username'];
			   $userImage = $row['user_image'];
			  $date = $row['date'];
			 
			 $postUrl = $row['post_url'];

			 $postId = $row['post_id'];
			    if($postUrl==null)
			    {

			    	$post_url = "<img src='temp/post_image.jpg'/>";

			    }else{

			    		$post_url = "<img src='$postUrl' />";
			    } 


			    if($userImage==null)
			    {

			    	$user_image = "<img src='temp/profile.jpeg' />";

			    }else{

			    		$user_image = "<img src='$userImage' />";
			    } 

			    echo "<div class='menu-main-container'>
				
				<ul>
			<li class='menu-image-icon'><a>$user_image</a></li>
			<li class='menu-name-icon'><a>$username</a></li>
			<li class='menu-menu-icon'><a><i class='fas fa-ellipsis-v'></i></a></li>
				</ul>

			</div>

			<div class='main-post-container'>
				
			$post_url;

			</div>

			<div class='comment-icon-container'>
				
				<ul style='margin-top:30px'>
		
			
			<li class='comment-menu-icon'><a><i class='far fa-comment'></i></a></li>
			<li class='comment-menu-icon'><a><i class='far fa-share-square'></i></a></li>
			<li class='comment-menu-icon'><a><i class='fas fa-pen-alt'></i></a></li>

			<li class='save-menu-icon'><a href='delete_post.php?post_id=$post_id'><i class='fas fa-trash-alt' style='color:#F77436'></i></a></li>
				</ul>

			</div>

			<div class='post-detail-container'>
				
			".make_posts($conn,$postId)."

			<p>$caption</p>
			<p style='color:#aaa;'>View all 0 comments</p>
			
			".make_date($conn,$postId).";

			</div>";

		}

	}

include("delete_post.php");

function make_posts($conn,$postId){

		$sql="SELECT count(*) As sum FROM `post_like` WHERE `post_id`='$postId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result==null){
			$output='<p><b>0 votes</b></p>';
		}
		else{
			$output='<p><b>'.$row_result.' votes</b></p>';
		}

		return $output;

	}


function make_delete($conn,$postId){

		$sql="DELETE  FROM `user_post` WHERE `post_id`='$postId'";

	$result=mysqli_query($conn,$sql);


		// $row = mysqli_fetch_assoc($result);

		// $row_result =$row['sum'];

		if($result){
			echo "<script>alert('post deleted')</script>";
		echo "<script>window.open('instagram.php','_self')</script>";
		}
		

		return $output;

	}

function make_date($conn,$postId){

		$sql="SELECT *  FROM `user_post` WHERE `post_id`='$postId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

		$date =$row['date'];

		
			$output='<p style="color:#aaa;">'.make_time($date).'</p>';
		}

		return $output;

	}
		function make_time($time_ago){

			$time_ago = strtotime($time_ago);

			$cur_time = time();

			$time_elapsed = $cur_time - $time_ago;

			$seconds = $time_elapsed;

			$minutes = round($time_elapsed/60);

			$hours = round($time_elapsed/3600);

			$days = round($time_elapsed/86400);

			$weeks = round($time_elapsed/604800);

			$months = round($time_elapsed/2600640);

			$years = round($time_elapsed/31207680);

			if($seconds <= 60){

				return "Just Now";
			}
			else if($minutes<=60){

				if($minutes==1){

					return "a minute ago";

				}else{

					return "$minutes minutes ago";

				}

			}

			else if($hours<=24){

				if($hours==1){

					return "an hour ago";

				}else{

					return "$hours hours ago";

				}

			} 

			else if($days<=7){

				if($days==1){

					return "Yesterday";

				}else{

					return "$days days ago";

				}

			}
			else if($weeks<=4.3){

				if($weeks==1){

					return "a week ago";

				}else{

					return "$weeks weeks ago";

				}

			}

			else if($months<=12){

				if($months==1){

					return "a month ago";

				}else{

					return "$months months ago";

				}

			}
			else{

				if($years==1){

					return "one year ago";

				}else{

					return "$years years ago";

				}

			}



		}





if(isset($_POST['action_grid_post'])){

	
	
	$userId = $_SESSION['user_id'];


	$sql="SELECT * FROM `user_post`  WHERE `user_id`='$userId' ORDER BY `post_id` DESC ";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 
			 $postUrl = $row['post_url'];

			
			    if($postUrl==null)
			    {

			    	$post_url = "<img src='temp/post_image.jpg'/>";

			    }else{

			    		$post_url = "<a href='#profile-grid' class='grid_button' data-action='grid' data-post_id = '$postId'><img src='$postUrl' /></a>";
			    } 

			    echo "<div class='grid-post-container'>

					$post_url
					
				</div>";

				

			}

		}


// post save menu 

if(isset($_POST['action_save_post'])){

	
	
	$userId = $_SESSION['user_id'];


	$sql="SELECT * FROM `user_post`  WHERE `user_id`='$userId' ORDER BY `post_id` DESC ";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 
			 $postUrl = $row['post_url'];

			
			    if($postUrl==null)
			    {

			    	$post_url = "<img src='temp/post_image.jpg'/>";

			    }else{

			    		$post_url = "<a href='#profile-grid' class='grid_button' data-action='grid' data-post_id = '$postId'><img src='$postUrl' /></a>";
			    } 

			    echo "<div class='grid-post-container'>

					$post_url
					
				</div>";

				

			}

		}


		// grid single post container




if($_POST['action_grid_single_post']=='grid'){

	
	$postId = $_POST['post_id'];



	$sql="SELECT * FROM `user_post` INNER JOIN `user` ON user_post.user_id= user.user_id WHERE user_post.post_id='$postId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $caption = $row['caption'];
			  $username = $row['username'];
			   $userImage = $row['user_image'];
			  $date = $row['date'];
			 
			 $postUrl = $row['post_url'];

			 $postId = $row['post_id'];
			    if($postUrl==null)
			    {

			    	$post_url = "<img src='temp/post_image.jpg'/>";

			    }else{

			    		$post_url = "<img src='$postUrl' />";
			    } 


			    if($userImage==null)
			    {

			    	$user_image = "<img src='temp/profile.jpeg' />";

			    }else{

			    		$user_image = "<img src='$userImage' />";
			    } 

			    echo "<div class='menu-main-container'>
				
				<ul>
			<li class='menu-image-icon'><a>$user_image</a></li>
			<li class='menu-name-icon'><a>$username</a></li>
			<li class='menu-menu-icon'><a><i class='fas fa-ellipsis-v'></i></a></li>
				</ul>

			</div>

			<div class='main-post-container'>
				
			$post_url;

			</div>

			<div class='comment-icon-container'>
				
				<ul>
		
			<li class='comment-menu-icon'><a><i class='far fa-heart'></i></a></li>
			<li class='comment-menu-icon'><a><i class='far fa-comment'></i></a></li>
			<li class='comment-menu-icon'><a><i class='far fa-share-square'></i></a></li>
			<li class='save-menu-icon'><a><i class='far fa-bookmark'></i></a></li>
				</ul>

			</div>

			<div class='post-detail-container'>
				
			".make_grid_posts($conn,$postId)."

			<p>$caption</p>
			<p style='color:#aaa;'>View all 0 comments</p>
			
			".make_grid_date($conn,$postId).";

			</div>";

		}
	}


function make_grid_posts($conn,$postId){

		$sql="SELECT count(*) As sum FROM `post_like` WHERE `post_id`='$postId'";

	$result=mysqli_query($conn,$sql);


		$row = mysqli_fetch_assoc($result);

		$row_result =$row['sum'];

		if($row_result==null){
			$output='<p><b>0 Likes</b></p>';
		}
		else{
			$output='<p><b>'.$row_result.' Likes</b></p>';
		}

		return $output;

	}



function make_grid_date($conn,$postId){

		$sql="SELECT *  FROM `user_post` WHERE `post_id`='$postId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

		$date =$row['date'];

		
			$output='<p style="color:#aaa;">'.make_grid_time($date).'</p>';
		}

		return $output;

	}
		function make_grid_time($time_ago){

			$time_ago = strtotime($time_ago);

			$cur_time = time();

			$time_elapsed = $cur_time - $time_ago;

			$seconds = $time_elapsed;

			$minutes = round($time_elapsed/60);

			$hours = round($time_elapsed/3600);

			$days = round($time_elapsed/86400);

			$weeks = round($time_elapsed/604800);

			$months = round($time_elapsed/2600640);

			$years = round($time_elapsed/31207680);

			if($seconds <= 60){

				return "Just Now";
			}
			else if($minutes<=60){

				if($minutes==1){

					return "a minute ago";

				}else{

					return "$minutes minutes ago";

				}

			}

			else if($hours<=24){

				if($hours==1){

					return "an hour ago";

				}else{

					return "$hours hours ago";

				}

			} 

			else if($days<=7){

				if($days==1){

					return "Yesterday";

				}else{

					return "$days days ago";

				}

			}
			else if($weeks<=4.3){

				if($weeks==1){

					return "a week ago";

				}else{

					return "$weeks weeks ago";

				}

			}

			else if($months<=12){

				if($months==1){

					return "a month ago";

				}else{

					return "$months months ago";

				}

			}
			else{

				if($years==1){

					return "one year ago";

				}else{

					return "$years years ago";

				}

			}



		}


?>


