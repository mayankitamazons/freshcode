<?php 

ob_start();
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
 $pincode=$b['pincode'];
 $mobile=$b['mobile'];
 $city=$b['city'];
 $area=$b['area'];


 
 $i=1;
 $total=0;
 $getdata= mysqli_query($con,"SELECT * FROM fb_order WHERE order_id ='$bill_no'");
 while($b = mysqli_fetch_assoc($getdata))
   {

     $product=$b["product"];
     $price=$b["price"];
     $qty=$b["qty"];
     $sub_total=$b["sub_total"];
     $delivery_fee=$b["delivery_fee"];
     $total=$total+$sub_total;


     $getProductInfo= mysqli_query($con,"SELECT * FROM fb_product WHERE code = '$product'");
     $info = mysqli_fetch_assoc($getProductInfo);
     /*echo '<pre>';print_r($info);exit;
     $productName=$info["product_name"];
     $productNameHindi=$info["product_hindi_name"];
     $Unit=$info["unit"];*/

$demo='<tr>
<td  style="text-align:center;border-left: 1px solid black;" >adsfsdfdsf</td>
    </tr>'.

$i=$i+1;
 }


 // echo '<pre>';print_r($demo);exit;




        //load the view and saved it into $html variable
        $html='<!DOCTYPE html>
        <html>        
        <head>
      

       

    </head>


    <body class="fixed-left">

        <div id="wrapper">  
               <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="panel-body table-responsive">


        


	<center>
	<br><br>
		<table cellspacing="0" cellpadding="0" style="width:695px; height:auto;color: black;; " border="0">
			<col width="64" span="12"></col>
			  <tr  >
     <th colspan="4"  style="text-align: left;"><img src="image/logo.png" width="150px" height="75px" /></th>
    <th  colspan="8" style="text-align: left" >Fresh Brigade <br>6th Floor Bhamashah Technohub, Jhalana Dungari,<br>Jaipur, Rajasthan, India 302020<br> Phone : +91 9116156256<br>Website : https://www.freshbrigade.com</th>

  </tr>
			</table><br><br><br>

		<table cellspacing="0" cellpadding="0" style="width:695px; height:auto;color: black;border-collapse: collapse;"   >

<col width="64" span="12"></col>



  <tr  width="100%" >
 	<td colspan="12">
	<table width="100%" border="2px" style="border-bottom: 0px;color: black;border-collapse: collapse; " >
		 <tr  colspan="12">
    <td   width="50%" style="padding:10px;  ;"  colspan="6">Invoice : '.$invoice_id .'<br>Invoice Date : '. $invoice_date.'<br>Company GSTIN : 08AACCF9649M1ZX</td>
    <td  width="50%" style="padding:10px;"  colspan="6">Order : '.$bill_no.' <br>  Order Date :'. $invoice_date .' <br> Customer GSTIN : -</td>
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

  <td width="50%" style="padding:10px; " colspan="10">'.$billing_name.'
  <br>
  '.$address.'", "'.$area.' <br>
  '. $city.'", "'.$state.'", "'.$pincode.'<br>
  '.$mobile.'<br>





  </td>
    <td style="padding:10px; "width="50%" colspan="6">'.$payment_method .'</td>
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
    <th style="text-align:center;" width="100px" colspan="3">Product</th>
    <th style="text-align:center;" width="100px" colspan="3">Hindi Name</th>
    <th style="text-align:center;" width="40px" >Qty.</th>
    <th style="text-align:center;" width="40px" >Unit</th>
    <th style="text-align:center;" width="40px">Tax<br>    %</th>
    <th style="text-align:center;" width="40px">Discount %</th>
	<th  style="text-align:center;" width="40px">Price</th>
    <th style="text-align:center;" width="50px">Subtotal</th>
  </tr>


  '.$demo.'



  </table>

		<br><br>
	<table cellspacing="0" cellpadding="0" style="width:695px; border-collapse: collapse;height:auto;color: black; " border="0" >
	   <tr>
	    <td  style="text-align: right " colspan="10" >Subtotal : </td>
	    <td  style="text-align: right; padding-right: 10px " colspan="2" > Rs.'. $total.' </td>
	   </tr>

	   </td>
    <tr >

    <td style="text-align: right "  colspan="10" >Order Discount</td>
<td style="text-align: right; padding-right: 10px "  colspan="2" >0</td>

  </tr>
	 <tr >
     <td style="text-align: right "  colspan="10">Delivery Fee :  </td>
    <td style="text-align: right; padding-right: 10px "  colspan="2">'. $delivery_fee .'  </td>
  </tr>

  <tr>
    <td style="text-align: right" colspan="10">Grand Total :  </td>
	<th style="text-align: right; padding-right: 10px " colspan="2">Rs.'. $total+$delivery_fee.' </th>
  </tr>
   </table>
		</center>


		</div>
				</div>

             
									</div>
                            </div>
                        </div>



                    </div> 

                </div> 
               

            </div>




        </div>



      



    </body>
</html>
        
        ';



    
//this the the PDF filename that user will get to download
$pdfFilePath = "invoice.pdf";
//load mPDF library
include_once('mpdf/mpdf.php');
$obj = new mPDF();
//generate the PDF from the given html
$obj->WriteHTML($html);
 //download it.
$obj->Output($pdfFilePath, "D");  

?>