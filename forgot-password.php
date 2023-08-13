<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Artists</title>
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/premium.css">
</head>

<body>
    <nav class="navbar nav-dashboard  bg-dark shadow">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 px-5 text-white"> <a href="index.php"> <img src="assets/logo-transparent.png" alt="Logo" width="200px" /></a></span>
        </div>
    </nav>

    <div class=" bg-dark">
        <div class="row m-0 artist-login-container">
            <div class="col-md-6 d-flex align-items-md-end artist-login-image">
                <img src="assets/rotator-1.png" width="90%" style="z-index: 1">
                <img src="assets/play-btn-2.png" width="100%" class="bg-play">
            </div>

            <div class="col-md-6 align-items-center justify-content-center m-auto">

                <form class="mx-5 my-5 px-5" method="POST" action="./scripts/prcoess-login.php">
                    <input type="hidden" name="user_type" value="artist"/>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-white">Username</label>
                        <input type="text" name="username" class="form-control bg-dark text-white place-holder" placeholder="Enter Username" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-white">Email</label>
                        <input type="text" name="username" class="form-control bg-dark text-white place-holder" placeholder="Enter Email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php
                        if(isset($_GET["error"])){
                            $error = $_GET["error"];
                            $msg = "";
                            
                            if($error == "1"){
                                $msg = "Incorrect username or password";
                            }
                            elseif($error == "2"){
                                $msg = "Incorrect username or password";
                            }
                            elseif($error == "3"){
                                $msg = "Unauthorized entry to the page";
                            }
                            elseif($error == "4"){
                                $msg = "Username or password cannot be empty";
                            }
                            elseif($error == "0"){
                                $msg = "You registered successfully. Please Log In.";
                            }
                            if($error == "0"){
                                ?>
                                <p class="text-success mt-3"><?php echo $msg; ?></p>
                                <?php
                            }
                            else{
                                ?>
                                <p class="text-danger mt-3"><?php echo $msg; ?></p>
                                <?php
                            }
                        }
                    ?>

                    <div class="d-flex justify-content-center">
                        <input type="submit" name="login" class="btn btn-primary fw-medium px-5 py-2 mt-4 btn-go">Login</a>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-start">
                                <a class="text-white ms-1 text-white mt-5" href="artist-register.php">Not registered?</a>
                            </div>
                        </div>      
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <a class="text-white ms-1 text-white mt-5" href="">Login</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>