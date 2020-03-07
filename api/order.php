<?php


    $vendore = array();
    require "conn.php";

    $c_code = $_POST['c_code'];
    $payment_methode = $_POST['payment_methode'];
    $json_string = $_POST['product_data'];
    $city = $_POST['city'];


    $sql_defaultVendor = mysqli_query($con, "SELECT * FROM `default_vendor_setting` WHERE `city`='$city'");
    $defaultVendorData = mysqli_fetch_assoc($sql_defaultVendor);
    $defaultVendor = $defaultVendorData["vendor_id"];


    	  if($city=="")
        {
            $defaultVendor='V101' ;
        }


    $array_data = json_decode($json_string, TRUE);
    $no = count($array_data);

    // print_r($array_data[1]["code"]);
    // print_r($array_data);

    chackWallte($c_code, $con);

    $dateOfDate = CURRENT_TIMESTAMP;

    date_default_timezone_set('Asia/Kolkata');

    $Current_hour = date('H');

    $todayDate = date('d-m-Y');
    switch ($Current_hour) {
        case ($Current_hour > 8 && $Current_hour < 24):

            $new_date = date('d-m-Y', strtotime($todayDate . ' + 1 days'));
            break;

        default:

            $new_date = date('d-m-Y');
    }


    $sql = "SELECT * FROM `client_order` ORDER BY sn DESC";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);

    $a = $data["order_id"];
    $b = substr($a, 2);
    if ($b == '') {
        $b = 101;
    } else {
        $b = $b + 1;
    }

    $orderId = "OD" . $b;






    for ($k = 0; $k < $no; $k++) {

        $productCode = $array_data[$k]['productCode'];
        $productName = $array_data[$k]['pname'];
        $v_code = $array_data[$k]['v_code'];
        $price = $array_data[$k]['price'];
        $qty = $array_data[$k]['quantity'];
        $min_qty = $array_data[$k]['min_qty'];





        if ($qty >= $min_qty) {

            $sql_order_info = "INSERT INTO `order_info`(`order_id`, `c_code`, `v_code`, `product_code`, `product_name`, `price`, `qty`, `payment_method`,`order_date`) VALUES (
            '$orderId','$c_code','$v_code','$productCode','$productName','$price','$qty','$payment_methode','$new_date')";
        } else {

            $sql_order_info = "INSERT INTO `order_info`(`order_id`, `c_code`, `v_code`, `product_code`, `product_name`, `price`, `qty`, `payment_method`,`order_date`) VALUES (
            '$orderId','$c_code','$defaultVendor','$productCode','$productName','$price','$qty','$payment_methode','$new_date')";
        }

        mysqli_query($con, $sql_order_info);

        $pre_amount = $qty * $price;
        $amount = $amount + $pre_amount;


        $array_size = count($vendore);


        // print_r($vendore);


        $search = array_search($v_code, $vendore);

        $vendore[] = $v_code;



        if ($search == " ") {

            if ($qty >= $min_qty) {

                $search_vendor_code = $vendore[$search];
                $sql_vendore_order = "SELECT * FROM `vendor_order` WHERE v_code ='$search_vendor_code' AND order_id ='$orderId'";
                $result_data = mysqli_query($con, $sql_vendore_order);
                $data = mysqli_fetch_assoc($result_data);
                $data_amount = $data["amount"];

                $new_amount = $data_amount + $pre_amount;

                $sql_vendore_order_update = "UPDATE `vendor_order` SET `amount`='$new_amount' WHERE v_code ='$v_code' AND order_id ='$orderId'";

                mysqli_query($con, $sql_vendore_order_update);
            } else {


                $search_vendor_code = $vendore[$search];
                $sql_vendore_order = "SELECT * FROM `vendor_order` WHERE v_code ='$defaultVendor' AND order_id ='$orderId'";
                $result_data = mysqli_query($con, $sql_vendore_order);
                $data = mysqli_fetch_assoc($result_data);
                $data_amount = $data["amount"];

                $new_amount = $data_amount + $pre_amount;

                $sql_vendore_order_update = "UPDATE `vendor_order` SET `amount`='$new_amount' WHERE v_code ='$defaultVendor' AND order_id ='$orderId'";

                mysqli_query($con, $sql_vendore_order_update);
            }
        } else {



            if ($qty >= $min_qty) {

                $sql_vendore_order = "INSERT INTO `vendor_order`( `v_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,`order_date`)
                     VALUES ('$v_code','$orderId','$pre_amount','$payment_methode','pending','0','$new_date')";
                mysqli_query($con, $sql_vendore_order);
            } else {
                $sql_vendore_order = "INSERT INTO `vendor_order`( `v_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,`order_date`)
                     VALUES ('$defaultVendor','$orderId','$pre_amount','$payment_methode','pending','0','$new_date')";
                mysqli_query($con, $sql_vendore_order);
            }
        }
    }




    $getWallet = mysqli_query($con, "SELECT * FROM `wallet` WHERE `c_code`='$c_code'");
    $row = mysqli_num_rows($getWallet);
    $data = mysqli_fetch_assoc($getWallet);
    $per_day = $data["per_day"];
    $per_day_user = $data["per_day_use"];
    $wallet_status = $data["activation_status"];
    $credit_amount = $data["credit_amount"];
    $pending_amount = $data["pending_amount"];
    $fix_amount = $data["value"];
    $chack_pendding_amount = $pending_amount + $amount;

    $usable_amount = $amount + $per_day_user;


    if ($row == 0) {
        $sql_client_order = "INSERT INTO `client_order`(`c_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,`from_cash`, `from_wallet`, `due`,`order_date`)
                            VALUES ('$c_code','$orderId','$amount','$payment_methode','pending','0','$amount','0','$amount','$new_date')";
        mysqli_query($con, $sql_client_order);
    } else {
        if ($wallet_status == "active") {

            if ($usable_amount > $per_day) {

                $per_day = $per_day -  $per_day_user;
                $due_amount = $amount - $per_day;
                $cash_amount = $due_amount;
                $todayDate = date('d-m-Y');
                $new_credit_amount = $credit_amount - $per_day;
                $new_pendind_amount = $pending_amount + $per_day;
                $new_per_day_user = $per_day_user + $per_day;



                $sql_client_order = "INSERT INTO `client_order`(`c_code`, `order_id`, `amount`, `payment_method`, `order_status`,
                                `amount_status`,`from_cash`, `from_wallet`, `due`,`order_date`)
                                  VALUES ('$c_code','$orderId','$amount','$payment_methode','pending','0','$cash_amount','$per_day','$due_amount','$new_date')";
                mysqli_query($con, $sql_client_order);


                mysqli_query($con, "UPDATE `wallet` SET `credit_amount`='$new_credit_amount',`pending_amount`='$new_pendind_amount',
                                    `per_day_use`='$new_per_day_user',`last_day_use`='$todayDate' WHERE `c_code`='$c_code'");
            } else if ($chack_pendding_amount >  $fix_amount) {
                $sql_client_order = "INSERT INTO `client_order`(`c_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,`from_cash`, `from_wallet`, `due`,`order_date`)
                                  VALUES ('$c_code','$orderId','$amount','$payment_methode','pending','0','$amount','0','$amount','$new_date')";
                mysqli_query($con, $sql_client_order);
            } else {


                if ($per_day > $amount) {
                    $per_day = $amount;
                }


                $due_amount = $amount - $per_day;
                $cash_amount = $due_amount;
                $todayDate = date('d-m-Y');
                $new_credit_amount = $credit_amount - $per_day;
                $new_pendind_amount = $pending_amount + $per_day;
                $new_per_day_user = $per_day_user + $per_day;



                $sql_client_order = "INSERT INTO `client_order`(`c_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,
                             `from_cash`, `from_wallet`, `due`,`order_date`)
                              VALUES ('$c_code','$orderId','$amount','$payment_methode','pending','0','$cash_amount','$per_day','$due_amount','$new_date')";
                mysqli_query($con, $sql_client_order);

                mysqli_query($con, "UPDATE `wallet` SET `credit_amount`='$new_credit_amount',`pending_amount`='$new_pendind_amount',
                             `per_day_use`='$new_per_day_user',`last_day_use`='$todayDate' WHERE `c_code`='$c_code'");
            }
        } else {


            $sql_client_order = "INSERT INTO `client_order`(`c_code`, `order_id`, `amount`, `payment_method`, `order_status`, `amount_status`,`from_cash`, `from_wallet`, `due`,`order_date`)
                            VALUES ('$c_code','$orderId','$amount','$payment_methode','pending','0','$amount','0','$amount','$new_date')";
            mysqli_query($con, $sql_client_order);
        }
    }








  //  echo json_encode(array('status' => 'ok', 'message' =>  $defaultVendor));

     echo json_encode(array('status' => 'ok', 'message' => 'order updated'));





    ////////////////////////////////// Wallte Chack Funtion///////////////////////////////////////

    function chackWallte($f_code, $conn)
    {



        $wallet_Data = mysqli_query($conn, "SELECT * FROM `wallet` WHERE `c_code` ='$f_code'");


        $data = mysqli_fetch_assoc($wallet_Data);
        $activation_status = $data['activation_status'];

        $credit_amount = $data['credit_amount'];
        $pending_amount = $data['pending_amount'];
        $credit_date = $data['credit_date'];
        $expire_date = $data['expire_date'];
        $new_credit_value = $data['value'];
        $expire_day = $data['expire_day'];
        $per_day = $data['per_day'];
        $last_day_use = $data['last_day_use'];
        $per_day_use = $data['per_day_use'];
        $todayDate = date('d-m-Y');

        if (strtotime($todayDate) != strtotime($last_day_use)) {

            mysqli_query($conn, "UPDATE `wallet` SET `per_day`='$per_day',`per_day_use`='0',`last_day_use`='$todayDate' WHERE `c_code`='$f_code'");
        }


        $new_expire_date = date('d-m-Y', strtotime($todayDate . ' + ' . $per_day . ' days'));



        $datediff = strtotime($expire_date) - strtotime($todayDate);

        $days = round($datediff / (60 * 60 * 24));




        switch ($activation_status) {


            case 'active':



                if (strtotime($todayDate) <= strtotime($expire_date)) {

                    $st = "nothing";
                } else {


                    if ($pending_amount == "0") {


                        mysqli_query($conn, "UPDATE `wallet` SET  `credit_amount`='$new_credit_value',`credit_date`='$todayDate',`expire_date`='$new_expire_date'  WHERE `c_code`='$f_code'");


                        $datediff = strtotime($new_expire_date) - strtotime($todayDate);

                        $days = round($datediff / (60 * 60 * 24));
                    } else {
                        mysqli_query($conn, "UPDATE `wallet` SET  `credit_amount`='0',`activation_status` ='due' WHERE `c_code`='$f_code'");
                    }
                }


                break;


            case 'due':



                if ($pending_amount == '0') {

                    mysqli_query($conn, "UPDATE `wallet` SET `activation_status` ='active', `credit_amount`='$new_credit_value',`credit_date`='$todayDate',`expire_date`='$new_expire_date'  WHERE `c_code`='$f_code'");

                    $datediff = strtotime($new_expire_date) - strtotime($todayDate);

                    $days = round($datediff / (60 * 60 * 24));
                } else {

                    $st = "nothing";
                }



                break;


            default:

                $st = "nothing";
        }
    }
