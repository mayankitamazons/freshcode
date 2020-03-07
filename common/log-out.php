<?php 
ob_start();
session_start();
unset($_SESSION['admin_id']);

session_destroy();
ob_clean();
header("Location:../index.php");
?>