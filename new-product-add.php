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
                                    <li class="breadcrumb-item active">Add Product </li>
                                </ol>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                      <form action="action-page/add-product-php.php" method="post" enctype="multipart/form-data">
                                  
                                   
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="p-20">
                       
                                                    <div class="form-group">
                                                        <label>Product Name</label>
                                                        <span class="text-danger">*</span>
                                                        <input type="text" placeholder="Enter product name" data-mask="999-99-999-9999-9" class="form-control" name="pname"  required >
                                                        
                                                    </div>
                                     <div class="form-group">
                                                        <label>Qunatity</label>
                                                        <span class="text-danger">*</span>
                                                        <input type="number" placeholder="Enter product qunatity " data-mask="999 99 999 9999 9" class="form-control"name="pqty" required  >
                                                      
                                     </div>
                                                    
                                    <div class="form-group">
                                                     <label>Product Status</label>
                                                        <span class="text-danger">*</span>
                                                   <select class="custom-select mt-3" name="pstatus" required >
                                                <option selected="" value="1">In Stock </option>
                                                <option value="0">out of Stock </option>
                                               
                                                 </select>  
                                                    
                                      </div>
									     <div class="form-group">
                                                     <label>Product Image</label>
                                                    <input type="file" class="form-control">
                                                    
                                      </div>
                                                  
                                                    
                                              
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="p-20">
                                               

                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <span class="text-danger">*</span>
                                                        <input name="price" type="text" placeholder="Enter product price" data-mask="99-9999999" class="form-control" required >
                                                           </div>
                                        
										 <div class="form-group">
                                                           <label>Unit:</label>
                                             <span class="text-danger">*</span>
                                                   <select  required class="custom-select mt-3" name="pgst">
                                                <option selected="" value="5">KG</option>
                                                <option value="12">Ltr </option>
                                                <option value="18">Meter</option>
                                                 <option value="28">Pkt</option>
												 <option value="28">Pcs</option>
                                               
                                                 </select>  
                                                       
                                         </div>
										   <div class="form-group"  >
                                                        <label>Product Discription</label>
                                                        <span class="text-danger">*</span>
                                                       <textarea name="pdes" class="form-control" rows="5" required ></textarea> </div>
                                   
                                                    
                                 <div class="form-group" style="text-align: right;">.
                                     <br><br>
                                                       <button type="submit"  class="btn btn-primary btn-rounded waves-effect waves-light" center >&nbsp;&nbsp; Add Product &nbsp;&nbsp;</button>
                                </div>
                                                    
                                                   
                                              
                                            </div>
                                        </div>
                                    </div>
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

        <script type="text/javascript">

            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
            
            
            function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
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