<?php
session_start();
include_once './../../contact.php';

$fname = trim($_REQUEST['fname']);
$lname = trim($_REQUEST['lname']);
$email = trim($_REQUEST['email']);
$password = trim($_REQUEST['password']);
$confirmpassword = trim($_REQUEST['confirmpassword']);
$hashPassword = password_hash($password, PASSWORD_BCRYPT);
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


if(count($errors) > 0){
    $_SESSION = $errors;
    header('Location: ./../../backend/register.php');
}else{
    $query = "INSERT INTO users(fname, lname, email, password) VALUES ('$fname','$lname','$email','$hashPassword')";
    $result = mysqli_query($conn, $query);
    
    
    
    if($result){
        $_SESSION["success"] ="Account Created Successfully. Please login your account.";
        header('Location: ./../../backend/login.php');
    }else{
        $_SESSION["failed"] ="Account Creation Failed.";
        header('Location: ./../../backend/register.php');
    }
  
}



?>
