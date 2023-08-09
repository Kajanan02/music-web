<?php

namespace classes;

require_once "../classes/db-connector.php";
use classes\DBConnector;
use PDOException;

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

    public function addSong(){
        try{
            $con = DBConnector::getConnection();
            $query = "INSERT INTO song(song_name, genre, track_id, collaborating_artists, album_id, artist_id) VALUES(?, ?, ?, ?, ?, ?)";
            $pstmt = $con->prepare($query);
            echo $this->genre;
            $pstmt->bindValue(1, $this->song_name);
            echo $this->genre;
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
}