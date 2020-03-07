<?php  
mysqli_connect('localhost','root','');
mysqli_select_db("bill");


$state_id=$_POST['state'];
$sql=mysqli_query($con,"SELECT * FROM `city` WHERE `state_id` = '$state_id' ORDER BY `city`.`cityname` ASC") or die(mysqli_error());

while($var=mysqli_fetch_array($sql))
{
echo "<option value=$var[city_id]>$var[cityname]</option>";
 }

if(isset($_POST['citysub']) && !empty($_POST['citysub']))
{ 
   $citysub=$_POST['citysub'];
}
?>