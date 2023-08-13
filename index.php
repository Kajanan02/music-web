<?php
    session_start();

    require_once "./classes/db-connector.php";
    use classes\DBConnector;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">
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

    <div class="main-container">
        <div class="melomaniac-playlists">
            <h2>Melomaniac Playlists</h2>

            <div class="list">
                <div class="item">
                    <img src="assets/playlists/focus.jpeg" />
                    <div class="play" onclick="playRandom()">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Good Times</h4>
                    <p>Don't search for music, Search for memories</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/party.png" />
                    <div class="play" onclick="playRandom()">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Random</h4>
                    <p>You didn't plan it? Did you?</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/love.jpeg" />
                    <div class="play" onclick="playRandom()">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Memories</h4>
                    <p>Reflect on your soul</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/mood.jpeg" />
                    <div class="play" onclick="playRandom()">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Favorites</h4>
                    <p>Everytime favorites</p>
                </div>
            </div>
        </div>

        <div class="melomaniac-playlists">
            <h2>From Ed Sheeran</h2>
            <div class="list">
                <?php
                $con = DBConnector::getConnection();
                $query1 = "SELECT * FROM album WHERE artist_id=? LIMIT 5";
                $pstmt1 = $con->prepare($query1);
                $pstmt1->bindValue(1, "1");
                $pstmt1->execute();
                $rows3 = $pstmt1->fetchAll(PDO::FETCH_NUM);

                foreach($rows3 as $row){
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
            
            <div class="list">
                <?php
                    $query3 = "SELECT song_name, album.album_name, album.thumbnail_url, artist.artist_name, artist.profile_pic_url, audio, lyrics 
                    FROM song, album, artist WHERE song.artist_id=artist.artist_id AND song.album_id=album.album_id AND 
                    song.artist_id = ? LIMIT 5";

                    $pstmt3 = $con->prepare($query3);
                    $pstmt3->bindValue(1, "1");
                    $pstmt3->execute();
                    $rows2 = $pstmt3->fetchAll(PDO::FETCH_NUM);
                ?>
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
            </div>
        </div>

        <div class="melomaniac-playlists mb-5">
            <h2>From Imagine Dragons</h2>
            <div class="list">
                <?php
                $con = DBConnector::getConnection();
                $query4 = "SELECT * FROM album WHERE artist_id=? LIMIT 5";
                $pstmt4 = $con->prepare($query4);
                $pstmt4->bindValue(1, "5");
                $pstmt4->execute();
                $rows3 = $pstmt4->fetchAll(PDO::FETCH_NUM);

                foreach($rows3 as $row){
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
            
            <div class="list">
                <?php
                    $query2 = "SELECT song_name, album.album_name, album.thumbnail_url, artist.artist_name, artist.profile_pic_url, audio, lyrics 
                    FROM song, album, artist WHERE song.artist_id=artist.artist_id AND song.album_id=album.album_id AND 
                    song.artist_id = ? LIMIT 5";

                    $pstmt2 = $con->prepare($query2);
                    $pstmt2->bindValue(1, "5");
                    $pstmt2->execute();
                    $rows2 = $pstmt2->fetchAll(PDO::FETCH_NUM);
                ?>
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
            </div>
        </div>

        <div style="margin-bottom: 180px;"></div>
        <hr>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>

    <!-- Audio Player Rendered as a Template-->
    <script src="js/render-player.js"></script>
    <script src="js/audio-player.js"></script>

    <script src="js/render-siderbar.js"></script>
    <script src="js/render-topbar.js"></script>
</body>

</html>