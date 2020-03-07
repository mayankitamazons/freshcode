<?php



$clientList=array();
$orderList=array();

require "conn.php";

if(empty($_POST['action']) || empty($_POST['code']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } 
    else {

if(!isset($_POST['action']) || !isset($_POST['code'])  )
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{
$code = $_POST['code'];
$action =$_POST['action'];

if($action=='get')
    {

        $sql="SELECT v_code,v_name FROM `vendor` WHERE `activation_status`='1' ORDER BY v_code ASC";
         $result=mysqli_query($con,$sql);

         while($data = mysqli_fetch_assoc($result))
        {        
        
              array_push($clientList,$data);

        }
        
         echo json_encode(array("list"=>$clientList));
    }
      
    
    else if($action=='getPrice'){       
          

         $result=mysqli_query($con,"SELECT fb_product.product_name ,fb_product.product_hindi_name,
         fb_product.imagepath,today_price_list.v_code,today_price_list.product_code,
         today_price_list.today_price,today_price_list.yesterday_price,today_price_list.dat
         FROM today_price_list INNER JOIN fb_product ON today_price_list.product_code=fb_product.code 
         WHERE today_price_list.v_code='$code'");
         $row = mysqli_num_rows($result);
         while($data = mysqli_fetch_assoc($result))
        {          
        
              array_push($orderList,$data);

        }
        
        echo json_encode(array("list"=>$orderList));
        
        
        }

    
}

}

header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>