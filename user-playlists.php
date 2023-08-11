<?php
session_start();
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-dark">Playlist Name</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Playlist Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput3" class="form-label text-dark">Song</label>
                            <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="Song">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Create playlist</button>

        <div class="melomaniac-playlists">
            <h2>My Playlists</h2>
            <div class="list">
                <div class="item">
                    <img src="assets/album-art/Divide.png" />
                    <div class="play" onclick="playPauseTrack()">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Favorites</h4>
                    <p>My Favorites</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/study.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Study</h4>
                    <p>Study Music</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/focus.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Focus</h4>
                    <p>Work Music</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/party.png" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Party</h4>
                    <p>PARTY!</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/instrumental.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Instrumental</h4>
                    <p>Instrumental</p>
                </div>
            </div>

            <br><br>

            <div class="list">
                <div class="item">
                    <img src="assets/playlists/love.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Love Songs</h4>
                    <p>Love</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/mood.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Mood</h4>
                    <p>Sad Music</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/old.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Old</h4>
                    <p>The Legends</p>
                </div>

                <div class="item">
                    <img src="assets/playlists/temp.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Temp</h4>
                    <p>Not yet favorite</p>
                </div>
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