<?php 
	
include("../common/connect.php");
$c=$_GET['code'];
$query2= mysqli_query($con,"SELECT * FROM `fb_product` Where code= '$c' ");
error_reporting(0);
$b = mysqli_fetch_assoc($query2);
$st=$b['product_status'];

if($st==1)
{
	$s=0;
	
	mysqli_query($con,"UPDATE `fb_product` SET `product_status`='$s' WHERE code='$c'");
	header("location:../viewproduct.php");
}	
	else
	{
		$s=1;
		
		mysqli_query($con,"UPDATE `fb_product` SET `product_status`='$s' WHERE code='$c'");
		header("location:../viewproduct.php");
	}



?>