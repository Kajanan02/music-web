<?php

namespace classes;

require_once "../classes/db-connector.php";

use classes\DBConnector;
use Exception;
use PDO;
use PDOException;

class Listener{
    private $listener_id;
    private $firstname;
    private $lastname;
    private $email;
    private $profile_pic;
    private $subscription_status;
    private $plan_id;
    private $username;
    private $password;
    private $card_number;
    private $expiry_date;

    public function setListenerID($listener_id) {
        $this->listener_id = $listener_id;
    }

    // Class constructor cannot be used as getAvailableUsernames() is executed before addListener()
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setSubscription($subscription_status){
        $this->subscription_status = $subscription_status;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function addListener(){
        $con = DBConnector::getConnection();

        $query = "INSERT INTO listener(first_name, last_name, email, subscription_status, username, password) VALUES(?,?,?,?,?,?)";
        try{
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->firstname);
            $pstmt->bindValue(2, $this->lastname);
            $pstmt->bindValue(3, $this->email);
            $pstmt->bindValue(4, $this->subscription_status);
            $pstmt->bindValue(5, $this->username);
            $pstmt->bindValue(6, $this->password);
            $a = $pstmt->execute();
            if($a > 0){
                header("Location: ../../user-login.php?error=0");
            }
            else{
                header("Location: ../../user-signup.php?error=6"); //registration unsuccessful
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getAvailableUsernames(){
        $con = DBConnector::getConnection();

        $usernames = array();

        $query = "SELECT username FROM listener";

        try{
            $pstmt = $con->prepare($query);
            $pstmt->execute();

            $listeners = $pstmt->fetchAll(PDO::FETCH_NUM);

            foreach($listeners as $l){
                array_push($usernames, $l[0]);
            }

            return $usernames;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function changePassword($enteredPassword, $newpassword) {
        try {
            $con = DBConnector::getConnection();

            // Select the current password for the listener
            $selectQuery = "SELECT password FROM listener WHERE listener_id = ?";
            $selectStmt = $con->prepare($selectQuery);
            $selectStmt->bindValue(1, $this->listener_id);
            $selectStmt->execute();
            $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $storedPassword = $row['password'];

                if (password_verify($enteredPassword, $storedPassword)) {

                    $updateQuery = "UPDATE listener SET password=? WHERE listener_id=?";
                    $updateStmt = $con->prepare($updateQuery);
                    $updateStmt->bindValue(1, password_hash($newpassword, PASSWORD_BCRYPT));
                    $updateStmt->bindValue(2, $this->listener_id);
                    $a = $updateStmt->execute();

                    if ($a > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return 8;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}