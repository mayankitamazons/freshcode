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
$query2= mysqli_query($con,"SELECT fb_product.code, fb_product.product_status, rate_group.product_code,fb_product.product_name,fb_product.product_hindi_name,rate_group.daily,rate_group.weakly,rate_group.monthly,rate_group.group_1,rate_group.group_2,rate_group.group_3
FROM `fb_product` 
INNER JOIN `rate_group` ON fb_product.code = rate_group.product_code 
WHERE fb_product.product_status ='1' GROUP BY fb_product.code");


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


    </head>


    <body class="fixed-left" onKeyPress="return keyPressed(event)">

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




                            </div>
                        </div>

                      <div class="row">

                            <div class="col-sm-12">

                                <div class="card-box">

                                       <form action="action-page/update_rate_group.php" method="post" >

                                    <div class="table-responsive" >
                                    <table class="table table-striped add-edit-table" id="datatable-editable">
                                        <thead>
    									<tr style="text-align:right">
										 <div class="col-sm-12" style="text-align: right; " >
                                   <button type="submit" class="btn btn-inverse btn-rounded waves-effect waves-light">Update</button></div>
										</tr><br><br>
                                        <tr>
                                            <th style="text-align:center">S.N </th>
                                             <th style="text-align:left">Product Name</th>
                                            <th style="text-align:center">Daily Rate</th>
                                             <th style="text-align:center">Weekly Rate </th>
											 <th style="text-align:center">Monthly </th>
											  <th style="text-align:center">Group 1 </th>
											    <th style="text-align:center">Group 2 </th>
											  <th style="text-align:center">Group 3 </th>





                                        </tr>
                                        </thead>
                                        <tbody>


                                            <tr>

                                            <?php
$i = 1;
while($b = mysqli_fetch_assoc($query2))
	  {


?>

<td  > <?php echo $i; ?> </td>
<td  > <?php echo $b['product_name']; ?> </td>
<td ><input style="width: 80px;"  class="form-control" type="text" placeholder=" Daily Rate" name="daily[]" id="qty_0"  value="<?php echo $b['daily']; ?>"  />
					<input class="form-control" type="hidden" placeholder="Enter Quantity" name="code[]" id="code" value="<?php echo $b['code']; ?>" /> </td>
<td ><input style="width: 80px;" class="form-control" type="text" placeholder="Weakly" name="weakly[]" id="qty_0" value="<?php echo $b['weakly']; ?>" >  </td>
<td><input style="width: 80px;" class="form-control" type="text" placeholder="Monthly" name="monthly[]" id="qty_0"  value="<?php echo $b['monthly']; ?>" >  </td>
<td ><input style="width: 80px;" class="form-control" type="text" placeholder="Group 1" name="group_1[]" id="qty_0"   value="<?php echo $b['group_1']; ?>">  </td>
<td ><input style="width: 80px;" class="form-control" type="text" placeholder="Group 2" name="group_2[]" id="qty_0" value="<?php echo $b['group_2']; ?>">  </td>
<td ><input style="width: 80px;" class="form-control" type="text" placeholder="Group 3" name="group_3[]" id="qty_0"  value="<?php echo $b['group_3']; ?>">  </td>


</tr>
<?php
$i++;
}

?>



                                        </tbody>
                                    </table>
                                        </div>
										</form>
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

        <script src="../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

        <script type="text/javascript">

function keyPressed(e)
{
     var key;
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox

     return (key != 13);
}

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>


    </body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>
