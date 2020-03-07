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

$custId=$_GET["code"];

include("common/connect.php");
$query2= mysqli_query($con,"SELECT * FROM `customer_cash` WHERE `order_id`='$custId' ORDER BY customer_cash.sn DESC");


    ?>
<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:36 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">


        <link rel="shortcut icon" href="assets/images/s.png">

        <title>Fresh Brigade</title>
 <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


         <script src="assets/js/modernizr.min.js"></script>


    </head>


    <body class="fixed-left">
<script>


 


function PrintElem(elem)
{
    // var mywindow = window.open('', 'PRINT', 'height=600,width=1000');



    // mywindow.document.write(document.getElementById(elem).innerHTML);


    // mywindow.document.close(); // necessary for IE >= 10
    // mywindow.focus(); // necessary for IE >= 10*/

    // mywindow.print();
    // mywindow.close();



    divToPrint=document.getElementById(elem);
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();

    return true;
}</script>
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

										 <label style="font-size:25px;">Cash</label>
										 </div>
										 </div>

   <div class="card-box">
<?php
   $PayDetailsQuery= mysqli_query($con,"SELECT * FROM `order_info` WHERE order_id='$custId'");
   $pay = mysqli_fetch_assoc($PayDetailsQuery);
   $paid =$pay['paid_amount'];
    $pendding =$pay['pending_amount'];
     $total =$pay['total_amount'];
   
?>
     
        <form id="form1" method="post" action="action-page/customer-cash.php">
			<div class="row" >

 <div class="col-lg-6">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">
                                                        	<label>Order Id :</label>
															<label ><?php echo $custId;?></label>
															<input name="orderId" type="hidden"  value="<?php echo $custId;?>"size="10"  class="border" readonly/>
														</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>

                          
             <div class="col-lg-6">
							<div class="form-group">
                                                <label>Payment Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input autocomplete="off" required type="text" class="form-control" placeholder="mm/dd/yyyy" name="datepicker-autoclose" id="datepicker-autoclose">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="md md-event-note"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                            </div>	
							</div>

            	                   

                            
            </div>


<div class="row" >


            <div class="col-lg-4">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">
                                                        	<label>Due Amount :</label>
															<label ><?php echo $pendding;?></label>
															<input name="due" type="hidden"  value="<?php echo $pendding;?>"size="10"  class="border" readonly/>
														</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>

            <div class="col-lg-4">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">
                                                        	<label>Paid Amount :</label>
															<label ><?php echo $paid;?></label>
															<input name="paid" type="hidden"  value="<?php echo $paid;?>"size="10"  class="border" readonly/>
														</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>


            	                    <div class="col-lg-4">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">
                                                        	<label>Total Amount :</label>
															<label ><?php echo $total;?></label>
															<input name="total" type="hidden"  value="<?php echo $total;?>"size="10"  class="border" readonly/>
														</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>

                          

                            
            </div>



            <div class="row" >


            <div class="col-lg-6">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">                                                        	
														
															<input class="form-control"name="cash" type="text"  value="<?php echo $invoice;?>"size="10"  class="border" />
														</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>


            	                    <div class="col-lg-6">
												
												<div class="form-group" align="left" >
												
													<div>
														<div class="form-group">
                                                        	<button  class="btn btn-inverse waves-effect waves-light" id="addProduct"   >Pay </button>
													</div>
                                                        </div>
														</div><!-- input-group -->
			                    	</div>

                          

                            
            </div>

        </form>
        
     </div>
     <br><br>




                                <div class="card-box">
                                <div class="panel-footer"  > <button class="btn btn-inverse btn-rounded waves-effect waves-light" onClick=" PrintElem('wp--')" style="margin:10px;">Print</button> </div>
 
                                   <div class="row"  id="wp--">

                            <div class="col-sm-12">
 
                                    <div class="table-responsive" data-pattern="priority-columns">
                                    <table class=" table table-bordered table-responsive" id="datatable-editable">
                                        <thead>
                                        <tr>
											<th style="text-align:center">SN </th>
                                            <th style="text-align:center">Order Id </th>                                             
                                             <th style="text-align:center">Payment Date</th>
                                             <th  style="text-align:center">Total Amount </th>
                                             <th style="text-align:center">Paid Amount </th>
                                             <th style="text-align:center">Due Amount </th>                                             
                                            <th style="text-align:center">Payment</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            

                                            <?php
$i = 1;
while($b = mysqli_fetch_assoc($query2))
	  {

?>

<td align="center" ><?php echo $i; ?>   </td>
<td align="center"> <?php echo $b['order_id'];; ?> </td>
<td align="center"> <?php echo $b['datee']; ?> </td>
<td align="center"> <?php echo $b['total_amount']; ?> </td>
<td align="center"> <?php echo $b['paid']; ?> </td>
<td align="center"> <?php echo $b['pendding']; ?> </td>
<td align="center"> <?php echo $b['payment']; ?> </td>

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

 <script src="plugins/moment/moment.js"></script>
        <script src="plugins/timepicker/bootstrap-timepicker.js"></script>
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <script src="plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

     
        <script src="assets/pages/jquery.form-pickers.init.js"></script>
    </body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>
