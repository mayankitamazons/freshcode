<?php
include('connection.php');
$p=$_REQUEST['product'];
$q=$_REQUEST['qty'];
$pr=$_REQUEST['price'];
$json_array=array("productname".$p,"qty".$q,"price".$pr);
$sql = "INSERT INTO products VALUES ('$p','$q','$pr')";

if ($conn->query($sql) === TRUE) {
    
    echo json_encode($json_array,JSON_FORCE_OBJECT);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
?>
<html>
    <head>
        
    </head>
    <body>
    <form action="" method="post">
        <input type="text" placeholder="enter product name" name="product" required>
        <br><br>
        <input type="text" placeholder="enter quantity" name="qty" required>
        <br><br>
        <input type="text" placeholder="enter price" name="price" required>
        <br>
        <input type="submit" value="add products" name="submit"> 
    </form>    
    </body>
</html>