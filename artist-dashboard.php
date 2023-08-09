<?php
    require_once "./classes/db-connector.php";
    use classes\DBConnector;

    $con = DBConnector::getConnection();

    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Artist Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/premium.css">
    <link rel="stylesheet" href="css/artist-dashboard.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg nav-dashboard bg-dark shadow">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 px-5 text-white">
                <a href="index.php"> <img src="assets/logo-transparent.png" alt="Logo" width="200px" /></a>
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-settings.php">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
            if(isset($_GET["a_error"])){
                $error = $_GET["a_error"];
                if($error == "0"){
                    $msg = "Album added successfully";
                }
                elseif($error == "1"){
                    $msg = "Please fill out all the Fields";
                }
                elseif($error == "2"){
                    $msg = "File type not supported (Valid Types: .png, .jpg, .jpeg)";
                }
                elseif($error == "3"){
                    $msg = "File size exceeds the limit. Please upload a file less than 5MB";
                }
                elseif($error == "4"){
                    $msg = "Internal Database Error. Please try again";
                }
                elseif($error == "5"){
                    $msg = "Internal Database Error. Please try again";
                }
                
                if($error == "0"){
                    ?>
                    <p class="mt-4 text-success text-center h5"><?php echo $msg; ?></p>
                    <?php
                }
                else{
                    ?>
                    <p class="mt-4 text-danger"><?php echo $msg; ?></p>
                    <?php
                }
            }

            if(isset($_GET["s_error"])){
                $error = $_GET["s_error"];

                if($error == "0"){
                    $msg = "Song added successfully";
                }
                elseif($error == "1"){
                    $msg = "Please fill out all the fields";
                }
                elseif($error == "2"){
                    $msg = "Lyrics files should be in lrc format";
                }
                elseif($error == "3"){
                    $msg = "Audio files should either be mp3 or ogg";
                }
                elseif($error == "4"){
                    $msg = "Lyrics file should be less than 2MB";
                }
                elseif($error == "5"){
                    $msg = "Audio file should be less tham 10MB";
                }
                elseif($error == "6"){
                    $msg = "Please enter a valid value for track number";
                }
                elseif($error == "7" || $error == "8"){
                    $msg = "An internal error occured. Please try again.";
                }

                if($error == "0"){
                    ?>
                    <p class="mt-4 text-success text-center h5"><?php echo $msg; ?></p>
                    <?php
                }
                else{
                    ?>
                    <p class="mt-4 text-danger"><?php echo $msg; ?></p>
                    <?php
                }
            }
        ?>

        <h1>Dashboard of 
            <?php
                $query = "SELECT artist_name FROM artist WHERE artist_id=?";
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $_SESSION["artist_id"]);
                $pstmt->execute();
                $res = $pstmt->fetch(PDO::FETCH_ASSOC);
                echo $res["artist_name"];
            ?>   
        </h1>

        <div class="">
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
                <h2 class="display-6 fw-medium mb-4 mt-3">Song List</h2>
                <div>
                    <button type="button" class="btn btn-light bg-light-subtle fw-medium mb-3" data-bs-toggle="modal" data-bs-target="#albumModal">
                        + Create Album
                    </button>
                    <button type="button" class="btn btn-light bg-light-subtle fw-medium ms-3 mb-3" data-bs-toggle="modal" data-bs-target="#songModal">
                        + Add Music
                    </button>
                </div>
            </div>

            <div class="">
                <div class="modal fade" id="albumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-dark fs-5" id="albumModalLabel">Create Album</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form method="POST" action="./scripts/process-album.php" enctype="multipart/form-data">
                                <input type="hidden" name="artist_id" value="<?php echo $_SESSION["artist_id"]; ?>"/>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label text-dark">Album Title</label>
                                            <input type="rext" id="album_name" name="album_name" class="form-control" placeholder="Album Title"  required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlInput3" class="form-label text-dark">Release Date</label>
                                            <input type="date" id="release_date" name="release_date" class="form-control" placeholder="Release Date" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="formFile" class="form-label text-dark">Album Thumbnail</label>
                                            <input type="file" id="album_art" name="album_art" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Create" name="create" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="songModal" tabindex="-1" aria-labelledby="songModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-dark fs-5" id="songModalLabel">Add Music</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form method="POST" action="./scripts/process-song.php" enctype="multipart/form-data">
                                <input type="hidden" name="artist_id" value="<?php echo $_SESSION["artist_id"]; ?>"/>

                                <div class="modal-body">
                                    <div class="row">                    
                                        <div class="col-md-6 mb-3">
                                            <label for="album_name" class="form-label text-dark">Album Title</label>
                                            <select name="album_id" class="form-control" id="album_name" placeholder="Album Title" required>
                                                <?php
                                                    $query2 = "SELECT album_id, album_name FROM album WHERE artist_id=?";
                                                    $pstmt2 = $con->prepare($query2);
                                                    $pstmt2->bindValue(1, $_SESSION["artist_id"]);
                                                    $pstmt2->execute();
                                                    $rows = $pstmt2->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($rows as $row){
                                                        ?>
                                                        <option value = "<?php echo $row["album_id"]; ?>"><?php echo $row["album_name"]; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="song_name" class="form-label text-dark">Song Title</label>
                                            <input type="text" name="song_name" class="form-control" id="song_name" placeholder="Song Title" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="lrc" class="form-label text-dark">Lyrics</label>
                                            <input type="file" name="lrc" class="form-control" id="lrc" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="track_id" class="form-label text-dark">Track Number</label>
                                            <input type="text" name="track_id" class="form-control" id="track_id" placeholder="Track Number" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="audio" class="form-label text-dark">Audio</label>
                                            <input type="file" name="audio" class="form-control" id="audio" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="genre" class="form-label text-dark">Genre</label>
                                            <input type="text" name="genre" class="form-control" id="genre" placeholder="Genre" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="collaborations" class="form-label text-dark">Collaborating Artists</label>
                                            <input type="text" name="collaborations" class="form-control" id="collaborations" value="N/A" placeholder="Collaborating Artists" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" name="addSong" value="Create"/>
                                </div>
                            </form>                           
                        </div>
                    </div>
                </div>

                <div class="bg-song-list ">
                    <table class="table table-secondary  table-hover shadow-lg table-bg" id="music-table">
                        <thead>
                            <tr>
                                <th>Track ID</th>
                                <th>Song Title</th>
                                <th>Album Title</th>
                                <th>Release Date</th>
                                <th>Genre</th>
                                <th>Album Thumbnail</th>
                                <th>Link to .lrc File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Song 1</td>
                                <td>Album 1</td>
                                <td>2023-06-01</td>
                                <td>Pop</td>
                                <td><img src="album1-thumbnail.jpg" alt="Album 1 Thumbnail" width="50"></td>
                                <td><a href="song1.lrc">Download</a></td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Song 2</td>
                                <td>Album 2</td>
                                <td>2023-06-05</td>
                                <td>Rock</td>
                                <td><img src="album2-thumbnail.jpg" alt="Album 2 Thumbnail" width="50"></td>
                                <td><a href="song2.lrc">Download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>