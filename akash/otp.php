
<html>
<head>
<style>
#otp
{
background-color:ALICEBLUE;
width:400px;
height:300px;
margin-left:740px;
border-radius:40px;
margin-top:200px;
}
#enterotp
{
color:BLUEVIOLET;
font-size:25px;
font-family:sans-serif;
font-weight:bold;
text-transform:uppercase;
margin-left:140px;
}
#otpnumber
{
width:300px;
height:50px;
border-radius:40px;
margin-left:50px;
border:2px solid aliceblue;
}
#otpnumber:hover
{
border:1px solid blueviolet;
}
#BTNOTP
	 {
	 width:200px;
	 height:50px;
	 background-color:BLUEVIOLET;
	 MARGIN-LEFT:100PX;
	 border-radius:50px;
	 border:2px solid BLUEVIOLET;
	 color:white;
	 font-size:16px;
	 font-family:"Times New Roman",Times,serif;
	 font-weight:bold;
	 text-transform:uppercase;
	 }
	 #BTNOTP:hover
	 {
	 opacity:0.4;
	 }
</style>
</head>
<body>
<div id="otp">
<br></br>
<h1 id="enterotp">enter otp</h1>
<br>
<FORM action="newpassword.php" method="post">
<input type="number" id="otpnumber" name="readotp" >
<BR><BR>
<INPUT TYPE="SUBMIT" VALUE="SUBMIT" ID="BTNOTP" NAME="SUBMIT"> 
</FORM>
</div>
</body>
</html>