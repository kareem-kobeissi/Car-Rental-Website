<?php
session_start(); 

if (isset($_POST["submit"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mail = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $city = $_POST["city"]; 
    $street = $_POST["street"]; 
    $pass = $_POST["password"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

   
    if (emailUsed($con, $mail) !== false) {
        $_SESSION["signupError"] = "Email is already in use. Please use a different email.";
        header("location:frontSignup.php");
        exit();
    }

   
    if (createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass)) {
        header("location:frontLogin.php");
        exit();
    } else {
        $_SESSION["signupError"] = "Registration failed. Please try again.";
        header("location:frontSignup.php");
        exit();
    }
} else {
    header("location:frontSignup.php");
    exit();
}
