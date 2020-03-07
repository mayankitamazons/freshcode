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

$id = $_GET["id"];


$query2 = mysqli_query($con, " SELECT * FROM `buy_list_data` where `id` ='$id'");


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

<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    function PrintElem(elem) {
        var mywindow = window.open('', 'PRINT', 'height=600,width=1000');



        mywindow.document.write(document.getElementById(elem).innerHTML);


        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>

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
                <div class="panel-footer"> <button class="btn btn-inverse btn-rounded waves-effect waves-light" onClick=" PrintElem('wp--')" style="margin:10px;">Print</button> </div>

                <div id="wp--" align="center" class="container-fluid">

                    <!-- Page-Title -->






                    <div class="card-box">
                        <br><br>
                        <div class="row">

                            <div class="col-sm-12">
                                <form id="form1" method="post" action="action-page/add-buy-list.php">

                                    <div class="table-responsive" data-pattern="priority-columns">

                                        <table class="table table-striped add-edit-table" id="datatable-editable">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">SN </th>
                                                    <th>Product Name </th>
                                                    <th style="text-align:center">Web Buy</th>
                                                    <th style="text-align:center">App Buy</th>
                                                    <th style="text-align:center">Total Buy</th>
                                                    <th style="text-align:center">Last Inventory</th>
                                                    <th style="text-align:center">Purchase Quantity</th>
                                                    <th style="text-align:center">Current Inventory</th>
                                                    <th style="text-align:center">Today Inventory</th>
                                                    <th style="text-align:center">Dump Inventory</th>
                                                    <th style="text-align:center">Gap</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <?php
                                                    $i = 1;
                                                    while ($b = mysqli_fetch_assoc($query2)) {

                                                    ?>



                                                        <td align="center"><?php echo $i; ?> </td>
                                                        <td> <?php echo $b['pname']; ?> </td>


                                                        <td align="center"> <?php echo $b['webbuy']; ?> </td>


                                                        <td align="center"> <?php echo $b['aapbuy']; ?> </td>


                                                        <td align="center"> <?php echo $b['totalbuy']; ?> </td>


                                                        <td align="center"> <?php echo $b['last_inventory']; ?> </td>


                                                        <td align="center"> <?php echo $b['purchase_quantity']; ?> </td>


                                                        <td align="center"> <?php echo $b['current_inventory']; ?> </td>


                                                        <td align="center"> <?php echo $b['today_inventory']; ?></td>


                                                        <td align="center"> <?php echo $b['dump_inventory']; ?> </td>


                                                        <td align="center"> <?php echo $b['gap']; ?> </td>

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
    <script type="text/javascript">
        function updateValue(tt) {



            var possition = $(tt).attr("num");
            //  var possition = t.charAt(t.length - 1);

            var appBuyQty = document.getElementById("appbuy" + possition).value;
            var webBuyQty = document.getElementById("webbuy" + possition).textContent;
            var totalbuy = parseFloat(appBuyQty) + parseFloat(webBuyQty);
            var lastInventory = parseFloat(document.getElementById("last" + possition).textContent);
            var purchase = parseFloat(document.getElementById("purchase" + possition).textContent);
            var remain = parseFloat(document.getElementById("remain" + possition).textContent);
            var todayInventory = parseFloat(document.getElementById("today" + possition).textContent);
            var dump = parseFloat(document.getElementById("dump" + possition).textContent);


            var currenInventory = (purchase + lastInventory) - totalbuy;

            var gap = (todayInventory + dump) - currenInventory;

            document.getElementById("today" + possition).innerHTML = Math.abs(currenInventory);

            document.getElementById("totalbuy" + possition).innerHTML = Math.abs(totalbuy);

            document.getElementById("gap" + possition).innerHTML = Math.abs(gap);

            document.getElementById("ttotalbuy" + possition).value = totalbuy;

            document.getElementById("ttoday" + possition).value = Math.abs(currenInventory);
            document.getElementById("tgap" + possition).value = Math.abs(gap);




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



    <script type="text/javascript">
        function status(tt) {



            var t = $(tt).attr("id");
            var status = document.getElementById(t).value;
            var order_id = document.getElementById(t).getAttribute("ips");
            // alert(order_id);
            $.ajax({

                url: "fatch_price.php",
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

            if (status == 'completed') {
                document.getElementById(t).disabled = true;

            }



        }
    </script>


</body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->

</html>