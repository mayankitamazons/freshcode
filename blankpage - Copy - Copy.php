<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/ubold/light/page-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:17:38 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Ubold - Responsive Admin Dashboard Template</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
              <?php include("common/header.php");?><!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                 <?php include("common/sidebar.php");?>   <!-- Left Sidebar End -->



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
                                <div class="btn-group pull-right m-t-15">
                                    <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings</button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#">Dropdown One</a>
                                        <a class="dropdown-item" href="#">Dropdown Two</a>
                                        <a class="dropdown-item" href="#">Dropdown Three</a>
                                        <a class="dropdown-item" href="#">Dropdown Four</a>
                                    </div>
                                </div>

                                <h4 class="page-title">Starter</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Ubold</a></li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                    <li class="breadcrumb-item active">Starter</li>
                                </ol>

                            </div>
                        </div>

					<div class="col-lg-7">
					<div class="card-box">
					<div class="form-group">
                                            <label for="userName">Product Name<span class="text-danger">*</span></label>
                                            <input type="text" name="nick" parsley-trigger="change" required="" placeholder="Enter user name" class="form-control" id="userName">
                                        </div>
										<div class="form-group">
                                            <label for="userName">Description<span class="text-danger">*</span></label>
                                            <input type="text" name="nick" parsley-trigger="change" required="" placeholder="Enter user name" class="form-control" id="userName">
                                        </div>
										<div class="form-group">
                                            <label for="userName">Price<span class="text-danger">*</span></label>
                                            <input type="text" name="nick" parsley-trigger="change" required="" placeholder="Enter user name" class="form-control" id="userName">
                                        </div>
										<div class="form-group">
                                            <label for="userName">GST%<span class="text-danger">*</span></label>
                                            <input type="text" name="nick" parsley-trigger="change" required="" placeholder="Enter user name" class="form-control" id="userName">
                                        </div>
										
										<input type="file" class="filestyle" data-placeholder="No file">
										<button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Submit
                                            </button>
											<button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>
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

    </body>

<!-- Mirrored from coderthemes.com/ubold/light/page-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:17:38 GMT -->
</html>