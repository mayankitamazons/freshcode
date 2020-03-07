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


	 mysqli_query($con,"INSERT INTO `vendor_cash`(`purchases_id`, `total`, `paid`, `due`, `payment`, `date`)
      VALUES ('$orderId','$total','$newpaid','$newdue','$cash','$new_date')");
    


//UPDATE `purchase_rate` SET `due`=[value-7],`paid`=[value-8] WHERE `id` =

  mysqli_query($con,"UPDATE `purchase_rate` SET `due`='$newdue',`paid`='$newpaid'
   WHERE `id` ='$orderId'");



 echo "<script>
 alert('Payment Succesfully');
 window.history.back();
 window.location.href='../cash-vendor.php?code=$orderId';
 </script>";

?>
