<?php
include("../common/connect.php");
$query = mysqli_query($con,"SELECT * FROM `customer` ORDER BY `customer`.`cust_id` DESC");
$data = mysqli_fetch_assoc($query);
error_reporting(0);

$a=$data["cust_id"];
 $b=substr($a,4);
if ($b=='')
{
	 $b=1001;
}
else
{
	 $b=$b+1;
}
$code="CUST".$b;
$cname = $_POST['cname'];
$gst_no = $_POST['gst_no'];
$number=$_POST['cnumber'];
$pincode=$_POST['pincode'];
$city=$_POST['ccity'];
$address=$_POST['address'];
$state=$_POST['cstate'];
$area=$_POST['area'];


$sql="SELECT * FROM `customer` WHERE `mobile` = '$number' ";	

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

  
        
          
        mysqli_query($con,"INSERT INTO `customer`(`gst_no`,`cust_id`, `cust_name`, `mobile`, `rate_group`, `area`, `address`, `city`, `pincode`, `state`) VALUES ( 
           '$gst_no','$code','$cname','$number','daily','$area','$address','$city','$pincode','$state')");
           
        

echo "<script type=\"text/javascript\">
             alert(\"New Customer Added.\");
              window.location = \"../add-customer.php\"
             </script>";    

//header("Location:../view-customer.php");
}








?>