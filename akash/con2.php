<?php
$server="localhost";
$username="root";
$password="";
$db="akash";
$conn=mysqli_connect($server,$username,$password,$db);
if($conn)
{
}
else
{
 echo "database not connected";
}
?>