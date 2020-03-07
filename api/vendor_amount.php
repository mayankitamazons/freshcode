<?php


require "conn.php";
$response=array();
$data_amt=array();
$data_full=array();
if( empty($_POST['v_code']) || empty($_POST['action']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if( !isset($_POST['v_code']) || !isset($_POST['action']) )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

$v_code = $_POST['v_code'];
$action = $_POST['action'];



if($action=='client')
{
    
 $sql_client =mysqli_query($con,"SELECT client.c_code, client.c_name FROM client INNER JOIN order_info ON client.c_code=order_info.c_code where order_info.v_code='$v_code' GROUP BY order_info.c_code DESC");


         while($data = mysqli_fetch_assoc($sql_client))
        {
             $c_name =$data['c_name']; 
             $c_code =$data['c_code']; 
             
             
    
             
             
               array_push($data_full,array("c_code"=>$c_code,"c_name"=>$c_name)); 
                
        }
        
        
        
        
           echo json_encode($data_full);
    
}

if($action=='order')
{

$c_code = $_POST['c_code'];
  
        $sql_client_data =mysqli_query($con,"SELECT * FROM `order_info` WHERE `v_code`='$v_code' AND `c_code`='$c_code' GROUP BY `order_id` ORDER BY `sn` DESC" );
     
          while($data_order_id = mysqli_fetch_assoc($sql_client_data))
        {
             $order_id =$data_order_id['order_id']; 
             $order_date =$data_order_id['order_date']; 
             
             
             
               $sql_client2 =mysqli_query($con,"SELECT order_info.order_id ,vendor_order.amount FROM `order_info` INNER JOIN vendor_order ON order_info.order_id=vendor_order.order_id WHERE order_info.`c_code`='$c_code' AND vendor_order.order_id='$order_id' GROUP BY `order_id`");
                $data2 = mysqli_fetch_assoc($sql_client2);
                  $amount  =$data2['amount']; 
                  
                  array_push($data_amt,array("order_id"=>$order_id,"order_date"=>$order_date,"amount"=>$amount));  

        }
        
        
        
        
           echo json_encode($data_amt);
    
}


if($action=='amount')
{

$order_id = $_POST['order_id'];
  
             $sql_order_payment_history2 =mysqli_query($con,"SELECT * FROM `vendor_amount` WHERE `v_code`='V101' AND `order_id`='OD101' ORDER BY `sn` DESC LIMIT 1" );
             $data_order_payment2 = mysqli_fetch_assoc($sql_order_payment_history2);
             
                $due_total =$data_order_payment2['due_amount'];  
                $paid_total =$data_order_payment2['paid_amount'];  
                $tot_amount=0;
                
                
                   $sql_order_payment_history11 =mysqli_query($con,"SELECT * FROM `vendor_amount` WHERE `v_code`='$v_code' AND `order_id`='$order_id' ORDER BY `sn` DESC" );
                
                          while($data_order_payment32 = mysqli_fetch_assoc($sql_order_payment_history11))
        {   
                              $amount2 =$data_order_payment32['amount']; 
                              $tot_amount =$tot_amount + $amount2;
        }
               
              $sql_order_payment_history =mysqli_query($con,"SELECT * FROM `vendor_amount` WHERE `v_code`='$v_code' AND `order_id`='$order_id' ORDER BY `sn` DESC" );
             
     
                while($data_order_payment = mysqli_fetch_assoc($sql_order_payment_history))
        {
                $amount =$data_order_payment['amount'];  
                $due_amount =$data_order_payment['due_amount'];  
                $paid_amount =$data_order_payment['paid_amount'];  
                $pay_date =$data_order_payment['pay_date'];  
             
             
                array_push($response,array("due_total"=>$due_total,"total_amount"=>$tot_amount,"amount"=>$amount,"due_amount"=>$due_amount,"paid_amount"=>$paid_amount,"pay_date"=>$pay_date ));
                
        }
        
        
        
        
           echo json_encode($response);
    
}


      
    
}
}
