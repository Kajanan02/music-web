<?php
session_start();

require_once './scripts/paypal-config.php';
require_once "./classes/db-connector.php";

use classes\DBConnector;

if (isset($_POST["signup"])) {
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["city"]) || empty($_POST["username"]) || empty($_POST["password"])) {
        header("Location: ./artist-register.php?error=1"); //empty fields

    } elseif ($_POST["country"] == "") {
        header("Location: ./artist-register.php?error=2"); //choose a country

    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        header("Location: ./artist-register.php?error=3"); //invalid email

    } else {
        $temp_con = DBConnector::getConnection();
        $query_temp = "SELECT artist_name FROM artist WHERE artist_name = ?";
        $pstmt_temp = $temp_con->prepare($query_temp);
        $pstmt_temp->bindValue(1, $_POST["name"]);
        
        if (is_null($pstmt_temp->execute())) {
            header("Location: ./artist-register.php?error=4"); //artist exists
        } else {
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["city"] = $_POST["city"];
            $_SESSION["country"] = $_POST["country"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>Payment</title>
                <link rel="icon" type="image/png" href="./assets/logos/favicon.png">

                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- Bootstrap 5.0.2 -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="./css/premium.css">

            </head>

            <body>
                <nav class="navbar nav-dashboard  bg-dark shadow">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 px-5 text-white"> <a href="./index.php"> <img src="assets/logo-transparent.png" alt="Logo" width="200px" /></a></span>
                    </div>
                </nav>

                <div class=" bg-dark">
                    <div class="row m-0 artist-login-container">
                        <div class="col-md-6 d-flex align-items-md-center mt-5 artist-login-image">
                            <img src="assets/register-artist.png" width="100%" style="z-index: 1">
                            <img src="assets/play-btn-5.png" width="100%" class="bg-play">
                        </div>

                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="mb-3">
                                <label for="plan" class="form-label text-white h4 mt-4">Choose your plan</label>
                                <?php
                                $query = "SELECT plan_id, plan_name, price FROM subscription WHERE plan_type=?";
                                try {
                                    $con = DBConnector::getConnection();
                                    $pstmt = $con->prepare($query);
                                    $pstmt->bindValue(1, "Artist");
                                    $pstmt->execute();
                                    $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $r) {
                                ?>
                                        <div class="product-box mt-5 mb-5">
                                            <div class="row mt-4 d-flex justify-content-center align-items-center">
                                                <h5 class="h5 text-light"><?php echo $r["plan_name"]; ?></h5>
                                            </div>
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <h4 class="h4 text-light"><?php echo "USD " . $r["price"]; ?></h4>
                                            </div>

                                            <form class="mx-5 my-5 px-5" method="POST" action="<?php echo PAYPAL_URL; ?>">
                                                <!-- Paypal Sandbox Business ID -->
                                                <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                                                <!-- Default Paypal "Buy Now" Button -->
                                                <input type="hidden" name="cmd" value="_xclick">

                                                <!-- Sending purchase data to Paypal API -->
                                                <input type="hidden" name="item_name" value="<?php echo $r['plan_name']; ?>">
                                                <input type="hidden" name="item_number" value="<?php echo $r['plan_id'];
                                                                                                $_SESSION["plan_id"] = $r['plan_id']; ?>">
                                                <input type="hidden" name="amount" value="<?php echo $r['price']; ?>">
                                                <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                                                <!-- Specifying Return, Cancel Payment and Notify URL of the site -->
                                                <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                                <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                                                <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">

                                                <input type="submit" name="signup" class="btn btn-primary fw-medium px-5 py-2 mt-4 btn-go" value="Choose Plan" />
                                            </form>
                                        </div>
                                <?php
                                    }
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

            </html>

<?php
        }
    }
}
?>