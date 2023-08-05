<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <link rel="icon" type="image/png" href=".././assets/logos/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <?php

    use classes\DBConnector;

    require_once 'paypal-config.php';
    require_once '../classes/db-connector.php';

    session_start();

    if (!empty($_GET["PayerID"])) {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $city = $_SESSION["city"];
        $country = $_SESSION["country"];
        $username = $_SESSION["username"];
        $password = password_hash($_SESSION["password"], PASSWORD_BCRYPT);
        $plan_id = $_SESSION["plan_id"];

        $status = false;
        $con = DBConnector::getConnection();
        try {
            $query1 = "INSERT INTO artist(artist_name, email, city, country, plan_id, username, password) VALUES(?,?,?,?,?,?,?)";
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $name);
            $pstmt1->bindValue(2, $email);
            $pstmt1->bindValue(3, $city);
            $pstmt1->bindValue(4, $country);
            $pstmt1->bindValue(5, $plan_id);
            $pstmt1->bindValue(6, $username);
            $pstmt1->bindValue(7, $password);
            $a = $pstmt1->execute();
            $artist_id = $con->lastInsertId();

            if ($a > 0) {
                $status = true;

                $query2 = "UPDATE subscription SET purchase_count = purchase_count + 1 WHERE plan_id=?";
                $pstmt2 = $con->prepare($query2);
                $pstmt2->bindValue(1, $plan_id);
                $b = $pstmt2->execute();

                if ($b > 0) {
                    $status = true;

                    $query3 = "INSERT INTO payment(txn_id, plan_id, artist_id, currency_code, payment_status) VALUES(?, ?, ?, ?, ?)";
                    $pstmt3 = $con->prepare($query3);
                    $pstmt3->bindValue(1, $_GET["PayerID"]);
                    $pstmt3->bindValue(2, $plan_id);
                    $pstmt3->bindValue(3, $artist_id);
                    $pstmt3->bindValue(4, "USD");
                    $pstmt3->bindValue(5, "Complete");
                    $c = $pstmt3->execute();

                    if ($c > 0) {
                        $status = true;
                    } else {
                        $status = false;
                        echo "FAIL: payment table";
                        $con->rollback();
                    }
                } else {
                    $status = false;
                    echo "FAIL: subscription table";
                    $con->rollback();
                }
            } else {
                $status = false;
                echo "FAIL: artist table";
            }

            if ($status) {
    ?>
                <div class="container-md bg-dark">
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <img src="../assets/success.png" class="img-fluid" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <h4 class="h4 text-light">Transaction Successful!</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <p class="text-light">You will be directed to the login page in 5 seconds</p>
                            <?php
                            header('Refresh: 5; URL="../artist-login.php"');
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="container-md bg-dark mt-5">
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <img src="../assets/error.jpeg" class="img-fluid" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <h4 class="h4 text-light">Transaction Failed!</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <p class="text-light">Please try again. You'll be redirected to signup in 5 seconds</p>
                            <?php
                            header('Refresh: 5; URL="../artist-register.php"');
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        } catch (PDOException $e) {
            ?>
            <div class="container-md bg-dark mt-5">
                <div class="row mt-5">
                    <div class="col d-flex justify-content-center align-items-center">
                        <img src="../assets/error.jpeg" class="img-fluid" />
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <h4 class="h4 text-light">Transaction Failed!</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <p class="text-light"><?php echo $e->getMessage(); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <p class="text-light">Please try again. You'll be redirected to signup in 5 seconds</p>
                        <?php
                        header('Refresh: 5; URL="../artist-register.php"');
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="container-md bg-dark mt-5">
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <img src="../assets/error.jpeg" class="img-fluid" />
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <h4 class="h4 text-light">Transaction Failed!</h4>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <p class="text-light">Please try again. You'll be redirected to signup in 10 seconds</p>
                    <?php
                    //header('Refresh: 5; URL="../artist-register.php"');
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>

<?php
// If transaction data is available in the URL 
/*if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 
    $item_number = $_GET['item_number'];  
    $txn_id = $_GET['tx']; 
    $payment_gross = $_GET['amt']; 
    $currency_code = $_GET['cc']; 
    $payment_status = $_GET['st']; 
     
    echo $item_number;
    echo $txn_id;
    // Get product info from the database 
    $productResult = $db->query("SELECT * FROM subscription WHERE plan_id = ".$item_number); 
    $productRow = $productResult->fetch_assoc(); 
     
    // Check if transaction data exists with the same TXN ID. 
    $prevPaymentResult = $db->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'"); 
 
    if($prevPaymentResult->num_rows > 0){ 
        $paymentRow = $prevPaymentResult->fetch_assoc(); 
        $payment_id = $paymentRow['payment_id']; 
        $payment_gross = $paymentRow['payment_gross']; 
        $payment_status = $paymentRow['payment_status']; 
    }else{ 
        // Insert tansaction data into the database 
        $insert = $db->query("INSERT INTO payment(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 
        $payment_id = $db->insert_id; 
    } 
} 
?>

<div class="container">
    <div class="status">
        <?php 
            if(!empty($payment_id)){ 
        ?>
                <h1 class="success">Your Payment has been Successful</h1>
                
                <h4>Payment Information</h4>
                <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
                <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
                <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
                
                <h4>Product Information</h4>
                <p><b>Name:</b> <?php echo $productRow['plan_name']; ?></p>
                <p><b>Price:</b> <?php echo $productRow['price']; ?></p>
        <?php 
            }
            else{ 
        ?>
            <h1 class="error">Your Payment has Failed</h1>
        <?php 
            } 
        ?>
    </div>
    <a href="../artist-register.php" class="btn-link">Try Again!</a>
</div>*/