<?php
include("../common/connect.php");

 $bill_no=$_POST["bill_number"];
   $vendor_id=$_POST["vendor"];  
   $getdate=$_POST["datepicker-autoclose"];
   $new_date=date('d-M-Y',strtotime($getdate));


 date_default_timezone_set("Asia/Kolkata");


 $query= mysqli_query($con,"SELECT * FROM `vendor` WHERE `vcode`='$vendor_id'");

 $b = mysqli_fetch_assoc($query);
 $vendor_name=$b['name'];
 $total=0;
$totalPaid=0;
$totalDue=0;

 foreach($_REQUEST['product'] as $key => $value)
  {
    $due=0;
    $paid=0;
     $qty=$_REQUEST['qty'][$key];    
	 $product_code=$_REQUEST['product'][$key];	
	 $price=$_REQUEST['price'][$key];
     $sub_amount=$_REQUEST['amount'][$key];
      $paymentmethod=$_REQUEST['methode'][$key];
	$total =$total + $sub_amount;
 
  if($paymentmethod=="CASH")
  {
    $paid=  $sub_amount;
  }
  else{
     $due=  $sub_amount;
  }

  $totalPaid=$totalPaid+$paid;
$totalDue=$totalDue+$due;


 mysqli_query($con,"INSERT INTO `purchase_rate_info`(`id`, `p_code`, `price`, `qty`, `total`, `payment_method`, `dateee`, `due`, `paid`)
      VALUES ('$bill_no','$product_code','$price','$qty','$sub_amount','$paymentmethod','$new_date','$due','$paid')");
    



  }


 "INSERT INTO `purchase_rate`( `id`,`vcode`, `vendor_name`, `date`, `tot`, `due`, `paid`)   VALUES ('$bill_no','$vendor_id','$vendor_name','$new_date','$total','$totalDue','$totalPaid')"; 
  mysqli_query($con,"INSERT INTO `purchase_rate`( `id`,`vcode`, `vendor_name`, `date`, `tot`, `due`, `paid`)
   VALUES ('$bill_no','$vendor_id','$vendor_name','$new_date','$total','$totalDue','$totalPaid')");



 echo "<script>
 alert('Order Saved');
 window.location.href='../purchase.php';
 </script>";

?>
