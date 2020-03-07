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
$query2= mysqli_query($con,"SELECT purchase_rate.id,purchase_rate.vcode,purchase_rate.vendor_name,purchase_rate.tot,purchase_rate.due,purchase_rate.paid,purchase_rate.date 
FROM purchase_rate 
WHERE purchase_rate.vcode='$custId' 
ORDER BY purchase_rate.sn DESC");


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

										 <label style="font-size:25px;">Cash Sales Report</label>
										 </div>
										 </div>




                                <div class="card-box">
                                 <div class="panel-footer"  > <button class="btn btn-inverse btn-rounded waves-effect waves-light" onClick=" PrintElem('wp--')" style="margin:10px;">Print</button> </div>

                                   <div class="row"  id="wp--">
 
                            <div class="col-sm-12">

                                    <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped add-edit-table" id="datatable-editable">
                                        <thead>
                                        <tr>
											<th style="text-align:center">SN </th>
                                            <th style="text-align:center">Order Id </th>
                                             <th style="text-align:center">Order Date</th>
                                            <th style="text-align:center">Billing Name</th>
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

?>

<td align="center" ><?php echo $i; ?>   </td>
<td align="center" > <a href="purchase-cash.php?code=<?php echo $b['id']; ?>"><?php echo $b['id']; ?></a> </td>

<td align="center"> <?php echo $b['date']; ?> </td>
<td align="center"> <?php echo $b['vendor_name']; ?> </td>
<td align="center"> <?php echo $b['tot']; ?> </td>
<td align="center"> <?php echo $b['paid']; ?> </td>
<td align="center"> <?php echo $b['due']; ?> </td>

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
