<?php
    session_start();
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

    <div class="main-container">
        <div class="container-fluid">
            <div class="cover position-relative">
                <div class="">
                    <div class="artist-header">
                        <div class="d-flex justify-content-center">
                            <div class=" mobile-hide">
                                <img src="assets/artist-art/A.R.Rahman.jpeg" class="col-4 align-self-start img-thumbnail profile-picture">
                            </div>
                            <div class="">
                                <h4 class="display-2 title">A.R Rahman</h4>
                                <h5 class="subtitle"> New Delhi - India</h5>
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
                        A.R. Rahman is an iconic Indian composer, singer, and music producer, widely regarded
                        as one of the greatest music maestros in the Indian film industry. Born on January 6, 1967,
                        in Chennai, India, Rahman's birth name is A. S. Dileep Kumar. He is renowned for his diverse
                        musical talent and ability to fuse various genres and cultural influences into his compositions.
                        <br>
                        Rahman gained international recognition with his groundbreaking soundtrack for the film "Roja"
                        in 1992, which marked his entry into the Indian film industry. Since then, he has composed
                        music for numerous critically acclaimed and commercially successful movies, earning him
                        widespread acclaim and numerous prestigious awards, including two Academy Awards, two Grammy
                        Awards, and a BAFTA Award.
                    </p>
                </div>
            </div>
            <div class="row melomaniac-playlists">
                <h2>Top Songs</h2>
                <div class="list">
                    <div class="item">
                        <img src="assets/album-art/Guru.jpg" />
                        <div class="play" onclick="setTrackIndex(6)">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Aaruyiae</h4>
                        <p>From Guru Soundtrack</p>
                    </div>

                    <div class="item">
                        <img src="assets/album-art/Sangamam.jpeg" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Varaha Nadhikarai</h4>
                        <p>From Sangamam</p>
                    </div>

                    <div class="item">
                        <img src="assets/album-art/Jai-Ho.jpeg" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Jai-Ho</h4>
                        <p>From Jai-Ho Soundtrack</p>
                    </div>
                </div>

                <h2>Top Albums</h2>
                <div class="list">
                    <div class="item">
                        <img src="assets/album-art/Guru.jpg" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Guru</h4>
                        <p>Soundtrack from original motion pricture Guru 2007</p>
                    </div>

                    <div class="item">
                        <img src="assets/album-art/Sangamam.jpeg" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Sangamam</h4>
                        <p>Soundtrack from original motion pricture Sangamam 1999</p>
                    </div>

                    <div class="item">
                        <img src="assets/album-art/Jai-Ho.jpeg" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>Jai-Ho</h4>
                        <p>Soundtrack from original motion pricture Jai-Jo 2014</p>
                    </div>
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