<?php


require "conn.php";
if( empty($_POST['c_code']) ||  empty($_POST['v_code'])  ||  empty($_POST['product_code']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['c_code']) || !isset($_POST['v_code'])  || !isset($_POST['product_code']) )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$c_code = $_POST['c_code'];
$v_code =$_POST['v_code'];
$action =$_POST['action'];
$product_code =$_POST['product_code'];


        $sql="SELECT * FROM `client_vendor_selection` WHERE `c_code`='$c_code' && `product_code`='$product_code'";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

           if($row==0)
        {
            mysqli_query($con,"INSERT INTO `client_vendor_selection`(`c_code`, `v_code`,`product_code`)VALUES ('$c_code','$v_code','$product_code')");
             echo json_encode(array('status'=>'ok', 'message'=> 'vendor added  succese'));
        } else
        {

             mysqli_query($con,"UPDATE `client_vendor_selection` SET `v_code`='$v_code' WHERE `c_code`='$c_code' && `product_code`='$product_code'");

            echo json_encode(array('status'=>'alert', 'message'=> 'vendor already add '));
        }







    }
}

?>

