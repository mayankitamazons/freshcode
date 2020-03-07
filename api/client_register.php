<?php


require "conn.php";
if( empty($_POST['code']) )
  
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['code'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

$c_name = $_POST['c_name'];
$c_address = $_POST['c_address'];
$c_city = $_POST['c_city'];
$code=$_POST['code'];
$action=$_POST['action'];
        $business_type = $_POST['business_type'];
        $dec = $_POST['dec'];
        $shopImage = $_POST['shopImage'];
        $idImage = $_POST['idImage'];
        $reffralCode = $_POST['reffralCode'];

$c_mobile=$_POST['c_mobile'];



        date_default_timezone_set('Asia/Kolkata');
        $dataTime = date('y-m-d h:i:s A');
        $year = date("Y");
        $idImageName = "id" . $year . $dataTime;
        $shopImageName = "Shop" . $year . $dataTime;
       
        $idpath = "img/$idImageName.png";
        $shoppath = "img/$shopImageName.png";
        
       file_put_contents($shoppath, base64_decode($shopImage));
       file_put_contents($idpath, base64_decode($idImage));
		
		


if($action =="update")
        {


 $insert =  mysqli_query($con, "UPDATE `client` SET `c_name`='$c_name',
 `c_mobile`='$c_mobile',`c_address`='$c_address',`c_city`='$c_city',`business_type`='$business_type',
 `descrption`='$dec',`shopImage`='$shoppath',`id_documern`='$idpath',
 `refferalCode`='$reffralCode',`user_activation_status`='1' WHERE  `c_code` ='$code'");
            if($insert == true)
            {

                 echo json_encode(array('status'=>'ok','c_code'=>$code,'c_mobile'=>$c_mobile, 'city' => $c_city, 'address' => $c_address, 'user_activation_status'=>"1",'userType'=>"client"));

           // echo json_encode(array('status'=>'ok','message'=>"Profile Updated"));


            }
            else
            {
                echo json_encode(array('status'=>'error','message'=>"Profile Updated failed"));

            }
}


if($action =="get")
     {

         $result=mysqli_query($con, "SELECT * FROM `client` WHERE `c_code`='$code'");

          $data = mysqli_fetch_assoc($result);
           $name = $data['c_name'];
            $address = $data['c_address'];
            $city = $data['c_city'];

            echo json_encode(array('status'=>'ok','c_name'=>$name,'c_address'=>$address,'c_city'=>$city));


    }


    }
}
