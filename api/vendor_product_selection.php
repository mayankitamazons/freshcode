<?php


require "conn.php";
if( empty($_POST['v_code']) ||  empty($_POST['prodcutcode']) ||  empty($_POST['action']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['v_code']) || !isset($_POST['prodcutcode'])  || !isset($_POST['action']) )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$c_code = $_POST['v_code'];
$product =$_POST['prodcutcode'];
$action =$_POST['action'];

if($action=='add')
    {
         $sql="SELECT * FROM `vendor_product_selection` WHERE `v_code`='$c_code' && `product_code`='$product'";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

           if($row==0)
        {
            mysqli_query($con,"INSERT INTO `vendor_product_selection`(`v_code`, `product_code`)VALUES ('$c_code','$product')");
             echo json_encode(array('status'=>'ok', 'message'=> 'Product add to kart succese'));
        } else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'product already add'));
        }
    }
    else
	{
		$sql="DELETE FROM `vendor_product_selection` WHERE v_code='$c_code' && 	product_code='$product'";
         $result=mysqli_query($con,$sql);

             $sql="DELETE FROM `today_price_list` WHERE v_code='$c_code' && 	product_code='$product'";
                $result=mysqli_query($con,$sql);


           if($result==true)
        {

             echo json_encode(array('status'=>'ok', 'message'=> 'Product remove from kart '));
        } else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'product already remove'));
        }

	}





    }
}

?>

