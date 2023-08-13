<?php

namespace classes;

require_once "../classes/db-connector.php";
use classes\DBConnector;
use PDOException;
use PDO;

class Song{
    private $song_id;
    private $song_name;
    private $genre;
    private $track_id;
    private $audio;
    private $lyrics;
    private $collaborating_artists;
    private $album_id;
    private $artist_id;

    private $play_count;
    private $download_count;

    public function __construct($song_name, $genre, $track_id, $collaborating_artists, $album_id, $artist_id)
    {
        $this->song_name = $song_name;
        $this->genre = $genre;
        $this->track_id = $track_id;
        $this->collaborating_artists = $collaborating_artists;
        $this->album_id = $album_id;
        $this->artist_id = $artist_id;
        echo $this->genre;
    }

    public function setLyrics($filename){
        $this->lyrics = $filename;
    }

    public function setAudio($filename){
        $this->audio = $filename;
    }

    public function getSongID(){
        return $this->song_id;
    }

    public function setSongID($song_id){
        $this->song_id = $song_id;
    }

    public function addSong(){
        try{
            $con = DBConnector::getConnection();
            $query = "INSERT INTO song(song_name, genre, track_id, collaborating_artists, album_id, artist_id) VALUES(?, ?, ?, ?, ?, ?)";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->song_name);
            $pstmt->bindValue(2, $this->genre);
            $pstmt->bindValue(3, $this->track_id);
            $pstmt->bindValue(4, $this->collaborating_artists);
            $pstmt->bindValue(5, $this->album_id);
            $pstmt->bindValue(6, $this->artist_id);
            
            $a = $pstmt->execute();
            $this->song_id = $con->lastInsertId();
            return $a;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }     
    }

    public function updateAudio(){
        try{
            $con = DBConnector::getConnection();
            $query3 = "UPDATE song SET audio=? WHERE song_id=?";
            $pstmt3 = $con->prepare($query3);
            $pstmt3->bindValue(1, "assets/audio/".$this->audio);
            $pstmt3->bindValue(2, $this->song_id);
            $b = $pstmt3->execute();
            if($b > 0){
                header("Location: ../artist-dashboard.php?s_error=0");
            }
            else{
                $con->rollback();
                header("Location: ../artist-dashboard.php?s_error=7"); //DB Error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateLyrics(){
        try{
            $con = DBConnector::getConnection();
            $query2 = "UPDATE song SET lyrics=? WHERE song_id=?";
            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, "assets/lrc/".$this->lyrics);
            $pstmt2->bindValue(2, $this->song_id);
            $b = $pstmt2->execute();
            if($b > 0){
                header("Location: ../artist-dashboard.php?s_error=0");
            }
            else{
                $con->rollback();
                header("Location: ../artist-dashboard.php?s_error=8"); //DB error
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getSongDetials($song_id){
        try{
            $con = DBConnector::getConnection();
            $query = "SELECT album.thumbnail_url, song.audio, song.album_id, song.song_name, song.track_id, song.genre, 
                    song.collaborating_artists FROM song, album WHERE song.album_id = album.album_id AND song.song_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $song_id);
            $pstmt->execute();
            return $pstmt->fetch();
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateSong(){
        try{
            $con = DBConnector::getConnection();
            $query = "UPDATE song SET song_name=?, genre=?, track_id=?, collaborating_artists=?, album_id=? WHERE song_id=?";
            $pstmt = $con->prepare($query);         
            $pstmt->bindValue(1, $this->song_name);
            $pstmt->bindValue(2, $this->genre);
            $pstmt->bindValue(3, $this->track_id);
            $pstmt->bindValue(4, $this->collaborating_artists);
            $pstmt->bindValue(5, $this->album_id);
            $pstmt->bindValue(6, $this->song_id);
            $pstmt->execute();
            $a = $pstmt->execute();
            if($a > 0){
                header("Location: ../artist-dashboard.php?s_error=0");
            }
            else{
                header("Location: ../artist-dashboard.php?s_error=4");
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }   
    }

    public function deleteSong(){
        try{
            $con = DBConnector::getConnection();
            $query1 = "SELECT audio, lyrics FROM song WHERE song_id = ?";
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $this->song_id);
            $pstmt1->execute();

            $row = $pstmt1->fetch(PDO::FETCH_NUM);
            unlink("../" .$row[0]);
            unlink("../" .$row[1]);

            $query2 = "DELETE FROM song WHERE song_id=?";
            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $this->song_id);
            $a = $pstmt2->execute();
            if($a > 0){
                header("Location: ../artist-dashboard.php?s_error=0");
            }
            else{
                header("Location: ../artist-dashboard.php?s_error=4");
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }  
    }

    public function playRandom(){
        try{
            $query = "SELECT song_name, artist.artist_name, album.thumbnail_url, artist.profile_pic_url, audio, lyrics 
                FROM song, album, artist WHERE song.artist_id=artist.artist_id AND song.album_id=album.album_id 
                ORDER BY RAND() LIMIT 3";
            $con = DBConnector::getConnection();
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $result = $pstmt->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}