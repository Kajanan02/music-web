<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Albums</title>
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
            <h2>Top Albums of the Week</h2>
            <div class="list">
                <div class="item">
                    <img src="assets/album-art/Divide.png" />
                    <div class="play" onclick="setTrackIndex(0)">
                        <span class="fa fa-play"></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Divide</h4>
                            <p>Ed Sheeran</p>
                        </div>
                        <img src="assets/heart.svg" class="favourite">
                    </div>
                </div>

                <div class="item">
                    <img src="assets/album-art/Daddy-K-The-Mix-12.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Daddy K - The</h4>
                            <p>Daddy Yankee</p>
                        </div>
                        <img src="assets/heart.svg" class="favourite">
                    </div>

                </div>

                <div class="item">
                    <img src="assets/album-art/Guru.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Guru</h4>
                            <p>A.R Rahman</p>
                        </div>
                        <img src="assets/heart.svg" class="favourite">
                    </div>


                </div>

                <div class="item">
                    <img src="assets/album-art/The_Fate_of_the_Furious_The_Album.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Fate of the Furious</h4>
                    <p>Fast and Furious 8 - Soundtrack</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/Prism.jpg" />
                    <div class="play" onclick="">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Prism</h4>
                    <p>Katy Perry</p>
                </div>
            </div>

            <h2>Most Streamed Albums All Time</h2>
            <div class="list">
                <div class="item">
                    <img src="assets/album-art/Divide.png" />
                    <div class="play" onclick="">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Divide</h4>
                    <p>Ed Sheeran</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/Daddy-K-The-Mix-12.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Daddy K - The Mix 12</h4>
                    <p>Daddy Yankee</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/The_Fate_of_the_Furious_The_Album.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Fate of the Furious</h4>
                    <p>Fast and Furious 8 - Soundtrack</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/Prism.jpg" />
                    <div class="play" onclick="">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Prism</h4>
                    <p>Katy Perry</p>
                </div>
            </div>

            <h2>Most Favorited Albums</h2>
            <div class="list">
                <div class="item">
                    <img src="assets/album-art/Prism.jpg" />
                    <div class="play" onclick="">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Prism</h4>
                    <p>Katy Perry</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/The_Fate_of_the_Furious_The_Album.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Fate of the Furious</h4>
                    <p>Fast and Furious 8 - Soundtrack</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/3.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>#3</h4>
                    <p>The Script</p>
                </div>
            </div>

            <h2>Top Personal</h2>
            <div class="list">
                <div class="item">
                    <img src="assets/album-art/Jai-Ho.jpeg" />
                    <div class="play" onclick="">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Jai-Ho</h4>
                    <p>A.R Rahman</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/The_Fate_of_the_Furious_The_Album.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Fate of the Furious</h4>
                    <p>Fast and Furious 8 - Soundtrack</p>
                </div>

                <div class="item">
                    <img src="assets/album-art/Sangamam.jpeg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Sangamam</h4>
                    <p>A.R Rahman</p>
                </div>
            </div>
            <div style="margin-bottom: 180px;"></div>
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