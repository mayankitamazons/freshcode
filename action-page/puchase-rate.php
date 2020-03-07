<?php
include("../common/connect.php");

$query = mysqli_query($con,"SELECT * FROM `purchase_rate_info`  ORDER BY id DESC");
$data = mysqli_fetch_assoc($query);
error_reporting(0);

$a=$data["id"];
echo $b=substr($a,1);
if ($b=='')
{
	 $b=101;
}
else
{
	 $b=$b+1;
}


 $code="P".$b;

$dateOfDate= CURRENT_TIMESTAMP;

date_default_timezone_set('Asia/Kolkata');


  $new_date = date('d-M-Y');


/////////////////////////





$sql="SELECT * FROM `purchase_rate` WHERE  `date` = '$new_date' ";	

$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_assoc($result);

	echo "<script type=\"text/javascript\">
             alert(\"User alreay added data for today.\");
              window.location = \"../purchase.php\"
             </script>";    
} else
{

  
        
     /////
$m_total=0;
 foreach($_REQUEST['total'] as $key => $value)
  {
	 $product_code=$_REQUEST['code'][$key];
     $tot=$_REQUEST['total'][$key];
      $vendor=$_REQUEST['vendor'][$key];
	 	 $qty=$_REQUEST['qty'][$key];
	 if($qty!="")
	 {

	 
$price= $tot/$qty;

$m_total=$m_total + $tot;


	 mysqli_query($con,"INSERT INTO `purchase_rate_info`( `vcode`,`id`, `p_code`, `price`, `qty`, `total`, `dateee`) 
	 VALUES ('$vendor','$code','$product_code','$price','$qty','$tot','$new_date')");



}
  }

	 mysqli_query($con,"INSERT INTO `purchase_rate`( `id`, `date`, `tot`) VALUES ('$code','$new_date','$m_total')");


 echo "<script>
 alert('Saved');
 window.location.href='../purchase.php';
 </script>";
           
        

 
}








?>
