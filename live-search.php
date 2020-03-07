<?php
include("common/connect.php");


if(isset($_POST["cust_id"]))
{
$output=$_POST["cust_id"];

    $queryy=mysqli_query($con,"SELECT * FROM `order_info` INNER JOIN bill_info ON order_info.order_id=bill_info.order_id WHERE cust_id ='$output' ORDER BY `order_info`.`order_id` DESC");

	
$i=1;
	while($b=mysqli_fetch_array($queryy))
{
	//echo 	$stat=$var["name"];


        $orderId= $b['order_id'];
        $date_time= $b['order_date']; 
        $billing_name=  $b['billing_name']; 
           $payment_method= $b['payment_method'];	
        $order_amount= $b['total_amount']; 
         $pending_amount= $b['pending_amount'];
        $paid_amount=  $b['paid_amount'];
            $invoice_id=  $b['invoice_id'];

  // echo "<option  price=$price value=$product_code>$p_name &nbsp;&nbsp; $p_himdi</option>";
    
	echo "<tr>
    <td style='text-align:center'>$i</td>
    	<td style='text-align:center'>$invoice_id</td>
	<td style='text-align:center'>$orderId</td>
    <td style='text-align:center'>$date_time </td>    
    <td style='text-align:center'>$billing_name </td>  
     <td style='text-align:center'>$payment_method</td>       
    <td style='text-align:center'>$order_amount</td>
      <td style='text-align:center'>$paid_amount</td>  
       <td style='text-align:center'>$pending_amount</td>   
    </tr>";
    
    $i=$i+1;
}


}

if(isset($_POST["vcode"]))
{
$output=$_POST["vcode"];

    $queryy=mysqli_query($con,"SELECT purchase_rate_info.dateee,vendor.name ,purchase_rate_info.qty,purchase_rate_info.price,purchase_rate_info.total,fb_product.product_name
     from `purchase_rate_info` 
     INNER JOIN vendor ON purchase_rate_info.vcode=vendor.vcode 
     INNER JOIN fb_product ON purchase_rate_info.p_code=fb_product.code 
    WHERE purchase_rate_info.vcode='$output' ORDER BY purchase_rate_info.sn DESC");

	
$i=1;
	while($b=mysqli_fetch_array($queryy))
{
	//echo 	$stat=$var["name"];


        $date= $b['dateee'];
        $name= $b['name']; 
        $product_name=  $b['product_name']; 
           $price= $b['price'];	
        $qty= $b['qty']; 
         $total= $b['total'];

  // echo "<option  price=$price value=$product_code>$p_name &nbsp;&nbsp; $p_himdi</option>";
    
	echo "<tr>
	<td style='text-align:center'>$i</td>
	<td style='text-align:center'>$date</td>
    <td style='text-align:center'>$name </td>    
    <td style='text-align:center'>$product_name </td>  
     <td style='text-align:center'>$price</td>       
    <td style='text-align:center'>$qty</td>
      <td style='text-align:center'>$total</td>  
     
    </tr>";
    
    $i=$i+1;
}


}

?>