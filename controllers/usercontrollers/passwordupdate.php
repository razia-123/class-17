<?php
session_start();
include_once './../../contact.php';
$oldpassword = trim($_REQUEST['oldpassword']);
$password = trim($_REQUEST['password']);
$confirmpassword = trim($_REQUEST['confirmpassword']);
$hashPassword = password_hash($password, PASSWORD_BCRYPT);
$errors =[];




//old Password Validation
if (empty($oldpassword)) {
    $errors['passError'] = 'oldpassword is required';
} elseif (strlen($oldpassword) < 8) {
    $errors['passError'] = 'Password can not be less than 8 Character.';
}

//Password Validation
if (empty($password)) {
    $errors['passwordError'] = 'Password is required';
} elseif (strlen($password) < 8) {
    $errors['passwordError'] = 'Password can not be less than 8 Character.';
}
//Confirm Password Validation
if ($password !== $confirmpassword) {
    $errors['confirmpasswordError'] = 'Password did not match.';
}


if ($password !== $confirmpassword) {
    $errors['confirmpasswordError'] = 'Password did not match.';
}

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ./../../backend/profile.php');
} else {
    $auth_id = $_SESSION['auth']['id'];
    $query = "SELECT password FROM users WHERE id = '$auth_id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $isvalidpassword = password_verify($oldpassword, $data['password']);
if( $isvalidpassword){
    $query = "UPDATE users SET password='$hashPassword' WHERE id = '$auth_id'";
            $result = mysqli_query($conn, $query);
         
            $_SESSION['msg'] = 'Password Changed successfully!.';
            header('Location: ./../../backend/profile.php');
    
}else{
            $_SESSION['password_error'] = 'Current Password did not match.';
        header('Location: ./../../backend/profile.php');

}
}







//     var_export($isValidPassword);

//     if ($isValidPassword) {
//         $query = "UPDATE users SET password='$hashPassword' WHERE id = '$auth_id'";
//         $result = mysqli_query($conn, $query);
//         var_dump($result);
//         $_SESSION['password_success'] = 'Password Changed successfully.';
//         header('Location: ./../../backend/profile.php');

//     } else {
//         echo 'hello';
//         $_SESSION['password_error'] = 'Current Password did not match.';
//         header('Location: ./../../backend/profile.php');
//     }



?>

