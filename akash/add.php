<?php
include('conn.php');
$name=$_REQUEST['name'];
$adhar=$_REQUEST['adhar'];
$contect=$_REQUEST['contect'];
$json_array=array($name,$adhar,$contect)
$query="INSERT INTO data VALUES('$name','$adhar','$contect')"; 
$data=mysqli_query($conn, $query);
if($data)
{
    echo "data is insrted";
    echo json_encode($json_array,JSON_FORCE_OBJECT);
}
else
{
    echo "sorry!data is not inserted";
}
?>