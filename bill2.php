<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION["bill_admin_id"]))
{
 if((time() - $_SESSION['last_time']) > 120) // Time in Seconds
 {
	
 header("location:common/log-out.php");
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
 $query= mysqli_query($con,"SELECT * FROM `cust_invoice_info` WHERE `invoice_no` = '$bill_no'");
                               
 $b = mysqli_fetch_assoc($query);
 $cust_id=$b["cust_id"];

 
  $getdate= mysqli_query($con,"SELECT * FROM `bill_info` WHERE `invoice_no` = '$bill_no'");
   $c = mysqli_fetch_assoc($getdate);
 
 $dat=$c["bill_date"];

 
 date_default_timezone_set("Asia/Kolkata");
		
			
 $query= mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` = '$cust_id'");
                               
 $b = mysqli_fetch_assoc($query);
 $cname=$b['cust_name'];
 $address=$b['address'];
 $gst_no=$b['gst_no'];
 $state=$b['state'];
 $dist_no=$b['district'];
 $mobile=$b['mobile'];
 
 $query2= mysqli_query($con,"SELECT * FROM `geo_locations` WHERE `id` = '$dist_no'");
   $c = mysqli_fetch_assoc($query2);   
 $dist=$c['name'];   
 
  $query3= mysqli_query($con,"SELECT * FROM `geo_locations` WHERE `id` = '$state' AND `location_type` = 'State'");
   $d = mysqli_fetch_assoc($query3);   
 $state_code=$d['external_id'];   
                                                  


?>
<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:36 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

       
        <link rel="shortcut icon" href="assets/images/s.png">

        <title>Fresh Brigade</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    </head>
<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=600,width=1000');

  
   
    mywindow.document.write(document.getElementById(elem).innerHTML);
 

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

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
                             

                             
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item">Bill View</li>
                                    <li class="breadcrumb-item active">Print Bill </li>
                                </ol>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="panel-body table-responsive">
					
				
			<div align="center" style="width:659px;height:942px;margin-left:auto;margin-right:auto;padding:5px;" id="wp--">
			<style>
.border {
    border-bottom:solid;border-bottom-style:solid;border-bottom-width:thick;border-width:1px;
} 
.space{
	margin:5px;
}
</style>
              
			 
	<center>	
		<br />&nbsp;<br />&nbsp;<br />
		<table cellspacing="0" cellpadding="0" style="width:695px; height:auto;" border="1">
  <col width="64" span="9">
  <tr>
  		<td colspan="9">
		  <table width="100%">
		  <tr>
		  <td align="left" style="padding:3px;width:33.3%;"> Orignal/Duplicate</td>
		  <td align="center" style="padding:3px;width:33.3%;"> Tax Invoice </td>
		  <td align="right" style="padding:3px;width:33.3%;"> Cash/Credit Memo</td>
			</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td colspan="9" align="center"> <font size="+2"><strong>SANKHLA MOBILES</strong> </font><br>
      All Type of Mobile Available <br /> <div style="width:240px;border-bottom:1px solid black;">Sales and Service									
 <br>
	  </div>
      Main Bus Stand, <br />Sojat City(Pali) - 306104	  
	 </td>
  </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr >
    <td colspan="9">
	<table width="100%"> 
		<tr>
		
			<td align="left" style="padding-left:3px;width:33.3%;"> Mobile :    8561843188 </td>
			<td align="center" style="width:33.3%;"> State : Rajasthan Code : 08 </td>
			<td align="right" style="padding-right:3px;width:33.3%;"> GSTIN :    24BATPN8532Q1ZQ </td>
		
		</tr>
	</table>
	</td>
  
  </tr>
  <tr >
    <td colspan="5" style="padding-left: 5px;">
	<table width="100%"> 
		<tr>
			<td rowspan="5"> 
			To : <?php echo $cname;  ?><br>
			Address : <?php echo $add=$address.",".$dist;  ?><br>
			GSTIN : <?php echo $gst_no;  ?></br>
			State : <?php  $getDataS = mysqli_query($con,"SELECT * FROM `geo_locations` WHERE `id` = '$state' AND `location_type` = 'State'"); 
			$GetState = mysqli_fetch_assoc($getDataS);
			echo $GetState['name'];
			
			?></br>
			
			</td>
		</tr>
	</table>
	
	</td>
    <td colspan="4" style="padding-left: 5px;">
	<table width="100%"> 
		<tr>
			<td rowspan="5"> 
	Invoice No : <?php echo $bill_no; ?><br>
       Date : <?php echo $dat; ?><br>
    
      &nbsp;<br />
	  		</td>
		</tr>
	</table>
	  
	  </td>
  </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  
  
  
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr> </tr>
  <tr>
  <td colspan="9" >
  
  	
	
	
  <table width="100%" style="line-height:30px;border-left: 1px solid black;" >
  
	<tr >
    <th style="text-align:center;border: 1px solid black;padding:2px;" width="20px">Sr.no</th>
    <th colspan="2" style="text-align:center;border: 1px solid black;padding:2px;" width="345px">Description of Products&nbsp;</th>
    <th style="text-align:center;border: 1px solid black;padding:2px;" width="40px">HSN/SAC</th>
    <th style="text-align:center;border: 1px solid black;padding:2px;" width="40px">Qty.</th>
    <th style="text-align:center;border: 1px solid black;padding:2px;" width="50px">Rate&nbsp;</th>
    <th style="text-align:center;border: 1px solid black;padding:2px;" width="100px;">Amount&nbsp;</th>
  </tr>
 
 
  <?php 
  
 
  $i = 1;
   $query1= mysqli_query($con,"SELECT * FROM `bill_info` WHERE `invoice_no` = '$bill_no'");
  
                               
 while($getProduct = mysqli_fetch_assoc($query1))
 
  {
	  
	  
	  $pname=$getProduct["item"];
	  $price=$getProduct['price'];
	  $gst=$getProduct['gst'];
	  
	  $qty =$getProduct['qty'];
	  
		
		
			
			
			
	  	
  ?>
  <tr >
    <td align="center" style="padding:2px;"><?php echo $i; ?></td>
    
	<td colspan="2" style="border-left: 1px solid black;padding:2px;">  
	<?php 
	echo $pname;
	
	
	?>
	
	</td>
	
    <td  style="text-align:center;border-left: 1px solid black;padding:2px;" >&nbsp;</td>
    <td  style="text-align:center;border-left: 1px solid black;padding:2px;" width="30px"> <?php echo $qty; ?>  </td>
	
	
	
    <td  style="text-align:center;border-left: 1px solid black;padding:2px;">
	<?php echo $price; ?>
	</td>
    <td  style="text-align:center;border-left: 1px solid black;padding:2px;">
	<?php echo  $amount[] =$price * $qty  ;
	 $ta =$price * $qty  ;
			$gstamount[] =($gst*$price)/100;
			
			
		
			
		
			
	?>
	</td>
	
	
	
  </tr>
 
   <?php 
 $gstTotalAmount[] = array_sum($gstamount); 
  $i++;
   }
   
   
   ?>
  
  
  
  <tr height="<?php 
  if($i == 1) { echo '300'; }
  else if($i == 2) { echo '360'; }
  else if($i == 3) { echo '320'; }
  else if($i == 4) { echo '280'; }
  else if($i == 5) { echo '240'; }
  else if($i == 6) { echo '200'; }
  else if($i == 7) { echo '160'; }
  else if($i == 8) { echo '120'; }
  else if($i == 9) { echo '80'; }
  else if($i == 10) { echo '40'; }
   ?>">
  	<td style="padding:2px;" rowspan="6">&nbsp;  </td>
	<td style="border-left: 1px solid black;padding:2px;" colspan="2"  rowspan="6">&nbsp;  </td>
	<td style="border-left: 1px solid black;padding:2px;" rowspan="6">&nbsp;  </td>
	<td style="border-left: 1px solid black;padding:2px;" rowspan="6">&nbsp;  </td>
	<td style="border-left: 1px solid black;padding:2px;" rowspan="6">&nbsp;  </td>
	<td style="border-left: 1px solid black;padding:2px;" rowspan="6">&nbsp;  </td>
  </tr>
  
  
	
 
  

  		
  </table>
  
  </td>
  </tr>
  
  <tr >
    <td colspan="4" style="text-align:right;padding-right:5px;border-left: 1px solid black;padding:2px;"><strong>Total :</strong></td>

    <td colspan="3" style="text-align:right;border-left: 1px solid black;padding:2px;"><strong><?php echo $finalWithoutGSTAmount =  array_sum($amount); ?></strong></td>
  </tr>
   
  <tr>
  	<td colspan="4" style="padding-left:5px;"> 
		<table  style="width:100%;">
				<tr>
				<td> Bank Name&nbsp; :  </td> 
				<td> State Bank Of India  </td> 
				</tr>
				<tr>
				<td> Branch Name :  </td> 
				<td> Sojat </td> 
				</tr>
					<tr><td> Account Number : </td> <td>  34022039917 </td> </tr>
					<tr><td> Account Name : </td> <td> Nirmal Sankhla </td> </tr>
					<tr><td> IFSC : </td> <td> SBIN0007257
				</td>
			</tr>
		</table>
	</td>
	
	<td colspan="5" style="padding-left:5px;"> 
		<table width="100%" >
			<tr> 
				<td> 
					<table width="100%">
						<tr>
						<td colspan="2"> 
							<table width="100%" style="padding:2px;"> 
								<tr> 
									<td style="text-align:left;width:70%"> 
										Total Amount Before Tax :  
										
									</td>
									<td style="text-align:right;width:50%"> 
									<?php $num1 = $finalWithoutGSTAmount*$gst;
							$num2 = 100+$gst;
							$resultgst = $num1/$num2;
							$round = round($resultgst);
							echo $finalWithoutGSTAmount-$round; ?>/-
									</td>
								</tr>
								<tr> 
									<td style="text-align:left;width:50%"> 
										CGST 
										<?php if($state_code == 8) 
										{ $amt = $gst/2; echo'[ ';echo $amt;echo ' %]';} ?>
									</td>
									<td style="text-align:right;width:50%">
									<?php if($state_code == 8) 
										{ echo $round/2; } else { echo '0';} ?>/-
									</td>
								</tr>
								<tr>
									<td style="text-align:left;width:50%">
										SGST
										<?php if($state_code == 8) 
										{ $amt = $gst/2; echo'[ ';echo $amt;echo ' %]'; } ?>
									</td>
									<td style="text-align:right;width:50%">
									<?php if($state_code == 8) 
										{ echo $round/2; } else { echo '0';} ?>/-
									</td>
								</tr>
								<tr>
									<td style="text-align:left;width:50%">
										IGST
										<?php if($state_code != 8) 
										{ $amt = $gst; echo'[ ';echo $amt;echo ' %]';} ?>
									</td>
									<td style="text-align:right;width:50%">
									<?php if($state_code != 8) 
										{ echo $round; } else { echo '0';} ?>/-
									</td>
								</tr>
							</table>
						
						
						</td>			
						</tr>
						
						<tr>	
							<td style="text-align:left;width:50%"> GST Total Amount :</td> <td style="text-align:right;width:50%"> <?php echo $finalWithoutGSTAmount ?>/- </td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
  
  
  <tr>
    <td colspan="4" >
		
		<table style="width:100%; height:1cm;padding:3px;border-bottom: 1px solid black;" >
			<tr>
				<td style="padding:3px;"> 
					Total Amount in Words : </td>  <td> <strong> <strong style="text-transform:capitalize;"><?php echo numberTowords($finalWithoutGSTAmount); ?></strong></strong>
				</td>
			</tr>
			
		</table>
		
		<table style="width:100%; height:.5cm;margin-top:5px;">
			<tr>
				<td style="padding:3px;"> 
					<strong>Terms And Conditions :</strong><br />
					Subject to Pali Jurisdiction only
				</td>
			</tr>
			
			
		</table>
		
    </td>
  
  
    <td colspan="5" align="center">
	
	
	<table style="width:100%; height:3cm; text-align:center"  >
			<tr>
				<td> 
					<strong>For, SANKHLA MOBILES:</strong>
				</td>
			</tr>
			<tr>
				<td> 
					<strong>Authorised Signatury</strong>
				</td>
			</tr>
			
		</table>
	
	
	</td>
  </tr>
 </table>
		
		
		</center>
		
			
		</div>
				</div>
				
               <div class="panel-footer"> <button onClick=" PrintElem('wp--')" style="margin:10px;">Print</button> </div>

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