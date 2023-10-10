<?php

session_start ();
include_once './../contact.php';
$title =trim($_REQUEST['title']);
$description =trim($_REQUEST['description']);
$cta_text =trim($_REQUEST['cta_text']);
$cta_link =trim($_REQUEST['cta_link']);
$video_link =trim($_REQUEST['video_link']);
$image =$_FILES['image'];
$image_extension=pathinfo($image['name'] ,PATHINFO_EXTENSION);
$image_size = $image['size'];

$errors=[];


//title Validation
if (empty($title)) {
    $errors['title_error'] = ' please enter a title';
} elseif (strlen($title) > 100) {
    $errors['title_error'] = 'title len not greater than 100 charcter';
}

//description Validation
if (empty($description)) {
    $errors['description_error'] = 'please enter a description';
} elseif (strlen($description) > 300) {
    $errors['description_error'] = 'description len not greater than 300 charcter';
}


//cta text Validation
if (empty($cta_text)) {
    $errors['cta_text_error'] = 'please enter a cta text';
} elseif (strlen($cta_text) > 50) {
    $errors['cta_text_error'] = ' cta text len not greater than 50 charcter';
}



//cta link Validation
if (empty($cta_link)) {
    $errors['cta_link_error'] = 'please enter a cta link';
} 
//video link Validation
if (empty($video_link)) {
    $errors['video_link_error'] = 'please enter a video link';
} 

//image validation
$expected_extension=['jpg','jpeg','png','Webp'];
if(!$image['size'] >0){
    $errors['image_error'] = 'image is required';
}
elseif(in_array($image_extension,$expected_extension)){

  $errors['image_error'] = 'image must be jpg,jpeg,png or webp ';
}
elseif($image['size'] >500000){
    $errors['image_error'] = 'image size not more than 5 mb';
}




if(count($errors)>0){
    $_SESSION['errors']=$errors;
    header("Location: ./../backend/banneredit.php?id=$banner_id");
}else{
    $image_name = uniqid().'.'.$image_extension;
  
    $query=" UPDATE banners SET title='$title' , description ='$description', cta_text='$cta_text', cta_link='$cta_link', video_link='$video_link', image='$image' WHERE id='$banner_id' ";

    $result = mysqli_query($conn, $query);

if($result){
    move_uploaded_file($image['tmp_name'],"./../uploads/".$image_name);
  
$_SESSION["success"] ="Banner updated successfully!.....";
header("Location: ./../backend/banneredit.php?id=$banner_id");
}else{
    $_SESSION["success"] ="failed.....";
header("Location: ./../backend/banneredit.php?id=$banner_id");
}
}















       
?>










