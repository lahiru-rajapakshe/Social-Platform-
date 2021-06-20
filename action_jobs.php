<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">



<?php

 error_reporting(0);
include('connect.php');
session_start();
if(!isset($_SESSION['user_id'])){
	
	header('location:instagram_login.php');
}
	

if(isset($_POST['action'])){

	
	$userId = $_SESSION['user_id'];



	$sql="SELECT * FROM `job_post` INNER JOIN `user` ON job_post.user_id= user.user_id LEFT JOIN `user_follow` ON job_post.user_id=user_follow.follow_id  WHERE job_post.user_id='$userId' OR user_follow.user_id = '$userId' GROUP BY job_post.post_id ORDER BY `post_id` DESC ";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $caption = $row['caption'];
			  $username = $row['username'];
			   $userImage = $row['user_image'];
			  $date = $row['date'];
			 
			 $postUrl = $row['post_url'];

			 $postId =$row['post_id'];
			    if($postUrl==null)
			    {

			    	$post_url = "<img src='temp/post_image.jpg'/>";

			    }else{

			    		$post_url = "<img src='$postUrl' />";
			    } 


			    if($userImage==null)
			    {

			    	$user_image = "<img src='temp/profile.png' />";

			    }else{

			    		$user_image = "<img src='$userImage' />";
			    } 

			    echo "<div class='menu-main-container' style='border:1px solid #00acee ;border-bottom:none;
		
		border:none;
		background-clip: padding-box;
		box-shadow: 1px 5px 10px rgba(45,55,68,0.30);
		background-color: transparent;border-top: 1px solid #D0D4D5;
		z-index:-5;
		
		'>
						

			
				<ul>
			<li class='menu-image-icon'><a>$user_image</a></li>


			<li class='menu-name-icon'><a href='#user_profile' class='user_button' data-post_id = '$postId'>$username</a></li>


			<li class='menu-menu-icon'><a href='profilesec.php'><i class='fas fa-chevron-circle-down' style='color:#C6C3C1;padding-top:10px'></i></a></li>
				</ul>

			</div>

			<div class='main-post-container' style='border:1px solid #00acee;border-top:none;border-bottom:none;border:none;
		background-clip: padding-box;
		box-shadow: 1px 5px 10px rgba(45,55,68,0.30);
		background-color: transparent;border-top: 1px solid #D0D4D5;
		z-index:-5;'>
				
			$post_url;

			</div>

			<div class='comment-icon-container' style='border:1px solid #00acee;border-radius:2px;border:none;
		background-clip: padding-box;
		box-shadow: 1px 5px 10px rgba(45,55,68,0.30);
		background-color: transparent;border-top: 1px solid #D0D4D5;
		z-index:-5;'>
				
				<ul>
		
			".make_like($conn,$userId, $postId)."
			<li class='comment-menu-icon'><a href='#comment' class='comment_button' data-user_image='$userImage' data-post_id = '$postId'><button style='font-size:10px;width:100px;border-radius:1px;border:none;margin-bottom:15px;cursor:pointer'>Apply for this Job </button></a></li>
			

			
				</ul>

			</div>

			<div class='post-detail-container' style='font-size:11.6px;'>
				
			".make_posts($conn,$postId)."
			<p style='font-family: 'Noto Sans JP', sans-serif;'>$caption</p>
			<p style='color:#aaa;'></p>
			
			".make_date($conn,$postId)."

			</div>";

		}
	}




		function make_like($conn,$userId, $postId){

			$sql="SELECT * FROM `post_like` WHERE `user_id` ='$userId' AND  `post_id` ='$postId'";

			$result=mysqli_query($conn,$sql);



			if($row = mysqli_num_rows($result)>0)
			{
				$output = '<li class="comment-menu-icon"><a class="like_button" data-action="unlike" data-user_id="'.$userId.'" data-post_id = "'.$postId.'" style="color:#00acee;margin-top:12px"><i class="fas fa-thumbs-up"></i></a></li>';

			}

			else{

				$output = '<li class="comment-menu-icon"><a class="like_button" data-action="like" data-user_id="'.$userId.'" data-post_id = "'.$postId.'" style="color:gray;margin-top:12px"><i class="fas fa-thumbs-up"></i></a></li>';
			}
			return $output;

		}

		if($_POST['action_like']=='like'){

	
			$userId = $_POST['user_id'];
			$postId = $_POST['post_id'];

			$query="INSERT INTO `post_like`(`user_id`,`post_id`)VALUES('$userId','$postId')";

			$query_result=mysqli_query($conn,$query);

			if($query_result)
			{
				
			}

}



		
		if($_POST['action_like']=='unlike'){

	
			$userId = $_POST['user_id'];
			$postId = $_POST['post_id'];

			$query="DELETE FROM `post_like` WHERE `user_id` ='$userId' AND `post_id`='$postId'";

			$query_result=mysqli_query($conn,$query);

			if($query_result)
			{
			
			}

}



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



function make_date($conn,$postId){

		$sql="SELECT *  FROM `job_post` WHERE `post_id`='$postId'";

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

		if($_POST['action']=='comment'){
			$userId= $_POST['user_id'];

			$postId = $_POST['post_id'];

			$postComment = $_POST['post_comment'];

			$query="INSERT INTO `post_comment`(`user_id`, `post_id`, `post_comments`) VALUES ('$userId','$postId','$postComment')";

			$query_result=mysqli_query($conn,$query);

			if($query_result)
			{
				
			}
		}

?>