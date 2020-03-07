<?php

$response=array();
$orderData=array();
require "conn.php";
if( empty($_POST['code']) ||   empty($_POST['userType']) ||   empty($_POST['fcm']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['code']) || !isset($_POST['userType']) || !isset($_POST['fcm'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$code = $_POST['code'];
$action =$_POST['userType'];
$fcm =$_POST['userType'];


if($action=="client")
{
 mysqli_query($con, "UPDATE `client` SET `fcm_id`='$fcmId' WHERE `c_code`='$code' ");

}

if($action=="vendor")
{
  mysqli_query($con, "UPDATE `vendor` SET `fcm_id`='$fcmId' WHERE `v_name`='$mobile' ");

}

    }
}


// echo json_encode($response);

?>
