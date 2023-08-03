<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
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
            <span class="navbar-brand mb-0 h1 px-5 text-white"> <img src="assets/logo-transparent.png"
                    alt="Logo" width="200px" /></span>
        </div>
    </nav>

    <div class="login-container position-relative">
        <div class="row m-0">
            <div class="col-md-6 p-0">
                    <div class="main-header">
                        <div class="elementor-background-overlay"></div>
                        <div class="mw-840 ">
                            <div class="main-header-txt">
                                <h1 class="main-heading">Thousands of music in your pockets</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 position-relative p-md-5 pt-5">
                    <div class="mb-3 p-md-5 m-md-5">
                        <form method="POST" action="./scripts//process-signup.php">
                            <input type="hidden" name="user_type" value="listener"/>

                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label-login">First Name</label>
                                    <input type="text" name="firstname" class="form-control place-holder" id="exampleFormControlInput1"
                                    placeholder="First Name">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label-login">Last Name</label>
                                    <input type="text" name="lastname" class="form-control place-holder" id="exampleFormControlInput1"
                                    placeholder="Last Name">
                                </div>
                            </div>

                            <label for="exampleFormControlInput1" class="form-label-login">Email address</label>
                            <input type="email" name="email" class="form-control place-holder" id="exampleFormControlInput1"
                                placeholder="Email address">

                            <label for="inputUsername" class="form-label-login">User Name</label>
                            <input type="text" name="username" id="inputUsername" placeholder="User name" class="form-control place-holder">

                            <label for="inputPassword6" class="form-label-login">Password</label>
                            <input type="password" name="password" placeholder="Password" id="inputPassword6" class="form-control place-holder"
                                aria-labelledby="passwordHelpInline">

                            <label for="confirm" class="form-label-login">Confirm Password</label>
                            <input type="password" name="cpassword" id="confirm" placeholder="Confirm Password"
                                class="form-control place-holder">

                            <?php
                                if(isset($_GET["error"])){
                                    $msg = "";
                                    $error = $_GET["error"];

                                    if($error == "1"){
                                        $msg = "Unauthorized access to the page";
                                    }
                                    elseif($error == "2"){
                                        $msg = "You must fill all the fields";
                                    }
                                    elseif($error == "3"){
                                        $msg = "Passwords does not match";
                                    }
                                    elseif($error == "4"){
                                        $msg = "Sorry. This username exists. Please try another one";
                                    }
                                    elseif($error == "5"){
                                        $msg = "Invalid user";
                                    }
                                    elseif($error == "6"){
                                        $msg = "Registration was unscuessful. Please try again.";
                                    }
                                }
                                ?>
                                <p class="text-danger mt-3"><?php echo $msg; ?></p>
                                <?php
                            ?>

                            <div class="d-flex justify-content-center">
                                <input type = "submit" class="btn btn-primary fw-medium px-5 py-2 mt-5 btn-go" name="signup">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
    </body>
</html>