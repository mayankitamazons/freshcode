<?php 
ob_start();
	session_start();
include("../common/connect.php");

 $username = $_POST['name'];
 $pass = $_POST['pass'];
$change =sha1($pass); 

 $query = mysqli_query($con,"SELECT * FROM `user` WHERE `user_name` = '$username' AND `pass` = '$change'");

if(mysqli_num_rows($query) > 0)
{
	$get = mysqli_fetch_assoc($query);
	
	 $_SESSION["bill_admin_id"] = $get['user_name'];
	  $_SESSION['last_time'] = time();
	$_SESSION['fail']=0;
   
	
	header("Location:../home.php");
}
else
{
	$_SESSION['fail']=1;
	header("Location:../index.php");
}
?>