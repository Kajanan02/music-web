<?php
    session_start();

    require_once "./classes/db-connector.php";
    use classes\DBConnector;

    if(!isset($_SESSION["listener_id"])){
        header("Location: user-login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Playlists</title>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="./scripts/process-playlist.php">
                    <div class="modal-body">
                        <input type="hidden" name="listener_id" value="<?php echo $_SESSION["listener_id"] ?>"/>
                        <div class="row">
                            <div class="col-md-6 mb-3"> 
                                <?php
                                    $con = DBConnector::getConnection();
                                    $query1 = "SELECT DISTINCT playlist_name FROM playlist WHERE listener_id=?";
                                    $pstmt1 = $con->prepare($query1);
                                    $pstmt1->bindValue(1, $_SESSION["listener_id"]);
                                    $pstmt1->execute();
                                    $result1 = $pstmt1->fetchAll(PDO::FETCH_NUM);
                                ?>     

                                <label for="playlist_name" class="form-label text-dark">Playlist Name</label>
                                <input list="playlists" name="playlist_name" id="playlist_name" class="form-control" placeholder="Playlist Name">
                                <datalist id="playlists">
                                    <?php
                                        foreach($result1 as $r){
                                            ?>
                                            <option value="<?php echo $r[0] ?>"></option>
                                            <?php
                                        }
                                    ?>
                                </datalist>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="song" class="form-label text-dark">Song</label>

                                <?php
                                    $query2 = "SELECT song.song_id, song.song_name, artist.artist_name FROM song, artist WHERE song.artist_id = artist.artist_id";
                                    $pstmt2 = $con->prepare($query2);
                                    $pstmt2->execute();
                                    $result2 = $pstmt2->fetchAll(PDO::FETCH_NUM);
                                ?>
                                <select name="song" id="song" class="form-control">
                                    <?php
                                        foreach($result2 as $r){
                                            ?>
                                            <option value="<?php echo $r[0]?>"><?php echo $r[1] . " by " . $r[2]?></option>
                                            <?php
                                        }
                                    ?>
                                </select>   
                            </div>
                        </div>                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="save" value="Save"/>
                    </div>
                </form> 
            </div>
        </div>
    </div>

    <div class="main-container">
        <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Create playlist</button>

        <div class="melomaniac-playlists">
            <h2>My Playlists</h2>
            <div class="list">
                <?php
                    $query3 = "SELECT DISTINCT playlist_name, COUNT(playlist_name) FROM playlist WHERE listener_id=? GROUP BY playlist_name";
                    $pstmt3 = $con->prepare($query3);
                    $pstmt3->bindValue(1, $_SESSION["listener_id"]);
                    $pstmt3->execute();
                    $result = $pstmt3->fetchAll(PDO::FETCH_BOTH);
                    
                    foreach($result as $r){
                        ?>
                        <div class="item">
                            <img src="./assets/playlists/old.jpeg" />
                            <div class="play" onclick="playPlaylist('<?php echo $_SESSION['listener_id']?>','<?php echo $r['playlist_name'] ?>')">
                                <span class="fa fa-play"></span>
                            </div>
                            <h4><?php echo $r["playlist_name"] ?></h4>
                            <p><?php echo  $r[1] ." Songs" ?></p>
                        </div>
                        <?php
                    }
                ?>
            </div>

            <div style="margin-bottom: 180px;"></div>
            <hr>
        </div>
    </div>

    <!-- Audio Player Rendered as a Template-->

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>

    <!-- Audio Player Rendered as a Template-->
    <script src="js/render-player.js"></script>
    <script src="js/audio-player.js"></script>

    <script src="js/render-siderbar.js"></script>
    <script src="js/render-topbar.js"></script>
</body>

</html>