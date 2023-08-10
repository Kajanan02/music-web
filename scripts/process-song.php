<?php

require_once "../classes/song.php";
use classes\Song;

if(isset($_POST["addSong"])){
    $extension1 = strtolower(pathinfo($_FILES["lrc"]["name"], PATHINFO_EXTENSION));
    $extension2 = strtolower(pathinfo($_FILES["audio"]["name"], PATHINFO_EXTENSION));

    if(empty($_POST["album_id"]) || empty($_POST["song_name"]) || empty($_FILES["lrc"]) || empty($_POST["track_id"]) ||
    empty($_FILES["audio"]) || empty($_POST["genre"]) || empty($_POST["collaborations"])){
        header("Location: ../artist-dashboard.php?s_error=1"); //empty fields
    }
    elseif($extension1 != "lrc"){
        header("Location: ../artist-dashboard.php?s_error=2"); // lyrics file is not in lrc format
    }
    elseif($extension2 != "mp3" && $extension2 != "ogg"){
        header("Location: ../artist-dashboard.php?s_error=3"); // audio should be mp3/ ogg
    }
    elseif($_FILES["lrc"]["size"] > 2000000){
        header("Location: ../artist-dashboard.php?s_error=4"); // file size is greater than 2MB
    }
    elseif($_FILES["audio"]["size"] > 10000000){
        header("Location: ../artist-dashboard.php?s_error=5"); // file size is greater than 10MB
    }
    elseif(!is_numeric($_POST["track_id"])){
        header("Location: ../artist-dashboard.php?s_error=6"); // track number must be an integer
    }
    else{
        $song_name = trim($_POST["song_name"]);
        $genre = trim($_POST["genre"]);
        $track_id = trim($_POST["track_id"]);
        $collaborations = trim($_POST["collaborations"]);
        $album_id = trim($_POST["album_id"]);
        $artist_id = trim($_POST["artist_id"]);

        $song = new Song($song_name, $genre, $track_id, $collaborations, $album_id, $artist_id);
        $a = $song->addSong();

        $lrc = $_FILES["lrc"];
        $newFileName1 = $song->getSongID()."."."$extension1";
        rename($lrc["name"], $newFileName1);
        $newFileLocation1 = "../assets/lrc/".$newFileName1;
        if(file_exists($newFileLocation1)){
            unlink($newFileLocation1);
        }
        move_uploaded_file($lrc["tmp_name"], $newFileLocation1);

        $audio = $_FILES["audio"];
        $newFileName2 = $song->getSongID()."."."$extension2";
        rename($audio["name"], $newFileName2);
        $newFileLocation2 = "../assets/audio/".$newFileName2;
        if(file_exists($newFileLocation2)){
            unlink($newFileLocation2);
        }
        move_uploaded_file($audio["tmp_name"], $newFileLocation2);

        if($a > 0){
            $song->setLyrics($newFileName1);
            $song->updateLyrics();
            $song->setAudio($newFileName2);
            $song->updateAudio();
        }
    }
}