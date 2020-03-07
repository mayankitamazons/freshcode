<?php

require "../common/connect.php";
$response = array();
$message ="";

if (empty($_POST['otp']) || empty($_POST['action']) ) {
    echo json_encode(array('status' => 'error', 'message' => 'feilds are required'));
} else {

    if (!isset($_POST['otp']) || !isset($_POST['action']) ) {
        echo json_encode(array('status' => 'error', 'message' => 'feild name problem'));
    } else {


$otpsql = mysqli_query($con, "SELECT * FROM `purchase_otp`");

$otpData = mysqli_fetch_assoc($otpsql);
$otp = $otpData["otp"];

$otpFromMobile = $_POST["otp"];

$action = $_POST["action"];
$newOtp = rand(1000, 9999);

if($action=="get")
{
    if($otp==$otpFromMobile)
    {
                mysqli_query($con, "UPDATE `purchase_otp` SET `otp`='$newOtp' WHERE `otp` ='$otp' ");
                $message = $newOtp;
    }else
    {
               
                $message = 0;
    }
  
}
else {
    $message="update";
  
    mysqli_query($con, "UPDATE `purchase_otp` SET `otp`='$newOtp' WHERE `otp` ='$otp' ");
}


        echo json_encode(array("message" => $message));

    }
}

?>