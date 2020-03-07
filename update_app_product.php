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
session_start();


include("common/app_connect.php");
$c = $_GET['code'];

$query2 = mysqli_query($con, "SELECT * FROM `fb_product` Where code= '$c' ");
error_reporting(0);
$b = mysqli_fetch_assoc($query2);

$code = $b["code"];
$pname = $b['product_name'];
$hindi_pname = $b['product_hindi_name'];
$image = $b['img'];
$de = $b["description"];
$qty = $b["quantity"];
$price = $b['price'];
$unit = $b["unit"];
$product_status = $b["product_status"];
$notify_for_quantity_below = $b["notify_for_quantity_below"];
$minimum_sale_quantity = $b["minimum_sale_quantity"];
$maximum_sale_quantity = $b["maximum_sale_quantity"];
$qty_increment = $b["qty_increment"];
$st = $b["in_stock"];


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
                                <li class="breadcrumb-item active">Product Update </li>
                            </ol>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <form action="action-page/app_product_update.php" method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Product Code : </label>

                                            <input class="form-control" readonly type="text" required="" placeholder="Product Name" name="code" value="<?php echo $code ?>">

                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Product Name</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required="" placeholder="Product Name" name="pname" value="<?php echo $pname ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="name">Product Hindi Name</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required placeholder="Product Hindi Name" name="hpname" value="<?php echo $hindi_pname ?>">
                                        </div>
                                    </div><br>



                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Quantity</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required="" placeholder="Quantity" name="qty" value="<?php echo $qty ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="name">Price</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required placeholder="Price" name="price" value="<?php echo $price ?>">
                                        </div>
                                    </div><br>

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Unit</label>
                                            <span class="text-danger">*</span>
                                            <select required class="custom-select mt-3" name="unit">
                                                <option value="KG" <?php if ($unit == "c") { ?> selected="selected" <?php  } ?>>KG</option>

                                                <option value="Ltr" <?php if ($unit == "Ltr") { ?> selected="selected" <?php  } ?>>Ltr</option>

                                                <option value="Meter" <?php if ($unit == "Meter") { ?> selected="selected" <?php  } ?>>Meter</option>

                                                <option value="Pcs" <?php if ($unit == "Pcs") { ?> selected="selected" <?php  } ?>>Pcs </option>
                                                <option value="Pkt" <?php if ($unit == "Pkt") { ?> selected="selected" <?php  } ?>>Pkt</option>

                                            </select> </div>
                                        <div class="col-sm-6">
                                            <label for="name">Product Status</label>
                                            <span class="text-danger">*</span>
                                            <select required class="custom-select mt-3" name="pstatus">
                                                <option value="1" <?php if ($st == "1") { ?> selected="selected" <?php  } ?>>Active Product</option>

                                                <option value="0" <?php if ($st == "0") { ?> selected="selected" <?php  } ?>>Deactive Product </option>

                                            </select> </div>
                                    </div><br>

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Notify For Quantity Below</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required="" placeholder="Notify For Quantity Below" name="NotifyForQuantityBelow" value="<?php echo $notify_for_quantity_below ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="name">Minimum Sale Quantity</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required placeholder="Minimum Sale Quantity" name="MinimumSaleQuantity" value="<?php echo $minimum_sale_quantity ?>">
                                        </div>
                                    </div><br>

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Maximum Sale Quantity</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required="" placeholder="Maximum Sale Quantity" name="MaximumSaleQuantity" value="<?php echo $maximum_sale_quantity ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="name">Qty Increment</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required placeholder="Qty Incremen" name="QtyIncremen" value="<?php echo $qty_increment ?>">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">In Stock</label>
                                            <span class="text-danger">*</span>
                                            <input class="form-control" type="text" required="" placeholder="In Stock" name="InStock" value="<?php echo $st ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="name" class="_20i8vs _3CMTvd">Description</label>
                                            <span class="text-danger">*</span>
                                            <textarea required="" name="pdes" class="form-control" rows="3"><?php echo $de; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="name">Image</label>
                                            <span class="text-danger">*</span>
                                            <input id="uploadImage" type="file" name="myPhoto" onchange="PreviewImage();" /><br>
                                            <img id="uploadPreview" style="width: 100px; height: 100px;" src=<?php echo $image ?> />
                                        </div>
                                    </div><br>
                                    <input type="submit" value="submit">

                                    <br>
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
        $("#imgInp").change(function() {
            readURL(this);
        });


        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });
    </script>
    <script type="text/javascript">
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    </script>
    <script type="text/javascript">
        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


</body>

<!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->

</html>