<?php
include('connection.php');
$id=$_REQUEST['id'];
$price=$_REQUEST['price'];
$sql = "UPDATE products SET price='$price' WHERE id='$id' ";
$json_array=array($id,$price);
if(isset($_POST['submit']))
{
if ($conn->query($sql) === TRUE) {
    echo json_encode($json_array,JSON_FORCE_OBJECT) ;
} else {
    echo "Error updating record: " . $conn->error;
}
}
$conn->close();
?>
<html>
    <head>
        
    </head>
    <body>
    <form action="" method="post">
        <input type="number" placeholder="enter price to update" name="price" required>
        <br>
         <input type="number" placeholder="enter id number" name="id" required>
        <br><br>
         <input type="submit" value="update" name="submit">
    </form>    
    </body>
</html>