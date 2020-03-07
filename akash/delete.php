<?php
include('conn.php');
$name=$_GET['n'];
$query="DELETE FROM users WHERE NAME='$name'";
$data=mysqli_query($conn, $query);
if($data)
{
	     $msg="record is deleted succesfully ";
	echo "<script type='text/javascript'>alert('$msg');</script>";
	require('displayuser.php');
}
else
{
	echo "sorry not deleted";
}
?>