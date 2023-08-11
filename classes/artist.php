<?php

namespace classes;

require_once "../classes/db-connector.php";

use classes\DBConnector;
use Exception;
use PDO;
use PDOException;

class Artist{
    private $artist_id;
    private $name;
    private $email;
    private $city;
    private $country;
    private $profile_pic_url;
    private $cover_pic_url;
    private $bio;
    private $username;
    private $password;

    public function getAvailableUsernames(){
        $con = DBConnector::getConnection();

        $usernames = array();

        $query = "SELECT username FROM artist";

        try{
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $artists = $pstmt->fetchAll(PDO::FETCH_NUM);

            foreach($artists as $a){
                array_push($usernames, $a[0]);
            }

            return $usernames;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function setArtistID($artist_id){
        $this->artist_id = $artist_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function setCountry($country){
        $this->country = $country;
    }

    public function setProfilePic($profile_pic_url){
        $this->profile_pic_url = $profile_pic_url;
    }

    public function setCoverPic($cover_pic_url){
        $this->cover_pic_url = $cover_pic_url;
    }

    public function setBio($bio){
        $this->bio = $bio;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getData(){
        $con = DBConnector::getConnection();
        $query = "SELECT artist.profile_pic_url, artist.artist_name, artist.email, artist.city, artist.country, artist.cover_pic_url, subscription.plan_name, 
            artist.artist_description, artist.username FROM artist INNER JOIN subscription ON artist.plan_id = subscription.plan_id WHERE artist.artist_id = ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $this->artist_id);
        $pstmt->execute();
        $row = $pstmt->fetch(PDO::FETCH_NUM);
        
        return $row;
    }

    public function updateArtist(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE artist SET artist_name=?, artist_description=?, email=?, city=?, country=?, username=? WHERE artist_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->name);
            $pstmt->bindValue(2, $this->bio);
            $pstmt->bindValue(3, $this->email);
            $pstmt->bindValue(4, $this->city);
            $pstmt->bindValue(5, $this->country);
            $pstmt->bindValue(6, $this->username);
            $pstmt->bindValue(7, $this->artist_id);
            $a = $pstmt->execute();
            if($a>0){
                return true;
            }
            else{
                return false; // DB error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function changePassword(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE artist SET password=? WHERE artist_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->password);
            $pstmt->bindValue(2, $this->artist_id);
            $a = $pstmt->execute();
            if($a>0){
                return true;
            }
            else{
                return false; // DB error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function changeProfilePicture(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE artist SET profile_pic_url=? WHERE artist_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "assets/artist-art/".$this->profile_pic_url);
            $pstmt->bindValue(2, $this->artist_id);
            $a = $pstmt->execute();
            if($a>0){
                return true;
            }
            else{
                return false; // DB error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function changeCoverPicture(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE artist SET cover_pic_url=? WHERE artist_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "assets/cover-art/".$this->cover_pic_url);
            $pstmt->bindValue(2, $this->artist_id);
            $a = $pstmt->execute();
            if($a>0){
                return true;
            }
            else{
                return false; // DB error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}