<?php


require "../common/connect.php";
$response = array();
$message = 1;
if (empty($_POST['p_code']) ||    empty($_POST['qty'])  ||  
 empty($_POST['total']) ||   empty($_POST['credit']) ||   empty($_POST['credit'])
    ||   empty($_POST['vcode'])
    ||   empty($_POST['vendor_name'])) {
    echo json_encode(array('status' => 'error', 'message' => 'feilds are required'));
} else {

    if (!isset($_POST['p_code']) || !isset($_POST['qty']) || !isset($_POST['total']) || !isset($_POST['credit']) ) {
        echo json_encode(array('status' => 'error', 'message' => 'feild name problem'));
    } else {


        $otp= $_POST["otp"];
        $otpsql = mysqli_query($con, "SELECT * FROM `purchase_otp`");

        $otpData = mysqli_fetch_assoc($otpsql);
        $otpCheck = $otpData["otp"];


        if($otpCheck!=$otp)
            {
            $message =0;

            echo json_encode(array("mesage" => "invalid user", "otp" => $message));
            }
            else{



            $p_code = $_POST["p_code"];
            $price = 0;
            $qty = $_POST["qty"];
            $total = $_POST["total"];
            $credit = $_POST["credit"];
            $paymentType = "CREDIT";
            $vcode = $_POST["vcode"];
            $vendor_name = $_POST["vendor_name"];
            $cash = $_POST["cash"];

            $price = round(($total) / $qty, 2);

            if ($credit == 0) {
                $paymentType = "CASH";
                $vendor_name = "cash";
                $vcode = "VEND1005";
            }


            date_default_timezone_set("Asia/Kolkata");

            $new_date = date('d-M-Y');


            $sqlCheckDate = mysqli_query($con, "SELECT * FROM `purchase_rate` WHERE `date`='$new_date'  AND `vcode` ='$vcode'");
            $rowCount = mysqli_num_rows($sqlCheckDate);
            $resultDate = mysqli_fetch_assoc($sqlCheckDate);



            // echo  "SELECT * FROM `purchase_rate` WHERE `date`=$new_date";

            $sql = mysqli_query($con, "SELECT * FROM `purchase_rate` ORDER BY `purchase_rate`.`sn` DESC ");
            $dataid = mysqli_fetch_assoc($sql);
            $last_id = $dataid['id'];
            $purchaseid = $last_id + 1;

            if ($rowCount == 0) {


                mysqli_query($con, "INSERT INTO `purchase_rate`(`id`, `vcode`, `vendor_name`, `date`, `tot`, `due`, `paid`) 
                    VALUES ('$purchaseid','$vcode','$vendor_name','$new_date','$total','$credit','$cash')");



                mysqli_query($con, "INSERT INTO `purchase_rate_info`(`id`, `p_code`, `price`, `qty`, 
         `total`, `payment_method`, `dateee`, `due`, `paid`) 
         VALUES ('$purchaseid','$p_code','$price','$qty','$total','$paymentType','$new_date',
         '$credit','$cash')");
            } else {


                $purchaseid = $resultDate['id'];
                $datee = $resultDate['date'];
                $tot = $resultDate['tot'];
                $due = $resultDate['due'];
                $paid = $resultDate['paid'];

                $paid = $paid + $cash;
                $due = $due + $credit;
                $tot = $tot + $total;

                mysqli_query($con, "UPDATE `purchase_rate` SET `tot`='$tot',`due`='$due',`paid`='$paid' 
            WHERE `id`=$purchaseid");



                mysqli_query($con, "INSERT INTO `purchase_rate_info`(`id`, `p_code`, `price`, `qty`, 
         `total`, `payment_method`, `dateee`, `due`, `paid`) 
         VALUES ('$purchaseid','$p_code','$price','$qty','$total','$paymentType','$datee',
         '$credit','$cash')");



                echo json_encode(array("mesage" => "purchase added", "otp" => $message));
        }

            }






    }

 
}


?>