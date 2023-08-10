<?php

require_once ".././classes/listener.php";
require_once ".././classes/artist.php";

use classes\Listener;
use classes\Artist;

if(isset($_POST["signup"])){
    if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["username"])
    || empty($_POST["password"] || empty($_POST["cpassword"]))){
        header("Location: ../../user-signup.php?error=2"); // empty fields
    }
    elseif($_POST["password"] != $_POST["cpassword"]){
        header("Location: ../../user-signup.php?error=3"); // passwords does not match
    }
    else{
        $listener = new Listener();
        $artist = new Artist();

        $existing_usernames = array_merge($listener->getAvailableUsernames(), $artist->getAvailableUsernames());
        if(in_array($_POST["username"], $existing_usernames)){
            header("Location: ../../user-signup.php?error=4"); // username exists
        }
        else{
            if($_POST["user_type"] == "listener"){
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email =$_POST["email"];
                $sub_status = 0;
                $username = $_POST["username"];
                $password = $_POST["password"];

                $listener->setFirstname($firstname);
                $listener->setLastname($lastname);
                $listener->setEmail($email);
                $listener->setSubscription($sub_status);
                $listener->setUsername($username);
                $listener->setPassword(password_hash($password, PASSWORD_BCRYPT));

                $listener->addListener();
            }
            // Artist Signup is removed due to the payment gateway processing needs
            else{
                header("Location: ../../user-signup.php?error=5"); // invalid user type
            }
        }
    }
}
else{
    header("Location: ../../user-signup.php?error=1"); // unauthorized access
}