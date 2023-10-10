
<?php 
session_start();
session_unset();
header('Location: ./../../backend/login.php');
?>