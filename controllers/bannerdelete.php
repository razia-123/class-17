<?php 
session_start();
include_once './../contact.php';
$banner_id = $_REQUEST['id'];
$select_id="SELECT *FROM banners";
$result= mysqli_query($conn, $select_id);
$post=mysqli_fetch_all($result,1);

$select_query = "SELECT image FROM banners WHERE id ='$banner_id'";
$select_query_result= mysqli_query($conn, $select_query);

$data = mysqli_fetch_assoc($select_query_result);


$image_path ='./../uploads/'. $data['image'];


if(count($post)>1){
if(file_exists($image_path)){
    unlink($image_path);
  
}

$query ="DELETE FROM banners WHERE id = $banner_id ";
$result= mysqli_query($conn ,$query);
if( $result){
    
    $_SESSION['delete'] = 'banner delete successfully!.';
    header('Location: ./../backend/bannerlist.php');

}else{
    $_SESSION['delete'] = 'failed';
header('Location: ./../backend/bannerlist.php');

}}
?>