<?php
 include("common/app_connect.php");
 //error_reporting(0); 
 if(isset($_POST["Import"])){
mysqli_query($con,"TRUNCATE TABLE fb_product ");	
 $count=0;

    $filename=$_FILES["file"]["tmp_name"];
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
    	fgetcsv($file, 10000, ",");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {


			    $query = mysqli_query($con,"SELECT * FROM `fb_product` ORDER BY `sn` DESC");
				$data = mysqli_fetch_assoc($query);
				 $last_id = $data['code'];

				$a = substr($last_id,2,4);
				$data_code=$getData[0];

	if($data_code == '')
	{
	    
	   
if ($a=='')
{
echo $b=1001;
}
else
{
echo $b=$a+1;
}
	  
	
		
		$f = "FB";
		 $code = $f.$b;

		

		 $sql = "INSERT INTO `fb_product`(`code`, `product_name`, `product_hindi_name`,`imagepath`,`img`,`description`, `quantity`, `price`, `unit`, `product_status`, 
		 `notify_for_quantity_below`, `minimum_sale_quantity`, `maximum_sale_quantity`, `qty_increment`, `in_stock`)
		VALUES ('$code','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."',
		'".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."','".$getData[13]."','".$getData[14]."')";




		$result = mysqli_query($con,$sql);
		
		 


	}
	else
	{
		
	
     	 $sql = "INSERT INTO `fb_product`(`code`, `product_name`, `product_hindi_name`,`imagepath`,`img`,`description`, `quantity`, `price`, `unit`, `product_status`, 
		 `notify_for_quantity_below`, `minimum_sale_quantity`, `maximum_sale_quantity`, `qty_increment`, `in_stock`)
		VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."',
		'".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."','".$getData[13]."','".$getData[14]."')";

		$result = mysqli_query($con,$sql);
		
		
		
	
	}
	  
	


//$result = mysqli_query($con,$sql);

 $count= $count+1;
	}



           }

   if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
        }

           //fclose($file);
     
  }



  if(isset($_POST["Export"])){
     
		
	header('Content-Type: text/csv; charset=utf-8');  
	header('Content-Disposition: attachment; filename=data.csv');  
	$output = fopen("php://output", "w");  
	fputcsv($output, array('Code', 'Product Name', 'Product Hindi Name','Image Path','Img','Description', 'Quantity','Price','Unit',
	'Product Status','Notify For Quantity Below','Minimum Sale Quantity','Maximum Sale Quantity','Qty Increment','In Stock'));  
	$query = " SELECT `code`, `product_name`, `product_hindi_name`,`imagepath`,`img`, `description`, `quantity`, `price`, `unit`, `product_status`, `notify_for_quantity_below`, 
	`minimum_sale_quantity`, `maximum_sale_quantity`, `qty_increment`, `in_stock` FROM `fb_product` ";  
	$result = mysqli_query($con, $query);  
	while($row = mysqli_fetch_assoc($result))  
	{  
		 fputcsv($output, $row);  
	}  
	fclose($output);  
}
