<?php
require('page.php');
?>
<style>
body
{
	background-color:aliceblue ;
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
error_reporting(0);
include('conn.php');
$query="SELECT * FROM data";
$data=mysqli_query($conn, $query);
$total=mysqli_num_rows($data);
echo $result['name']." ".$result['adhar']." ".$result['contect'];
if($total !=0)
{
	?>
	<table>
	<tr>
	<th>NAME</th>
	<th>ADHAR CARD NUMBER</th>
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
	<td><a href='update.php?n=$result[name]&email=$result[email]&user=$result[username]&pass=$result[password]'><button id=btn>Edit</button></a></td>
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