<?php


require "conn.php";
if( empty($_POST['c_code']) || empty($_POST['action']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if( !isset($_POST['c_code']) || !isset($_POST['action']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

$c_code = $_POST['c_code'];
$action = $_POST['action'];
$active_code = $_POST['active_code'];
$actiavation_code = rand(1000,9999);
$activation_status=0;
$city = $_POST['city'];
$name = $_POST['name'];
$v_code = $_POST['v_code'];
$v_type = $_POST['v_type'];


$sql ="SELECT * FROM `vendor` ORDER BY v_code DESC";
$result=mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($result);

$a=$data["v_code"];
$b=substr($a,1);
if ($b=='')
{
    $b=101;
}
else
{
    $b=$b+1;
}
 $new_code="V".$b;

            if($action =="get")
            {

                $result=mysqli_query($con, "SELECT * FROM `vendor_active_req` WHERE `c_code`='$c_code'");
                $data = mysqli_fetch_assoc($result);

                $status=$data["status"];

                if($status=="")
                {
                    $status="not";
                }

                if($status=="pending")
                {
                     echo json_encode(array('status'=>'ok','active_status'=>$status));
                }
                else
                {
                      echo json_encode(array('status'=>'ok','active_status'=>$status));

                }

            }
           else if($action == "code")
           {
                $find_code_result = mysqli_query($con,"SELECT * FROM `vendor_active_req` WHERE `c_code`='$c_code'");
                $data_code = mysqli_fetch_assoc($find_code_result);
                $act_code = $data_code["active_code"];
                $vv_code = $data_code["v_code"];

                 $find_client_data = mysqli_query($con,"SELECT * FROM `client` WHERE `c_code`='$c_code'");
                $data_client = mysqli_fetch_assoc($find_client_data);
                $client_activation_status = $data_client["user_activation_status"];
                  $client_mobile = $data_client["c_mobile"];
                   $fcm_id = $data_client["fcm_id"];


                if($act_code==$active_code)
                {


                          mysqli_query($con, "UPDATE `vendor_active_req` SET `status`='active'  WHERE `c_code`='$c_code'");
                          mysqli_query($con, "INSERT INTO `vendor`(`v_code`, `v_name`, `v_mobile`, `city`,`activation_status`,`fcm_id`) VALUES ('$vv_code','','$client_mobile',
                                            '','0','$fcm_id')");


                       echo json_encode(array('status'=>'ok','active_status'=>"active"));
                }
                else
                {
                   echo json_encode(array('status'=>'error','message'=>"activation invalid"));
                }



           }

        else if($action == "update")
        {
              $s2 = mysqli_query($con, "SELECT * FROM vendor WHERE v_code = '$v_code' ");
               $code=$data["v_code"];
             $v_mobile=$data["v_mobile"];
             $activation_status=$data["activation_status"];
             $vendor_type=$data["v_type"];


            if($vendor_type=="")
            {
              $vendor_type="0";
            }

            mysqli_query($con, "UPDATE `vendor` SET  `v_name`='$name',`city`='$city',`v_type`='$v_type',`activation_status`='1'  WHERE `v_code`='$v_code'");

            echo json_encode(array('status'=>'ok','v_code'=>$code,'v_mobile'=>$v_mobile, 'userType'=>"vendor",'userStatus'=>$activation_status,'vendor_type'=>$vendor_type));




        }


           else
            {


                    $find_wallet_result=mysqli_query($con, "SELECT * FROM `wallet` WHERE `c_code`='$c_code'");
                     $row = mysqli_num_rows($find_wallet_result);


                     if(!$row==0)
                    {
                      $wallet_data = mysqli_fetch_assoc($find_wallet_result);
                      $pending_amount=$wallet_data["pending_amount"];

                      if($pending_amount > 0)
                      {
                        echo json_encode(array('status'=>'error','meesage'=>'paid wallet amount first'));
                      }
                      else
                      {
                          mysqli_query($con, "INSERT INTO `vendor_active_req`(`v_code`, `c_code`, `status`, `active_code`) VALUES ('$new_code','$c_code','pending','$actiavation_code' )");
                          echo json_encode(array('status'=>'ok','active_status'=>'pending'));
                      }


                    }
                    else
                    {
                       mysqli_query($con, "INSERT INTO `vendor_active_req`(`v_code`, `c_code`, `status`, `active_code`) VALUES ('$new_code','$c_code','pending','$actiavation_code' )");
                       echo json_encode(array('status'=>'ok','active_status'=>'pending'));
                    }









            }




}
}
