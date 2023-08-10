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
                    $msg = "Album information saved successfully";
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
                    <p class="mt-4 text-danger text-center"><?php echo $msg; ?></p>
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
                    <p class="mt-4 text-danger text-center"><?php echo $msg; ?></p>
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

                            <form method="POST" action="./scripts/process-album.php" enctype="multipart/form-data" onsubmit="confirm('Are you sure you want to proceed?')">
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

                            <form method="POST" action="./scripts/process-song.php" enctype="multipart/form-data" onsubmit="confirm('Are you sure you want to proceed?')">
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

                <div name="updateAlbum" id="updateAlbum" style="display: none;" class="mb-5">
                    <fieldset>
                        <div class="row">
                            <div class="col-10">
                                <legend class="text-light">Update Album Information</legend>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" onclick="showHideAlbum()">X</button>
                            </div>   
                        </div>

                        <form method="POST" action="./scripts/process-album.php" enctype="multipart/form-data" 
                            onsubmit="confirm('This action will affect all songs associated with this album, and cannot be reversible. Are you sure you want to proceed?')">

                            <input type="hidden" name="selected_album_id" id="selected_album_id" value=""/>

                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-center">
                                    <img id="sel_album_art" name="sel_album_art" src="" alt="Album Art" width="200" class="img-thumbnail"/>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label text-light">Album Title</label>
                                    <input type="rext" id="sel_album_name" name="sel_album_name" class="form-control" placeholder="Album Title"  required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput3" class="form-label text-light">Release Date</label>
                                    <input type="date" id="sel_release_date" name="sel_release_date" class="form-control" placeholder="Release Date" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="new_album_art" class="form-label text-light">Album Thumbnail</label>
                                    <input type="file" id="new_album_art" name="new_album_art" class="form-control"/>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" name="updateAlbum" value="Update"/>
                            <input type="submit" class="btn btn-danger" name="deleteAlbum" value="Delete"/>
                        </form>
                    </fieldset>                        
                </div>

                <div name="updateSong" id="updateSong" style="display: none;">
                    <fieldset>
                        <div class="row">
                            <div class="col-10">
                                <legend class="text-light">Update Song Information</legend>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" onclick="showHideSong()">X</button>
                            </div>   
                        </div>

                        <form method="POST" action="./scripts/process-song.php" class="mt-5 mb-5" enctype="multipart/form-data" 
                            onsubmit="confirm('Are you sure you want to proceed?')">

                            <input type="hidden" name="selected_song_id" id="selected_song_id" value=""/>

                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-center">
                                    <img id="sel_song_art" name="sel_song_art" src="" alt="Album Art" width="200" class="img-thumbnail"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 d-flex justify-content-center">
                                    <audio id="sel_audio" name="sel_audio" src="" alt="Album Art" controls>
                                </div>
                            </div>
                            <div class="row">                    
                                <div class="col-md-6 mb-3">
                                    <label for="album_name" class="form-label text-dark">Album Title</label>
                                    <select name="sel_song_album_id" class="form-control" id="sel_song_album_id" placeholder="Album Title" required>
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
                                        <label for="sel_song_name" class="form-label text-light">Song Title</label>
                                        <input type="text" name="sel_song_name" class="form-control" id="sel_song_name" placeholder="Song Title" required>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="lrc" class="form-label text-light">Lyrics</label>
                                        <input type="file" name="new_lrc" class="form-control" id="new_lrc">
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="track_id" class="form-label text-light">Track Number</label>
                                        <input type="text" name="sel_track_id" class="form-control" id="sel_track_id" placeholder="Track Number" required>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="audio" class="form-label text-light">Audio</label>
                                        <input type="file" name="new_audio" class="form-control" id="new_audio">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="genre" class="form-label text-light">Genre</label>
                                        <input type="text" name="sel_genre" class="form-control" id="sel_genre" placeholder="Genre" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="collaborations" class="form-label text-light">Collaborating Artists</label>
                                        <input type="text" name="sel_collaborations" class="form-control" id="sel_collaborations" value="N/A" placeholder="Collaborating Artists" required>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" name="updateAlbum" value="Update"/>
                                <input type="submit" class="btn btn-danger" name="deleteAlbum" value="Delete"/>
                            </div>
                        </form>
                    </fieldset>
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
                                <th>Play Count</th>
                                <th>Download Count</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query3 = "SELECT song.song_id, song.track_id, song.song_name, album.album_name, 
                                album.release_date, song.genre, album.thumbnail_url, song.play_count, song.download_count, album.album_id 
                                FROM song INNER JOIN album ON song.album_id = album.album_id 
                                WHERE album.artist_id = ? ORDER BY album.release_date DESC";

                                $pstmt3 = $con->prepare($query3);
                                $pstmt3->bindValue(1, $_SESSION["artist_id"]);
                                $pstmt3->execute();
                                $rows = $pstmt3->fetchAll(PDO::FETCH_NUM);

                                foreach($rows as $row){
                                    ?>
                                     <tr>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><img src="<?php echo "./".$row[6]; ?>" alt="Album 1 Thumbnail" width="50"></td>
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" class="editAlbum" onclick="showHideAlbum()">Edit Album</button>
                                            <button type="button" class="btn btn-primary" class="editSong" onclick="showHideSong()">Edit Song</button>
                                        </td>                                       
                                        <td hidden><?php echo $row[0]; ?></td>
                                        <td hidden><?php echo $row[9]; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const table = document.getElementById('music-table');
        const rows = table.getElementsByTagName('tr');

        Array.from(rows).forEach((row, index) => {
            row.addEventListener('click', () => {
                const cells = row.getElementsByTagName('td');

                // UPDATE ALBUM DIV ACCORDINGLY ======================================================
                let sel_album_id = cells[10].textContent; //album id
                
                var xhr_album = new XMLHttpRequest();
                xhr_album.onreadystatechange = function(e){
                    if (this.readyState==4 && this.status==200) {
                        var details = JSON.parse(this.responseText);

                        document.getElementById("selected_album_id").value = cells[10].textContent;
                        document.getElementById("sel_album_name").value = details[0];
                        document.getElementById("sel_release_date").value = details[1];
                        document.getElementById("sel_album_art").src = "./" + details[2];
                    }
                }
                xhr_album.open("GET","./scripts/process-album.php?album_id=" + sel_album_id, true);
                xhr_album.send();
                // ===================================================================================

                // UPDATE ALBUM DIV ACCORDINGLY ======================================================
                let sel_song_id = cells[9].textContent; //song id
                
                var xhr_song = new XMLHttpRequest();
                xhr_song.onreadystatechange = function(e){
                    if (this.readyState==4 && this.status==200) {
                        var details = JSON.parse(this.responseText);

                        document.getElementById("selected_song_id").value = cells[9].textContent;
                        document.getElementById("sel_song_art").src = "./" + details[0];
                        document.getElementById("sel_audio").src = "./" + details[1];
                        document.getElementById("sel_song_album_id").value = details[2];
                        document.getElementById("sel_song_name").value = details[3];
                        document.getElementById("sel_track_id").value = details[4];
                        document.getElementById("sel_genre").value = details[5];
                        document.getElementById("sel_collaborations").value = details[6];
                    }
                }
                xhr_song.open("GET","./scripts/process-song.php?song_id=" + sel_song_id, true);
                xhr_song.send();
                // ===================================================================================
            });
        });
    </script>

    <script type="text/javascript">
        const updateAlbumDiv = document.getElementById("updateAlbum");
        const updateSongDiv = document.getElementById("updateSong");

        function showHideAlbum(){
            if(updateAlbumDiv.style.display == "none"){
                updateAlbumDiv.style.display = "block";
                updateSongDiv.style.display = "none";
            }
            else{
                updateAlbumDiv.style.display = "none";
            }
        }
      
        function showHideSong(){
            if(updateSongDiv.style.display == "none"){
                updateSongDiv.style.display = "block";
                updateAlbumDiv.style.display = "none";
            }
            else{
                updateSongDiv.style.display = "none";
            }
        }
    </script>
</body>

</html>