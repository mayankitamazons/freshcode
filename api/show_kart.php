<?php

require "conn.php";
$response=array();
$c_code = $_POST['c_code'];
 $sql="SELECT * FROM `add_to_kart` WHERE `c_code`='$c_code'";
         $result=mysqli_query($con,$sql);
  while($dataa = mysqli_fetch_assoc($result))
    {

      $p_code=$dataa['product_code'];
     $sql="SELECT * FROM `fb_product` where `code`= '$p_code'";
    $result2=mysqli_query($con,$sql);

    $data = mysqli_fetch_assoc($result2);


         $sql_get_vendore="SELECT * FROM `client_vendor_selection` where `c_code`= '$c_code' && `product_code` ='$p_code'";
         $result_get_vendor=mysqli_query($con,$sql_get_vendore);

 while($data_get_vendor = mysqli_fetch_assoc($result_get_vendor))
    {


      $vendore_product_code=$data_get_vendor["product_code"];
      $vendore_code=$data_get_vendor["v_code"];


      $get_vendore_min_qty =mysqli_query($con,"SELECT * FROM `vendor_product_selection` WHERE `v_code`='$vendore_code' AND `product_code`='$vendore_product_code'");

      $data_get_vendor_min_qty = mysqli_fetch_assoc($get_vendore_min_qty);



       $min_qty=$data_get_vendor_min_qty["min_qty"];

       $sql_get_vendore_price="SELECT * FROM `today_price_list` where `v_code`= '$vendore_code' && `product_code`='$vendore_product_code'";
        $result_get_vendor_price=mysqli_query($con,$sql_get_vendore_price);
          $data_get_vendor_product_price=mysqli_fetch_assoc($result_get_vendor_price);

           $price=$data_get_vendor_product_price['today_price'];
            $yesterday_price=$data_get_vendor_product_price['yesterday_price'];


     $code=$data["code"];
     $pname=$data['product_name'];
     $hindi_pname=$data['product_hindi_name'];
     $img=$data['imagepath'];
     $de=$data["description"];
     $qty=$data["quantity"];

    $unit=$data["unit"];
    $product_status=$data["product_status"];
    $notify_for_quantity_below=$data["notify_for_quantity_below"];
    $minimum_sale_quantity=$data["minimum_sale_quantity"];
    $maximum_sale_quantity=$data["maximum_sale_quantity"];
    $qty_increment=$data["qty_increment"];
    $st=$data["in_stock"];


      if($vendore_product_code == $p_code)
      {
      array_push($response,array("productcode"=>$code,"pname"=>$pname,"hindi_pname"=>$hindi_pname,"img"=>$img,
       "de"=>$de,"qty"=>$qty,"unit"=>$unit,
        "notify_for_quantity_below"=>$notify_for_quantity_below,"minimum_sale_quantity"=>$minimum_sale_quantity,
        "maximum_sale_quantity"=>$maximum_sale_quantity,"qty_increment"=>$qty_increment,"st"=>$st,"v_code"=>$vendore_code,"price"=>$price,
        "yesterday_price"=>$yesterday_price, "min_qty"=>$min_qty));

      }
      else
      {

          array_push($response,array("productcode"=>$code,"pname"=>$pname,"hindi_pname"=>$hindi_pname,"img"=>$img,"de"=>$de,"qty"=>$qty,"price"=>$price,"unit"=>$unit,
        "notify_for_quantity_below"=>$notify_for_quantity_below,"minimum_sale_quantity"=>$minimum_sale_quantity,
        "maximum_sale_quantity"=>$maximum_sale_quantity,"qty_increment"=>$qty_increment,"st"=>$st,"v_code"=>$vendore_code,"price"=>$price,"yesterday_price"=>$price,$yesterday_price));

      }


    }



    }
 echo json_encode($response);
 $response=array();
?>
