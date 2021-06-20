<?php
include('connect.php');

if(isset($_GET['post_id'])){
	 $post_id = $_GET['post_id'];

	 $delete_post = "delete from user_post where post_id='$post_id'";

	 $run_delete = mysqli_query($conn, $delete_post);

	 if($run_delete){
	 	echo "<script>alert('A post have been deleted! ')</script>";
	 	echo "<script>window.open('instagram.php', '_self')</script>";
	 }
}

?>

