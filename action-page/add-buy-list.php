<?php
include("../common/connect.php");

$bill_no = $_POST["bill_number"];
$getdate = $_POST["datepicker-autoclose"];
$new_date = date('d-M-Y', strtotime($getdate));


date_default_timezone_set("Asia/Kolkata");

$new_date = date('d-M-Y');


$query = mysqli_query($con, "SELECT * FROM `buylist` ORDER BY id DESC");
$data = mysqli_fetch_assoc($query);
$last_id = $data['id'];
$bill_no = $last_id+1;

foreach ($_REQUEST['webbuy'] as $key => $value) {

    $webbuy = $_REQUEST['webbuy'][$key];
    $code = $_REQUEST['code'][$key];
    $appbuy = $_REQUEST['appbuy'][$key];
    $totalbuy = $_REQUEST['totalbuy'][$key];
    $last = $_REQUEST['last'][$key];
    $purchase = $_REQUEST['purchase'][$key];
    $remain = $_REQUEST['remain'][$key];
    $today = $_REQUEST['today'][$key];
    $dump = $_REQUEST['dump'][$key];
    $gap = $_REQUEST['gap'][$key];
  $name= $_REQUEST['name'][$key];


    mysqli_query($con, "INSERT INTO `buy_list_data`(`id`, `date`,`pcode`,`pname`, `webbuy`,
     `aapbuy`, `totalbuy`, `last_inventory`,`purchase_quantity`, `current_inventory`, `today_inventory`,
      `dump_inventory`, `gap`) 
    VALUES ('$bill_no','$new_date','$code','$name','$webbuy','$appbuy','$totalbuy','$last','$purchase','$remain',
    '$today','$dump','$gap')");
}


mysqli_query($con, "INSERT INTO `buylist`( `id`, `date`)VALUES ('$bill_no','$new_date')");



echo "<script>
 alert('Data Saved');
 window.location.href='../view_gap.php';
 </script>";
