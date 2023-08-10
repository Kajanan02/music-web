<?php
    session_start();

    if(isset($_SESSION["artist_id"])){
        unset($_SESSION["artist_id"]);
        session_destroy();
        header("Location: ../artist-login.php");
    }
    elseif(isset($_SESSION["listener_id"])){
        unset($_SESSION["listener_id"]);
        session_destroy();
        header("Location: ../user-login.php");
    }
    