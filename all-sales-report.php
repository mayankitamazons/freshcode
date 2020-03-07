<?php
ob_start();
session_start();
if(isset($_SESSION["bill_admin_id"]))
{
 if((time() - $_SESSION['last_time']) > 120) // Time in Seconds
 {
 //header("location:common/log-out.php");
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
error_reporting(0);
ob_start();



include("common/connect.php");
$query2= mysqli_query($con,"SELECT * FROM `order_info` ORDER BY `order_info`.`order_id` DESC");


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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="assets/js/modernizr.min.js"></script>


    </head>


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


<div class="row" >
    									  <div class="col-lg-12" align="center" >

										 <label style="font-size:25px;">Sales Report</label>
										 </div>
										 </div>




                                <div class="card-box">
                                   <div class="row">

                            <div class="col-sm-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped add-edit-table" id="datatable-editable">
                                        <thead>
                                        <tr>
											<th style="text-align:center">SN </th>
                                            <th style="text-align:center">Order Id </th>
                                             <th style="text-align:center">Invoice Id </th>
                                             <th style="text-align:center">Order Date</th>
                                            <th style="text-align:center">Billing Name</th>
                                             <th style="text-align:center">Order Status</th>
                                             <th style="text-align:center" >Payment Method</th>
                                              <th  style="text-align:center">Total Purchase Amount </th>
                                             <th  style="text-align:center">Total Amount </th>
                                             <th style="text-align:center">Paid Amount </th>
                                             <th style="text-align:center">Due Amount </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            <?php
$i = 1;
while($b = mysqli_fetch_assoc($query2))
	  {
	      $total_purchase=0;
  $st=$b["order_status"];
  $q= $b['order_date'];
    $date = date('d-M-Y',strtotime($q));
     $time = date('h:i:s A',strtotime($q));
     $startDate =strtotime($b['order_date']);  
     date_default_timezone_set('Asia/Kolkata');    

       $order_id= $b['order_id'];    
       

       $invoiceIdSql=mysqli_query($con,"SELECT * FROM `bill_info` WHERE `order_id`= '$order_id' ");
       $dataInvoiceId = mysqli_fetch_assoc($invoiceIdSql);

       $invoiceid=$dataInvoiceId['invoice_id'];   
       

$orderSql=mysqli_query($con,"SELECT * FROM `fb_order` WHERE `order_id`= '$order_id' ");


while($dataOrder = mysqli_fetch_assoc($orderSql))
	  {
	   
	       $pCode= $dataOrder['product'];   
	         $qty=$dataOrder["qty"];
	         $tot=0;   
               
             $findProductSql=mysqli_query($con,"SELECT * FROM `purchase_rate_info` WHERE `p_code`='$pCode'");
	            
	            while($dataFindProduct = mysqli_fetch_assoc($findProductSql))
	             {
                          $findDate= $dataFindProduct["dateee"];
                          $endDate =strtotime($findDate);
         
         if($endDate <= $startDate)
         {         
            
	            $price=$dataFindProduct["price"];
	            $tot=$qty* $price;
	           
	            $elseCount=$elseCount+1;
                $total_purchase=$tot+$total_purchase;
                   break;
              
         }      
	          
	       }
	     
	     
	  }  


?>

<td align="center" ><?php echo $i; ?>   </td>
<td align="center" > <a href="view-order.php?code=<?php echo $b['order_id']; ?>"><?php echo $b['order_id']; ?></a> </td>
<td align="center"> <?php echo 'J'.$invoiceid; ?> </td>
<td align="center"> <?php echo $date; ?> </td>
<td align="center"> <?php echo $b['billing_name']; ?> </td>
<td align="center">


<?php if($st=="completed") { ?>
    <select disabled="true"  onchange="status(this)"  ips = <?php echo $b['order_id']; ?>  class="form-control" id="status<?php echo $i; ?>" name="status" >

    <?php
    }
    else {

    ?>
<select onchange="status(this)"  ips = <?php echo $b['order_id']; ?>  class="form-control" id="status<?php echo $i; ?>" name="status" >

    <?php }  ?>
			<option  value="cancelled" <?php if($st=="cancelled") { ?> selected="" <?php }?> >Cancelled</option>
			<option  value="pending" <?php if($st=="pending") { ?> selected="" <?php }?> >Pending</option>
			<option  value="in_process" <?php if($st=="in_process") { ?> selected="" <?php }?> >In Process</option>
			<option   value="delivered" <?php if($st=="delivered") { ?> selected="" <?php }?> >Delivered</option>
			<option   value="completed" <?php if($st=="completed") { ?> selected="" <?php }?> >Completed</option>
						</select> </td>

  <td align="center"> <?php echo $b['payment_method']; ?> </td>

<?php if($st=="completed") { ?>

 <td align="center"> <?php echo round($total_purchase,2) ; ?> </td>
  <?php
    }
    else {

    ?>
 <td align="center"> <?php echo "Order Not Completed" ?> </td>

  <?php }  ?>
 
<td align="center"> <?php echo $b['total_amount']; ?> </td>
<td align="center"> <?php echo $b['paid_amount']; ?> </td>
<td align="center"> <?php echo $b['pending_amount']; ?> </td>

</tr>
<?php
$i++;
}

?>



                                        </tbody>
                                    </table>
                                        </div>
                                </div>
                            </div>
                            <!-- end: page -->

                        </div>


                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    &copy; 2016 - 2018. All rights reserved.
                </footer>

            </div>


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

        <script src="plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

        <script type="text/javascript">

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>



<script type="text/javascript" >

function status(tt) {



                       var t= $(tt).attr("id");
                       var status =document.getElementById(t).value;
                       var order_id = document.getElementById(t).getAttribute("ips");
                       // alert(order_id);
                      $.ajax({

                        url:"fatch_price.php",
                          method:"POST",
                          async: false,
                          dataType: 'html',
                          data:{status:status ,order_id:order_id},
                          success:function(data)
                          {

                       alert("Order Status Updated");


                          }
                      });

                    if(status =='completed'){
                        document.getElementById(t).disabled = true;

                    }



					    }











</script>


    </body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>
