<?php
 include('conn.php');
 $number=$_REQUEST['number'];
 $adhar=$_REQUEST['adhar'];
 $password=$_REQUEST['password'];
 $sql="INSERT INTO adddata VALUES('$number','$adhar','$password')";
 $data=mysqli_query($conn, $sql);
 if($data)
 {
     echo "data is inserted";
 }
 else
 {
     echo "not inserted";
 }
 ?>