<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION["bill_admin_id"]))
{
 if((time() - $_SESSION['last_time']) > 120) // Time in Seconds
 {

// header("location:common/log-out.php");
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
<?php


include("common/connect.php");
$query1= mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_status`='completed'");


$total_order =mysqli_num_rows($query1);

while($getAmount = mysqli_fetch_assoc($query1))

{
  $total_amount= $getAmount["total_amount"] + $total_amount;
}

$query2= mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_status`='completed' AND `payment_method` ='CREDIT'");

    

while($getAmount = mysqli_fetch_assoc($query2))

{
 
  $total_credit_amount= $getAmount["total_amount"] + $total_credit_amount;
}




?>
<html>

    <!-- Mirrored from coderthemes.com/ubold/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:11:55 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/S.PNG">

        <title>Dashboard</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="temp/assets/style.css">

        <script src="assets/js/modernizr.min.js"></script>
 <script>
// Set the date we're counting down to

/* var countDownDate = new Date().getTime()+1*60*2000;



// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds


    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML =  minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        //window.location="common/log-out.php ";
        document.getElementById("demo").innerHTML = "SESSION EXPIRED";
    }
}, 1000);*/
</script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

           <?php include("common/header.php");?>


            <!-- ========== Left Sidebar Start ========== -->

      <?php include("common/sidebar.php");?>
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


                                <h4 class="page-title">Dashboard</h4>
                                <p class="text-muted page-title-alt">Welcome to  admin panel !</p>


                                <label class="col-2 col-form-label">Start Date</label>
                                <input  type="date" name="date"><br/>
                                <label class="col-2 col-form-label">End Date</label>
                                <input  type="date" name="date">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light">Submit</button>
                                <button class="btn btn-success btn-rounded waves-effect waves-light" onclick="getElementById('demo').innerHTML = Date()">Today</button>
                                <p id="demo" style="color:red" align="center"></p>
                            </div>
                        </div></br>

                        <div class="row">



                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-purple pull-left">
                                        <i class="md  md-shopping-cart text-purple"></i>
                                    </div>
                                    <div class="text-right">
                                    <h4 class="text-dark"> <b>Total Sales Amount</b></h4>
                                        <h5 class="text-dark">&#8377  <b class="counter"><?php  echo $total_amount ; ?></b></h5>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-pink pull-left">
                                        <i class="md  md-shopping-basket text-pink"></i>
                                    </div>
                                    <div class="text-right">
                                    <h4 class="text-dark"> <b>Total Purchase Amount</b></h4>
                                        <h5 class="text-dark">&#8377  <b class="counter">3965569</b></h5>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-success pull-left">
                                        <i class="md   ion-ios7-clock-outline text-success"></i>
                                    </div>

                                    <div class="text-right">

                                      <h4 class="text-dark"> <b>Order</b></h4>
                                        <h5 class="text-dark"> <b class="counter"><?php echo $total_order;  ?></b></h5>
                                    </div>


                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-success pull-left">
                                        <i class="md md-wb-irradescent text-success"></i>
                                    </div>
                                    <div class="text-right">
                                        <h4 class="text-dark"> <b>Wastage Amount</b></h4>
                                        <h5 class="text-dark">&#8377  <b class="counter">3965569</b></h5>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                             <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-purple pull-left">
                                        <i class="md md-assessment text-purple"></i>
                                    </div>
                                    <div class="text-right">
                                      <h4 class="text-dark"> <b>Today Profits</b></h4>
                                        <h5 class="text-dark">&#8377  <b class="counter">3965569</b></h5>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>


                              <div class="col-lg-12 col-xl-4">



                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-info pull-left">
                                        <i class="ion-cash text-info"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"> <b>Today Credit</b></h3>
                                        <h4 class="text-dark">&#8377  <b class="counter"><?php echo $total_credit_amount; ?></b></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>


                        <!-- end row -->



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

        <script src="plugins/peity/jquery.peity.min.js"></script>

        <!-- jQuery  -->
        <script src="plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="plugins/counterup/jquery.counterup.min.js"></script>

        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael-min.js"></script>

        <script src="plugins/jquery-knob/jquery.knob.js"></script>

        <script src="assets/pages/jquery.dashboard.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>

    </body>

    <!-- Mirrored from coderthemes.com/ubold/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:12:45 GMT -->
</html>
