<?php
include('con2.php');
error_reporting(0);
$name=$_REQUEST['name'];
$number=$_REQUEST['number'];
$adhar=$_REQUEST['adhar'];
$password=$_REQUEST['password'];
$sql="INSERT INTO freshdata VALUES('$name','$number','$adhar','$password')";
$data=mysqli_query($conn, $sql);
if($data)
{
  $msg="we will send you a password on your mail in 2 working hours!thank you ";
	echo "<script type='text/javascript'>alert('$msg');</script>";
	require('passwordsetup.html');
}
else
{
  echo "database is not connnected";
}
?>