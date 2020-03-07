<?php

require "conn.php";
$response=array();
$v_code = $_POST['v_code'];
$sql="SELECT * FROM `vendor_product_selection` WHERE `v_code`='$v_code'";
         $result=mysqli_query($con,$sql);

    while($data = mysqli_fetch_assoc($result))
    {

      $p_code=$data['product_code'];
     $sql2="SELECT * FROM `fb_product` WHERE `code`='$p_code'";
         $result2=mysqli_query($con,$sql2);
    $minimum_sale_quantity=$data["min_qty"];
     while($data2 = mysqli_fetch_assoc($result2))
    {

       

        $code=$data2["code"];
     $pname=$data2['product_name'];
     $hindi_pname=$data2['product_hindi_name'];
     $img=$data2['imagepath'];
     $de=$data2["description"];
	 $qty=$data2["quantity"];
    $price=$data2['price'];
    $unit=$data2["unit"];
	$product_status=$data2["product_status"];
	$notify_for_quantity_below=$data2["notify_for_quantity_below"];

	$maximum_sale_quantity=$data2["maximum_sale_quantity"];
	$qty_increment=$data2["qty_increment"];
    $st=$data2["in_stock"];

    $result4=mysqli_query($con,"SELECT * FROM `today_price_list` WHERE `product_code`='$code'  AND `v_code` ='$v_code'");
    $data_today = mysqli_fetch_assoc($result4);
    $today_rate=$data_today["today_price"];


		array_push($response,array("productcode"=>$code,"pname"=>$pname,"hindi_pname"=>$hindi_pname,"img"=>$img,"de"=>$de,"qty"=>$qty,"price"=>$price,"unit"=>$unit,
		"notify_for_quantity_below"=>$notify_for_quantity_below,"min_qty"=>$minimum_sale_quantity,
		"maximum_sale_quantity"=>$maximum_sale_quantity,"qty_increment"=>$qty_increment,"st"=>$st,"today_rate"=>$today_rate));

	}
	}
 echo json_encode($response);
?>
