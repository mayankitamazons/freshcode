<style>
body
{
	background-color:aliceblue;
}
table
{
margin-left:100px;
}
td
{
	padding:10px;
}
a
{
text-decoration:none;
}
th
{
	color:black;
	font-weight:bold;
	
}
button
{
	width:100px;
	height:30px;
	background-color:red;
	color:white;
	border-radius:30px;
	border:1px solid red;
}
button:hover
{
	opacity:0.4;
}

#btn
{
	width:100px;
	height:30px;
	background-color:limegreen;
	color:white;
	border-radius:30px;
	border:1px solid limegreen;
}
#btn:hover
{
	opacity:0.4;
}
</style>
<?php
require('tables.html');
?>
<?php
error_reporting(0);
include('conn.php');
$query="SELECT * FROM meradata";
$data=mysqli_query($conn, $query);
$total=mysqli_num_rows($data);
echo $result['name']."  ".$result['adhar']." ".$result['contect'];
if($total !=0)
{
	?>
	<table>
	<tr>
	<th>NAME</th>
	<th>ADHARCARD</th>
	<th>CONTECT</th>
	<th colspan="2">UPDATE RECORDS</th>
	</tr>
	<?php
	
	
	while($result=mysqli_fetch_assoc($data))
	{
	   echo "<tr>
	<td>".$result['name']."</td>
	<td>".$result['adhar']."</td>
	<td>".$result['contect']."</td>
	<td><a href='update2.php?n=$result[name]&adharcard=$result[adhar]&contect=$result[contect]'><button id=btn>Edit</button></a></td>
	<td><a href='delete.php?n=$result[name]'><button>Delete</button></a></td>
	</tr>";	
		
	}
	
}
else
{
	echo "no record found";
}
?>
</table>