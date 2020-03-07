<?php
require "../common/connect.php";
$response = array();
$vendorArray = array();



$sql = mysqli_query($con, "SELECT * FROM `buylist` ORDER BY `buylist`.`sn` DESC ");
$dataid = mysqli_fetch_assoc($sql);
$buydataid = $dataid["id"];

$sqlbuyList = mysqli_query($con, "SELECT * FROM `buy_list_data` INNER JOIN fb_product ON fb_product.code=buy_list_data.pcode WHERE `id`=$buydataid");
//$dataList = mysqli_fetch_assoc($sqlbuyList);


while ($data = mysqli_fetch_assoc($sqlbuyList)) {

    array_push($response, $data); 

}


$sqlVendor = mysqli_query($con, "SELECT * FROM `vendor`");



while ($dataVendor = mysqli_fetch_assoc($sqlVendor)) {

    array_push($vendorArray, $dataVendor);
}




echo json_encode (array("vendor" => $vendorArray,"product"=> $response));

?>