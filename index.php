<?php
error_reporting(0);
ob_start();
session_start();

if($_SESSION['bill_admin_id'] != '')
{
	header("Location:home.php");
}

?>
<!DOCTYPE html>

<html>
	
<!-- Mirrored from coderthemes.com/ubold/light/page-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:17:38 GMT -->
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Gst Billig System Devlop by Nirmal Sankhla ">
		<meta name="author" content="Coderthemes">

		  <link rel="shortcut icon" href="assets/images/s.png">

        <title>Fresh Brigade</title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

	</head>
	<body>

		<div class="account-pages"></div> 
		<div class="clearfix"></div>
		
		<div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h4 class="text-center"> Sign In to <strong class="text-custom">Billing System</strong></h4>
				</div>

				<div class="p-20">
					<form class="form-horizontal m-t-20" action="action-page/log-in-action.php" method="post">

						<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="text" required="" placeholder="Username" name="name">
							</div>
						</div>

						<div class="form-group">
							<div class="col-12">
								<input class="form-control" type="password" required="" placeholder="Password" name="pass">
							</div>
						</div>
 <?php 
		
		  if($_SESSION['fail']==1)
		  {
			  ?>  <font face="calibri" color="red"><big> <label>invalid username & password!</label></big></font>
			  <?php
			  unset($_SESSION['fail']);
									}
		 ?>
						<div class="form-group text-center m-t-40">
							<div class="col-12">
								<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
									Log In
								</button>
							</div>
						</div>

						
					
						
						
					</form>

				</div>
			</div>
			

		</div>

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

<!-- Mirrored from coderthemes.com/ubold/light/page-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:17:38 GMT -->
</html>