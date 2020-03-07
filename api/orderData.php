<?php

require "conn.php";

  $json_string = $_POST['data'];


$data = json_decode($json_string, TRUE);

print_r($data);

 echo $data['productCode0'];

echo $no=count($data);

#for($i =0;i<=$no;$i++){
#
#    echo $data[$i]['name'];
#    }


?>
