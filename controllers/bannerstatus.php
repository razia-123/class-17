<?php

session_start();
include_once './../contact.php';
$banner_id = $_REQUEST['id'];
$query ="UPDATE banners SET status = 0";
$result= mysqli_query($conn ,$query);
$active_query = "UPDATE banners SET status = 1 WHERE id = '$banner_id'";
$result= mysqli_query($conn ,$active_query);

if( $result){
    
            $_SESSION['mess'] = 'status Changed successfully!.';
            header('Location: ./../backend/bannerlist.php');
    
}
?>