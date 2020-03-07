<?php
$server="localhost";
$username="root";
$password="";
$db="akash";
$conn=mysqli_conncet($server,$username,$password,$db);
if($conn)
{
    echo "connection is creted";
}
else
{
    echo "connection not created";
}
?>