<?php

require "conn.php";
$response = array();
if (empty($_POST['c_code']) ||   empty($_POST['fcm'])) {
    echo json_encode(array('status' => 'error', 'message' => 'feilds are required'));
} else {

    if (!isset($_POST['c_code']) || !isset($_POST['fcm'])) {
        echo json_encode(array('status' => 'error', 'message' => 'feild name problem'));
    } else {


        $city = $_POST['city'];
      //  $city="dfsdf";

        $sql_defaultVendor = mysqli_query($con, "SELECT * FROM `default_vendor_setting` WHERE `city`='$city'");
        $defaultVendorData = mysqli_fetch_assoc($sql_defaultVendor);
        $defaultVendor = $defaultVendorData["vendor_id"];


        $row_get_defaultCity = mysqli_num_rows($sql_defaultVendor);

          //  if ($row_get_defaultCity != 0) {


        if($city=="")
        {
            $defaultVendor='V101' ;
        }

        $c_code = $_POST['c_code'];
        $fcm = $_POST['fcm'];
        $sn = 0;
        $sql = "SELECT * FROM `fb_product` WHERE `product_status`='1' ORDER BY sn";
        $result = mysqli_query($con, $sql);



        while ($data = mysqli_fetch_assoc($result)) {
            $product_match = "0";
            $code = $data["code"];
            $pname = $data['product_name'];
            $hindi_pname = $data['product_hindi_name'];
            $img = $data['imagepath'];
            $de = $data["description"];
            $qty = $data["quantity"];
            $price = $data['price'];
            $unit = $data["unit"];
            $product_status = $data["product_status"];
            $notify_for_quantity_below = $data["notify_for_quantity_below"];
            $minimum_sale_quantity = $data["minimum_sale_quantity"];
            $maximum_sale_quantity = $data["maximum_sale_quantity"];
            $qty_increment = $data["qty_increment"];
            $st = $data["in_stock"];




            $sql_get_vendore = "SELECT * FROM `client_vendor_selection` where `c_code`= '$c_code' AND `product_code` ='$code'";
            $result_get_vendor = mysqli_query($con, $sql_get_vendore);
            $row_get_vendore = mysqli_num_rows($result_get_vendor);

            if ($row_get_vendore != 0) {
                $data_get_vendor = mysqli_fetch_assoc($result_get_vendor);
                $vendore_code = $data_get_vendor["v_code"];
            } else {

                $vendore_code = $defaultVendor;
            }



            $sql_check_vendore_with_product = "SELECT * FROM `vendor_product_selection ` where `v_code`= '$vendore_code' AND `product_code` ='$code'";
            $result_check_vendore_with_product = mysqli_query($con, $sql_check_vendore_with_product);
            $row_check_vendore = mysqli_num_rows($result_check_vendore_with_product);

            if ($row_check_vendore == 0) {
                $vendore_code =  $defaultVendor;
            }



            $get_vendore_min_qty = mysqli_query($con, "SELECT * FROM `vendor_product_selection` WHERE `v_code`='$vendore_code' AND `product_code`='$code'");

            $data_get_vendor_min_qty = mysqli_fetch_assoc($get_vendore_min_qty);

            $minimum_sale_quantity = $data_get_vendor_min_qty["min_qty"];


            $sql_get_vendore_price = "SELECT * FROM `today_price_list` where `v_code`= '$vendore_code' && `product_code`='$code'";
            $result_get_vendor_price = mysqli_query($con, $sql_get_vendore_price);
            $data_get_vendor_product_price = mysqli_fetch_assoc($result_get_vendor_price);

            $price = $data_get_vendor_product_price['today_price'];




            $sql2 = "SELECT * FROM `add_to_kart` WHERE `c_code` ='$c_code' && `product_code`='$code'";
            $result2 = mysqli_query($con, $sql2);
            $row = mysqli_num_rows($result2);

            if ($row != 0) {
                array_push($response, array(
                    "code" => $code, "pname" => $pname, "hindi_pname" => $hindi_pname, "img" => $img, "de" => $de, "qty" => $qty, "price" => $price, "unit" => $unit,
                    "notify_for_quantity_below" => $notify_for_quantity_below, "minimum_sale_quantity" => $minimum_sale_quantity,
                    "maximum_sale_quantity" => $maximum_sale_quantity, "qty_increment" => $qty_increment, "st" => $st, "kart" => "1", "sn" => $sn, "v_code" => $vendore_code
                ));
            } else {

                array_push($response, array(
                    "code" => $code, "pname" => $pname, "hindi_pname" => $hindi_pname, "img" => $img, "de" => $de, "qty" => $qty, "price" => $price, "unit" => $unit,
                    "notify_for_quantity_below" => $notify_for_quantity_below, "minimum_sale_quantity" => $minimum_sale_quantity,
                    "maximum_sale_quantity" => $maximum_sale_quantity, "qty_increment" => $qty_increment, "st" => $st, "kart" => "0", "sn" => $sn, "v_code" => $vendore_code
                ));
            }


            $sn++;
        }
  //  }


        mysqli_query($con, "UPDATE `client` SET `fcm_id`='$fcm' WHERE `c_code`='$c_code' ");

        echo json_encode($response);
    }
}