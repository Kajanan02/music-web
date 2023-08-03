<?php

require_once ".././classes/user.php";

use classes\User;

if(isset($_POST["login"])){
    if(empty($_POST["username"]) || empty($_POST["password"])){
        header("Location: ../user-login.php?error=4");
    }
    else{
        $user = new User();
        $input_usertype = $_POST["user_type"];
        $input_username = $_POST["username"];
        $input_password = $_POST["password"];
        $user->verifyLogin($input_usertype, $input_username, $input_password);
    }
}
else{
    header("Location: ../user-login.php?error=3");
}