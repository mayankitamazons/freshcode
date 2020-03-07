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
	
	 
error_reporting(0);
ob_start();


$query = mysqli_query($con,"SELECT * FROM `cust_invoice_info` ORDER BY `cust_invoice_info`.`id` DESC");
$data = mysqli_fetch_assoc($query);

$last_id = $data['invoice_no'];

$a = substr($last_id,2,4);

if($a == '')
{
	$a = 1000;
}
$b = $a+1;
$f = "SM";
$invoice = $f.$b;
		
                    
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


    <body class="fixed-left">

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


                                
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                                    <li class="breadcrumb-item"><a href="#">New Invoice</a></li>
                                    <li class="breadcrumb-item active">Add Details to invoice</li>
                                </ol>
                                
                            </div>
                        </div>



                        <div class="row">
					
                            <div class="col-sm-12">
                                <div class="card-box">
                                    	<form method="post" action="action-page/add-bill.php">
                                    <div class="row">
                                      <div class="col-lg-12" align="right"  >
                                            <div class="form-group">
                                                <label>Bill No.</label>
                                                <div>
                                                    <div class="form-group">
                                                        <label ><?php echo $invoice;?></label>
														<input name="bill_number" type="hidden"  value="<?php echo $invoice;?>"size="10"  class="border" readonly/>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label>Customer Name</label>


                                                <select class="selectpicker" data-live-search="true" data-style="btn-white" id="cust" name="cust" required >
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
                                            <div class="form-group">
                                                <label>Bill Date</label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="datepicker-autoclose" id="datepicker-autoclose">
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
                                            
                                                        <br>
                                                                <select class="selectpicker" data-live-search="true" data-style="btn-white" id="product" name="product">
                                                                    <option value="0"selected="">----Select Product----</option>

                                                                    <?php 


                                                                    $query= mysqli_query($con,"select * from product;");
                                                                    while($b = mysqli_fetch_assoc($query))
                                                                    { 
                                                                    ?>

                                                                    <option value="<?php echo $b['product_code']; ?>"> <?php echo $b['product_name']; ?> </option>
                                                                    <?php 
                                                                    }
                                                                    ?> 

                                                                </select>
                                        </div>
                                        <div class="col-lg-6">
                                                <br>
                                            <select class="form-control"  id="qty" name="qty">
                                             <option value="0" selected="">----Select Quantity----</option></select>
                                        </div>
                                        
                                          
                                        
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-12" align="center">
                                        <br><br>
                                        
<button id="add" name="add" type="button" class="btn btn-inverse btn-rounded waves-effect waves-light">Add Product</button>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php 
                                            $query= mysqli_query($con,"select * from product;");


                                            ?>
                                            <div class="table-responsive" data-pattern="priority-columns">
                                                <table id="tdd" name="tdd" class="table table-striped add-edit-table" >
                                                  
                                                    <thead>
                                                        <legend>Product </legend>
                                                        <tr>
                                                            <th  style="width:10%">S.No</th>
                                                            <th style="text-align:center">Product Name</th>
                                                            <th style="text-align:center" >Quantity</th>
                                                               <th style="width:10%" >Remove Product</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                     
                                                    </tbody>
                                                  
                                                </table>

                                            </div>

                                        </div>
 <div class="col-lg-12" align="center">
                                        <br><br>
 <button  style="display: none;" id="Genrate" name="Genrate" class="btn btn-inverse waves-effect waves-light">Genrate Bill </button></div>
 
                                    </div>
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

        <!-- END wrapper -->

  <script > 
       var count=0;
 var s=0;   
                                                        jQuery(document).ready(function($){
                                                            var totalQty='';
                                                            var i;
														var arrProduct = new Array();
	
   
	
if(performance.navigation.type == 2){
   location.reload(true);
}

                                                            $('#product').change(function(){
                                                                // alert("Enter uantity ");
                                                                var query =document.getElementById("product").value;


                                                                $.ajax({
                                                                    url:"fatch-qty.php",
                                                                    method:"POST",
                                                                    async: false,
                                                                    dataType: 'json', 
                                                                    data:{query:query},
                                                                    success:function(data)
                                                                    {
                                                                        totalQty=data;
                                                                       

                                                                        $("#qty").empty();
                                                                          $("#qty").append(' <option  value="0" selected="">----Select Quantity----</option>');	
                                                                        for(i=1;i<=totalQty;i++){
                                                                            $("#qty").append('<option value=' + i + '>' + i + '</option>');	
                                                                        }


                                                                    }
                                                                });


                                                            });
                                                            
                                                            
                                                         
	$('#add').click(function(){
		var genBtn = document.getElementById('Genrate');
		
		
		 if(count>=0)
		{
			
	genBtn.style.display = 'block';
		}
    s++; 
        
		
		
     
		cust = document.getElementById("cust").value;
       
   var datee = document.getElementById("datepicker-autoclose").value;
	var productid = document.getElementById("product").value;
	var qty = document.getElementById("qty").value;
	
	 
	 
	

	
	
		
		
	
	
	
	
	
	
        
              jQuery("#qty").val(0).trigger('change'); 
			jQuery("#product").val(0).trigger('change'); 
		//jQuery("#qty").append(' <option  value="0" selected="">Select Product</option>');	
          
        
        if(cust=="0"){
                 alert("Please Select Customer");
				 if(count!=0){
					 
					   count=count-1;
				 }
              
				
                genBtn.style.display = 'none';
                }
        
         else if(datee==""){
                 alert("Please Select date");
                if(count!=0){
					 
					   count=count-1;
				 }
            
				  genBtn.style.display = 'none';
                
                }
    
        else if(productid=="0"){
            alert("Please Select Product");
			if(count!=0){
					 
					   count=count-1;
				 }
             
			  genBtn.style.display = 'none';
            
        }
        else if(qty=="0"){
                 alert("Please Select Quantity");
                 count=count-1;
				  genBtn.style.display = 'none';
                
                }else if( $.inArray(productid, arrProduct) !== -1 ) {

    alert("This product already added !");
	
	
	
	 count=count-1;
	}
				
				
				
        
        else {
			arrProduct.push(productid);
            
            $.ajax({
			url:"fatch-qty.php",
			method:"POST",
			data:{productid:productid},
			success:function(data)
			{
                
                $('#tdd').append('<tr id="tr'+s+'"><td >'+ s +'</td><td  style="text-align:center" >'+ data +'<input type="hidden" name="productid[]" value="'+ productid +'" size="20" readonly  class="border"/></td><td  style="text-align:center">'+ qty +'<input type="hidden" name="qty[]" value="'+ qty +'"size="10" id="qt" class="border" readonly/><td ><Button  id="'+s+'"  class="btn btn-danger btn_remove" >X</button></td></tr>');	
                
                count=count+1;
                
                }
				 
				
            
                 });
				 
				
                
        }
		
       
        

                                     });
                                                            
                                                            
                  
                                                            
                                                            
            $(document).on('click','.btn_remove',function(){
	var button_id = $(this).attr("id");
                count=count-1;
		
		if(count==0)
	{	
		var genBtn = document.getElementById('Genrate');
	genBtn.style.display = 'none';
    }
    
	
	$("#tr"+button_id+"").remove();
		
	});
	
	
	
	
	$('#Genrate').click(function(){
		
		if(s==0){
		 alert("Plese Select Product");	
			
		}
		
		  });
                                                            
                       });
					   
					   
					   

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




