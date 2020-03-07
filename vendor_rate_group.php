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

<?php
error_reporting(0);
ob_start();



include("common/connect.php");
$query2 = mysqli_query($con, "SELECT * FROM `vendor` ORDER BY `vcode`");


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
                                <li class="breadcrumb-item">Vendor</li>
                                <li class="breadcrumb-item active">View Vendor </li>
                            </ol>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="card-box">


                                <div class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped add-edit-table" id="datatable-editable">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">S.N </th>
                                                <th style="text-align:center">Vendor ID</th>
                                                <th style="text-align:center">Vendor Name</th>
                                                <th style="text-align:center">Mobile NO. </th>
                                                <th style="text-align:center">Area </th>
                                                <th style="text-align:center">Add Rate Group </th>



                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr>

                                                <?php
                                                $i = 1;
                                                while ($b = mysqli_fetch_assoc($query2)) {

                                                    $st = $b['rate_group'];

                                                ?>

                                                    <td align="center"> <?php echo $i; ?> </td>
                                                    <td align="center"> <?php echo $b['vcode']; ?> </td>
                                                    <td align="center"> <?php echo $b['name']; ?> </td>
                                                    <td align="center"> <?php echo $b['mobile']; ?> </td>
                                                    <td align="center"> <?php echo $b['area']; ?> </td>

                                                    <td align="center"> <a href="vendor_view_rate_group.php?code=<?php echo $b['vcode']; ?>">Add Rate Group</a> </td>



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

    <script type="text/javascript">
        function status(tt) {



            var t = $(tt).attr("id");
            var rateGroup = document.getElementById(t).value;
            var custIdForRateGroup = document.getElementById(t).getAttribute("ips");
            // alert(custIdForRateGroup);
            $.ajax({

                url: "fatch_price.php",
                method: "POST",
                async: false,
                dataType: 'html',
                data: {
                    custIdForRateGroup: custIdForRateGroup,
                    rateGroup: rateGroup
                },
                success: function(data) {

                    alert("Daily Rate Update");


                }
            });

        }
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

    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script src="plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <script src="plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

    <script type="text/javascript">
        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });
    </script>






</body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->

</html>