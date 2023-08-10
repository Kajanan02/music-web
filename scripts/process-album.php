<?php

require_once "../classes/album.php";
use classes\Album;

if(isset($_POST["create"])){
    $extension = strtolower(pathinfo($_FILES["album_art"]["name"],PATHINFO_EXTENSION));

    if(empty($_POST["artist_id"]) || empty($_POST["album_name"]) || empty($_POST["release_date"]) || empty( $_FILES["album_art"])){
        header("Location: ../artist-dashboard.php?a_error=1"); //fill out all the fields
    }
    else if($_FILES["album_art"]["size"] > 5000000){
        header("Location: ../artist-dashboard.php?a_error=3"); //file size if greater than 5MB
    }
    else if($extension != "png" && $extension != "jpg" && $extension != "jpeg"){
        header("Location: ../artist-dashboard.php?a_error=2"); //file type is not supported
    }
    else if($_FILES["album_art"]["size"] > 5000000){
        header("Location: ../artist-dashboard.php?a_error=3"); //file size if greater than 5MB
    }
    else{
        $album_name = trim($_POST["album_name"]);
        $release_date = trim($_POST["release_date"]);        
        $artist_id = trim($_POST["artist_id"]);

        $album = new Album($album_name, $release_date, $artist_id);
        $album->addAlbum();

        $album_id = $album->getAlbumID();
        $album_art_file = $_FILES["album_art"];
        $newFileName = $album_id.".".$extension;
        rename($album_art_file["name"], $newFileName);
        $newFileLocation = ".././assets/album-art/$newFileName";

        if(file_exists($newFileLocation)){
            unlink($newFileLocation);
        }
        move_uploaded_file($album_art_file["tmp_name"], $newFileLocation);

        $album->setAlbumArt($newFileName);
        $album->updateAlbumArt();
    }
}