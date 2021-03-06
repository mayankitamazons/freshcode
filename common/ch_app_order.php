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

include("common/app_connect.php");



$query2 = mysqli_query($con, "SELECT * FROM `client_order` INNER JOIN client ON client.c_code=client_order.c_code AND client.c_city='Chandigarh' ORDER BY client_order.sn DESC");


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


                    <div class="row">
                        <div class="col-lg-12" align="center">

                            <label style="font-size:25px;">Mobile Order</label>
                        </div>
                    </div>




                    <div class="card-box">
                        <div class="row">

                            <div class="col-sm-12">


                                <div class="table-responsive" data-pattern="priority-columns">

                                </div>

                                <form method="post" action="add-purchase-vendor.php">
                                    <div align="right" class="col-sm-12">

                                    </div>
                                    <table class="table table-striped add-edit-table" id="datatable-editable">
                                        <thead>
                                            <tr>
                                                <th>SN </th>
                                                <th>Date</th>
                                                <th>Order ID </th>
                                                <th>Customer ID </th>
                                                <th>Billing Name </th>
                                                <th>City </th>
                                                <th>Status </th>
                                                <th>Total Amount </th>
                                                <th>Total Amount </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <?php
                                                $i = 1;
                                                while ($b = mysqli_fetch_assoc($query2)) {

                                                    $st = $b["order_status"];

                                                ?>

                                                    <td><?php echo $i; ?> </td>

                                                    <td><?php echo $b['order_date']; ?></td>
                                                    <td> <?php echo $b['order_id']; ?> </td>
                                                    <td> <?php echo $b['c_code']; ?> </td>
                                                    <td> <?php echo $b['c_name']; ?> </td>
                                                    <td> <?php echo $b['c_city']; ?> </td>

                                                    <td>


                                                        <?php if ($st == "completed") { ?>
                                                            <select disabled="true" onchange="myFunction(this)" ips=<?php echo $b['order_id']; ?> class="form-control" id="status<?php echo $i; ?>" name="status">

                                                            <?php
                                                        } else {

                                                            ?>
                                                                <select onchange="myFunction(this)" ips=<?php echo $b['order_id']; ?> class="form-control" id="status<?php echo $i; ?>" name="status">

                                                                <?php }  ?>
                                                                <option value="pending" <?php if ($st == "pending") { ?> selected="" <?php } ?>>Pending</option>

                                                                <option value="in_process" <?php if ($st == "in_process") { ?> selected="" <?php } ?>>In Process</option>
                                                                <option value="transport " <?php if ($st == "transport ") { ?> selected="" <?php } ?>>Transport </option>
                                                                <option value="delivered" <?php if ($st == "delivered") { ?> selected="" <?php } ?>>Delivered</option>

                                                                <option value="completed" <?php if ($st == "completed") { ?> selected="" <?php } ?>>Completed</option>

                                                                <option value="cancelled" <?php if ($st == "cancelled") { ?> selected="" <?php } ?>>Cancelled</option>

                                                                </select> </td>



                                                    <td> <?php echo $b['amount']; ?> </td>
                                                    <td> <a href="app_order_view.php?code=<?php echo $b['order_id']; ?>"><label> View Details</label></a></td>

                                                    </td>



                                            </tr>
                                        <?php
                                                    $i++;
                                                }

                                        ?>



                                        </tbody>
                                    </table>
                                </form>
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






    <script>
        function myFunction(tt) {


            var t = $(tt).attr("id");
            var status = document.getElementById(t).value;
            var order_id = document.getElementById(t).getAttribute("ips");
            // alert(order_id);
            $.ajax({

                url: "app_order_status_update.php",
                method: "POST",
                async: false,
                dataType: 'html',
                data: {
                    status: status,
                    order_id: order_id
                },
                success: function(data) {

                    alert("Order Status Updated");


                }
            });
        }


        function status(tt) {
            // alert("53445");
            alert("sdsfsdf");
            // var t = $(tt).attr("id");
            // var status = document.getElementById(t).value;
            // var order_id = document.getElementById(t).getAttribute("ips");
            // alert(order_id);
            // $.ajax({

            //     url: "app_order_status_update.php",
            //     method: "POST",
            //     async: false,
            //     dataType: 'html',
            //     data: {
            //         status: status,
            //         order_id: order_id
            //     },
            //     success: function(data) {

            //         alert("Order Status Updated");


            //     }
            // });

            if (status == 'completed') {
                document.getElementById(t).disabled = true;

            }



        }
    </script>




</body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->

</html>