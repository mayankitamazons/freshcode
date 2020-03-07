<?php
include("../common/connect.php");



$query = mysqli_query($con,"SELECT * FROM `product` ORDER BY `product`.`product_code` DESC");
$data = mysqli_fetch_assoc($query);
error_reporting(0);

$a=$data["product_code"];
if ($a=='')
{
	$code=1001;
}
else
{
	$code=$a+1;
}
  
  $pname = $_POST['pname'];
 $qty = $_POST['pqty'];
$status=$_POST['pstatus'];
$des=$_POST['pdes'];
$price=$_POST['price'];
$gst=$_POST['pgst'];


$total=$qty*$price;
    
     date_default_timezone_set('Asia/Kolkata');
        $dataTime = date('y-m-d h:i:s A');
        
         mysqli_query($con,"INSERT INTO `product` (`product_code`, `product_name`, `product_description`, `price`, `gst`, `quantity`, `total_amount`, `status`, `last_update`) VALUES ('$code','$pname','$des','$price','$gst','$qty','$total','$status','$dataTime')");

    
     header("Location:../addproduct.php");
	  echo "<script type='text/javascript'>alert('hhhhhhhhh');</script>";
    
   

/*function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 300;
    $resizeHeight = 500;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}


if(is_array($_FILES)) {
        $fileName = $_FILES['pimage']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "../uploads/";
        $fileExt = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
               imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                  $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
      echo $i="uploads/thump_". $resizeFileName. ".". $fileExt;
}*/









      //echo  $imgContent = addslashes(file_get_contents( $uploadPath. $resizeFileName. ".". $fileExt));
        
      
?>