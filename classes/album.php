<?php

namespace classes;

require_once "../classes/db-connector.php";
use classes\DBConnector;
use PDOException;
use PDO;

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

    public function setAlbumID($album_id){
        $this->album_id = $album_id;
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
                header("Location: ../artist-dashboard.php?a_error=4"); //DB Error
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
                header("Location: ../artist-dashboard.php?a_error=0"); 
            }
            else{
                $con->rollback();
                header("Location: ../artist-dashboard.php?a_error=5"); //DB Error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getAlbumDetails($album_id){
        try{
            $con = DBConnector::getConnection();
            $query = "SELECT album_name, release_date, thumbnail_url FROM album WHERE album_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $album_id);
            $pstmt->execute();
            $result = $pstmt->fetch();
            return $result;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateAlbum(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE album SET album_name=?, release_date=? WHERE album_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->album_name);
            $pstmt->bindValue(2, $this->release_date);
            $pstmt->bindValue(3, $this->album_id);
            $a = $pstmt->execute();
            if($a > 0){
                header("Location: ../artist-dashboard.php?a_error=0");
            }
            else{
                header("Location: ../artist-dashboard.php?a_error=4");
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteAlbum(){
        try{
            $con = DBConnector::getConnection();
            $query1 = "SELECT album.thumbnail_url, song.audio, song.lyrics FROM album INNER JOIN song ON song.album_id = album.album_id WHERE song.album_id = ?";
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $this->album_id);
            $pstmt1->execute();
            $rows = $pstmt1->fetchAll(PDO::FETCH_NUM);
            foreach($rows as $row){
                unlink("../" .$row[0]);
                unlink("../" .$row[1]);
                unlink("../" .$row[2]);
            }

            $query2 = "DELETE FROM album WHERE album_id=?";
            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $this->album_id);
            $a = $pstmt2->execute();
            if($a > 0){
                header("Location: ../artist-dashboard.php?a_error=0");
            }
            else{
                header("Location: ../artist-dashboard.php?a_error=4");
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function sendNowPlayingAlbumInfo($album_id){
        try{
            $query = "SELECT song_name, artist.artist_name, album.thumbnail_url, artist.profile_pic_url, audio, lyrics FROM song, album, artist WHERE song.artist_id=artist.artist_id AND song.album_id=album.album_id AND 
            album.album_id = ?";
            $con = DBConnector::getConnection();
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $album_id);
            $pstmt->execute();
            $result = $pstmt->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}