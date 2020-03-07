<?php

require "conn.php";
$response=array();
if( empty($_POST['v_code']) )
    {
        echo json_encode(array('status'=>'error', 'message'=>'feilds are required'));
    } else {

if(  !isset($_POST['v_code']))
{
    echo json_encode(array('status'=>'error', 'message'=>'feild name problem'));
}
else{




$v_code = $_POST['v_code'];

$sql="SELECT fb_product.imagepath,fb_product.product_name,today_price_list.today_price,today_price_list.yesterday_price ,today_price_list.dat FROM today_price_list INNER JOIN fb_product ON today_price_list.product_code = fb_product.code WHERE today_price_list.v_code='$v_code'";
         $result=mysqli_query($con,$sql);



    while($data = mysqli_fetch_assoc($result))
    {


     $pname=$data['product_name'];

     $img=$data['imagepath'];
     $dat=$data['dat'];


$dt = new DateTime($dat);
$dt->format('d-m-Y');


    $today_price=$data['today_price'];
     $yesterday_price=$data['yesterday_price'];






        array_push($response,array("pname"=>$pname,"img"=>$img,"today_price"=>$today_price,"yesterday_price"=>$yesterday_price,"dat"=>$dt->format('d-m-Y')));

                 }




 echo json_encode($response);

}}
?>
