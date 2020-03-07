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
$query2 = mysqli_query($con, "SELECT order_info.order_id,order_info.order_status, fb_order.product, fb_order.qty,
fb_order.order_id ,SUM(fb_order.qty) AS quantity,fb_order.date_time FROM order_info 
INNER JOIN fb_order ON order_info.order_id = fb_order.order_id
WHERE order_info.order_id = fb_order.order_id AND order_info.order_status='in_process' GROUP BY fb_order.product");


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

                    <div class="row">
                        <div class="col-lg-12" align="center">

                            <label style="font-size:25px;">Purchase List</label>
                        </div>
                        <?php
                        $dateOfDate = CURRENT_TIMESTAMP;

                        date_default_timezone_set('Asia/Kolkata');

                        $Current_hour = date('H');

                        $todayDate = date('d-M-Y');
                        $new_date = date('d-M-Y');

                        ?>

                        <div class="col-lg-12" align="center">

                            <label style="font-size:18px;">Date</label>
                            <label style="font-size:18px;"><?php echo $new_date ?></label>
                        </div>
                    </div>




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
                                                        $p_code = $b['product'];
                                                        $date_time = $b['date_time'];

                                                        $result_product_details = mysqli_query($con, "SELECT * FROM `fb_product` WHERE `code`='$p_code'");

                                                        $pd = mysqli_fetch_assoc($result_product_details);

                                                        $result_purchase_details = mysqli_query($con, "SELECT * FROM `purchase_rate_info` WHERE `p_code`='$p_code' AND `dateee`='$new_date'");

                                                        //   $pdArray = mysqli_fetch_assoc($result_purchase_details);

                                                        $t = 0;
                                                        while ($pdArray = mysqli_fetch_assoc($result_purchase_details)) {

                                                            $t = $t + $pdArray['qty'];
                                                        }

                                                        $purchaseQuantity =  $t;

                                                        if ($purchaseQuantity == "") {
                                                            $purchaseQuantity  = 0;
                                                        }

                                                        $new_date_inventory = date('d-M-Y', strtotime($new_date . ' - 1 days'));

                                                        $result_inventory_details = mysqli_query($con, "SELECT * FROM `inventory_info` where `product_code` ='$p_code' AND `datee`='$new_date_inventory'");

                                                        $inventoryArray = mysqli_fetch_assoc($result_inventory_details);

                                                        $lastInventory = $inventoryArray['remain'];

                                                        $result_Todaypurchase_details = mysqli_query($con, "SELECT * FROM `inventory_info` WHERE `datee`='$new_date'");


                                                        $todayArray = mysqli_fetch_assoc($result_Todaypurchase_details);

                                                        $todayInventory = $todayArray["remain"];
                                                        if ($todayInventory == "") {
                                                            $todayInventory  = 0;
                                                        }


                                                        $dump = $todayArray['dump'];
                                                        if ($lastInventory == "") {
                                                            $lastInventory  = 0;
                                                        }

                                                        if ($dump == "") {
                                                            $dump  = 0;
                                                        }

                                                        $remainStock =  $lastInventory + $purchaseQuantity -  $b['quantity'];



                                                        if ($remainStock < 0) {
                                                            $remainStock = 0;
                                                        }

                                                        $subgap = $todayArray["remain"] +  $dump;

                                                        $gap = $remainStock - $subgap;


                                                    ?>



                                                        <td align="center"><?php echo $i; ?> </td>
                                                        <td> <?php echo $pd['product_name'] . " (" . $pd['product_hindi_name'] . " )"; ?>
                                                            <input type="hidden" name="name[]" id=<?php echo "tname" . $i; ?> value=<?php echo $pd['product_name']; ?> />
                                                            <input type="hidden" name="code[]" id=<?php echo "tcode" . $i; ?> value=<?php echo $b['product']; ?> /> </td>

                                                        <td align="center"><label name="webbuy[]" id=<?php echo "webbuy" . $i; ?>><?php echo $b['quantity']; ?> </label>
                                                            <input type="hidden" name="webbuy[]" id=<?php echo "twebbuy" . $i; ?> value=<?php echo $b['quantity']; ?> /></td>


                                                        <td align="center"> <input name="appbuy[]" num=<?php echo $i; ?> type="text" onchange="updateValue(this)" style='width:70px' id=<?php echo "appbuy" . $i; ?> /> </td>


                                                        <td align="center"><label name="totalbuy[]" id=<?php echo "totalbuy" . $i; ?>><?php echo $b['quantity']; ?> </label>
                                                            <input type="hidden" name="totalbuy[]" id=<?php echo "ttotalbuy" . $i; ?> value=<?php echo $b['quantity']; ?> /> </td>


                                                        <td align="center"> <label name="last[]" id=<?php echo "last" . $i; ?>><?php echo  $lastInventory; ?></label>
                                                            <input type="hidden" name="last[]" id=<?php echo "last" . $i; ?> value=<?php echo $lastInventory; ?> /></td>


                                                        <td align="center"> <label name="purchase[]" id=<?php echo "purchase" . $i; ?>><?php echo  $purchaseQuantity; ?> </label>
                                                            <input type="hidden" name="purchase[]" id=<?php echo "tpurchase" . $i; ?> value=<?php echo $purchaseQuantity; ?> /></td>


                                                        <td align="center"> <label name="remain[]" id=<?php echo "remain" . $i; ?>><?php echo $remainStock; ?></label>
                                                            <input type="hidden" name="remain[]" id=<?php echo "tremain" . $i; ?> value=<?php echo $remainStock; ?> /> </td>


                                                        <td align="center"> <label name="today[]" id=<?php echo "today" . $i; ?>><?php echo  $todayInventory; ?></label>
                                                            <input type="hidden" name="today[]" id=<?php echo "ttoday" . $i; ?> value=<?php echo $todayInventory; ?> /> </td>


                                                        <td align="center"> <label name="dump[]" id=<?php echo "dump" . $i; ?>><?php echo  $dump; ?></label>
                                                            <input type="hidden" name="dump[]" id=<?php echo "tdump" . $i; ?> value=<?php echo  $dump;  ?> /></td>


                                                        <td align="center"> <label name="gap[]" id=<?php echo "gap" . $i; ?>> <?php echo  $gap; ?></label>
                                                            <input type="hidden" name="gap[]" id=<?php echo "tgap" . $i; ?> value=<?php echo $gap; ?> /></td>

                                                </tr>
                                            <?php

                                                        $i++;
                                                    }

                                            ?>



                                            </tbody>
                                        </table>

                                        <button class="btn btn-primary waves-effect waves-light">Save Buy List </button>
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

            var appBuyQty = 0;
            var Qty = document.getElementById("appbuy" + possition).value;

            alert(Qty);
            if (Qty == "") {
                appBuyQty = 0;
            } else {
                appBuyQty = parseFloat(Qty);
            }

            var webBuyQty = document.getElementById("webbuy" + possition).textContent;
            var totalbuy = appBuyQty + parseFloat(webBuyQty);
            var lastInventory = parseFloat(document.getElementById("last" + possition).textContent);
            var purchase = parseFloat(document.getElementById("purchase" + possition).textContent);
            var remain = parseFloat(document.getElementById("remain" + possition).textContent);
            var todayInventory = parseFloat(document.getElementById("today" + possition).textContent);
            var dump = parseFloat(document.getElementById("dump" + possition).textContent);



            var currenInventory = (purchase + lastInventory) - totalbuy;

            var gap = (todayInventory + dump) - currenInventory;


            if (currenInventory < 0) {
                currenInventory = 0;
            }
            document.getElementById("remain" + possition).innerHTML = currenInventory;


            document.getElementById("totalbuy" + possition).innerHTML = totalbuy;

            document.getElementById("gap" + possition).innerHTML = gap;

            document.getElementById("ttotalbuy" + possition).value = totalbuy;

            document.getElementById("ttoday" + possition).value = currenInventory;
            document.getElementById("tgap" + possition).value = gap;




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