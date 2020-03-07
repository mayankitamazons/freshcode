<?php

include("common/app_connect.php");




if(isset($_POST["status"]))
{


    

 
	$status=$_POST["status"];
	$order_id=$_POST["order_id"];

	mysqli_query($con,"UPDATE `client_order` SET `order_status`='$status' WHERE `order_id`='$order_id'");

	

}


?>