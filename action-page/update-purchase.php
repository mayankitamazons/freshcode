<?php
include("../common/connect.php");

 $bill_no=$_POST["bill_number"];
   $vendor_id=$_POST["vendor"];  
   $getdate=$_POST["datepicker-autoclose"];
   $new_date=date('d-M-Y',strtotime($getdate));


 date_default_timezone_set("Asia/Kolkata");

mysqli_query($con,"DELETE FROM `purchase_rate_info` WHERE `id`='$bill_no'");

 $query= mysqli_query($con,"SELECT * FROM `vendor` WHERE `vcode`='$vendor_id'");

 $b = mysqli_fetch_assoc($query);
 $vendor_name=$b['name'];
 $total=0;


 foreach($_REQUEST['product'] as $key => $value)
  {
      $i=1;
      echo $i;
     $qty=$_REQUEST['qty'][$key];    
	 $product_code=$_REQUEST['product'][$key];	
	 $price=$_REQUEST['price'][$key];
     $sub_amount=$_REQUEST['amount'][$key];
      $paymentmethod=$_REQUEST['methode'][$key];
	$total =$total + $sub_amount;
    
    $i=$i+1;

 mysqli_query($con,"INSERT INTO `purchase_rate_info`(`id`, `p_code`, `price`, `qty`, `total`, `payment_method`, `dateee`)
      VALUES ('$bill_no','$product_code','$price','$qty','$sub_amount','$paymentmethod','$new_date')");
    



  }



  mysqli_query($con,"UPDATE `purchase_rate` SET  `tot`='$total' WHERE `id`='$bill_no'");



 echo "<script>
 alert('Order Saved');
 window.location.href='../purchase.php';
 </script>";

?>
