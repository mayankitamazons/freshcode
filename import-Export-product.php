<?php
ob_start();
session_start();
if (isset($_SESSION["bill_admin_id"])) {
    if ((time() - $_SESSION['last_time']) > 120) // Time in Seconds
    {
        //header("location:common/log-out.php");
    } else {
        $_SESSION['last_time'] = time();
    }
} else {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>

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
                            <div class="card-box">
                                <form class="form-horizontal" action="import-export-functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Form Name -->
                                        <legend>Form Name</legend>
                                        <!-- File Button -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                                            <div class="col-md-4">
                                                <input type="file" require name="file" id="file" class="input-large">
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                                            <div class="col-md-4">
                                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                            </div>
                                        </div>
                                        <div>
                                            <form class="form-horizontal" action="import-export-functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-4 col-md-offset-4">
                                                        <input type="submit" name="Export" class="btn btn-success" value="export to excel" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </fieldset>
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




</body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->

</html>