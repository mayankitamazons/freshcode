<?php
include("../common/connect.php");

 mysqli_query($con,"TRUNCATE `rate_group`");
 foreach($_REQUEST['daily'] as $key => $value)
  {
    $product_code=$_REQUEST['code'][$key];
	  $daily=$_REQUEST['daily'][$key];
	   $weakly=$_REQUEST['weakly'][$key];
	    $monthly=$_REQUEST['monthly'][$key];
	     $group_1=$_REQUEST['group_1'][$key];
		  $group_2=$_REQUEST['group_2'][$key];
		   $group_3=$_REQUEST['group_3'][$key];
		  
		 
		    mysqli_query($con,"INSERT INTO `rate_group`(`product_code`, `daily`, `weakly`, `monthly`, `group_1`, `group_2`, `group_3`)
		    VALUES ('$product_code','$daily','$weakly','$monthly','$group_1','$group_2','$group_3')");
		  
		  // mysqli_query($con,"UPDATE `rate_group` SET `daily`='$daily',`weakly`=$weakly,`monthly`='$monthly',`group_1`='$group_1',`group_2`='$group_2',`group_3`='$group_3'
		  // WHERE `product_code` ='$product_code'");
		  
		  
	
			
  }  
  
echo"<script>window.open('../view-rate-group.php','_self')</script>";

?>