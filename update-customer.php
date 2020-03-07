<?php
ob_start();
session_start();
if(isset($_SESSION["bill_admin_id"]))
{
 if((time() - $_SESSION['last_time']) > 120) // Time in Seconds
 {
 //header("location:common/log-out.php");
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
    $mobile=$b["mobile"];
	$area=$b["area"];
    $address=$b["address"];
      $city=$b["city"];
      $pincode=$b["pincode"];
     
      $st=$b["state"];
      $gst_no=$b["gst_no"];
	  
	   
    

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
                                    <li class="breadcrumb-item active">Customer Update </li>
                                </ol>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form action="action-page/update-customer-php.php" method="post" >    
                                  <div class="row">
                                        
                                <div class="col-sm-6">
								 <input value="<?php echo $code;?>" class="form-control" type="hidden" required placeholder="Customer Name" name="code">
                            <label for="name" class="_20i8vs _3CMTvd">Name</label><span class="text-danger">*</span>
                        <input value="<?php echo $cname;?>" class="form-control" type="text" required placeholder="Customer Name" name="cname">
                        </div> 
						 <div class="col-sm-6">
                                 <label for="name">Mobile Number</label>
                        <input name="number" value="<?php echo $mobile ; ?>" class="form-control" type="tel"  pattern="[0-9]{10}" maxlength="10">
                        </div>
						</div>
						   <div class="row">
                                        
                               
						 <div class="col-sm-6">
                                 <label for="name">Gst No</label>
                        <input name="gst_no" value="<?php echo $gst_no ; ?>" class="form-control" type="text"  >
                        </div>
						</div>
						<br>
                                      
                                      <div class="row">
									  <div class="col-sm-3">
                                   <label for="name">State</label>   <span class="text-danger">*</span>                  
                                 
                                   <input value="<?php echo $st;?>" class="form-control" readonly type="text" value="Rajasthan" required name="cstate">
                       
                                 
                                 
                            </div>
                                      <div class="col-sm-3">
					    <label for="name">City</label><span class="text-danger">*</span>
                                  
                                 <input value="<?php echo $city;?>" class="form-control" readonly type="text" value="Jaipur" required  name="ccity">
                       
                            </div>
							<div class="col-sm-3">
                              <label for="name">Area</label><span class="text-danger">*</span>
                        <input value="<?php echo $area;?>" class="form-control" type="text" required="" placeholder="City" name="area">
                        </div>
						 
                        <div class="col-sm-3">
                              <label for="name">Pincode</label><span class="text-danger">*</span>
                        <input value="<?php echo $pincode;?>" class="form-control" type="tel" required maxlength="6" pattern="[0-9]{6}" placeholder="Pincode" name="pincode">
                        </div>
                             </div>
                                         
                       
                         <br>
                        
                        
                     
						
                     
                                          
                                          
         
                        <div class="row">
                       
                                </div><br>    
                       <div class="row">
                        <div class="col-sm-12">
                              <label for="name">Address (Area and Street)</label><span class="text-danger">*</span>
							   <textarea name="address"  class="form-control" placeholder="Area and Street" rows="5" required ><?php echo $address;?></textarea> 
                                   
                      
					 
                            
                           </div></div>
                            <br>
                               <div class="col-sm-12" style="text-align: right; " >
                                   <button type="submit" class="btn btn-inverse btn-rounded waves-effect waves-light">Update</button></div>
                                 
                                 
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

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>


    </body>

    <!-- Mirrored from coderthemes.com/ubold/light/form-mask.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:37 GMT -->
</html>