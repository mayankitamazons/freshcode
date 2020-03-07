<?php
include("../common/connect.php");


  
	
	 $code=$_POST["code"];
	 $pname=$_POST['pname'];
	 $hindi_pname=$_POST['hpname'];
	//echo $img=$_FILES['myPhoto'];
     $de=$_POST["pdes"];
	 $qty=$_POST["qty"];
    $price=$_POST['price'];
    $unit=$_POST["unit"];
	$product_status=$_POST["pstatus"];
	$notify_for_quantity__POSTelow=$_POST["NotifyForQuantityBelow"];
	$minimum_sale_quantity=$_POST["MinimumSaleQuantity"];
	$maximum_sale_quantity=$_POST["MaximumSaleQuantity"];
	$qty_increment=$_POST["QtyIncremen"];
    $st=$_POST["InStock"];    
	 
    if(!$_FILES['myPhoto']['size'] == 0){
  // $imagename = $_FILES['myPhoto']['name'];
 $_POSTanner=$_FILES['myPhoto']['name']; 
 $exp_POSTanner=explode('.',$_POSTanner);
 $_POSTannerexptype=$exp_POSTanner[1];
 date_default_timezone_set('Asia/Kolkata');
 $date = date('m/d/Yh:i:sa', time());
 $rand=rand(10000,99999);
 $encname=$date.$rand;
 $_POSTannername=md5($encname).'.'.$_POSTannerexptype;
          $source = $_FILES['myPhoto']['tmp_name'];
          $target = "../vegImage/".$_POSTannername;
          move_uploaded_file($source, $target);

          $imagepath = $_POSTannername;
          $save = "../vegImage/" . $imagepath; //This is the new file you saving
          $file = "../vegImage/" . $imagepath; //This is the original file

          list($width, $height) = getimagesize($file); 

          $tn = imagecreatetruecolor($width, $height);

          //$image = imagecreatefromjpeg($file);
          $info = getimagesize($target);
          if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($file);
          }elseif ($info['mime'] == 'image/gif'){
            $image = imagecreatefromgif($file);
          }elseif ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($file);
          }

          imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
          imagejpeg($tn, $save, 50);

        

 
 
	
 
 
  $imgpath="vegImage/".$imagepath;
    $mobile_imgpath="https://freshbrigade.com/b2b/vegImage/".$imagepath;
  
 move_uploaded_file($_FILES["myPhoto"]["tmp_name"],$_POSTannerpath);
    
    
   

    
      

mysqli_query($con,"UPDATE `fb_product` SET `product_name`='$pname',`product_hindi_name`='$hindi_pname',`img`='$imgpath',`imagepath`='$mobile_imgpath',`description`='$de',
`quantity`='$qty',`price`='$price',`unit`='$unit',`product_status`='$product_status',`notify_for_quantity_below`='$notify_for_quantity__POSTelow',
`minimum_sale_quantity`='$minimum_sale_quantity',`maximum_sale_quantity`='$maximum_sale_quantity',
`qty_increment`='$qty_increment',`in_stock`='st' WHERE code='$code' ");  
   
	}
	else{
	
mysqli_query($con,"UPDATE `fb_product` SET `product_name`='$pname',`product_hindi_name`='$hindi_pname',`description`='$de',
`quantity`='$qty',`price`='$price',`unit`='$unit',`product_status`='$product_status',`notify_for_quantity_below`='$notify_for_quantity__POSTelow',
`minimum_sale_quantity`='$minimum_sale_quantity',`maximum_sale_quantity`='$maximum_sale_quantity',
`qty_increment`='$qty_increment',`in_stock`='st' WHERE code='$code' ");  
	}
  

header("Location:../viewproduct.php");     

      
?>