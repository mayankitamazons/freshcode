<?php

require "conn.php";
$response=array();
if( empty($_POST['v_code']) ||   empty($_POST['fcm']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['v_code']) || !isset($_POST['fcm']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{








$c_code = $_POST['v_code'];
$fcm = $_POST['fcm'];
$sn =0;
$sql="SELECT * FROM `fb_product` WHERE `product_status`='1'";
         $result=mysqli_query($con,$sql);



    while($data = mysqli_fetch_assoc($result))
    {
        $product_match="0";
        $code=$data["code"];
     $pname=$data['product_name'];
     $hindi_pname=$data['product_hindi_name'];
     $img=$data['imagepath'];
     $de=$data["description"];
     $qty=$data["quantity"];
    $price=$data['price'];
    $unit=$data["unit"];
    $product_status=$data["product_status"];
    $notify_for_quantity_below=$data["notify_for_quantity_below"];
    $minimum_sale_quantity=$data["minimum_sale_quantity"];
    $maximum_sale_quantity=$data["maximum_sale_quantity"];
    $qty_increment=$data["qty_increment"];
    $st=$data["in_stock"];



  $sql2="SELECT * FROM `vendor_product_selection` WHERE `v_code` ='$c_code' && `product_code`='$code'";
         $result2=mysqli_query($con,$sql2);
           $row = mysqli_num_rows($result2);

         if($row != 0){
                array_push($response,array("code"=>$code,"pname"=>$pname,"hindi_pname"=>$hindi_pname,"img"=>$img,"de"=>$de,"qty"=>$qty,"price"=>$price,"unit"=>$unit,
    	"notify_for_quantity_below"=>$notify_for_quantity_below,"minimum_sale_quantity"=>$minimum_sale_quantity,
		"maximum_sale_quantity"=>$maximum_sale_quantity,"qty_increment"=>$qty_increment,"st"=>$st,"kart"=>"1","sn"=>$sn));

             }else{

                     array_push($response,array("code"=>$code,"pname"=>$pname,"hindi_pname"=>$hindi_pname,"img"=>$img,"de"=>$de,"qty"=>$qty,"price"=>$price,"unit"=>$unit,
		"notify_for_quantity_below"=>$notify_for_quantity_below,"minimum_sale_quantity"=>$minimum_sale_quantity,
		"maximum_sale_quantity"=>$maximum_sale_quantity,"qty_increment"=>$qty_increment,"st"=>$st,"kart"=>"0","sn"=>$sn));

                 }


 $sn++;

	}
 echo json_encode($response);
 mysqli_query($con, "UPDATE `vendor` SET `fcm_id`='$fcm' WHERE `v_code`='$c_code' ");
}}
?>
