<?php
include("../common/connect.php");

$code= $_POST['code'];
$cname = $_POST['cname'];
$number=$_POST['number'];
$pincode=$_POST['pincode'];
$city=$_POST['ccity'];
$address=$_POST['address'];
$state=$_POST['cstate'];
$area=$_POST['area'];
$gst_no=$_POST['gst_no'];
        
       

mysqli_query($con,"UPDATE `customer` SET `gst_no`='$gst_no',`cust_name`='$cname',`mobile`='$number',`area`='$area',`address`='$address',
`city`='$city',`pincode`='$pincode',`state`='$state' WHERE `cust_id`='$code'");


header("Location:../view-customer.php");        

      
?>