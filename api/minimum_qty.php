<?php


$vendore=array();
require "conn.php";


$v_code = $_POST['v_code'];
$json_string = $_POST['min_qty'];
$array_data = json_decode($json_string, TRUE);
$no=count($array_data)/2;
print_r($array_data);

for($k =0;$k < $no;$k++)
    {
      $productCode =$array_data['productCode'.$k];
      $qty =$array_data['qty'.$k];


      echo mysqli_query($con,"UPDATE `vendor_product_selection` SET `min_qty`='$qty' WHERE `product_code`='$productCode' AND `v_code`='$v_code'");

    }

echo json_encode(array('status'=>'ok', 'message'=> 'minimum quantity updated'));


 ?>
