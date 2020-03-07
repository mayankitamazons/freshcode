<?php
include('con2.php');
$number=$_REQUEST['phone'];
$pass=$_REQUEST['password'];
$sql="INSERT INTO password VALUES('$number','$pass')";
$data=mysqli_query($conn, $sql);
if($data)
{
  require('popfrom.php');
}
else
{
  echo "no";
}
?>