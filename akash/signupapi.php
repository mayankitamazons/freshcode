<?php
include('connection.php');
$user=$_REQUEST['username'];
$pass=$_REQUEST['password'];
$json_array=array($user,$pass);
$sql = "SELECT *FROM user_ragistration WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //cheack user is allready ragister or not
    while($row = $result->fetch_assoc()) {
        include('exeistuser.html');
        include('akashadminsignup.html');
    }
} else {
    $insert = "INSERT INTO user_ragistration VALUES ('$user', '$pass')";
    if ($conn->query($insert) === TRUE) {
    echo "New record created successfully";
    echo json_encode($json_array,JSON_FORCE_OBJECT);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();

?>
