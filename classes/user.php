<?php

namespace classes;

require_once "../classes/db-connector.php";

use classes\DBConnector;
use PDO;
use PDOException;

class User{
    public function verifyLogin($user_type, $input_username, $input_password){
        $con = DBConnector::getConnection();
    
        if($user_type == "listener"){
            $query = "SELECT username, password from listener where username=?";
            try{
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $input_username);
                $pstmt->execute();
                $a = $pstmt->fetch(PDO::FETCH_ASSOC);
                if($a > 0){
                    //encrypted = password_hash($input_password, PASSWORD_BCRYPT);
                    if($a["password"] == $input_password){
                        header("Location: ../index.php");
                    }
                    else{
                        header("Location: ../user-login.php?error=2");
                    }
                }
                else{
                    header("Location: ../user-login.php?error=1");
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        elseif($user_type == "artist"){

        }
    }
}