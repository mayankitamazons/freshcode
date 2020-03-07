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
   
    $query2= mysqli_query($con,"SELECT * FROM `customer` Where cust_id= '$c' ");
    error_reporting(0);
    $b = mysqli_fetch_assoc($query2);

    $code=$b["cust_id"];
    $cname=$b['cust_name'];
    $gst=$b["gst_no"];
    $mobile=$b["mobile"];
    $email=$b["email"];
      $address=$b["address"];
      $city=$b["city"];
      $pincode=$b["pincode"];
      $dist=$b["district"];
      $st=$b["state"];
    
	    $query3= mysqli_query($con,"SELECT * FROM `geo_locations` Where id= '$dist' ");
    
    $c = mysqli_fetch_assoc($query3);
	 $distName=$c["name"];
	 
	 
	    $query4= mysqli_query($con,"SELECT * FROM `geo_locations` Where id= '$st' ");
    
    $d = mysqli_fetch_assoc($query4);
	 $statetName=$d["name"];

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
                                    <li class="breadcrumb-item">Customer</li>
                                     <li class="breadcrumb-item">Customer View</li>
                                    <li class="breadcrumb-item active"><?php echo $code ?> </li>
                                </ol>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form action="view-customer.php" >
                                       

    <div class="row">
                                        
                                <div class="col-sm-6">
                            <label for="name" class="_20i8vs _3CMTvd">Name</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" required="" placeholder="Customer Name" name="cname" readonly value=<?php echo $cname ?>  >
                                     <input readonly type="hidden" placeholder="Enter product name" data-mask="999-99-999-9999-9" class="form-control" name="code" value=<?php echo $code ?>  required >
                        </div>
                                        <div class="col-sm-6">
                            <label for="name" class="_20i8vs _3CMTvd">GST NO.</label><span class="text-danger">*</span>
                        <input readonly class="form-control" type="text" required="" placeholder="Customer GST Number" name="gst" value=<?php echo $gst ?> >
                                      </div> </div><br>
                                      
                                      <div class="row">
                                        <div class="col-sm-6">
                            <label for="name" class="_20i8vs _3CMTvd">E-Mail</label><span class="text-danger">*</span>
                        <input  readonly class="form-control" type="text" required="" placeholder="Email Id" name="email" value=<?php echo $email ?> >
                        </div>
                             <div class="col-sm-6">
                                 <label for="name">Mobile Number</label><span class="text-danger">*</span>
                        <input readonly class="form-control" type="text" required placeholder="Mobile Number" name="mnumber"value=<?php echo $mobile ?>  >
                        </div> </div>
                                         
                       
                         <br>
                        
                        <div class="row">
                       
                        <div class="col-sm-6">
                              <label for="name">Pincode</label><span class="text-danger">*</span>
                        <input readonly class="form-control" type="text" required="" placeholder="Pincode" name="pincode"value=<?php echo $pincode ?>  >
                        </div>
                             <div class="col-sm-6">
                                   <label for="name">City</label><span class="text-danger">*</span>
                        <input readonly class="form-control" type="text" required="" placeholder="City" name="city" value=<?php echo $city ?> >
                            </div>   </div><br>
                     
						
                         
                       <div class="row">
                        <div class="col-sm-12">
                              <label for="name">Address (Area and Street)</label><span class="text-danger">*</span>
                       <textarea readonly class="form-control" placeholder="Area and Street" name="address">
                            <?php echo $address ?> </textarea>
                           </div></div>
                            <br>
                        <div class="row">
                        <div class="col-sm-6">
                              <label for="name">District</label><span class="text-danger">*</span>
                        <input readonly class="form-control" type="text" required="" placeholder="District" name="district" value=<?php echo $distName ?> >
                        </div>
                             <div class="col-sm-6">
                                   <label for="name">State</label>   <span class="text-danger">*</span>                  
                                 
                               <input readonly class="form-control" type="text" required="" placeholder="District" name="district" value=<?php echo $statetName ?> >
                                 
                                 
                            </div>   </div><br>
                               <div class="col-sm-12" style="text-align: right; " >
                                   <button type="submit" class="btn btn-inverse btn-rounded waves-effect waves-light">Back </button></div>
                                 
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


            <!-- Right Sidebar -->
            <div class="side-bar right-bar nicescroll">
                <h4 class="text-center">Chat</h4>
                <div class="contact-list nicescroll">
                    <ul class="list-group contacts-list">
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-1.jpg" alt="">
                                </div>
                                <span class="name">Chadengle</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-2.jpg" alt="">
                                </div>
                                <span class="name">Tomaslau</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-3.jpg" alt="">
                                </div>
                                <span class="name">Stillnotdavid</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-4.jpg" alt="">
                                </div>
                                <span class="name">Kurafire</span>
                                <i class="fa fa-circle online"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-5.jpg" alt="">
                                </div>
                                <span class="name">Shahedk</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-6.jpg" alt="">
                                </div>
                                <span class="name">Adhamdannaway</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-7.jpg" alt="">
                                </div>
                                <span class="name">Ok</span>
                                <i class="fa fa-circle away"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-8.jpg" alt="">
                                </div>
                                <span class="name">Arashasghari</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-9.jpg" alt="">
                                </div>
                                <span class="name">Joshaustin</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-10.jpg" alt="">
                                </div>
                                <span class="name">Sortino</span>
                                <i class="fa fa-circle offline"></i>
                            </a>
                            <span class="clearfix"></span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->

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