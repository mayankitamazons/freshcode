<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .pass_show{position: relative} 

.pass_show .ptxt { 

position: absolute; 

top: 50%; 

right: 10px; 

z-index: 1; 

color: #f36c01; 

margin-top: -10px; 

cursor: pointer; 

transition: .3s ease all; 

} 

.pass_show .ptxt:hover{color: #333333;} 
#set 
{
    background-color:limegreen;
    width:200px;
    height:50px;
    border:1px solid limegreen;
    border-radius:40px;
    margin-left:50
}
body 
{
    background-color:aliceblue;
}

    </style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
		    
		   
		       <label>New Password</label>
            <div class="form-group pass_show" > 
                <input type="password" value="xyz@7767544" class="form-control" placeholder="New Password" id="new"> 
            </div> 
		       <label>Confirm Password</label>
            <div class="form-group pass_show" > 
                <input type="password" value="xyz@656645" class="form-control" placeholder="Confirm Password" id="conform"> 
            </div> 
            <br>
            <button id="set" onclick=" return Validate()"><a href="ok.php">Submit</a></button>
		</div>  
	</div>
</div>
</body>
<script>
    $(document).ready(function(){
$('.pass_show').append('<span class="ptxt">Show</span>');  
});
  

$(document).on('click','.pass_show .ptxt', function(){ 

$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

});

    </script>
    <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("new").value;
        var confirmPassword = document.getElementById("conform").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
</html>