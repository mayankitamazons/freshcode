<?php


require "conn.php";
if( empty($_POST['v_code']) ||  empty($_POST['order_id']) ||  empty($_POST['update_data'])  )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['v_code']) || !isset($_POST['order_id'])  || !isset($_POST['update_data']) )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$c_code = $_POST['v_code'];
$order_id =$_POST['order_id'];

$json_string = $_POST['update_data'];

$array_data = json_decode($json_string, TRUE);
$no=count($array_data)/3;

$new_amount=0;



for($k =0;$k < $no;$k++)
    {
     $productCode =$array_data['productCode'.$k];
     $qty =$array_data['quantity'.$k];
     $price =$array_data['price'.$k];
   $total = $qty * $price;
   $new_amount = $new_amount + $total;

     mysqli_query($con,"UPDATE `order_info` SET `qty`='$qty' WHERE `order_id`='$order_id' AND `v_code`='$c_code' AND  `product_code`='$productCode'");



    }


          $result=mysqli_query($con,"SELECT * FROM `vendor_order` WHERE `v_code`='$c_code' AND `order_id` ='$order_id'");
         $data = mysqli_fetch_assoc($result);
          $old_amount=$data["amount"];

            mysqli_query($con,"UPDATE `vendor_order` SET`amount`='$new_amount' WHERE `v_code`='$c_code' AND `order_id` ='$order_id'");


      $result_client= mysqli_query($con,"SELECT * FROM `client_order` WHERE `order_id`='$order_id'");
      $data_client = mysqli_fetch_assoc($result_client);
     $old_client_amount=$data_client["amount"];
     $from_cash=$data_client["from_cash"];
     $due=$data_client["due"];
    $from_wallet=$data_client['from_wallet'];



       $diffrent = abs($old_client_amount - $old_amount);
    $new_update_amount = $new_amount + $diffrent;

     $due = 0 ;
     $new_from_cash=0;



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
              
                
                
                
                
                
            }
            
      
        }




    //   if($from_cash !="0")
    //     {
    //       $new_from_cash = $new_update_amount ;
    //       $due = $new_update_amount ;
    //     }else
    //     {

    //       $from_wallet =  $new_update_amount-$from_wallet;
    //     }

    //     if($from_wallet !="0")
    //       {
    //         $due = $new_update_amount-$from_wallet ;
    //       }


//echo "<br> UPDATE `client_order` SET `amount`='$new_update_amount',`from_cash`='$new_from_cash',`from_wallet`='$from_wallet',`due`='$due' WHERE `order_id`='$order_id'";
     $re = mysqli_query($con,"UPDATE `client_order` SET `amount`='$new_update_amount',`from_cash`='$new_from_cash',`from_wallet`='$from_wallet',`due`='$due' WHERE `order_id`='$order_id'");
     
     
     if($re){
        echo json_encode(array('status'=>'ok', 'message'=> 'order updated')); 
     }else
     {
         echo json_encode(array('status'=>'ok', 'message'=> 'error'));
     }
     


    }
}



 

?>

