<?php

$response=array();
$orderData=array();
require "conn.php";
if( empty($_POST['code']) ||   empty($_POST['userType']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['code']) || !isset($_POST['userType'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$code = $_POST['code'];
$action =$_POST['userType'];

if($action=='client')
    {

        $sql="SELECT * FROM `client_order` where `c_code`='$code' ORDER BY `sn` DESC ";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

         while($data = mysqli_fetch_assoc($result))
        {

              $order_id=$data["order_id"];
              $amount=$data["amount"];
              $payment_method=$data["payment_method"];
              $order_status=$data["order_status"];
              $amount_status=$data["amount_status"];
              $order_date=$data["order_date"];
            
              $from_cash=$data["from_cash"];
                  $from_wallet=$data["from_wallet"];

            
              $date = date('d-m-Y',strtotime($order_date));
              $time = date('h:i:s:a',strtotime($order_date));


              $result_order_data= mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id` ='$order_id' ");


               while($order_data = mysqli_fetch_assoc($result_order_data))
               {
                     $v_code=$order_data["v_code"];
                     $product_name=$order_data["product_name"];
                     $price=$order_data["price"];
                     $qty=$order_data["qty"];


                     $result_vender_order = mysqli_query($con,"SELECT * FROM `vendor_order` WHERE `v_code`='$v_code' && `order_id`='$order_id'");
                      $data_vendore_order = mysqli_fetch_assoc($result_vender_order);
                       $order_status=$data_vendore_order["order_status"];


                       $result_vender_details = mysqli_query($con,"SELECT * FROM `vendor` WHERE `v_code`='$v_code'");
                      $data_vendore_details = mysqli_fetch_assoc($result_vender_details);
                       $vendore_name=$data_vendore_details["v_name"];



                      array_push($orderData,array("v_code"=>$v_code,"product_name"=>$product_name,"price"=>$price,"qty"=>$qty,
                    "order_status"=>$order_status,"v_name"=>$vendore_name));


               }


               array_push($response,array("order_id"=>$order_id,"amount"=>$amount,"payment_method"=>$payment_method,"order_status"=>$order_status,
               "amount_status"=>$amount_status,"order_date"=>$date,"order_time"=>$time,"from_cash"=>$from_cash,"from_wallet"=>$from_wallet,"order_data"=>$orderData));
               $orderData=array();


        }
    }
    else
    {

        $sql="SELECT * FROM `vendor_order` where `v_code`='$code' ORDER BY `sn` DESC ";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

         while($data = mysqli_fetch_assoc($result))
        {

             $order_id=$data["order_id"];
             $amount=$data["amount"];
             $payment_method=$data["payment_method"];
              $order_status=$data["order_status"];
              $amount_status=$data["amount_status"];
              $order_date=$data["order_date"];


                $date = date('d-m-Y',strtotime($order_date));
                $time = date('h:i:s:a',strtotime($order_date));
                
                
                
                


                 $result_order_data= mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id` ='$order_id' AND `v_code`='$code'");
                 while($order_data = mysqli_fetch_assoc($result_order_data))
               {
                     $v_code=$order_data["v_code"];
                     $product_name=$order_data["product_name"];
                     $price=$order_data["price"];
                     $c_code=$order_data["c_code"];
                     $qty=$order_data["qty"];
                       $product_code=$order_data["product_code"];


                             $result_client_details = mysqli_query($con,"SELECT * FROM `client` WHERE `c_code` ='$c_code'");
                             $data_client_details = mysqli_fetch_assoc($result_client_details);
                              $client_name=$data_client_details["c_name"];




                       array_push($orderData,array("v_code"=>$v_code,"product_name"=>$product_name,"price"=>$price,"qty"=>$qty,
                         "order_status"=>$order_status,"v_name"=>$vendore_name,"c_code"=>$c_code,"product_code"=>$product_code));


               }




             array_push($response,array("order_id"=>$order_id,"amount"=>$amount,"payment_method"=>$payment_method,"order_status"=>$order_status,
               "amount_status"=>$amount_status,"order_date"=>$date,"order_time"=>$time,"client_name"=>$client_name,"order_data"=>$orderData));


                  $orderData=array();




        }





    }





    }
}

header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 echo json_encode($response);

?>

