<?php
include("../common/connect.php");

 $bill_no=$_POST["bill_number"];
   $getdate=$_POST["datepicker-autoclose"];
   $new_date=date('d-M-Y',strtotime($getdate));


 date_default_timezone_set("Asia/Kolkata");



 foreach($_REQUEST['product'] as $key => $value)
  {
  
     $qty=$_REQUEST['qty'][$key];
    $dump = $_REQUEST['dump'][$key];
    $p_code = $_REQUEST['product'][$key];  
 
 
 mysqli_query($con, "INSERT INTO `inventory_info`( `id`, `product_code`, `remain`, `dump`, `datee`)
  VALUES ('$bill_no','$p_code','$qty','$dump','$new_date')");
    



  }


 mysqli_query($con, "INSERT INTO `inventory`( `id`, `datee`)VALUES ('$bill_no','$new_date')");



 echo "<script>
 alert('Data Saved');
 window.location.href='../inventory.php';
 </script>";
