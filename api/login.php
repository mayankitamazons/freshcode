<?php
require "conn.php";
if( empty($_POST['mobile']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['mobile']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$get="0";
$mobile = $_POST['mobile'];

         //   ************************ Vendor Login*******************************

        $s2 = mysqli_query($con, "SELECT * FROM vendor WHERE v_mobile = '$mobile' ");
         $row2 = mysqli_num_rows($s2);
        if($row2>0)
        {
            $get="1";
            $data=mysqli_fetch_assoc($s2);

            $code=$data["v_code"];
            $v_mobile=$data["v_mobile"];
             $activation_status=$data["activation_status"];
             $vendor_type=$data["v_type"];


            if($vendor_type=="")
            {
              $vendor_type="0";
            }

             echo json_encode(array('status'=>'ok','v_code'=>$code,'v_mobile'=>$v_mobile, 'userType'=>"vendor",'userStatus'=>$activation_status,'vendor_type'=>$vendor_type));

         }




        else
        {

      //   ************************ Client Login *******************************


         $sl = mysqli_query($con, "SELECT * FROM client WHERE c_mobile = '$mobile' ");
        $row = mysqli_num_rows($sl);
        if($row>0 && $get=="0")
        {
             $data=mysqli_fetch_assoc($sl);
             $code=$data["c_code"];
             $c_mobile=$data["c_mobile"];
             $status=$data["user_activation_status"];
            $city = $data["c_city"];
             $address = $data["c_address"];


             if($address==null)
             {
                 $address="";
             }

                if ($city == null) {
                    $city = "";
                }

        echo json_encode(array('status'=>'ok','c_code'=>$code,'c_mobile'=>$c_mobile, 'city' => $city, 'address' => $address, 'userStatus'=>$status,'userType'=>"client"));
        }

        else
        {
           // echo json_encode(array('status'=>'alert', 'message'=> 'user not found'));
            $sql ="SELECT * FROM `client` ORDER BY c_code DESC";
            $result=mysqli_query($con,$sql);
            $data = mysqli_fetch_assoc($result);

            $a=$data["c_code"];
            $b=substr($a,1);
            if ($b=='')
            {
               $b=101;
            }
            else
            {
               $b=$b+1;
            }


             $code="C".$b;

             $status="0";
            mysqli_query($con, "INSERT INTO `client`(`c_code`,`c_mobile`,`user_activation_status`) VALUES ('$code','$mobile','0') ");
             mysqli_query($con, "INSERT INTO `wallet`(`c_code`,`activation_status` ) VALUES ('$code','u_n_a')");

              echo json_encode(array('status'=>'ok','c_code'=>$code,'c_mobile'=>$mobile,'userStatus'=>$status,'userType'=>"client"));


        }

            }
}
}
