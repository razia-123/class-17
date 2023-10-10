<?php
session_start();
include_once './../../contact.php';

$fname = trim($_REQUEST['fname']);
$lname = trim($_REQUEST['lname']);
$email = trim($_REQUEST['email']);
$avatar = $_FILES['avatar'];


$avatarExtension=pathinfo($avatar['name'], PATHINFO_EXTENSION);
$expectedExtension =['jpg','jpeg','png','webp'];
$errors =[];









//First Name Validation
if (empty($fname)) {
    $errors['fnameError'] = 'First name is required';
} elseif (strlen($fname) > 20) {
    $errors['fnameError'] = 'First name can not be more than 20 Character.';
}


//Last Name Validation
if (empty($lname)) {
    $errors['lnameError'] = 'Last name is required';
} elseif (strlen($lname) > 20) {
    $errors['lnameError'] = 'Last name can not be more than 20 Character.';
}

//Email Validation
if (empty($email)) {
    $errors['emailError'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['emailError'] = 'Invalid Email Address';
}


//avater/profile Validation

if(!in_array($avatarExtension ,$expectedExtension)){
    echo 'only jpg,jpeg,png and webp format is allowed';
}
elseif( $avatar['size'] >5000000){
    echo'your file too large.max file size 5 mb';
}











if(count($errors) > 0){
    $_SESSION['errors']=$errors;
    header('Location: ./../../backend/profile.php');
}else{
    $avatar_name = uniqid().'.'.$avatarExtension;
    $auth_id= $_SESSION['auth']['id'];
    if( $avatar['size']>0){
        $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',avatar='$avatar_name' WHERE id='$auth_id'"; 
    }else{
        $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email' WHERE id='$auth_id'";
    }
    
    $result = mysqli_query($conn, $query);

  if($result){
move_uploaded_file($avatar['tmp_name'],"./../../uploads/".$avatar_name);
  
$_SESSION["success"] ="profile photo update successfully!.....";

if( $avatar['size']>0){
    
$query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',avatar='$avatar_name' WHERE id='$auth_id'"; 
$_SESSION['auth']['avatar']= $avatar_name;
}
$_SESSION['auth']['fname'] = $fname;
$_SESSION['auth']['lname'] = $lname;
$_SESSION['auth']['email'] = $email;
header('Location: ./../../backend/profile.php');
       
}

}




// if(count($errors) > 0){
//     $_SESSION['errors'] = $errors;
//     header('Location: ./../../backend/profile.php');
// }else{
//     $avatar_name = uniqid().'.'.$avatarExtension;
//     $auth_id = $_SESSION['auth']['id'];
//     if($avatar['size'] > 0){
//         $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',avatar='$avatar_name' WHERE id = '$auth_id'";
//     }else{
//         $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email' WHERE id = '$auth_id'";
//     }
//     $result = mysqli_query($conn, $query);
//     if($result){
//         move_uploaded_file($avatar['tmp_name'], "./../../uploads/".$avatar_name);
//         $_SESSION['success'] = 'Profile Photo updated successfully!';
//         if($avatar['size'] > 0){
//             $_SESSION['auth']['avatar'] = $avatar_name;
//         }
//         $_SESSION['auth']['fname'] = $fname;
//         $_SESSION['auth']['lname'] = $lname;
//         $_SESSION['auth']['email'] = $email;
//         header('Location: ./../../backend/profile.php');
//     }
// }
?>
