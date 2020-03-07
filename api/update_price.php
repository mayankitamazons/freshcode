<?php


require "conn.php";
    if( empty($_POST['price_data']) || empty($_POST['v_code']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['price_data']) || !isset($_POST['v_code']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

$v_code = $_POST['v_code'];
$json_string = $_POST['price_data'];
$array_data = json_decode($json_string, TRUE);
$no=count($array_data)/2;

print_r($array_data);

for($k =0;$k < $no;$k++)
    {

  $product =$array_data['productCode'.$k];
  $today_price =$array_data['price'.$k];





        $sql = "SELECT * FROM `price_list` WHERE `v_code`='$v_code' && `product_code`='$product' ORDER BY `price_list`.`sn` DESC";
         $result=mysqli_query($con,$sql);
         $data = mysqli_fetch_assoc($result);
        $last_price = $data["today_price"];

           if($last_price == null && $last_price =='0')
        {
            mysqli_query($con,"INSERT INTO `price_list`(`v_code`, `product_code`, `today_price`, `yesterday_price`) VALUES
            ('$v_code','$product','$today_price','$today_price')");

        } else
        {
            mysqli_query($con,"INSERT INTO `price_list`(`v_code`, `product_code`, `today_price`, `yesterday_price`) VALUES
            ('$v_code','$product','$today_price','$last_price')");

        }



           $sql2 = "SELECT * FROM `today_price_list` WHERE `v_code`='$v_code' && `product_code`='$product' ORDER BY `today_price_list`.`sn` DESC";
         $result2=mysqli_query($con,$sql2);
         $data = mysqli_fetch_assoc($result2);
           $row = mysqli_num_rows($result2);
        $last_price = $data["today_price"];

           if($row==0)
        {
            mysqli_query($con,"INSERT INTO `today_price_list`(`v_code`, `product_code`, `today_price`, `yesterday_price`) VALUES
            ('$v_code','$product','$today_price','$today_price')");

        } else
        {
            mysqli_query($con,"UPDATE `today_price_list` SET `today_price`='$today_price',
            `yesterday_price`='$last_price' WHERE  `v_code`='$v_code' && `product_code`='$product'");

        }


    }







    }



 echo json_encode(array('status'=>'ok', 'message'=> 'price updated'));

    }


?>

