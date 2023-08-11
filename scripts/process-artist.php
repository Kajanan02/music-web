<?php

require_once "../classes/artist.php";
use classes\Artist;

if(isset($_POST["save"])){
    $extension1 = strtolower(pathinfo($_FILES["new_profile_picture"]["name"], PATHINFO_EXTENSION));
    $extension2 = strtolower(pathinfo($_FILES["new_cover_picture"]["name"], PATHINFO_EXTENSION));

    if(empty($_POST["artist_name"]) || empty($_POST["user_email"]) || empty($_POST["user_city"]) || 
        empty($_POST["user_country"]) || empty($_POST["username"])){
        header("Location: ../artist-settings.php?error=1"); //empty fields
    }
    elseif((!empty($_POST["new_password"]) && !empty($_POST["c_password"])) && ($_POST["new_password"] != $_POST["c_password"])){
        header("Location: ../artist-settings.php?error=2"); //passwords does not match
    }
    elseif(($_FILES["new_profile_picture"]["size"] != 0) && 
        ($extension1 != "png" && $extension1 != "jpg" && $extension1 != "jpeg")){
        header("Location: ../artist-settings.php?error=3"); //profile pic: file type is not supported
    }
    elseif(($_FILES["new_cover_picture"]["size"] != 0) && 
        ($extension2 != "png" && $extension2 != "jpg" && $extension2 != "jpeg")){
        header("Location: ../artist-settings.php?error=4"); //cover pic: file type is not supported
    }
    elseif($_FILES["new_profile_picture"]["size"] > 5000000){
        header("Location: ../artist-settings.php?error=5"); //profile: file is bigger than max file limit (5 MB)
    }
    elseif($_FILES["new_cover_picture"]["size"] > 5000000){
        header("Location: ../artist-settings.php?error=6"); //cover: file is bigger than max file limit (5 MB)
    }
    else{
        $status = true;

        $artist_id = trim($_POST["artist_id"]);
        $name = trim($_POST["artist_name"]);
        $email = trim($_POST["user_email"]);
        $city = trim($_POST["user_city"]);
        $country = trim($_POST["user_country"]);
        $bio = trim($_POST["artist-bio"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["new_password"]);
        $cpassword = trim($_POST["c_password"]);

        $artist = new Artist();
        $artist->setArtistID($artist_id);
        $artist->setName($name);
        $artist->setEmail($email);
        $artist->setCity($city);
        $artist->setCountry($country);
        $artist->setBio($bio);
        $artist->setUsername($username);
        $status = $artist->updateArtist();

        if(!empty($password) && !empty($cpassword) && $password == $cpassword){
            $artist->setPassword($password);
            $status = $artist->changePassword();
        }
        else{
            header("Location: ../artist-settings.php?error=7"); //passwords cannot be empty
        }
        
    
        if($_FILES["new_profile_picture"]["size"] != 0){
            $profile_pic = $_FILES["new_profile_picture"];

            $newFileName = $artist_id.".".$extension1;
            rename($profile_pic["name"], $newFileName);

            $newFileLocation = "../assets/artist-art/".$newFileName;
            if(file_exists($newFileLocation)){
                unlink($newFileLocation);
            }

            move_uploaded_file($profile_pic["tmp_name"], $newFileLocation);

            $artist->setProfilePic($newFileName);
            $status = $artist->changeProfilePicture();
        }

        if($_FILES["new_cover_picture"]["size"] != 0){
            $cover_pic = $_FILES["new_cover_picture"];

            $newFileName = $artist_id.".".$extension2;
            rename($cover_pic["name"], $newFileName);

            $newFileLocation = "../assets/cover-art/".$newFileName;
            if(file_exists($newFileLocation)){
                unlink($newFileLocation);
            }

            move_uploaded_file($cover_pic["tmp_name"], $newFileLocation);

            $artist->setCoverPic($newFileName);
            $status = $artist->changeCoverPicture();
        }

        if($status){
            header("Location: ../artist-settings.php?error=0");
        }
        else{
            header("Location: ../artist-settings.php?error=8"); //DB Error
        }
    }
}

if(isset($_REQUEST["artist_id"])){
    $artist_id = $_REQUEST["artist_id"];
    $artist = new Artist();
    $artist->setArtistID($artist_id);
    $result = $artist->getData();

    $response = json_encode($result);
    echo $response;
}