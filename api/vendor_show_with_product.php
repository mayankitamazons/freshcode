<?php


require "conn.php";
$response = array();
$data2 = array();
$c_code = $_POST['c_code'];
$city = $_POST['city'];



	  if($city=="")
        {
    $city= 'Jaipur' ;
        }


$sn = 0;
$p = 0;
$sql = "SELECT * FROM `fb_product` WHERE `product_status`='1'";
$result = mysqli_query($con, $sql);

while ($data = mysqli_fetch_assoc($result)) {


    $code = $data["code"];

  
      $sql_vendor_with_product= "SELECT fb_product.code,fb_product.product_name, fb_product.imagepath, today_price_list.today_price,today_price_list.yesterday_price,vendor.v_code,vendor.v_type,vendor.v_name ,vendor.rating FROM fb_product INNER JOIN today_price_list ON today_price_list.product_code = fb_product.code INNER JOIN vendor ON vendor.v_code = today_price_list.v_code WHERE today_price_list.product_code='$code' AND vendor.city='$city' ORDER BY vendor.v_code";
    $result_data = mysqli_query($con, $sql_vendor_with_product);







    while ($data_product = mysqli_fetch_assoc($result_data)) {
        $p = 1;

        $product_name = $data_product["product_name"];
        $p_imagepath = $data_product["imagepath"];
        $p_today_price = $data_product["today_price"];
        $yesterday_price = $data_product["yesterday_price"];
        $v_code = $data_product["v_code"];
        $v_name = $data_product["v_name"];
        $v_type = $data_product["v_type"];
        $v_rating = $data_product["rating"];


        $sql2 = "SELECT * FROM `client_vendor_selection` WHERE `c_code` ='$c_code' && `v_code`='$v_code' && `product_code`='$code'";
        $result2 = mysqli_query($con, $sql2);
        $row = mysqli_num_rows($result2);



        $result_vend = mysqli_query($con, "SELECT * FROM `vendor_product_selection` WHERE `v_code` ='$v_code' AND `product_code`='$code'");
        $data_vendore = mysqli_fetch_assoc($result_vend);
        $min_qty = $data_vendore["min_qty"];


        if ($row != 0) {
            array_push($response, array(
                "today_price" => $p_today_price, "yesterday_price" => $yesterday_price, "v_code" => $v_code,
                "v_name" => $v_name, "v_selection" => "1", "sn" => $sn, "min_qty" => $min_qty, "v_type" => $v_type, "v_rating" => $v_rating, "v_P_code" => $code
            ));
        } else {
            array_push($response, array(
                "today_price" => $p_today_price, "yesterday_price" => $yesterday_price, "v_code" => $v_code,
                "v_name" => $v_name, "v_selection" => "0", "sn" => $sn, "min_qty" => $min_qty, "v_type" => $v_type, "v_rating" => $v_rating, "v_P_code" => $code
            ));
        }




        $sn++;
    }


    if ($p == 1) {
        $p = 0;
        array_push($data2, array("p_code" => $code, "product_name" => $product_name, "imagepath" => $p_imagepath, "data" => $response));
        $response = array();
    }
}
header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


echo json_encode($data2);
