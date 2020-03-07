<?php


require "conn.php";
if( empty($_POST['c_code']) ||  empty($_POST['prodcutcode']) ||  empty($_POST['action']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['c_code']) || !isset($_POST['prodcutcode'])  || !isset($_POST['action']) )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$c_code = $_POST['c_code'];
$product =$_POST['prodcutcode'];
$action =$_POST['action'];

if($action=='add')
    {

        $sql="SELECT * FROM `add_to_kart` WHERE `c_code`='$c_code' && `product_code`='$product'";
         $result=mysqli_query($con,$sql);
         $row = mysqli_num_rows($result);

           if($row==0)
        {
            mysqli_query($con,"INSERT INTO `add_to_kart`(`c_code`, `product_code`)VALUES ('$c_code','$product')");

             echo json_encode(array('status'=>'ok', 'message'=> 'Product add to kart succese'));
        } else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'product already add'));
        }


          $sql_auto_vendor_select="SELECT * FROM `client_vendor_selection` WHERE `c_code`='$c_code' && `product_code`='$product'";
         $result2=mysqli_query($con,$sql_auto_vendor_select);
         $row2 = mysqli_num_rows($result2);

          if($row2==0){
               mysqli_query($con,"INSERT INTO `client_vendor_selection`(`c_code`, `v_code`, `product_code`) VALUES ('$c_code','V101','$product')");
              }
    }
    
    else if($action=='all'){
         $result1= mysqli_query($con,"DELETE FROM `add_to_kart` WHERE `c_code`='$c_code'");
           
           if($result1)
        {

             echo json_encode(array('status'=>'ok', 'message'=> 'Product reset '));
        } else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'not reset'));
        }
        
        
        
    }
    else
    {
        $sql="DELETE FROM `add_to_kart` WHERE c_code='$c_code' && product_code='$product' ";
        // $sql="DELETE FROM `client_vendor_selection` WHERE c_code='$c_code' && product_code='$product' ";
         mysqli_query($con,"DELETE FROM `client_vendor_selection` WHERE c_code='$c_code' && product_code='$product'  ");
         $result=mysqli_query($con,$sql);


           if($result==true)
        {

             echo json_encode(array('status'=>'ok', 'message'=> 'Product remove from kart '));
        } else
        {
            echo json_encode(array('status'=>'alert', 'message'=> 'product already remove'));
        }

    }





    }
}

?>

