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

if(isset($_REQUEST["album_id"])){
    $album_id = $_REQUEST["album_id"];
    $album = new Album("", "", "");
    $row = $album->getAlbumDetails($album_id);
    
    $json = json_encode($row);
    echo $json;
}

if(isset($_POST["updateAlbum"])){
    $extension = strtolower(pathinfo($_FILES["new_album_art"]["name"], PATHINFO_EXTENSION));

    if(empty($_POST["sel_album_name"]) || empty($_POST["sel_release_date"])){
        header("Location: ../artist-dashboard.php?a_error=1"); //fill out all the fields
    }
    else if($extension != "png" && $extension != "jpg" && $extension != "jpeg"){
        header("Location: ../artist-dashboard.php?a_error=2"); //file type is not supported
    }
    else if($_FILES["new_album_art"]["size"] > 5000000){
        header("Location: ../artist-dashboard.php?a_error=3"); //file size if greater than 5MB
    }
    else{
        $selected_album_id = trim($_POST["selected_album_id"]);
        $new_album_name = trim($_POST["sel_album_name"]);
        $new_release_date = trim($_POST["sel_release_date"]);   
        
        $album = new Album($new_album_name, $new_release_date, "");
        $album->setAlbumID($selected_album_id);
        $album->updateAlbum();

        if(!empty($_FILES["new_album_art"])){
            $album_art_file = $_FILES["new_album_art"];
            $newFileName = $selected_album_id.".".$extension;
            $newFileLocation = ".././assets/album-art/$newFileName";
            
            if(file_exists($newFileLocation)){
                unlink($newFileLocation);
            }
            rename($album_art_file["name"], $newFileName);
            move_uploaded_file($album_art_file["tmp_name"], $newFileLocation);
    
            $album->setAlbumArt($newFileName);
            $album->updateAlbumArt();
        }
    }
}

if(isset($_POST["deleteAlbum"])){
    $selected_album_id = trim($_POST["selected_album_id"]);

    $album = new Album("", "", "");
    $album->setAlbumID($selected_album_id);
    $album->deleteAlbum();
}

if(isset($_REQUEST["now_playing_album"])){
    $album_id = $_REQUEST["now_playing_album"];
    $album = new Album("", "", "");
    $row = $album->sendNowPlayingAlbumInfo($album_id);
    
    $json = json_encode($row);
    echo $json;
}