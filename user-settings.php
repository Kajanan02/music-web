<?php

namespace classes;

require_once "classes/db-connector.php";

use classes\DBConnector;
use Exception;
use PDO;
use PDOException;

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

        <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            $msg = "";
            if ($error == "0") {
                $msg = "Profile updated successfully";
            } elseif ($error == "1") {
                $msg = "Manadatory fields are left empty. Please try again";
            } elseif ($error == "2") {
                $msg = "Password does not match";
            } elseif ($error == "3") {
                $msg = "File type profile picture is not supported (Supported types: .png, .jpeg, .jpg)";
            } elseif ($error == "4") {
                $msg = "File type cover picture is not supported (Supported types: .png, .jpeg, .jpg)";
            } elseif ($error == "5") {
                $msg = "Profile picture is larger than max supported limit (5MB)";
            } elseif ($error == "6") {
                $msg = "Cover picture is larger than max supported limit (5MB)";
            } elseif ($error == "7") {
                $msg = "Passwords cannot be empty or null";
            } elseif ($error == "8") {
                $msg = "Wrong password";
            }

            if ($error == "0") {
        ?>
                <p class="text-success text-center h5 mt-5"><?php echo $msg; ?></p>
            <?php
            } else {
            ?>
                <p class="text-danger text-center mt-5"><?php echo $msg; ?></p>
        <?php
            }
        }
        ?>
        <?php
        $con = DBConnector::getConnection();

        // Select the current password for the listener
        $selectQuery = "SELECT * FROM listener WHERE listener_id = ?";
        $selectStmt = $con->prepare($selectQuery);
        $selectStmt->bindValue(1, $_SESSION["listener_id"]);
        $selectStmt->execute();
        $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <form class="mx-5 my-5 px-5" action="scripts/process-listener.php" method="post" enctype="multipart/form-data" onsubmit="confirm('Are you sure you want to proceed?')">

            <input type="hidden" name="listener_id" id="listener_id" value="<?php echo $_SESSION["listener_id"]; ?>" />

            <div class="row">
                <h3 class=" text-white mb-4">Edit User details </h3>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label text-white">First Name</label>
                    <input type="text" name="first_name" class="form-control bg-dark text-white place-holder" value=<?php echo $row['first_name']; ?> id="first_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label text-white">Last Name</label>
                    <input type="text" name="last_name" class="form-control bg-dark text-white place-holder" value=<?php echo $row['last_name']; ?> id="last_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_email" class="form-label text-white">Email</label>
                    <input type="text" name="user_email" class="form-control bg-dark text-white place-holder" value=<?php echo $row['email']; ?> id="user_email">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label text-white">Username</label>
                    <input type="text" name="username" class="form-control bg-dark text-white place-holder" value=<?php echo $row['username']; ?> id="username">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sub_plan" class="form-label text-white">Subscription Plan</label>
                    <input type="text" name="sub_plan" class="form-control bg-dark text-white place-holder" placeholder="Subscription Plan" id="sub_plan">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="card_number" class="form-label text-white">Credit Card Number</label>
                    <input type="password" name="card_number" class="form-control bg-dark text-white place-holder" placeholder="Credit Card Number" id="card_number">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiry_date" class="form-label text-white">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control bg-dark text-white place-holder" placeholder="Expiry Date" id="expiry_date">
                </div>

                <div class="col-md-6 mb-3">
                    <input type="hidden" class="form-control bg-dark text-white place-holder">
                </div>

                <div class="d-flex">
                    <input type="submit" class="ms-auto btn btn-warning fw-medium px-5 py-2 mt-4 btn-go" value="Save Changes" name="save">
                </div>
        </form>


    </div>

    <form class="mx-5 my-5 px-5" action="scripts/process-listener-password.php" method="post" enctype="multipart/form-data" onsubmit="confirm('Are you sure you want to proceed?')">

        <input type="hidden" name="listener_id" id="listener_id" value="<?php echo $_SESSION["listener_id"]; ?>" />
        <div class="row">
            <h3 class=" text-white">Change password </h3><br><br>
        </div>

        <div class="col-md-6 mb-3">
            <label for="current_password" class="form-label text-white">Password</label>
            <input type="password" name="current_password" class="form-control bg-dark text-white place-holder" placeholder="Password" id="new_password">
        </div>

        <div class="col-md-6 mb-3">
            <label for="new_password" class="form-label text-white">New Password</label>
            <input type="password" name="new_password" class="form-control bg-dark text-white place-holder" placeholder="New Password" id="new_password">
        </div>

        <div class="col-md-6 mb-3">
            <label for="confirm_password" class="form-label text-white">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control bg-dark text-white place-holder" placeholder="Confirm Password" id="confirm_password">
        </div>

        <div class="d-flex">
            <input type="submit" class="ms-auto btn btn-warning fw-medium px-5 py-2 mt-4 btn-go" value="Changes password" name="change_password">
        </div>
    </form>
    </div>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>

    <script src="js/render-siderbar.js"></script>
    <script src="js/render-topbar.js"></script>
</body>

</html>