<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    @import url(http://fonts.googleapis.com/css?family=Lato);

.container
{
    width:800px;
    overflow:hidden;
    display:inline-block;
}
.side-bar
{
    background:#74AFAD;
    position:absolute;
    height:100%;
    width:200px;
    color:#fff;
    transition: margin-left 0.5s;
}

.side-bar ul
{
    list-style:none;
    padding:0px;
    
}

.side-bar ul li.menu-head
{
    font-family: 'Lato', sans-serif;
    padding:20px;
}


.side-bar ul li.menu-head a
{
    color:#fff;
    text-decoration:none;
    height:50px;
}


.side-bar ul .menu-head  a
{
    color:#fff;
    text-decoration:none;
    height:50px;
}

.side-bar ul .menu li  a 
{
    color:#fff;
    text-decoration:none;
    display:inline-table;
    width:100%;
    padding-left:20px;
    padding-right:20px;
    padding-top:10px;
    padding-bottom:10px;
}

.side-bar ul .menu li  a:hover
{
    border-left:3px solid #ECECEA;    
    padding-left:17px;
}

.side-bar ul .menu li  a.active
{
    padding-left:17px;
    background:#D9853B;
    border-left:3px solid #ECECEA;
}

.side-bar ul .menu li  a.active:before {
   content:"";
   position: absolute;
   width: 0;
   height: 0;
   border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
	
	border-left: 7px solid #D9853B;
    margin-top: -10px;
    margin-left: 180px;
}


.content
{
    padding-left: 200px;
    transition: padding-left 0.5s;
}

.active > .side-bar
{
    margin-left:-150px;   
    transition: margin-left 0.5s;
}

.active > .content
{
    padding-left:50px;
    transition: padding-left 0.5s;
}
    </style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="wrapper">
    	    <div class="side-bar">
                <ul>
                    <li class="menu-head">
                        Fresh   Brigade <a href="#" class="push_menu"><span class="glyphicon glyphicon-align-justify pull-right"></span></a>
                    </li>
                    <div class="menu">
                        <li>
                            <a href="#">Dashboard <span class="glyphicon glyphicon-dashboard pull-right"></span></a>
                        </li>
                        <li>
                            <a href="#" class="active">Users Data<span class="glyphicon glyphicon-heart pull-right"></span></a>
                        </li>
                        <li>
                            <a href="#">Login<span class="glyphicon glyphicon-star pull-right"></span></a>
                        </li>
                        <li>
                            <a href="#">Signup<span class="glyphicon glyphicon-cog pull-right"></span></a>
                        </li>
                    </div>
                    
                </ul>
    	    </div>   
            
             <?php
             require('displaymyrecords.php');
             ?>      
<script>
    $(document).ready(function(){
    $(".push_menu").click(function(){
         $(".wrapper").toggleClass("active");
    });
});
    </script>
    </body>
    </html>