<?php
include("common/connect.php");



if(isset($_POST["query"])) 
{
	$output='';
	
	$query=mysqli_query($con,"SELECT price,product FROM product WHERE product LIKE '%".$_POST["query"]."%'");
	
	
	$output='<ul class="list-unstyled">';
	if(mysqli_num_rows($query) > 0)
	{
		While($row=mysqli_fetch_array($query))
		{
			$output .='<li>'.$row["product"].'</li>';
			
		}
		
	}
	else
	{
		$output .='<li>Product Not Found</li>';
	}
	$output .='</ul>';
	echo $output;
	
	
	
	
}
?>