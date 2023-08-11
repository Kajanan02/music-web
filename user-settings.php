<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Settings</title>
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">
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
        <h2 class=" text-white">Settings</h2>

        <form class="mx-5 my-5 px-5">
            <div class="row">
                <div class="col-md-12 mb-5 d-flex justify-content-center">
                    <input type="file" enc_type="multipart/form-data" class="profile_picture form-control bg-light place-holder" placeholder="Profile Picture" id="profile_picture">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label text-white">First Name</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="First name" id="first_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label text-white">Last Name</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Last name" id="last_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_email" class="form-label text-white">Email</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Email" id="user_email">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="user_email" class="form-label text-white">Gender</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Gender" id="user_gender">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_city" class="form-label text-white">City</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="City" id="user_city">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_country" class="form-label text-white">Country</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Country" id="user_country">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sub_plan" class="form-label text-white">Subscription Plan</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Subscription Plan" id="sub_plan">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="card_number" class="form-label text-white">Credit Card Number</label>
                    <input type="password" class="form-control bg-dark text-white place-holder" placeholder="Credit Card Number" id="card_number">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiry_date" class="form-label text-white">Expiry Date</label>
                    <input type="date" class="form-control bg-dark text-white place-holder" placeholder="STORED ExpDate IN DB" id="expiry_date">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label text-white">Username</label>
                    <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Username" id="username">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="new_password" class="form-label text-white">New Password</label>
                    <input type="password" class="form-control bg-dark text-white place-holder" placeholder="New Password" id="new_password">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="confirm_password" class=" form-label text-white">Confirm Password</label>
                    <input type="password" class="form-control bg-dark text-white place-holder" placeholder="Confirm Password" id="confirm_password">
                </div>
            </div>
            <!--button class="btn btn-primary fw-medium px-5 py-2 mt-4 btn-go">Change Password</button-->

            <div class="d-flex">
                <input type="submit" class="ms-auto btn btn-warning fw-medium px-5 py-2 mt-4 btn-go" value="Save Changes" name="save">
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>

    <script src="js/render-siderbar.js"></script>
    <script src="js/render-topbar.js"></script>
</body>

</html>