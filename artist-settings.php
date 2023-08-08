<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
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

    <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background-color: rgb(22, 28, 36)">
<nav class="navbar navbar-expand-lg nav-dashboard bg-dark shadow">
    <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 px-5 text-white"> 
                    <a href="index.html"> <img src="assets/logo-transparent.png" alt="Logo" width="200px"/></a>
                </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 "
                       href="artist-dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 "
                       href="artist-settings.php">Settings</a>
                </li>
                <li class="nav-item">
                    <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 "
                       href="artist-login.php">Logout</a>
                </li>
            </ul>

<!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-dashboard.html">Dashboard</a>-->
<!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-settings.html">Settings</a>-->
<!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-login.html">Logout</a>-->

        </div>
    </div>
</nav>

<div class="container-md">
    <h5 class="ms-md-3 mt-4 fw-semibold ps-4  fs-2 text-white mt-4">Settings</h5>

    <form class="mx-md-5 my-md-5 px-md-5 my-5 mx-2">
        <!-- CHANGE PROFILE PIC GOES HERE -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="artist_name" class="form-label text-white">First Name</label>
                <input type="text" class="form-control bg-dark text-white place-holder" placeholder="First Name"
                       id="artist_name">
            </div>



            <div class="col-md-6 mb-3">
                <label for="user_email" class="form-label text-white">Email</label>
                <input type="text" class="form-control bg-dark text-white place-holder" placeholder="Email"
                       id="user_email">
            </div>

            <div class="col-md-6 mb-3">
                <label for="user_city" class="form-label text-white">City</label>
                <input type="text" class="form-control bg-dark text-white place-holder" placeholder="City"
                       id="user_city">
            </div>

            <div class="col-md-6 mb-3">
                <label for="user_country" class="form-label text-white">Country</label>
                <input type="text" class="form-control bg-dark text-white place-holder"
                       placeholder="Country" id="user_country">
            </div>

            <div class="col-md-6 mb-3">
                <label for="cover_picture" class="form-label text-white">Cover Image</label>
                <input type="file" class="form-control bg-dark text-white place-holder"
                       placeholder="STORED COVER_IMG IN DB" id="cover_picture">
            </div>

            <div class="col-md-6 mb-3">
                <label for="sub_plan" class="form-label text-white">Subscription Plan</label>
                <input type="text" class="form-control bg-dark text-white place-holder"
                       placeholder="Subscription Plan" id="sub_plan">
            </div>

            <div class="col-md-6 mb-3">
                <label for="card_number" class="form-label text-white">Credit Card Number</label>
                <input type="password" class="form-control bg-dark text-white place-holder"
                       placeholder="Credit Card Number" id="card_number">
            </div>

            <div class="col-md-6 mb-3">
                <label for="expiry_date" class="form-label text-white">Expiry Date</label>
                <input type="date" class="form-control bg-dark text-white place-holder"
                       placeholder="STORED ExpDate IN DB" id="expiry_date">
            </div>

            <div class="mb-3">
                <label for="artist-bio" class="form-label text-white">Description</label>
                <textarea rows="10" cols="10" class="form-control bg-dark text-white place-holder"
                          placeholder="STORED bio IN DB" id="artist-bio">

                    </textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label text-white">Username</label>
                <input type="text" class="form-control bg-dark text-white place-holder"
                       placeholder="Username" id="username">
            </div>

            <div class="col-md-6 mb-3">
                <label for="new_password" class="form-label text-white">New Password</label>
                <input type="password" class="form-control bg-dark text-white place-holder"
                       placeholder="New Password" id="new_password">
            </div>

            <div class="col-md-6 mb-3">
                <label for="confirm_password" class="form-label text-white">Confirm Password</label>
                <input type="password" class="form-control bg-dark text-white place-holder"
                       placeholder="Confirm Password" id="confirm_password">
            </div>


            <!--button class="btn btn-primary fw-medium px-5 py-2 mt-4 btn-go">Change Password</button-->
        </div>
        <div class="d-flex">
            <input type="submit" class=" ms-auto btn btn-warning fw-medium px-5 py-2 mt-4 btn-go" value="Save Changes"
                   name="save">
        </div>
    </form>
</div>

</body>
</html>