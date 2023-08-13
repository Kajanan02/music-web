<?php

require_once "../classes/listener.php";

use classes\Listener;

session_start();


if (isset($_POST['change_password'])) {
    $status = true;

    $listener_id = $_SESSION["listener_id"];
    $enteredpassword = password_hash($_POST['password'], PASSWORD_BCRYPT); //$_POST['password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    $listener = new Listener();
    $listener->setListenerID($listener_id);
    
    if (!empty($newPassword) && !empty($confirmPassword) && $newPassword == $confirmPassword) {
        
        $status = $listener->changePassword($enteredpassword,$newPassword);
    } else {
        header("Location: ../user-settings.php?error=");
        
        exit;
    }
    
    if ($status) {
        header("Location: ../user-settings.php?error=0");
    } else {
        header("Location: ../user-settings.php?error=8");
    }
    
}
