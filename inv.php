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
		
		
		$c=$_GET['code'];
		
		$query = mysqli_query($con,"SELECT * FROM `order_info` WHERE `order_id`='$c'");
		$data = mysqli_fetch_assoc($query);
	 $billing_name = $data['billing_name'];
		$payment_method	 = $data['payment_method'];
			$cust_id	 = $data['cust_id'];
			$order_date	 = $data['order_date'];
		
		
	
		$query2 = mysqli_query($con,"SELECT * FROM `fb_order` WHERE `order_id`='$c'");
		$data2 = mysqli_fetch_assoc($query2);
		$delivery_fee = $data2['delivery_fee'];
		$sales_order_remark	 = $data2['sales_order_remark'];
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
								<form method="post" action="action-page/updatebill.php">
										
										<div class="row" >
											<div class="col-lg-12" align="center" >
											
												<label style="font-size:25px;">Order Create</label>
											</div>
										</div>
										<div class="row" >
											
											<div class="col-lg-6">
												
												<div class="form-group" align="left" >
													<label>Invoice No :</label>
													<div>
														<div class="form-group">
															<label ><?php echo $c;?></label>
															<input name="bill_number" id="bill_number" type="hidden"  value="<?php echo $c;?>"size="10"  class="border" readonly/>
														</div>
														</div><!-- input-group -->
													</div>

</div>
												<div class="col-lg-6">
												 <div class="form-group">
                                                <label>Invoice Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input autocomplete="off" value=<?php echo $order_date;?> required type="text" class="form-control" placeholder="mm/dd/yyyy" name="datepicker-autoclose" id="datepicker-autoclose">
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
														<label>Customer Name</label><br>
														<label><?php echo $billing_name; ?></label>
														<input name="cust" id="cust" type="hidden"  value="<?php echo $cust_id;?>"size="10"  class="border" readonly/>
													
														
														
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
													<input  class="form-control" type="number"  placeholder="Delivery fee:" name="deliveryfees"  value =<?php echo $delivery_fee; ?>   />
												</div>
												
												<div class="col-lg-6">
													<label>Sales order remark</label>
													<input  name="pdec" class="form-control" rows="2" value=<?php echo $sales_order_remark; ?> />
												</div>
												
											</div>
										

                                            <br>
											<div  id ="productDiv" class="row">
												
												<div  class="col-lg-6">
													<label>Select Product</label>
                                                    <select  p_id="0" class="selectpicker" data-style="btn-white" data-live-search="true" id="product"  onchange="m_ch(this)" >
																	<option value="">Select Product</option>
																
																	<?php
																	$queryy=mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id` ='$cust_id'");
																	$data = mysqli_fetch_array($queryy);
																
																	 $rate_group = $data['rate_group'];
																
																
																
																	 $product_data=mysqli_query($con,"SELECT fb_product.code, fb_product.product_status, rate_group.product_code,fb_product.product_name,fb_product.product_hindi_name,rate_group.daily,rate_group.weakly,rate_group.monthly,rate_group.group_1,rate_group.group_2,rate_group.group_3
																FROM `fb_product` 
																INNER JOIN `rate_group` ON fb_product.code = rate_group.product_code 
																WHERE fb_product.product_status ='1' GROUP BY fb_product.code");
																$i=1;
																	while($var=mysqli_fetch_array($product_data))
																{
																	//echo 	$stat=$var["name"];
																
																
																	$price = $var[$rate_group];
																	$product_code = $var['code'];
																	$p_name = $var['product_name'];
																	$p_himdi = $var['product_hindi_name'];  ?>
																	
																	<option price="<?php echo $price; ?>" value=<?php echo $product_code; ?> ><?php echo $p_name." (".$p_himdi." )"; ?> </option>
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
                      
              
											<div class="col-lg-12" align="center"   class="row" id=tableRow>
													<label style="font-size:25px;">Products</label>
													
													<table   id="dataTable" name="dataTable"  class="table  table-striped">
												
													<tr>
												<th >SN</th>
												<th >Product Name</th>
												<th >Quantity</th>
												<th >Price</th>
												<th>Total</th>
												<th>Delete</th>
												</tr>
													<?php   
																	$i =0;
																	$product_id_value='product';
																	$query3 = mysqli_query($con,"SELECT fb_order.product,fb_order.price,fb_order.qty,fb_order.sub_total,fb_product.product_name,fb_product.product_hindi_name FROM `fb_order` INNER JOIN fb_product ON fb_product.code=fb_order.product WHERE `order_id`='$c'");
																while($bb = mysqli_fetch_assoc($query3))
																{
																	$i=$i+1;
																	 $p_code =  $bb['product'];
																	 $qty =  $bb['qty'];
																	 $price =  $bb['price'];
																	 $sub_total =  $bb['sub_total'];
																	 $product_name =  $bb['product_name'];
																	 $product_hindi_name =  $bb['product_hindi_name'];
																
																
																?>
														
													
                                                        
													<tr id="tr<?php echo $i;?>" ><td ><?php echo $i;?></td>
													<td ><label  ><?php echo $product_name." (".$product_hindi_name." )"; ?><label>
													<input type="hidden" name="product[]" value=<?php echo $p_code; ?>   readonly/></td>

													<td >
													<input tabIndex=<?php echo $i;?> require onkeyup="getPrice(this)" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="qty[]" id="qty<?php echo $i;?>" value=<?php echo $qty; ?>  /></td>

													<td ><label><?php echo $price; ?></label>
													<input id="price<?php echo $i;?>" type="hidden" name="price[]" value=<?php echo $price; ?>   readonly/></td>
													
													<td >
													<input class="form-control" type="text"  id="amount<?php echo $i;?>" name="amount[]"  value=<?php echo $sub_total; ?>   readonly/></td>
													
													<td ><Button type="button" id="<?php echo $i;?>"  class="btn btn-danger btn_remove" >X</button></td></tr>

															<?php


																}
																?>
															
														</table>
														
														
														
													
												</div>
												
												<div class="col-lg-12" align="center">
													<br><br>
												<button  id ="btnSave" class="btn btn-inverse waves-effect waves-light">UPDATE </button></div>
												
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



													function getPrice(id){

													
                                                        var mainID = $(id).attr('id');
														var subId =mainID.substring(3,);
														var priceId ="#price"+subId;
														var amountId ="#amount"+subId;
                                                        var price = $(priceId).val();
                                                        var qty = $(id).val();												
                                                        
                                                        var total = price*qty;
														$(amountId).val(total);
													
													}


										jQuery(document).ready(function($){

											var i=<?php echo $i;?>;
									



                                                          $('#product').change(function(){
                                                             // alert("dssad") ;
															   document.getElementById("selectqty").value="";	
                                                               document.getElementById("selectqty").focus();										


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

													if(productName=="Select Product")
													{
													alert("Please Select Product");
													return;
													}

													document.getElementById("btnSave").style.visibility  = 'visible'; 


                                                            $('#dataTable').append('<tr id="tr'+i+'" ><td >'+ i+'</td><td ><label>'+ productName +'<label><input type="hidden" name="product[]" value="'+ productCode +'"size="30"  readonly/></td><td ><input type="text" name="qty[]"  class="form-control" require onkeypress="return isNumberKey(event)" id="qty'+ i +'" tabIndex="'+ i +'"  value="'+ qty +'"size="30" onkeyup="getPrice(this)" /></td><td ><label>'+ price +'</label><input type="hidden" id="price'+ i +'" name="price[]" value="'+ price +'"size="30"  readonly/></td><td ><input type="text" name="amount[]" id="amount'+ i +'" class="form-control" value="'+ total +'"size="30"  readonly/></td><td ><Button type="button" id="'+i+'"  class="btn btn-danger btn_remove" >X</button></td></tr>');	


                                                       
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