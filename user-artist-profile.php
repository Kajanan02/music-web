<?php
    session_start();

    require_once "./classes/db-connector.php";
    use classes\DBConnector;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Artists</title>
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/user-artists.css">
    <link rel="stylesheet" href="css/audio-player.css">
</head>

<body>
    <!-- Topbar -->
    <div>
        <div class="topbar">
            <div class="modal-layer" id="layer" onclick="toogleSidebar()"></div>

            <nav class="navbar navbar-expand-lg nav-dashboard  shadow">
                <button onclick="myFunction()" class="navbar-toggler p-2 rounded w-auto" style="transform: rotate(180deg)">
                    <img src="./assets/slider-icon.svg" alt="menu" class="menu-icon">
                </button>

                <button class="navbar-toggler  p-2 rounded w-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul>
                        <li>
                            <a href="user-premium.html">Premium</a>
                        </li>
                        <li>
                            <a href="artist-main.html">For Artists</a>
                        </li>
                        <li class="divider">|</li>
                        <li>
                            <a href="user-signup.php" id="signup" style="display: block">Sign Up</a>
                        </li>
                        <li class="text-center">
                            <a href="./scripts/logout.php" id="logout" style="display: none;">Logout</a>
                        </li>
                        <li>
                            <a href="./user-login.php" id="login" style="display: block;">Login</a>
                        </li>

                        <?php
                        if (isset($_SESSION["listener_id"]) || isset($_SESSION["artist_id"])) {
                        ?>
                            <script>
                                document.getElementById("signup").style.display = "none";
                                document.getElementById("logout").style.display = "block";
                                document.getElementById("login").style.display = "none";
                            </script>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <?php
        $artist_id = $_GET["artist_id"];
        $con = DBConnector::getConnection();
        $query = "SELECT artist_name, artist_description, city, country, profile_pic_url, cover_pic_url FROM artist WHERE artist_id=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $artist_id);
        $pstmt->execute();
        $row = $pstmt->fetch(PDO::FETCH_NUM);
    ?>
    <input type="hidden" id="profile_pic" value="<?php echo $row[4] ?>"/>
    <input type="hidden" id="artist_name" value="<?php echo $row[0] ?>"/>

    <div class="main-container">
        <div class="container-fluid">
            <div class="cover position-relative">
                <div class="">
                    <div class="artist-header" style="background-image: url(<?php echo "./".$row[5] ?>)">
                        <div class="d-flex justify-content-center">
                            <div class=" mobile-hide">
                                <img src="<?php echo "./".$row[4] ?>" class="col-4 align-self-start img-thumbnail profile-picture">
                            </div>
                            <div class="">
                                <h4 class="display-2 title"><?php echo $row[0] ?></h4>
                                <h5 class="subtitle"> <?php echo $row[2]. " - ". $row[3] ?></h5>
                            </div>
                        </div>
                        <div>
                            <button class="follow-btn">Follow</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class=" bio">
                    <p class="lead">
                        <?php echo $row[1] ?>
                    </p>
                </div>
            </div>

            <?php
                $query2 = "SELECT song_name, album.album_name, album.thumbnail_url, artist.artist_name, artist.profile_pic_url, audio, lyrics 
                    FROM song, album, artist WHERE song.artist_id=artist.artist_id AND song.album_id=album.album_id AND 
                    song.artist_id = ? LIMIT 5";

                $pstmt2 = $con->prepare($query2);
                $pstmt2->bindValue(1, $artist_id);
                $pstmt2->execute();
                $rows2 = $pstmt2->fetchAll(PDO::FETCH_NUM);
            ?>
            <div class="row melomaniac-playlists">
                <h2>Top Songs</h2>
                <div class="list">
                    <?php
                    foreach($rows2 as $row){
                        ?>
                        <div class="item">
                            <img src="<?php echo $row[2] ?>" />
                            <div class="play" onclick="playSong(
                                '<?php echo $row[0] ?>', 
                                '<?php echo $row[3] ?>', 
                                '<?php echo './'.$row[2] ?>', 
                                '<?php echo './'.$row[4] ?>', 
                                '<?php echo './'.$row[5] ?>', 
                                '<?php echo './'.$row[6] ?>')">

                                <span class="fa fa-play play"></span>
                            </div>
                            <h4><?php echo $row[0] ?></h4>
                            <p>From <?php echo $row[1] ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
                    $query3 = "SELECT * FROM album WHERE artist_id=? LIMIT 5";
                    $pstmt3 = $con->prepare($query3);
                    $pstmt3->bindValue(1, $artist_id);
                    $pstmt3->execute();
                    $rows3 = $pstmt3->fetchAll(PDO::FETCH_NUM);
                ?>
                <h2>Top Albums</h2>
                <div class="list">
                    <?php
                    foreach($rows3 as $row){
                        $query4 = "SELECT song_name, artist.artist_name, artist.profile_pic_url, audio, lyrics 
                            FROM song, artist WHERE song.artist_id=artist.artist_id AND song.artist_id = ? AND song.album_id = ?";
                        
                        $pstmt4 = $con->prepare($query4);
                        $pstmt4->bindValue(1, $artist_id);
                        $pstmt4->bindValue(2, $row[0]);
                        $pstmt4->execute();
                        $songs = $pstmt4->fetchAll(PDO::FETCH_NUM);

                        ?>
                        
                        <div class="item">
                            <img src="<?php echo $row[3]?>" />
                            <div class="play" onclick="playAlbum(<?php echo $row[0]?>)">
                                <span class="fa fa-play"></span>
                            </div>
                            <h4><?php echo $row[1]?></h4>
                            <p><?php echo "Released On: " .$row[2]?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div style="margin-bottom: 180px;"></div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>

    <!-- Audio Player Rendered as a Template-->
    <script src="js/render-player.js"></script>
    <script src="js/audio-player.js"></script>

    <script src="js/render-siderbar.js"></script>
    <script src="js/render-topbar.js"></script>

</body>

</html>