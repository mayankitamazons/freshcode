<?php
include("../common/connect.php");


//error_reporting(0);

if(isset($_POST["select"])){
	 $query = "SELECT * FROM fb_product ORDER BY id asc";
     $result = mysqli_query($con,$query);
     $user_arr = array();
	  while($row = mysqli_fetch_array($result)){
		  
	  $user_arr[] = array($id,$uname,$name,$gender,$email);
	    }
		 $serialize_user_arr = serialize($user_arr);
		 
		 
		 $filename = 'users.csv';
		$export_data = unserialize($serialize_user_arr);

// file creation
		$file = fopen($filename,"w");

foreach ($export_data as $line){
 fputcsv($file,$line);
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Type: application/csv; "); 

readfile($filename);

// deleting file
unlink($filename);
exit();
		 
}

 $query = mysqli_query($con,"SELECT * FROM `fb_product` ORDER BY `fb_product`.`sn` DESC");
	$data = mysqli_fetch_assoc($query);
	$last_id = $data['code'];
 if(isset($_POST["upload"])){
	
		
		$filename=$_FILES["file"]["tmp_name"];		

		 if($_FILES["file"]["size"] > 1)
		 {
		  	$i = 0;
			$file = fopen($filename, "r");
	        while (($filesop = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			 if($i>0) {

$code=$filesop[0];
$name = $filesop[1];
$hindi_name = $filesop[2];
$img=$filesop[3];;
$des = $filesop[4];
$quantity=$filesop[5];
$price=$filesop[6];
$unit = $filesop[7];
$product_status = $filesop[8];

$notify_for_quantity = $filesop[9];
$minimum_sale_quantity = $filesop[10];
$maximum_salw_quantity = $filesop[11];
$qty_increment = $filesop[12];
$instock ="00";



				

$a = substr($last_id,2,4);

if($a == '')
{
	$a = 1000;
	$b = $a+1;
	$f = "FB";
	$code = $f.$b;

	$sql = "INSERT INTO `fb_product`(`code`, `product_name`, `product_hindi_name`, `img`, `description`, `quantity`, `price`, `unit`, `product_status`, `notify_for_quantity_below`, `minimum_sale_quantity`, `maximum_sale_quantity`, `qty_increment`, `in_stock`) VALUES ('$code','$name','$hindi_name','$img','$des',$quantity,'$price','$unit','$product_status','$notify_for_quantity','$minimum_sale_quantity','$maximum_salw_quantity','$qty_increment','$instock')";
		 	 
    $result = mysqli_query($con,$sql);	
}
else{
		
		
		$back_code=$data['code'];
		if($code==''){
			
			$b = $a+1;
			$f = "FB";
			$code = $f.$b;
			$sql = "INSERT INTO `fb_product`(`code`, `product_name`, `product_hindi_name`, `img`, `description`, `quantity`, `price`, `unit`, `product_status`, `notify_for_quantity_below`, `minimum_sale_quantity`, `maximum_sale_quantity`, `qty_increment`, `in_stock`) VALUES ('$code','$name','$hindi_name','$img','$des',$quantity,'$price','$unit','$product_status','$notify_for_quantity','$minimum_sale_quantity','$maximum_salw_quantity','$qty_increment','$instock')";
		 
			$result = mysqli_query($con,$sql);	
			
		
			
		}else{
			$b = $a+1;
			$f = "FB";
			$code = $f.$b;
			
			$sql = "UPDATE `fb_product` SET `product_name`='$name',`product_hindi_name`='$name',`img`='$img',`description`='$des',
			 ,`quantity`='$quantity',`price`='$price',`unit`='$unit',`product_status`='$product_status',`notify_for_quantity_below`='$notify_for_quantity',`minimum_sale_quantity`='$minimum_sale_quantity',`maximum_sale_quantity`='$maximum_salw_quantity',
			 `qty_increment`='$qty_increment',`in_stock`='$instock' WHERE `code`='$code'";
		 
			$result = mysqli_query($con,$sql);
			
		}


		
	
	
}
	
			
	         }
			$i++;
		 }
		 	if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload Correct CSV File.\");
							window.location = \"../index.php\"
						  </script>";	 	
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						
					</script>";
					
				}
	         fclose($file);	
		 }
	}


?>