<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">
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

    <link rel="stylesheet" href="css/login.css">
</head>

<body class="bg-body">
<nav class="navbar nav-dashboard  bg-dark shadow">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 px-5 text-white"> 
                <img src="assets/logo-transparent.png" alt="Logo" width="200px"/>
            </span>
        </div>
    </nav>
    <div class="login-container position-relative">
        <div class="row m-0">
            <div class="col-md-6 p-0">
                <div class="main-header">
                    <div class="elementor-background-overlay"></div>

                    <div class="mw-840 ">
                        <div class="main-header-txt">
                            <h1 class="main-heading">Thousands song and podcast in your device</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 position-relative p-5">
                <div class="mb-3 p-md-5 m-md-5">
                    <form method="POST" action="./scripts/prcoess-login.php">
                        <input type="hidden" name="user_type" value="listener"/>

                        <label for="exampleFormControlInput1" class="form-label-login">Email address</label>
                        <input type="text" class="form-control place-holder" id="exampleFormControlInput1"
                            placeholder="Enter Username" name="username">

                        <label for="inputPassword6" class="form-label-login">Password</label>
                        <input type="password" placeholder="Password" id="inputPassword6" class="form-control place-holder"
                            aria-labelledby="passwordHelpInline" name="password">

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
                                ?>
                                <p class="text-danger mt-3"><?php echo $msg; ?></p>
                                <?php
                            }
                        ?>
                        
                        <div class="d-flex justify-content-center">
                            <input type="submit" name="login" class="btn btn-primary fw-medium px-5 py-2 mt-4 btn-go" value="Log In">
                        </div>  
                    </form>

                    <div class="row d-flex mt-5">
                        <div class="col justify-content-start">
                                <p><a href="" class="text-light">Forgot Password?</a></p>
                        </div>
                        <div class="col ms-auto text-end">
                            <p><a href="user-signup.php" class="text-light">Not registered?</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>