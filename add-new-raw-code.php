<html>
<script language="javascript">
function addRow(tableID)
{var table=document.getElementById(tableID);
var rowCount=table.rows.length;
var row=table.insertRow(rowCount);

var colCount=table.rows[0].cells.length;
for(var i=0;i<colCount;i++)
{var newcell=row.insertCell(i);
newcell.innerHTML=table.rows[0].cells[i].innerHTML;
switch(newcell.childNodes[0].type)
{case"text":newcell.childNodes[0].value="";
break;
case"checkbox":newcell.childNodes[0].checked=false;
break;
case"select-one":newcell.childNodes[0].selectedIndex=0;
break;
}}}
function deleteRow(tableID)
{
try{var table=document.getElementById(tableID);
var rowCount=table.rows.length;
for(var i=0;i<rowCount;i++){
var row=table.rows[i];
var chkbox=row.cells[0].childNodes[0];
if(null!=chkbox&&true==chkbox.checked){
if(rowCount<=1){alert("Cannot delete all the rows.")
;break;}
table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}</script>





<table id="dataTable" class="table table-border">
							<tr>
							<td><input type="checkbox" name="chk" ></td>
							
							<td><select class="form-control" id="product" name="product[]" required>
							<option value="">Select Product</option>
							<?php /*
										$getdetail = mysql_query("SELECT * FROM `product_detail` WHERE `status` = 1 ORDER BY `product_detail`.`product_name` ASC");
										while($getd = mysql_fetch_assoc($getdetail))
										{
										?>
										<option value="<?php echo $getd['id']; ?>"><?php echo $getd['product_name']; ?></option>
										<?php 
										}
										*/?>
						</select></td>
						
						<td><select class="form-control" id="qty" name="qty[]" required>
							<option value="">Select Quantity</option>
										<?php for($i=1;$i<=100;$i++) 
										{ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
						</select></td>
						
						<td>
							<input type="text" placeholder="Amount Per Piece" name="amount[]" id="amount" required />
						</td>
                        
                        
                        
                        </tr>
                        
                        </table>
						<a onclick="addRow('dataTable')">Add</a>&nbsp;&nbsp; <a onclick="deleteRow('dataTable')">Delete</a>

</html>