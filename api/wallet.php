<?php


require "conn.php";
if( empty($_POST['c_code']) || empty($_POST['action']))
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if( !isset($_POST['c_code']) || !isset($_POST['action']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{

 $c_code = $_POST['c_code'];
 $action = $_POST['action'];




if($action=="get")
    {
      $wallet_Data= mysqli_query($con, "SELECT * FROM `wallet` WHERE `c_code` ='$c_code'");
     $data = mysqli_fetch_assoc($wallet_Data);
     $activation_status=$data['activation_status'];

               $credit_amount=$data['credit_amount'];
               $pending_amount=$data['pending_amount'];
               $credit_date=$data['credit_date'];
               $expire_date=$data['expire_date'];
               $new_credit_value=$data['value'];
               $expire_day=$data['expire_day'];
                $per_day=$data['per_day'];
               $last_day_use=$data['last_day_use'];
                $per_day_use=$data['per_day_use'];
                   $value=$data['value'];
                 $todayDate =date('d-m-Y');

                if(strtotime($todayDate)!=strtotime($last_day_use))
                {

                      mysqli_query($con,"UPDATE `wallet` SET `per_day`='$per_day',`per_day_use`='0',`last_day_use`='$todayDate' WHERE `c_code`='$c_code'");


                }

                    $new_expire_date = date('d-m-Y', strtotime($todayDate. ' + '.$expire_day.' days'));



$datediff = strtotime($expire_date) - strtotime($todayDate) ;

 $days= round($datediff / (60 * 60 * 24));




     switch ($activation_status)
        {

          case 'u_n_a':
                         echo json_encode(array('status'=>'ok','activation_status'=>$activation_status));

            break;

        case 'pending':
                          echo json_encode(array('status'=>'ok','activation_status'=>$activation_status));

            break;

        case 'active':



               if(strtotime($todayDate)<= strtotime($expire_date))
                    {


                            echo json_encode(array('status'=>'ok','activation_status'=>$activation_status,'credit_amount'=>$value,'pending_amount'=>$pending_amount
                                    ,'expire_date'=>$expire_date ,'days'=>$days));

                   }
                   else
                   {


                    if($pending_amount == "0")
                        {


                             mysqli_query($con, "UPDATE `wallet` SET  `credit_amount`='$new_credit_value',`credit_date`='$todayDate',`expire_date`='$new_expire_date'  WHERE `c_code`='$c_code'");


                            $datediff = strtotime($new_expire_date) - strtotime($todayDate) ;

                             $days= round($datediff / (60 * 60 * 24));

                             echo json_encode(array('status'=>'ok','activation_status'=>$activation_status,'credit_amount'=>$new_credit_value,'pending_amount'=>$pending_amount
                                    ,'expire_date'=>$new_expire_date,'days'=>$days));
                        }
                        else
                        {
                             mysqli_query($con, "UPDATE `wallet` SET  `credit_amount`='0',`activation_status` ='due' WHERE `c_code`='$c_code'");
                              echo json_encode(array('status'=>'ok','activation_status'=>'due'));


                        }

                   }


            break;


         case 'due':



                          if($pending_amount=='0')
                        {

                             mysqli_query($con, "UPDATE `wallet` SET `activation_status` ='active', `credit_amount`='$new_credit_value',`credit_date`='$todayDate',`expire_date`='$new_expire_date'  WHERE `c_code`='$c_code'");

                            $datediff = strtotime($new_expire_date) - strtotime($todayDate) ;

                             $days= round($datediff / (60 * 60 * 24));

                           echo json_encode(array('status'=>'ok','activation_status'=>'active','credit_amount'=>$new_credit_value,'pending_amount'=>$pending_amount
                                    ,'expire_date'=>$new_expire_date,'days'=>$days));

                        }
                        else
                        {

                             echo json_encode(array('status'=>'ok','activation_status'=>"due",'pending_amount'=>$pending_amount
                                    ,'expire_date'=>$expire_date));
                        }



            break;


        default:

             echo json_encode(array('status'=>'ok','activation_status'=>$activation_status));


         }

    }
    else
    {

         $wallet_update= mysqli_query($con, "UPDATE `wallet` SET `activation_status`='pending' WHERE `c_code`='$c_code'");

         if($wallet_update)
         {
             echo json_encode(array('status'=>'ok','activation_status'=>'pending'));
         }else
         {
              echo json_encode(array('error'=>'request faield'));
         }


    }



}
}
