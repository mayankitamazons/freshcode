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

       $result= mysqli_query($con ,"SELECT client.c_code,client.c_mobile,client.c_name,wallet.activation_status FROM wallet INNER JOIN client ON wallet.c_code=client.c_code WHERE wallet.activation_status='pending'");

           while($data = mysqli_fetch_assoc($result))
    {
        
            $c_code=$data["c_code"];
            $c_mobile=$data["c_mobile"];
            $c_name =$data["c_name"];
            $activation_status =$data["activation_status"];
            array_push($response,array('status'=>'ok','c_code'=>$c_code,'c_mobile'=>$c_mobile,'c_name'=>$c_name,'activation_status'=>$activation_status));

}

echo json_encode($response);

}


if($action == "list")
{

       $result2= mysqli_query($con ,"SELECT client.c_code,client.c_mobile,client.c_name,wallet.activation_status FROM wallet INNER JOIN client ON wallet.c_code=client.c_code WHERE wallet.activation_status !='u_n_a'");
     
       while($data2 = mysqli_fetch_assoc($result2))
       {
           
        $activation_status =$data2["activation_status"];
        if($activation_status!="pending")
        {
            $c_code=$data2["c_code"];
            $c_mobile=$data2["c_mobile"];
            $c_name =$data2["c_name"];
            $activation_status =$data2["activation_status"];
            array_push($response,array('status'=>'ok','c_code'=>$c_code,'c_mobile'=>$c_mobile,'c_name'=>$c_name,'activation_status'=>$activation_status));


        }

              
   }

echo json_encode($response);

}

            if($action == "update")
            {
                $Credit_value = $_POST['value'];
                $expire_day = $_POST['expire_day'];
                $per_day = $_POST['per_day'];
                $c_code = $_POST['c_code'];

             //   echo "UPDATE `wallet` SET `activation_status`='active',`value`='$Credit_value',`expire_day`='$expire_day',`per_day`='$per_day' WHERE `c_code`='$c_code'";
                mysqli_query($con, "UPDATE `wallet` SET `activation_status`='active',`value`='$Credit_value',`expire_day`='$expire_day',`per_day`='$per_day' WHERE `c_code`='$c_code'");

                echo json_encode(array('status'=>'ok'));


            }

}
}
