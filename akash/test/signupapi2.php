<?php
include('conn.php');
 header('Content-Type: application/json');
 /**
 User Registeration
 */
 class Register
 {
 private $db;
 private $connection;
 function __construct()
 {
 //constructor call
 $this->db = new DB_Connection();
 $this->connection=$this->db->get_connection();
 }
 public function does_user_exist($name,$mail,$mobile,$add,$pass)
 {
 // does user already exist or not
 $query = "SELECT * FROM json email='$mail' ";
 $result=mysqli_query($this->connection,$query);
 if(mysqli_num_rows($result)>0){
$json['status']=400;
$json['message']=' Sorry '.$mail.' is already exist.';
   echo json_encode($json);
   mysqli_close($this->connection);
 }else {
   $query="insert into json(name,email,phone,address,password) values('$name','$mail','$mobile','$add','$pass')";
   $is_inserted=mysqli_query($this->connection,$query);
   if($is_inserted == 1){
$json['status']=200;
     $json['message']='Account created, Welcome '.$name;
   }else {
$json['status']=401;
     $json['message']='Something wrong';
   }
   echo json_encode($json);
   mysqli_close($this->connection);
 }
 } 
 }
 $register=new Register();
 if(isset($_POST['name'],$_POST['email'],$_POST['mobile'],$_POST['address'],$_POST['password']))
 {
   $name=$_POST['name'];
   $mail=$_POST['email'];
   $mobile=$_POST['mobile'];
 $add=$_POST['address'];
   $pass=$_POST['password'];
 if (!empty($name) && !empty($mail) && !empty($mobile) && !empty($add) && !empty($pass)) {
     $encrypted_password=md5($pass);
     $register-> does_user_exist($name,$mail,$mobile,$add,$encrypted_password);
   }else {
$json['status']=100;
     $json['message']='You must fill all the fields';
     echo json_encode($json);
   }
 }

?>