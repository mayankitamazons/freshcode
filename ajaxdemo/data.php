<?php
include("../common/connect.php");

	$output=$_POST["cust_id"];
	
	$queryy=mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` ='$output'");
	$data = mysqli_fetch_array($queryy);
	
	echo $rate_group = $data['rate_group'];
	
	
	 
	 $product_data=mysqli_query($con,"SELECT * FROM `rate_group`");
	//$product_data=mysqli_query($con,"SELECT * FROM `customer` ");
	
	while($var=mysqli_fetch_array($product_data))
{
	//echo 	$stat=$var["name"];


	$price = $var[$rate_group];
	$product_code = $var['product_code'];
	$p_name = $var['p_name'];
	 
	 echo "<option  price=$price value=$product_code>$p_name</option>";
}

	

		
		    
	




		
	


?>