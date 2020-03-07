<html>
	<?php include("../common/connect.php");?>
<head>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>


<select   id="pp" name="pp"  ></select>
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


	


														<script type="text/javascript">
jQuery(document).ready(function($){
                                                          
                                                        
													


														$('#cust').change(function(){
                                                               
                                                                 var cust_id =document.getElementById("cust").value;
																 alert(cust_id);
																// $('#pp').html(cust_id);	

                                                                $.ajax({
																	
                                                                     url:"data.php",
                                                                    method:"POST",
                                                                    async: false,
                                                                    dataType: 'html', 
                                                                    data:{cust_id:cust_id},
                                                                    success:function(data)
                                                                    {

                                                                       alert(data);
																		$('#pp').html(data);	
                                                                      //  $("#product").empty();
                                                                       

                                                                        // for(i=1;i<=totalQty;i++){
                                                                        //     $("#product").append('<option value=' + i + '>' + i + '</option>');	
                                                                        // }


                                                                    }
                                                                });


                                                            });


													});



				</script>
</body>






</html>