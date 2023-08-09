<?php

namespace classes;

require_once "../classes/db-connector.php";
use classes\DBConnector;
use PDOException;

class Album{
    private $album_id;
    private $album_name;
    private $release_date;
    private $album_art;
    private $artist_id;

    public function __construct($album_name, $release_date, $artist_id)
    {
        $this->album_name = $album_name;
        $this->release_date = $release_date;
        $this->artist_id = $artist_id;
    }

    public function getAlbumID(){
        return $this->album_id;
    }

    public function setAlbumArt($filename){
        $this->album_art = $filename;
    }

    public function addAlbum(){
        try{
            $con = DBConnector::getConnection();
            $query = "INSERT INTO album(album_name, release_date, artist_id) VALUES(?, ?, ?)";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->album_name);
            $pstmt->bindValue(2, $this->release_date);
            $pstmt->bindValue(3, $this->artist_id);
            $a = $pstmt->execute();
            $this->album_id = $con->lastInsertId();
            
            if($a <= 0){
                header("Location: ../artist-dashboard.php?error=4"); //DB Error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateAlbumArt(){
        try{
            $con = DBConnector::getConnection();
            $query2 = "UPDATE album SET thumbnail_url=? WHERE album_id=?";
            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, "assets/album-art/$this->album_art");
            $pstmt2->bindValue(2, $this->album_id);
            $b = $pstmt2->execute();

            if($b > 0){
                header("Location: ../artist-dashboard.php?error=0"); 
            }
            else{
                $con->rollback();
                header("Location: ../artist-dashboard.php?error=5"); //DB Error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}