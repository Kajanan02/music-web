<?php
    session_start();
?>

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
                    <a href="index.php"> <img src="assets/logo-transparent.png" alt="Logo" width="200px"/></a>
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
                    <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="./scripts/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-md">
    <h5 class="ms-md-3 mt-4 fw-semibold ps-4  fs-2 text-white mt-4">Settings</h5>

    <div class="row">
        <div class="col-md-12 mb-5 d-flex justify-content-center">
            <img src="" name="cover_picture" id="cover_picture" class="img-fluid z-index-n1" width="600"/>
            <img src="" name="profile_picture" id="profile_picture" class="profile_picture z-index-2 img-thmubnail"/>
        </div>
    </div>

    <?php
        if(isset($_GET["error"])){
            $error = $_GET["error"];
            if($error == "0"){
                $msg = "Profile updated successfully";
            }
            elseif($error == "1"){
                $msg = "Manadatory fields are left empty. Please try again";
            }
            elseif($error == "2"){
                $msg = "Password does not match";
            }
            elseif($error == "3"){
                $msg = "File type profile picture is not supported (Supported types: .png, .jpeg, .jpg)";
            }
            elseif($error == "4"){
                $msg = "File type cover picture is not supported (Supported types: .png, .jpeg, .jpg)";
            }
            elseif($error == "5"){
                $msg = "Profile picture is larger than max supported limit (5MB)";
            }
            elseif($error == "6"){
                $msg = "Cover picture is larger than max supported limit (5MB)";
            }
            elseif($error == "7"){
                $msg = "Passwords cannot be empty or null";
            }
            elseif($error == "8"){
                $msg = "Internal database error. Please try again";
            }
            
            if($error == "0"){
                ?>
                <p class="text-success text-center h5 mt-5"><?php echo $msg; ?></p>
                <?php
            }
            else{
                ?>
                <p class="text-danger text-center mt-5"><?php echo $msg; ?></p>
                <?php
            }
        }
    ?>

    <form class="mx-md-5 my-md-5 px-md-5 my-5 mx-2" method="POST" action="./scripts/process-artist.php" enctype="multipart/form-data" 
        onsubmit="confirm('Are you sure you want to proceed?')">

        <input type="hidden" name="artist_id" id="artist_id" value="<?php echo $_SESSION["artist_id"]; ?>"/>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="artist_name" class="form-label text-white">First Name</label>
                <input type="text" name="artist_name" class="form-control bg-dark text-white place-holder" placeholder="First Name"
                       id="artist_name">
            </div>

            <div class="col-md-6 mb-3">
                <label for="user_email" class="form-label text-white">Email</label>
                <input type="email" name="user_email" class="form-control bg-dark text-white place-holder" placeholder="Email"
                       id="user_email">
            </div>

            <div class="col-md-6 mb-3">
                <label for="user_city" class="form-label text-white">City</label>
                <input type="text" name="user_city" class="form-control bg-dark text-white place-holder" placeholder="City"
                       id="user_city">
            </div>

            <div class="col-md-6 mb-3">
                <label for="user_country" class="form-label text-white">Country</label>
                <select name="user_country" id="user_country" class="form-control bg-dark text-white place-holder" id="country" required>
                    <option value="">--None--</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland Islands">Aland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, Democratic Republic of the Congo">Congo, Democratic Republic of the Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curacao">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of">Korea, Republic of</option>
                    <option value="Kosovo">Kosovo</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Barthelemy">Saint Barthelemy</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Martin">Saint Martin</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sint Maarten">Sint Maarten</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                    <option value="South Sudan">South Sudan</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="new_profile_picture" class="form-label text-white">Profile Picture</label>
                <input type="file" name="new_profile_picture" class="form-control bg-dark text-white place-holder" id="new_profile_picture">
            </div>

            <div class="col-md-6 mb-3">
                <label for="new_cover_picture" class="form-label text-white">Cover Image</label>
                <input type="file" name="new_cover_picture" class="form-control bg-dark text-white place-holder" id="new_cover_picture">
            </div>

            <div class="col-md-6 mb-3">
                <label for="sub_plan" class="form-label text-white">Subscription Plan</label>
                <input type="text" name="sub_plan" class="form-control bg-dark text-white place-holder"
                       placeholder="Subscription Plan" id="sub_plan" disabled>
            </div>

            <div class="mb-3">
                <label for="artist-bio" class="form-label text-white">Description</label>
                <textarea rows="10" cols="10" name="artist-bio" class="form-control bg-dark text-white place-holder"
                          placeholder="Indicate line breaks with <br>" id="artist-bio">
                </textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for="username" class="form-label text-white">Username</label>
                <input type="text" name="username" class="form-control bg-dark text-white place-holder"
                       placeholder="Username" id="username">
            </div>

            <div class="col-md-6 mb-3">
                <label for="new_password" class="form-label text-white">New Password</label>
                <input type="password" name="new_password" class="form-control bg-dark text-white place-holder"
                       placeholder="New Password" id="new_password">
            </div>

            <div class="col-md-6 mb-3">
                <label for="confirm_password" class="form-label text-white">Confirm Password</label>
                <input type="password" name="c_password" class="form-control bg-dark text-white place-holder"
                       placeholder="Confirm Password" id="confirm_password">
            </div>
        </div>

        <div class="d-flex">
            <input type="submit" class=" ms-auto btn btn-warning fw-medium px-5 py-2 mt-4 btn-go" value="Save Changes" name="save">
        </div>
    </form>
</div>

<script>
    let artist_id = document.getElementById("artist_id").value;

    let profile_pic = document.getElementById("profile_picture");
    let cover_pic = document.getElementById("cover_picture");

    let name = document.getElementById("artist_name");
    let email = document.getElementById("user_email");
    let city = document.getElementById("user_city");
    let country = document.getElementById("user_country");
    let sub_plan = document.getElementById("sub_plan");
    let bio = document.getElementById("artist-bio");
    let username = document.getElementById("username");

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var result = JSON.parse(this.responseText);

            profile_pic.src = "./" + result[0];
            cover_pic.src = "./" + result[5];

            name.value = result[1];
            email.value = result[2];
            city.value = result[3];
            country.value = result[4];
            sub_plan.value = result[6];
            bio.value = result[7];
            username.value = result[8];
        }
    }
    xhr.open("GET", "./scripts/process-artist.php?artist_id=" + artist_id, true);
    xhr.send();
</script>

</body>
</html>