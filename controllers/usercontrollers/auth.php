<?php
session_start();
include_once './../../contact.php';


$email = trim($_REQUEST['email']);
$password = trim($_REQUEST['password']);

// $hashPassword = password_hash($password, PASSWORD_BCRYPT);
$errors =[];


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



if(count($errors) > 0){
    $_SESSION = $errors;
    header('Location: ./../../backend/login.php');
}else{
   
$query = "SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($conn, $query);
   $authuserdata = mysqli_fetch_assoc($result);


if(mysqli_num_rows($result) >0){
 $isvalidpassword = password_verify($password,$authuserdata['password']);
 if($isvalidpassword){
    $_SESSION['auth']=$authuserdata;
    header('Location: ./../../backend/dashboard.php');
   
}else{
    $_SESSION['pass_error']='wrong password';
    header('Location: ./../../backend/login.php');
 }

}
else{
    $_SESSION['email_error']='please inter correct email';
    header('Location: ./../../backend/login.php');
}



    // echo '<pre>';
    //   print_r($data);
    // echo '</pre>';
}




?>