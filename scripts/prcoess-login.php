<?php

require_once ".././classes/user.php";

use classes\User;

if(isset($_POST["login"])){
    if(empty($_POST["username"]) || empty($_POST["password"])){
        if($_POST["user_type"] == "listener"){
            header("Location: ../user-login.php?error=4");
        }
        elseif($_POST["user_type"] == "artist"){
            header("Location: ../artist-login.php?error=4");
        }
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
    if($_POST["user_type"] == "listener"){
        header("Location: ../user-login.php?error=4");
    }
    elseif($_POST["user_type"] == "artist"){
        header("Location: ../artist-login.php?error=4");
    }
}