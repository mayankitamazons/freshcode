<?php
include("../common/connect.php");

 $bill_no=$_POST["bill_number"];
   $cust_id=$_POST["cust"];
   $paymentmethod=$_POST["paymentmethod"];
   $deliveryfees=$_POST["deliveryfees"];
   $sale_remark=$_POST["pdec"];

 $getdate=$_POST["datepicker-autoclose"];
   $new_date=date('d-M-Y',strtotime($getdate));
 date_default_timezone_set("Asia/Kolkata");


 $query= mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` = '$cust_id'");

 $b = mysqli_fetch_assoc($query);
 $cname=$b['cust_name'];
 $rate_group=$b['rate_group'];
 $area=$b['area'];
 $address=$b['address'];
 $pincode=$b['pincode'];
 $city=$b['city'];
 $total=0;

/////////////////////////////////////

	// $query = mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$bill_no'");
	// $data = mysqli_fetch_assoc($query);
    // $new_date	 = $data['order_date'];


	 mysqli_query($con,"DELETE FROM `fb_order` WHERE `order_id`='$bill_no'");
	 mysqli_query($con,"DELETE FROM `order_info` WHERE `order_id`='$bill_no'");







/////////////////////////
 foreach($_REQUEST['product'] as $key => $value)
  {
	 $product_code=$_REQUEST['product'][$key];
	 $qty=$_REQUEST['qty'][$key];
	 $price=$_REQUEST['price'][$key];
	 $sub_amount=$_REQUEST['amount'][$key];
	$total =$total + $sub_amount;


	 mysqli_query($con,"INSERT INTO `fb_order`(`cust_id`, `order_id`, `product`, `price`, `qty`, `sub_total`, `date_time`, `delivery_fee`, `sales_order_remark`, `payment_method`)
	  VALUES ('$cust_id','$bill_no','$product_code','$price','$qty','$sub_amount','$new_date','$deliveryfees','$sale_remark','$paymentmethod')");




  }



  mysqli_query($con,"INSERT INTO `order_info`( `order_id`, `cust_id`, `billing_name`, `order_status`, `payment_method`, `total_amount`, `pending_amount`, `paid_amount`, `order_date`)
 VALUES ('$bill_no','$cust_id','$cname','pending','$paymentmethod','$total','$total','0','$new_date')");



 echo "<script>
 alert('Order Saved');
 window.location.href='../all-sales-report.php';
 </script>";

?>