<?php 
include("../common/connect.php");

$query = mysqli_query($con,"SELECT image FROM `product` WHERE `sn` = '5' ");


//$result = $db->query("SELECT image FROM images WHERE id = {$_GET['id']}");
    
   
        
        
        if(mysqli_num_rows($query) > 0)
{
	$get = mysqli_fetch_assoc($query);
             header("Content-type: image/jpg"); 
	echo $get['image'];
	
}

        
        
        
        ?>