<?php

$orderList=array();
$orderDetails=array();
require "conn.php";
if(empty($_POST['action']) || empty($_POST['code']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(!isset($_POST['action']) || !isset($_POST['code'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$code = $_POST['code'];
$action =$_POST['action'];

if($action=='get')
    {

      
         $result=mysqli_query($con,"SELECT * FROM `client_order` ORDER BY sn DESC");
         $row = mysqli_num_rows($result);

         while($data = mysqli_fetch_assoc($result))
        {

             
              $c_code=$data["c_code"];   
              $order_id=$data["order_id"];     
              
              $resultClient=mysqli_query($con,"SELECT * FROM `client` WHERE `c_code`='$c_code'");
              $dataClient = mysqli_fetch_assoc($resultClient);
              $c_name=$dataClient["c_name "];

              $newArray =array('c_name'=>$c_name);   
        
            //  array_push($orderList,array("order_id"=>$order_id,"c_name"=>$c_name,"c_code"=>$c_code));

              array_push($orderList,array_merge($data,$newArray));

        }
        
         echo json_encode(array("list"=>$orderList));
    }
      
 


    else if($action=='getOderDetails'){    
         
         $result=mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$code' ORDER BY sn DESC");
         while($data = mysqli_fetch_assoc($result))
        {          
            $vCode=$data["v_code"];
            $cCode=$data["c_code"];
        
            $vendoerResult=mysqli_query($con,"SELECT * FROM `vendor` WHERE `v_code`='$vCode'");
            $vendorData = mysqli_fetch_assoc($vendoerResult);

            $clientrResult=mysqli_query($con,"SELECT * FROM `client` WHERE `c_code`='$cCode'");
            $clientData = mysqli_fetch_assoc($clientrResult);

            $v_name=$vendorData["v_name"];
           
            $newArray =array('v_name'=>$v_name,'c_name'=>$c_name);   
            
            

          //  array_merge
              array_push($orderDetails,array_merge($data,$newArray));

        }
        
        echo json_encode(array("list"=>$orderDetails));
        
        
    }


    else if($action='update_status'){
        
        $od_status =$_POST['status'];
$get_order_id =$_POST['code'];

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
mysqli_query($con,"UPDATE `client_order` SET  `order_status`='$od_status', `amount`='$new_update_amount',`from_cash`='$new_from_cash',`from_wallet`='$from_wallet',`due`='$due' WHERE `order_id`='$get_order_id'");

           
 
 
}



echo json_encode(array("status"=>"ok"));
    
    
}






    }
}

header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


?>