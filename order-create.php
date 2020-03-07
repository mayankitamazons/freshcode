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
	<?php include("common/connect.php");
		
		
	$query = mysqli_query($con,"SELECT * FROM `fb_order` ORDER BY `fb_order`.`order_id` DESC limit 1");
	$data = mysqli_fetch_assoc($query);
	$last_id = $data['order_id'];
	if($last_id == '')
	{
		$last_id = 101;
	}else
	{
	$last_id = $last_id+1;
	}
	$invoice = $last_id;
	?>
	
	<!-- Mirrored from coderthemes.com/ubold/light/form-pickers.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:32 GMT -->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
		
		<link rel="shortcut icon" href="assets/images/s.png">
		<title>Fresh Brigade</title>
	<link href="plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

        <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/main.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       

	
		
	</head>
	<body class="fixed-left" >
	    
	    	
	    		</script>
	    
		<!-- Begin page -->
		<div id="wrapper">
			<!-- Top Bar Start -->
			<?php
			include("common/header.php");
			?>   <!-- Top Bar End -->
			<!-- ========== Left Sidebar Start ========== -->
			<?php
			include("common/sidebar.php");
			?>    <!-- Left Sidebar End -->
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
								<div class="card-box">
									<form id="form1" method="post" action="action-page/add-bill.php">
										
										<div class="row" >
											<div class="col-lg-12" align="center" >
											
												<label style="font-size:25px;">Order Create</label>
											</div>
										</div>
										<div class="row" >
											
											<div class="col-lg-6">
												
												<div class="form-group" align="left" >
													<label>Order Id :</label>
													<div>
														<div class="form-group">
															<label ><?php echo $invoice;?></label>
															<input name="bill_number" type="hidden"  value="<?php echo $invoice;?>"size="10"  class="border" readonly/>
														</div>
														</div><!-- input-group -->
													</div>

</div>
												<div class="col-lg-6">
												 <div class="form-group">
                                                <label>Invoice Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input autocomplete="off" required type="text" class="form-control" placeholder="mm/dd/yyyy" name="datepicker-autoclose" id="datepicker-autoclose">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="md md-event-note"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>	
												</div>
												
											</div>
											<div class="row">
												<div class="col-lg-6">
												    
													<div class="form-group">
														<label>Customer Name</label>
														<select onchange="selectName(this)" class="selectpicker" data-live-search="true" data-style="btn-white" id="cust" name="cust" required >
															<option  value="0" selected="">----Select Customer----</option>
															<?php
															$query= mysqli_query($con,"select * from customer;");
															while($b = mysqli_fetch_assoc($query))
															{
															?>
															<option value=<?php echo $b['cust_id']; ?>  > <?php echo $b['cust_name']; ?></option>
															<?php
															}
															?>
														</select>
														
														
													</div>
												</div>
												<div class="col-lg-6">
													<label>Payment method</label>
													<select class="form-control" id="paymentmethod" name="paymentmethod"   >
														<option value="CASH">CASH</option>
														<option value="CREDIT">CREDIT</option>
														
													</select>
												</div>
												
												
												
											</div>
											
											
											<div class="row">
												
												<div class="col-lg-6">
													<label>Delivery fee</label>
													<input  class="form-control" type="number"  placeholder="Delivery fee:" name="deliveryfees"   />
												</div>
												
												<div class="col-lg-6">
													<label>Sales order remark</label>
													<input  name="pdec" class="form-control" rows="2"  />
												</div>
												
											</div>
										

                                            <br>
											<div   Style="visibility :hidden;" id ="productDiv" class="row">
												
												<div  class="col-lg-6">
													<label>Select Product</label>
                                                    <select  p_id="0" class="selectpicker" data-style="btn-white" data-live-search="true" id="product"  onchange="m_ch(this)" >
																	<option value="">Select Product</option>
																
																	<?php
																	$query= mysqli_query($con,"SELECT * FROM `fb_product` WHERE `product_status`='1'");
																	while($b = mysqli_fetch_assoc($query))
																	{
																	?>
																	
																	<option price="<?php echo $b['price']; ?>" value=<?php echo $b['code']; ?> ><?php echo $b['product_name']." (".$b['product_hindi_name']." )"; ?> </option>
																	<?php
																	}
																	?>
																</select>
												</div>
												
												<div class="col-lg-4">
													<label>Enter Quantity</label>
													<input require onkeypress="return isNumberKey(event)" name="selectqty" id="selectqty" class="form-control" rows="2"  />
												</div>

                                                <div class="col-lg-2">
												<br>
												<button  class="btn btn-inverse waves-effect waves-light" id="addProduct" onclick="return false;"  >Add Product </button>
												</div>


                                                
												
											</div>

                                            <br>
											<br>
                      
              
											<div class="col-lg-12" align="center"   Style="visibility :hidden;" class="row" id=tableRow>
													<label style="font-size:25px;">Products</label>
													
											
														
														
														<table   id="dataTable" name="dataTable" class="table table-hover" >
                                                        
															
															
														</table>
														
														
														
													
												</div>
												
												<div class="col-lg-12" align="center">
													<br><br>
												<button Style="visibility :hidden;" id ="btnSave" class="btn btn-inverse waves-effect waves-light">Save </button></div>
												
											</div>
											<br>
											<br>
											<br>
											
											
											
										</form>
										
									</div>
								</div>
								
							</div>
							<!-- end row -->
							</div> <!-- container -->
							</div> <!-- content -->
							<footer class="footer text-right">
								&copy; 2016 - 2018. All rights reserved.
							</footer>
						</div>
						
					</div>
					
					<script>
					
					
					</script>
					<!-- END wrapper -->

					<script>
					var resizefunc = [];
					</script>


					   <!-- jQuery  -->
		

				
							
										<script type="text/javascript" >
	function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function selectName(tt) {

                            
document.getElementById("productDiv").style.visibility  = 'visible'; 	
document.getElementById("tableRow").style.visibility  = 'visible'; 
document.getElementById("add").style.visibility  = 'visible'; 
document.getElementById("remove").style.visibility  = 'visible'; 

}

										jQuery(document).ready(function($){

											var i=0;
											$('#cust').change(function(){
                                                               
															   var cust_id =document.getElementById("cust").value;														

															  $.ajax({
															
																url:"fatch_price.php",
																  method:"POST",
																  async: false,
																  dataType: 'html', 
																  data:{cust_id:cust_id},
																  success:function(data)
																  {																	i=0;		
																 $("#product").empty();
																 $("#dataTable").empty();
																 $('#dataTable').append('<tr id="tr'+i+'" ><th >sn</th><th >Product Name</th><th >Quantity</th><th >price</th><th>total</th><th>action</th></tr>');
															
																	 $("#product").append(' <option  value="0" selected >----Select Product----</option>');	
																	  $('#product').append(data);	
																	 

																  }
															  });



															


														  });



                                                          $('#product').change(function(){
                                                             // alert("dssad") ;
															   document.getElementById("selectqty").value="";	
                                                               document.getElementById("selectqty").focus();										
                                                               $("#addProduct").removeClass('btn btn-danger').addClass('btn btn-inverse waves-effect waves-light');
												

														  });

                                                

													



											$('#addProduct').click(function(){
                                                i=i+1;

                                              
                                                        var productCode = $("#product option:selected").val();
                                                         var productName = $("#product option:selected").text();
                                                         var price = $("#product option:selected").attr('price');
                                                         var qty = $("#selectqty").val();
                                                        
                                                        var total = price*qty;
																													
													if(qty=="")
													{
													alert("Please Enter Quantity");
													return;
													}

													if(productName=="----Select Product----")
													{
													alert("Please Select Product");
													return;
													}

													document.getElementById("btnSave").style.visibility  = 'visible'; 


                                                            $('#dataTable').append('<tr id="tr'+i+'" ><td >'+ i+'</td><td ><label>'+ productName +'<label><input type="hidden" name="product[]" value="'+ productCode +'"size="30"  readonly/></td><td ><label>'+ qty +'</label><input type="hidden" name="qty[]" value="'+ qty +'"size="30"  readonly/></td><td ><label>'+ price +'</label><input type="hidden" name="price[]" value="'+ price +'"size="30"  readonly/></td><td ><label>'+ total.toFixed(2) +'</label><input type="hidden" name="amount[]" value="'+ total +'"size="30"  readonly/></td><td ><Button type="button" id="'+i+'"  class="btn btn-danger btn_remove" >X</button></td></tr>');	

                                                            $("#addProduct").removeClass('btn btn-inverse waves-effect waves-light').addClass('btn btn-danger');
												
                                                       
														  });


                                                          $(document).on('click','.btn_remove',function(){
	var button_id = $(this).attr("id");
	
	
	$("#tr"+button_id+"").remove();
		
	});
                                                         



													});



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

        <script src="plugins/moment/moment.js"></script>
        <script src="plugins/timepicker/bootstrap-timepicker.js"></script>
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <script src="plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/pages/jquery.form-pickers.init.js"></script>



        <script src="plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="../plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


        <script type="text/javascript" src="plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/pages/autocomplete.js"></script>

        <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>

        


				</body>
				<!-- Mirrored from coderthemes.com/ubold/light/form-pickers.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Jul 2018 08:16:35 GMT -->
			</html>