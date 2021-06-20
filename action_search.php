<?php

error_reporting(0);
include('connect.php');
session_start();
if(!isset($_SESSION['user_id'])){
	
	header('location:instagram_login.php');
}



if(isset($_POST['search'])){

	
	$userId = $_SESSION['user_id'];

	$search = $_POST['search'];

	$sql="SELECT * FROM `user` WHERE fullname LIKE '%$search%' AND `user_id`!='$userId'";

	$result=mysqli_query($conn,$sql);


		while($row = mysqli_fetch_assoc($result)){

			 $fullname = $row['fullname'];

			  $followId = $row['user_id'];
			  $bio =$row['bio'];

			    $profileImage = $row['user_image'];


			    if($profileImage==null)
			    {

			    	$userProfileImage = "<img src='temp/profile.png' />";

			    }else{

			    		$userProfileImage = "<img src='$profileImage' />";
			    }

			 echo "<div class='search-main-container'>

			<div class='search-image-container'>
				
				$userProfileImage
				
			</div>
			
		</div>

		<div class='search-main-container'>

			<p style='font-size:11px;text-align:left;'><a href='dismiss_this.php?u_id=$user_id'>$fullname</a></p>
			<p style='font-size:10px;text-align:left;border-bottom:1px solid #00acee;'>$bio</p>
		</div>

		<div class='search-main-container'>

			<div class='search-like-container' style='font-size:10px;text-align:right;cursor:pointer'>

				".make_follow($conn,$userId,$followId)."
				
			</div>
			
		</div>";
			}
		}

		function make_follow($conn,$userId, $followId){

			$sql="SELECT * FROM `user_follow` WHERE `user_id` ='$userId' AND  `follow_id` ='$followId'";

			$result=mysqli_query($conn,$sql);



			if($row = mysqli_num_rows($result)>0)
			{
				$output = '<button style="background-color:white;color:black;border:1px solid #ccc;" class="follow_button" data-action="following" data-user_id="'.$userId.'" data-user_follow = "'.$followId.'">Following</button>';
			}
			else{

				$output = '<button class="follow_button" data-action="follow" data-user_id="'.$userId.'" data-user_follow = "'.$followId.'">Follow</button>';
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


?>