<?php 
ob_start();
	session_start();
include("../common/connect.php");

 $username = $_POST['user'];
 $pass = $_POST['password'];
$email = $_POST['email'];
$change =sha1($pass);   

 mysqli_query($con,"insert into user(`user_name`,`pass`,`email_id`) values('$username','$change','$email')");
// "insert into(`user_name`,`pass`,`email_id`) value(`$username`,`$change`,`$email`)";

	header("Location:../index.php"); 

?>