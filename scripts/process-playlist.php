<?php
    require_once ".././classes/song.php";

    use classes\Song;

    if(isset($_POST["save"])){
        if(empty($_POST["playlist_name"])){
            header("Location: ../user-playlists.php?error=1");
        }
        else{
            $playlist_name = $_POST["playlist_name"];
            $song_id = $_POST["song"];
            $listener_id = $_POST["listener_id"];

            $playlist = new Song("", "", "", "", "", "");
            $playlist->addToPlaylist($listener_id, $song_id, $playlist_name);
        }
    }

    if(isset($_REQUEST["listener_id"])){
        $listener_id = $_REQUEST["listener_id"];
        $playlist_name = $_REQUEST["playlist_name"];

        $playlist = new Song("", "", "", "", "", "");
        $songs = $playlist->getSongsInPlaylist($listener_id, $playlist_name);
        
        $result = json_encode($songs);
        echo $result;
    }