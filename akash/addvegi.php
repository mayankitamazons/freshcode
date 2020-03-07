<?php
include('connection.php');
$vname=$_POST['veginame'];
$sql="INSERT INTO saveproduct VALUES('$vname')";
$data=mysqli_query($conn, $sql);
if($data)
{
echo "data is inserted";
}
else
{
echo "data is not inserted";
}
?>