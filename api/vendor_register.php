<?php


require "conn.php";
if( empty($_POST['v_name']) || empty($_POST['v_mobile'])|| empty($_POST['v_city']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if( !isset($_POST['v_name']) || !isset($_POST['v_mobile']) || !isset($_POST['v_city']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

$v_name = $_POST['v_name'];
$v_mobile = $_POST['v_mobile'];
$v_city = $_POST['v_city'];

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


 $code="V".$b;
$actiavation_code = rand(1000,9999);
$activation_status=0;



        $sl = mysqli_query($con, "SELECT * FROM vendor WHERE v_mobile = '$v_mobile' ");
        $row = mysqli_num_rows($sl);
        if($row<1)
        {

            $insert = mysqli_query($con, "INSERT INTO `vendor`(`v_code`, `v_name`, `v_mobile`, `city`, `activation_code`, `activation_status`)
            VALUES ('$code', '$v_name', '$v_mobile', '$v_city','$actiavation_code','$activation_status') ");
            if($insert == true)
            {

                echo json_encode(array('status'=>'ok','v_code'=>$code, 'v_name'=>$v_name, 'v_mobile'=>$v_mobile, 'v_city'=>$v_city, 'userType'=>"vendor"
                , 'activation_code'=>$actiavation_code, 'activation_status'=>$activation_status));
            }
            else
            {
                echo json_encode(array('status'=>'error', 'message'=>'query problem'));
            }
        }
        else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'user already register'));
    	}
	}
}
?>

