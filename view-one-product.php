<?php
ob_start();
session_start();
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
    error_reporting(0);
   
   

    include("common/connect.php");
    $c=$_GET['code'];

    $query2= mysqli_query($con,"SELECT * FROM `product` Where product_code= '$c' ");
    error_reporting(0);
    $b = mysqli_fetch_assoc($query2);

    $code=$b["product_code"];
    $image=$b['image'];
    $pname=$b['product_name'];
    $de=$b["product_description"];
    $price=$b['price'];
    $gst=$b["gst"];
    $qty=$b["quantity"];
    $st=$b["status"];
    $total_Amount=$b["total_amount"];
    $last_update=$b["last_update"];


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
                                    <li class="breadcrumb-item">Product</li>
                                    <li class="breadcrumb-item active">Product View </li>
                                </ol>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form action="./viewproduct.php" method="post" enctype="multipart/form-data">



                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="row">

                                                    <div class="col-sm-6" ">
                                                       <div class="form-group">
                                                            <label>Product Code</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" readonly placeholder="Enter product name" class="form-control" name="pname" value=<?php echo $code ?>  required >

                                                            <input type="hidden" readonly placeholder="Enter product name" data-mask="999-99-999-9999-9" class="form-control" name="code" value=<?php echo $code ?>  required >

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        
                                                        <div class="form-group">
                                                            <label>Product Name</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" readonly placeholder="Enter product name" class="form-control" name="pname" value=<?php echo $pname ?>  required >

                                                            <input type="hidden" readonly placeholder="Enter product name" data-mask="999-99-999-9999-9" class="form-control" name="code" value=<?php echo $code ?>  required >

                                                        </div></div>
														
														 <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <span class="text-danger">*</span>
                                                            <input required  name="price" type="text" placeholder="Enter product price" readonly class="form-control" value =<?php echo $price ?> >
                                                        </div></div>
														
														 <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GST</label>
                                                            <span class="text-danger">*</span>
                                                            <input required  name="price" type="text" placeholder="Enter product price" readonly class="form-control" value =<?php echo $gst ?> >

                                                        </div></div>

 <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" placeholder="Enter product qunatity "readonly class="form-control"name="pqty" value=<?php echo $qty ?> required  >

                                                        </div></div>

                                                   
 <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Total Amount</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" placeholder="Enter product qunatity "readonly class="form-control"name="pqty" value=<?php echo $total_Amount ?> required  >

                                                </div> </div></div><div>
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group"  >
                                                            <label>Product Discription</label>
                                                            <span class="text-danger">*</span>
                                                            <textarea  readonly required name="pdes" class="form-control" rows="5"  ><?php echo $de; ?></textarea> </div> 
                                                    </div>
                                                    
                                                     <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Product Status</label>
                                                        <span class="text-danger">*</span>
                                                        <input required  name="price" type="text" placeholder="Enter product price" readonly class="form-control" value =<?php if($st=='1'){echo "Active" ;}else echo "Deactive"; ?> >

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Last Update</label>
                                                        <span class="text-danger">*</span>
                                                        <input required  name="price" type="text" placeholder="Enter product price" readonly class="form-control" value =<?php echo $last_update ?> required  >

                                                    </div>



                                                </div>


                                            </div>

                                            <div class="row">




                                                <div class="col-sm-6">
                                                    <div class="form-group" style="text-align: right;">.
                                                        <br><br>
                                                        <button type="submit"  class="btn btn-primary btn-rounded waves-effect waves-light" center >&nbsp;&nbsp; Back &nbsp;&nbsp;</button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>



                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
                &copy; 2016 - 2018. All rights reserved.
            </footer>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


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