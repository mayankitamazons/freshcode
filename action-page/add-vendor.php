<?php
include("../common/connect.php");
$query = mysqli_query($con,"SELECT * FROM `vendor` ORDER BY `sn` DESC");
$data = mysqli_fetch_assoc($query);
error_reporting(0);

$a=$data["vcode"];
 $b=substr($a,4);
if ($b=='')
{
	 $b=1001;
}
else
{
	 $b=$b+1;
}
$code="VEND".$b;
$cname = $_POST['cname'];
$number=$_POST['cnumber'];
$pincode=$_POST['pincode'];
$city=$_POST['ccity'];
$address=$_POST['address'];
$state=$_POST['cstate'];
$area=$_POST['area'];


$sql="SELECT * FROM `vendor` WHERE `mobile`= = '$number' ";	

$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_assoc($result);

	echo "<script type=\"text/javascript\">
             alert(\"User alreay registred with this mobile number.\");
              window.location = \"../new-add-customer.php\"
             </script>";    
} else
{      
          
    echo  mysqli_query($con,"INSERT INTO `vendor`(`vcode`, `name`, `mobile`, `state`, `city`, `area`, `pincode`, `address`) 
        VALUES ('$code','$cname','$number','$state','$city','$area','$pincode','$address')");
           
        

echo "<script type=\"text/javascript\">
             alert(\"New Vendor Added.\");
              window.location = \"../view-vendor.php\"
             </script>";    

//header("Location:../view-customer.php");
}








?>