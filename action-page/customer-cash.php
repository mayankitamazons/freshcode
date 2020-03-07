<?php
include("../common/connect.php");

  $orderId=$_POST["orderId"];
   $due=$_POST["due"];
   $paid=$_POST["paid"];
   $total=$_POST["total"];
   $cash=$_POST["cash"];
  
   $getdate=$_POST["datepicker-autoclose"];
   $new_date=date('d-M-Y',strtotime($getdate));


 date_default_timezone_set("Asia/Kolkata");


 $newpaid=$paid+$cash;
  $newdue =$total-$newpaid;


	 mysqli_query($con,"INSERT INTO `customer_cash`(`order_id`, `total_amount`, `pendding`, `paid`, `payment`, `datee`)
      VALUES ('$orderId','$total','$newdue','$newpaid','$cash','$new_date')");
    




  mysqli_query($con,"UPDATE `order_info` SET `pending_amount`='$newdue',`paid_amount`='$newpaid'
   WHERE `order_id` ='$orderId'");



 echo "<script>
 alert('Payment Succesfully');
 window.history.back();
 window.location.href='../order-cash.php?code=$orderId';
 </script>";

?>
