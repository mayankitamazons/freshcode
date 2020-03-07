<?php

include("common/connect.php");

	$sugg_json = array();    // this is for displaying json data as a autosearch suggestion
	

if(isset($_POST["query"])) 
{
	//$output='';
	
	$queryy=mysqli_query($con,"SELECT * FROM product WHERE `product_code` LIKE '%".$_POST["query"]."%'");
	
	
	
$row=mysqli_fetch_assoc($queryy);
		// <script > alert($row['quantity']); </script > 
		//echo $row['quantity'];
		
		 $price=$row["quantity"];
		//$pric=$row["price"];
		    
		
	echo $price;
		
	
}


if(isset($_POST["productid"])) 
{
	//$output='';
	
	$queryy=mysqli_query($con,"SELECT * FROM product WHERE `product_code` LIKE '%".$_POST["productid"]."%'");
	
	
	
$row=mysqli_fetch_assoc($queryy);
		// <script > alert($row['quantity']); </script > 
		//echo $row['quantity'];
		
		 $pname=$row["product_name"];
		
		    
		
	echo $pname;
		
	
}


if(isset($_POST["statee"])) 
{
	$output=$_POST["statee"];
	
	$queryy=mysqli_query($con,"SELECT * FROM `geo_locations` WHERE `parent_id` ='$output'");
	
	
	
	while($var=mysqli_fetch_array($queryy))
{
	//echo 	$stat=$var["name"];
	 
	 echo "<option value=$var[id]>$var[name]</option>";
	
}
	
//$row=mysqli_fetch_assoc($queryy);
		// <script > alert($row['quantity']); </script > 
		//echo $row['quantity'];
		
		// $stat=$row["name"];
		
		    
		
	echo $stat;
		
	
}




if(isset($_POST["cust_id"])) 
{
	$output=$_POST["cust_id"];
	
	$queryy=mysqli_query($con,"SELECT * FROM `customer` WHERE`cust_id`='$output'");
	$data = mysqli_fetch_assoc($queryy);
	$rate_group = $data['rate_group'];
	
	$product_data=mysqli_query($con,"SELECT * FROM `rate_group`");
	
	while($var=mysqli_fetch_array($queryy))
{
	//echo 	$stat=$var["name"];


	$price = $var[$rate_group];
	$product_code = $var['product_code'];
	$p_name = $var['p_name'];
	 
	  "<option value=$product_code>$p_name</option>";
	
}
	

		
		    
		
	echo "jkjhkjk";
		
	
}

?>