<?php
session_start(); 

if (isset($_POST["submit"])) {
    
    $cardNumber = $_POST["cardNumber"];
    $expirationMonth = $_POST["expirationMonth"];
    $expirationYear = $_POST["expirationYear"];
    $cvv = $_POST["cvv"];
    $customer_ID = $_SESSION["customerId"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';


    if (cardCusUsed($con, $cardNumber,$cvv,$customer_ID) !== false) {
        header("location:PaymentCard.php?error=redundantCard");
        exit();
    }


    
    $customer_ID = $_SESSION["customerId"] ?? null; 
    
    $expirationDate = "20{$expirationYear}-{$expirationMonth}-01";

    paymentCard($con, $cardNumber, $expirationMonth, $expirationYear, $cvv, $customer_ID);
    header("location:PaymentCard.php");
} else {
    header("location:PaymentCard.php");}
?>
