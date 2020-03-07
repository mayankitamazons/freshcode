<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION["bill_admin_id"]))
{
 if((time() - $_SESSION['last_time']) > 120) // Time in Seconds
 {

// header("location:common/log-out.php");
 }
 else
 {
 $_SESSION['last_time'] = time();

 }
}
else
{
 header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<?php

include("common/connect.php");
  $bill_no=$_GET["id"];
 $query= mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id` = '$bill_no'");

 $b = mysqli_fetch_assoc($query);
 $cust_id=$b["cust_id"];
 $billing_name=$b["billing_name"];


 $getInvoiceId= mysqli_query($con,"SELECT * FROM `bill_info` WHERE `order_id` = '$bill_no'");

 $d = mysqli_fetch_assoc($getInvoiceId);
 $invoice_id=$d["invoice_id"];
 $invoice_date=$d["order_date"];
 $getdate= mysqli_query($con,"SELECT * FROM `fb_order` WHERE `order_id` = '$bill_no'");
   $c = mysqli_fetch_assoc($getdate);

 $dat=$c["bill_date"];
 $payment_method=$c["payment_method"];
date_default_timezone_set("Asia/Kolkata");


 $query= mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` = '$cust_id'");

 $b = mysqli_fetch_assoc($query);
 $cname=$b['cust_name'];
 $address=$b['address'];
 $state=$b['state'];
 $gst_no=$b['gst_no'];
 $pincode=$b['pincode'];
 $mobile=$b['mobile'];
 $city=$b['city'];
 $area=$b['area'];
?>
<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:36 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="assets/images/s.png">

        <title> Fresh Brigade</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>



    </head>
<script>


 


function PrintElem(elem)
{
	var divContents = $("#wp").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
    // var mywindow = window.open('', 'PRINT', 'height=600,width=1000');



    // mywindow.document.write(document.getElementById(elem).innerHTML);


    // mywindow.document.close(); // necessary for IE >= 10
    // mywindow.focus(); // necessary for IE >= 10*/

    // mywindow.print();
    // mywindow.close();



    // divToPrint=document.getElementById(elem);
   // newWin= window.open("");
   // newWin.document.write(divToPrint.outerHTML);
   // newWin.print();
   // newWin.close();

    return true;
}</script>


        <!--

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php

                include("common/header.php");

            ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

         <?php

                        include("common/sidebar.php");




                    ?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="panel-body table-responsive">
  <div class="panel-footer"  > <button class="btn btn-inverse btn-rounded waves-effect waves-light" onClick=" PrintElem('wp')" style="margin:10px;">Print</button> </div>
  

        	<div align="center" style="width:659px;height:942px;margin-left:auto;margin-right:auto;padding:5px;"  id="wp">
			<style>
.border {
    border-bottom:solid;border-bottom-style:solid;border-bottom-width:thick;border-width:1px;
}
.space{
	margin:5px;
}
</style>


	<center>
	<br><br>
		<table cellspacing="0" cellpadding="0" style="width:695px; height:auto;color: black;; " border="0">
			<col width="64" span="12"></col>
			  <tr  >
     <th colspan="4"  style="text-align: left;"><img src="image/po.jpg" width="150px" height="75px" /></th>
    <th  colspan="8" style="text-align: left" >Fresh Brigade <br>6th Floor Bhamashah Technohub, Jhalana Dungari,<br>Jaipur, Rajasthan, India 302020<br> Phone : +91 9116156256<br>Website : https://www.freshbrigade.com</th>

  </tr>
			</table><br><br><br>

		<table cellspacing="0" cellpadding="0" style="width:695px; height:auto;color: black;border-collapse: collapse;"   >

<col width="64" span="12"></col>



  <tr  width="100%" >
 	<td colspan="12">
	<table width="100%" border="2px" style="border-bottom: 0px;color: black;border-collapse: collapse; " >
		 <tr  colspan="12">
    <td   width="50%" style="padding:10px;  ;"  colspan="6">Invoice : <?php echo "J",$invoice_id ; ?><br>Invoice Date : <?php echo $invoice_date ; ?><br>Company GSTIN : 08CBGPK7718A3ZQ</td>
    <td  width="50%" style="padding:10px;"  colspan="6">Order : <?php echo $bill_no;?> <br>  Order Date : <?php echo $invoice_date ; ?> <br> Customer GSTIN : -<?php echo $gst_no; ?></td>
  </tr>
	</table>
	</td>

  </tr>


    <tr  width="100%" >
 	<td colspan="12">
	<table width="100%" border="2px" style="color: black;border-collapse: collapse;padding-left:10px;" >
		 <tr  height="50px" colspan="12">

  <th width="50px" align="left" style="text-align:center; border-bottom: 0px;padding:10px;"  colspan="10">BILLED TO</th>
    <th style="padding:10px;text-align:center;" width="50%" colspan="6" align="left">PAYMENT METHOD</th>
  </tr>

  <tr   colspan="12">

  <td width="50%" style="padding:10px; " colspan="10"><?php echo $billing_name; ?>
  <br>
  <?php echo $address.", ".$area; ?> <br>
  <?php echo $city.", ".$state.", ".$pincode; ?> <br>
  <?php echo $mobile; ?> <br>





  </td>
    <td style="padding:10px; "width="50%" colspan="6"><?php echo $payment_method ;?></td>
  </tr>
	</table>
	</td>

  </tr>


	</table>

	</td>

  </tr>




 </table>


		<br><br>
  <table cellspacing="0" cellpadding="0" style="width:695px; height:auto;border-collapse: collapse;color: black;" border="2px" >
		<col width="64" span="12"></col>
	<tr>
    <th style="text-align:center;" width="20px">S No.</th>
    <th style="text-align:center;" width="100px" colspan="4">Product</th>
    <th style="text-align:center;" width="100px" colspan="4">Hindi Name</th>
    <th style="text-align:center;" width="40px">Qty.</th>
    
	<th  style="text-align:center;" width="40px">Price</th>
    <th style="text-align:center;" width="50px"  colspan="2">Subtotal</th>
  </tr>


  <?php
  $i=1;
  $total=0;
  $getdata= mysqli_query($con,"SELECT * FROM `fb_order` WHERE `order_id` = '$bill_no' ORDER BY fb_order.sn");
  while($b = mysqli_fetch_assoc($getdata))
	  {
        $qty=$b["qty"];

        if($qty!="")
        {

        

      $product=$b["product"];
      $price=$b["price"];
     
      $sub_total=$b["sub_total"];
      $delivery_fee=$b["delivery_fee"];
      $total=$total+$sub_total;


      $getProductInfo= mysqli_query($con,"SELECT * FROM `fb_product` WHERE `code` = '$product'");
      $info = mysqli_fetch_assoc($getProductInfo);
      $productName=$info["product_name"];
      $productNameHindi=$info["product_hindi_name"];
      $Unit=$info["unit"];


    ?>

<tr>
<td  style="text-align:center;border-left: 1px solid black;" ><?php echo $i ;?></td>
    <td style="text-align:center;border-left: 1px solid black;"colspan="4" ><?php echo $productName ;?></td>
    <td style="text-align:center;border-left: 1px solid black;" colspan="4"><?php echo $productNameHindi ;?></td>
    <td style="text-align:center;border-left: 1px solid black;"  ><?php echo $qty ;?></td>
    <td style="text-align:center;border-left: 1px solid black;"><?php echo $price ;?></td>
	   <td style="text-align:center;border-left: 1px solid black;"  colspan="2"><?php echo   round($sub_total, 3); ?></td>

     </tr>
<?php
$i=$i+1;
        }
  }
?>




  </table>

		<br><br>
	<table cellspacing="0" cellpadding="0" style="width:695px; border-collapse: collapse;height:auto;color: black; " border="0" >
	   <tr>
	    <td  style="text-align: right " colspan="10" >Subtotal : </td>
	    <td  style="text-align: right; padding-right: 10px " colspan="2" > Rs. <?php echo $total;?>  </td>
	   </tr>

	   </td>
    <tr >

    <td style="text-align: right "  colspan="10" >Order Discount</td>
<td style="text-align: right; padding-right: 10px "  colspan="2" >0</td>

  </tr>
	 <tr >
     <td style="text-align: right "  colspan="10">Delivery Fee :  </td>
    <td style="text-align: right; padding-right: 10px "  colspan="2"><?php echo $delivery_fee ;?>  </td>
  </tr>

  <tr>
    <td style="text-align: right" colspan="10">Grand Total :  </td>
	<th style="text-align: right; padding-right: 10px " colspan="2">Rs. <?php echo $total+$delivery_fee;?>  </th>
  </tr>
   </table>
		</center>


		</div>
				</div>

             
									</div>
                            </div>
                        </div>



                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    &copy; 2016 - 2018. All rights reserved.
                </footer>

            </div>

	<?php	function numberTowords($num)
{
$ones = array(
1 => "one",
2 => "two",
3 => "three",
4 => "four",
5 => "five",
6 => "six",
7 => "seven",
8 => "eight",
9 => "nine",
10 => "ten",
11 => "eleven",
12 => "twelve",
13 => "thirteen",
14 => "fourteen",
15 => "fifteen",
16 => "sixteen",
17 => "seventeen",
18 => "eighteen",
19 => "nineteen"
);
$tens = array(
1 => "ten",
2 => "twenty",
3 => "thirty",
4 => "forty",
5 => "fifty",
6 => "sixty",
7 => "seventy",
8 => "eighty",
9 => "ninety"
);
$hundreds = array(
"hundred",
"thousand",
"million",
"billion",
"trillion",
"quadrillion"
); //limit t quadrillion
$num = number_format($num,2,".",",");
$num_arr = explode(".",$num);
$wholenum = $num_arr[0];
$decnum = $num_arr[1];
$whole_arr = array_reverse(explode(",",$wholenum));
krsort($whole_arr);
$rettxt = "";
foreach($whole_arr as $key => $i){
if($i < 20){
$rettxt .= $ones[$i];
}elseif($i < 100){
$rettxt .= $tens[substr($i,0,1)];
$rettxt .= " ".$ones[substr($i,1,1)];
}else{
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
$rettxt .= " ".$tens[substr($i,1,1)];
$rettxt .= " ".$ones[substr($i,2,1)];
}
if($key > 0){
$rettxt .= " ".$hundreds[$key]." ";
}
}
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}

?>


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

        <script type="text/javascript">

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>





    </body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>
