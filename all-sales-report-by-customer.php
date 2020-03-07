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
$query2= mysqli_query($con,"SELECT * FROM `order_info` 
INNER JOIN bill_info ON order_info.order_id=bill_info.order_id ORDER BY `order_info`.`sn` DESC ");
    
    
    ?>
<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:36 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

       
        <link rel="shortcut icon" href="assets/images/s.png">

        <title>Fresh Brigade</title>

        <link href="plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

        <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/main.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





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
										 
										 <label style="font-size:25px;">Sales Report By Customer</label>
										 </div>
										 </div>
                      

                                <div class="card-box">
								
								  <div class="row">


                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label>Customer Name</label>


                                               <select class="selectpicker" data-live-search="true" data-style="btn-white" id="cust" name="cust">
                                                    <option  value="0" selected="">----Select Customer----</option>

                                                    <?php 

                                                    $query= mysqli_query($con,"select * from customer;");
                                                    while($b = mysqli_fetch_assoc($query))
                                                    { 
                                                    ?>
                                                    <option value=<?php echo $b['cust_id']; ?>  > <?php echo $b['cust_name']; ?></option>
                                                    <?php 
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div  class="col-lg-6" class="row" align="right">
                                         <button class="btn btn-inverse btn-rounded waves-effect waves-light" onClick=" PrintElem('wp--')" style="margin:10px;">Print</button> 
                                                                 </div>

										</div><br><br>
                                       
										 
								
                                  <div class="row">
									
                            <div class="col-sm-12">
                                  
                                    <div    id="wp--" class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped add-edit-table" id="product" name="product">
                                        <thead>
                                        <tr>
										<th style="text-align:center">SN </th>
                                          <th style="text-align:center">Invoice No. </th>
                                        <th style="text-align:center">Sales Id </th>
                                        <th style="text-align:center">Order Date</th>
                                        <th style="text-align:center">Billing Name</th>
                                        <th style="text-align:center" >Payment Method</th>
                                        <th  style="text-align:center">Order Amount </th>
                                        <th style="text-align:center">Paid Amount </th>
                                        <th style="text-align:center">Due Amount</th></tr>         
														
                                           
                                             
                                        </tr>
                                        </thead>
                                        <tbody>
                                     
                                            
                                            <tr>
                                            
                                            <?php
$i = 1;
while($b = mysqli_fetch_assoc($query2))
	  { 
  $st=$b["order_status"];
 
	

?>

<td align="center" > <?php echo $i; ?> </td>
<td align="center" > <?php echo $b['invoice_id']; ?> </td>
<td align="center" > <?php echo $b['order_id']; ?> </td>
<td align="center"> <?php echo $b['order_date']; ?> </td>
<td align="center"> <?php echo $b['billing_name']; ?> </td>						
<td align="center"> <?php echo $b['payment_method']; ?> </td>
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



	<script type="text/javascript" >

jQuery(document).ready(function($){

											var i=0;
											$('#cust').change(function(){

                                              //  var addHeader ='<tr><th style="text-align:center">SN </th><th style="text-align:center">Sales Id </th><th style="text-align:center">Order Date</th><th style="text-align:center">Billing Name</th><th style="text-align:center" >Payment Method</th><th  style="text-align:center">Order Amount </th><th style="text-align:center">Paid Amount </th><th style="text-align:center">Due Amount</th></tr>'           
															   var cust_id =document.getElementById("cust").value;														
                                                     		  $.ajax({
															
																url:"live-search.php",
																  method:"POST",
																  async: false,
																  dataType: 'html', 
																  data:{cust_id:cust_id},
																  success:function(data)
																  {	
                                                                      															i=0;		
														              //   $('#product').empty();
                                                                          $("#product").find("tbody").empty();
                                                                    
                                                                   //   $('#product').append(addHeader);
																	  $('#product').append(data);	
																	 

																  }
															  });													


														  });     

													});



    </script>







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

        <script src="plugins/moment/moment.js"></script>
        <script src="plugins/timepicker/bootstrap-timepicker.js"></script>
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <script src="plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/pages/jquery.form-pickers.init.js"></script>



        <script src="plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="../plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


        <script type="text/javascript" src="plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/pages/autocomplete.js"></script>

        <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>

        


        <script type="text/javascript">

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>


    </body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>