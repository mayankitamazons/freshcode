<?php

require "conn.php";
 $response=array();
if( empty($_POST['action']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(!isset($_POST['action']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

 $action = $_POST['action'];

if($action == "get")
{
       $result= mysqli_query($con, "SELECT client.c_mobile, vendor_active_req.active_code FROM vendor_active_req INNER JOIN client ON vendor_active_req.c_code=client.c_code WHERE vendor_active_req.status='pending'");

           while($data = mysqli_fetch_assoc($result))
    {


        $c_mobile=$data["c_mobile"];
        $active_code=$data["active_code"];


           array_push($response,array('status'=>'ok','c_mobile'=>$c_mobile,'active_code'=>$active_code));


          //echo json_encode(array('status'=>'ok','c_mobile'=>$c_mobile,'active_code'=>$active_code));
}

echo json_encode($response);

}
}
}
