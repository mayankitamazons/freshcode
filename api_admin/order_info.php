<?php

$response=array();
$orderData=array();
$orderId=array();
require "conn.php";
if( empty($_POST['code']) ||   empty($_POST['action']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['code']) || !isset($_POST['action'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$code = $_POST['code'];
$action =$_POST['action'];

if($action=='get')
    {

        $sql="SELECT vendor.v_code, vendor.v_name FROM vendor_order INNER JOIN vendor ON vendor_order.v_code=vendor.v_code GROUP BY vendor_order.v_code ASC";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

         while($data = mysqli_fetch_assoc($result))
        {


              $v_name=$data["v_name"];
              $v_code=$data["v_code"];




              $result_order_id_data= mysqli_query($con,"SELECT * FROM `vendor_order` WHERE `v_code`='$v_code' ORDER BY `sn` DESC");
              
              
                while($data_id = mysqli_fetch_assoc($result_order_id_data))
        {
            
                $od_id=$data_id["order_id"];


         $result_client_data22= mysqli_query($con,"SELECT client.c_code,client.c_name ,client_order.order_status FROM client INNER JOIN client_order ON client.c_code=client_order.c_code  WHERE client_order.order_id='$od_id'");
         $order_data222 = mysqli_fetch_assoc($result_client_data22);
         
         $od_status=$order_data222["order_status"];
        



              $result_order_data= mysqli_query($con,"SELECT order_info.v_code,vendor_order.order_status ,order_info.order_id,order_info.qty,order_info.payment_method,vendor_order.amount,order_info.order_date,
              order_info.price,order_info.product_name,order_info.product_code 
              FROM vendor_order 
              RIGHT JOIN order_info ON vendor_order.v_code=order_info.v_code
              WHERE order_info.v_code ='$v_code' AND 
              order_info.order_id='$od_id' 
              GROUP BY order_info.product_code 
              ORDER BY order_info.`sn` DESC");


               while($order_data = mysqli_fetch_assoc($result_order_data))
               {
                     $v_code=$order_data["v_code"];
                     $product_name=$order_data["product_name"];
                     $price=$order_data["price"];
                      $product_code=$order_data["product_code"];
                     $qty=$order_data["qty"];

                        
                           $order_id=$order_data["order_id"];
              $amount=$order_data["amount"];
              $payment_method=$order_data["payment_method"];
              $order_status=$order_data["order_status"];
              $amount_status=$order_data["amount_status"];
              $order_date=$order_data["order_date"];
              
                $result_client_data= mysqli_query($con,"SELECT client.c_code,client.c_name FROM client INNER JOIN client_order ON client.c_code=client_order.c_code WHERE client_order.order_id='$order_id'");

                   $client_data = mysqli_fetch_assoc($result_client_data);
                    $c_name =$client_data["c_name"];
                     $c_code=$client_data["c_code"];
                   


                      array_push($orderData,array("v_code"=>$v_code,"product_name"=>$product_name,"price"=>$price,"qty"=>$qty,
                    "order_status"=>$order_status,"v_name"=>$v_name,"order_id"=>$order_id,"amount"=>$amount,"payment_method"=>$payment_method,"order_status"=>$order_status,
              "order_date"=>$order_date,"c_name"=>$c_name,"c_code"=>$c_code,"p_code"=>$product_code));


               }
               
                array_push($orderId,array("id"=>$od_id,"order_status"=>$od_status,"order_data"=>$orderData));
                   $orderData=array();
               
               
               
        }


                array_push($response,array("v_name"=>$v_name,"v_code"=>$v_code,"orderId"=>$orderId));
               $orderId=array();


        }
        
         echo json_encode($response);
    }
    
    
    
    
    
    else if($action='update_status'){
        
            $od_status =$_POST['status'];
    $get_order_id =$_POST['order_id'];

 mysqli_query($con,"UPDATE `client_order` SET `order_status`='$od_status' WHERE `order_id`='$get_order_id'");
 mysqli_query($con,"UPDATE `vendor_order` SET `order_status`='$od_status' WHERE `order_id`='$get_order_id'");
 
 
 if($od_status=='in_process'){
     
     
      $result_orderData =mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$get_order_id'");
      
          while($order_data_update = mysqli_fetch_assoc($result_orderData))
               {
                   $v_codee=$order_data_update["v_code"];  
                  $product_codee=$order_data_update["product_code"];  
                  
                 $data_get_new_price = mysqli_query($con,"SELECT * FROM `today_price_list` WHERE `v_code`='$v_codee' AND `product_code`='$product_codee'");
                 $order_new_pricee = mysqli_fetch_assoc($data_get_new_price);
                  $product_price=$order_new_pricee["today_price"];
                  
                  mysqli_query($con,"UPDATE `order_info` SET `price`='$product_price' WHERE `order_id`='$get_order_id' AND `product_code`='$product_codee' AND `v_code`='$v_codee'");
                   
                   
               }
               
               
                
      $result_orderData_update =mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$get_order_id' AND `v_code`='$v_codee'");
               $V_tot=0;
               while($order_vendor_update = mysqli_fetch_assoc($result_orderData_update))
               {
                   $v_codee=$order_vendor_update["v_code"];  
                  $product_codee=$order_vendor_update["product_code"];  
                   	$price=$order_vendor_update["price"];  
                    $qty=$order_vendor_update["qty"];  
                    
                     $sub_tot =$price*$qty;
                    $V_tot =$V_tot + $sub_tot;
                  
                     
                   
               }
                  $result_client2=mysqli_query($con,"SELECT * FROM `vendor_order` WHERE `v_code`='$v_codee' AND `order_id` ='$get_order_id'");
         $data_clientt = mysqli_fetch_assoc($result_client2);
          $old_amount=$data_clientt["amount"];
               
                mysqli_query($con,"UPDATE `vendor_order` SET `amount`='$V_tot'  WHERE `v_code`='$v_codee' AND `order_id`='$get_order_id'");
                
                //****** Client Data Upadate ****////////
                
                

          // mysqli_query($con,"UPDATE `vendor_order` SET`amount`='$new_amount' WHERE `v_code`='$v_codee' AND `order_id` ='$get_order_id'");


      $result_client= mysqli_query($con,"SELECT * FROM `client_order` WHERE `order_id`='$get_order_id'");
      $data_client = mysqli_fetch_assoc($result_client);
     $old_client_amount=$data_client["amount"];
     $from_cash=$data_client["from_cash"];
     $due=$data_client["due"];
    $from_wallet=$data_client['from_wallet'];
      $c_code=$data_client['c_code'];



       $diffrent = abs($old_client_amount - $old_amount);
      $new_update_amount = $V_tot + $diffrent;

      $due = 0 ;
     $new_from_cash="0";


      if($from_cash !=0)
        {
          $new_from_cash = $new_update_amount ;
           $due = $new_update_amount ;
        }else
        {
        
            if($from_wallet > $new_update_amount)
            {
              $result_client_wallet= mysqli_query($con,"SELECT * FROM `wallet` WHERE `c_code`='$c_code'");
              $data_client_wallet = mysqli_fetch_assoc($result_client_wallet);
                $credit_amount=$data_client_wallet["credit_amount"];
                $pending_amount=$data_client_wallet["pending_amount"];
                
                $wallet_due = $from_wallet-$new_update_amount;
                $credit_amount = $credit_amount + $wallet_due;
                $pending_amount=$pending_amount - $wallet_due;
                
                mysqli_query($con,"UPDATE `wallet` SET `credit_amount`='$credit_amount',`pending_amount`='$pending_amount'  WHERE `c_code`='$c_code'");
                
            }
            else if($from_wallet < $new_update_amount){
                 $due=0;
                 $due= $new_update_amount- $from_wallet;
                  $due.'sdsadsad';
                
                
                
                
                
            }
            
     
        }
    mysqli_query($con,"UPDATE `client_order` SET `amount`='$new_update_amount',`from_cash`='$new_from_cash',`from_wallet`='$from_wallet',`due`='$due' WHERE `order_id`='$get_order_id'");

               
     
     
 }



   echo json_encode(array("status"=>"ok"));
        
        
    }
  





    }
}

// header('Content-Type: application/json');
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");


?>

