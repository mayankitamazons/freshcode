<?php
include("common/connect.php");


if(isset($_POST["cust_id"]))
{
$output=$_POST["cust_id"];

    $queryy=mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` ='$output'");
	$data = mysqli_fetch_array($queryy);

	 $rate_group = $data['rate_group'];



	 $product_data=mysqli_query($con,"SELECT fb_product.code, fb_product.product_status, rate_group.product_code,fb_product.product_name,fb_product.product_hindi_name,rate_group.daily,rate_group.weakly,rate_group.monthly,rate_group.group_1,rate_group.group_2,rate_group.group_3
FROM `fb_product` 
INNER JOIN `rate_group` ON fb_product.code = rate_group.product_code 
WHERE fb_product.product_status ='1' GROUP BY fb_product.code");
$i=1;
	while($var=mysqli_fetch_array($product_data))
{
	//echo 	$stat=$var["name"];


	$price = $var[$rate_group];
	$product_code = $var['code'];
	$p_name = $var['product_name'];
	$p_himdi = $var['product_hindi_name'];

   echo "<option  price=$price value=$product_code>$p_name &nbsp;&nbsp; $p_himdi</option>";
    
	// echo "<tr>
	// <td style='text-align:left'><label >$i</label></td>
	// <td style='text-align:left'><label>$p_name($p_himdi)</label></td>
    // <td style='text-align:left'><input type='hidden' id='product' name='product[]' value=$product_code /> </td>    
    // <td style='text-align:center'><input class='form-control' type='text' id='qty$i' name='qty[]' onchange='status(this)' /> </td> 
    // <td style='text-align:center'><input class='form-control' type='text' id='price$i' name='price[]' value=$price readonly/> </td> 
    // <td style='text-align:center'><input class='form-control' type='text' id='amount$i' name='amount[]' readonly /> </td></tr>";
$i=$i+1;
}


}





if(isset($_POST["status"]))
{

 
	$status=$_POST["status"];
	$order_id=$_POST["order_id"];

	mysqli_query($con,"UPDATE `order_info` SET `order_status`='$status' WHERE `order_id`='$order_id'");

	if($status=='in_process'){


        
	$queryGetDate = mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$order_id'");
	$getData = mysqli_fetch_assoc($queryGetDate);

    $orderDate = $getData['order_date'];
    $billing_name=$getData["billing_name"];

		$query = mysqli_query($con,"SELECT * FROM `bill_info` ORDER BY `bill_info`.`sn` DESC limit 1");
	$data = mysqli_fetch_assoc($query);
	$last_id = $data['invoice_id'];
	if($last_id == '')
	{
		$last_id = 1001;
	}else
	{
	$last_id = $last_id+1;
	}
	$invoice = $last_id;
	


		 $getBillInfo=mysqli_query($con,"SELECT * FROM `bill_info` WHERE `order_id`='$order_id'");

		  $no=mysqli_num_rows($getBillInfo);

		 if($no==0){
			 echo mysqli_query($con,"INSERT INTO `bill_info`(`invoice_id`, `order_id`, `billing_name`, `order_date`) VALUES ('$invoice','$order_id','$billing_name','$orderDate')");
		 }

    }
    

    if($status=='cancelled')
    {
        mysqli_query($con,"DELETE FROM `bill_info` WHERE `order_id`='$order_id'");
    }

}



if(isset($_POST["custIdForRateGroup"]))
{
	$rate_group = $_POST["rateGroup"];
	$cust_id = $_POST["custIdForRateGroup"];

	echo mysqli_query($con,"UPDATE `customer` SET `rate_group`='$rate_group' WHERE `cust_id` ='$cust_id'");

	echo "Rate Group Update";


}


?>
