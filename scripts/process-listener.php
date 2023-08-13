<?php

require_once "../classes/listener.php";

use classes\Listener;

session_start();

if (isset($_POST['save'])) {

    $status = true;

    $listener_id = $_SESSION["listener_id"];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['user_email'];
    $username = $_POST['username'];

    $subscriptionPlan = $_POST['sub_plan'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];

    $listener = new Listener();

    $listener->setListenerID($listener_id);
    $listener->setFirstName($firstName);
    $listener->setLastName($lastName);
    $listener->setEmail($email);
    $listener->setUsername($username);
    
//    $listener->setSubscriptionPlan($subscriptionPlan);
//    $listener->setCardNumber($cardNumber);
//    $listener->setExpiryDate($expiryDate);

    $status = $listener->updateListener();

    if ($status) {
        header("Location: ../user-settings.php?error=99");
    } else {
        header("Location: ../user-settings.php?error=8");
    }
} else {
    header("Location: user-settings.php");
    exit; // Add an exit to ensure no further execution after redirection
}


?>
