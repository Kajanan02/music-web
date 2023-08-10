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
            $query = "SELECT listener_id, username, password from listener where username=?";
            try{
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $input_username);
                $pstmt->execute();
                $a = $pstmt->fetch(PDO::FETCH_ASSOC);
                if($a > 0){
                    if(password_verify($input_password, $a["password"])){
                        header("Location: ../index.php");
                        $_SESSION["listener_id"] = $a["listener_id"]; 
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
            $query = "SELECT artist_id, username, password from artist where username=?";
            try{
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $input_username);
                $pstmt->execute();
                $a = $pstmt->fetch(PDO::FETCH_ASSOC);
                if($a > 0){
                    if(password_verify($input_password, $a["password"])){
                        header("Location: ../artist-dashboard.php");
                        session_start();
                        $_SESSION["artist_id"] = $a["artist_id"];
                    }
                    else{
                        header("Location: ../artist-login.php?error=2"); // username and password does not match
                    }
                }
                else{
                    header("Location: ../artist-login.php?error=1"); //user does not exist
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
}