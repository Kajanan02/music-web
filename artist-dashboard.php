<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Artist Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logos/favicon.png">

    <!-- Bootstrap 5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
            integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/premium.css">
    <link rel="stylesheet" href="css/artist-dashboard.css">
</head>

<body>
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

            <!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 "-->
            <!--               href="artist-dashboard.html">Dashboard</a>-->
            <!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 "-->
            <!--               href="artist-settings.html">Settings</a>-->
            <!--            <a class=" fw-medium px-3 py-1 text-decoration-none nav-items mt-4 " href="artist-login.html">Logout</a>-->
        </div>
    </div>
</nav>

<div class="container">
    <h1>Dashboard</h1>
    <div class="">
        <!--        <div class="col-md-4 align-self-start left">-->
        <!--            <form>-->
        <!--                <fieldset>-->
        <!--                    <legend class="display-7">Create Album</legend>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="album-titles">Album Title</label>-->
        <!--                        <input type="text" class="form-control" id="album-titles">-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="release-date">Release Date</label>-->
        <!--                        <input type="date" class="form-control" id="release-date">-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="thumbnail">Album Thumbnail</label>-->
        <!--                        <div class="custom-file">-->
        <!--                            <input type="file" class="custom-file-input" id="thumbnail">-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <button type="submit" class="btn btn-primary">Create Album</button>-->
        <!--                </fieldset>-->
        <!--            </form>-->

        <!--            <br><br>-->

        <!--            <form>-->
        <!--                <fieldset>-->
        <!--                    <legend class="display-7">Add Music</legend>-->
        <!--                    &lt;!&ndash; Fill the Thumbnail of the Song and Other data using the album title &ndash;&gt;-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="album-title">Album Title</label>-->
        <!--                        <input type="text" class="form-control" id="album-title"> &lt;!&ndash; Should be a Dropdown&ndash;&gt;-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="song-title">Song Title</label>-->
        <!--                        <input type="text" class="form-control" id="song-title">-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="genre">Genre</label>-->
        <!--                        <input type="text" class="form-control" id="genre">-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="track-id">Track ID</label>-->
        <!--                        <input type="text" class="form-control" id="track-id">-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="lyrics">Lyrics</label>-->
        <!--                        <div class="custom-file">-->
        <!--                            <input type="file" class="custom-file-input" id="lyrics">-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <label for="collaborating-artists">Collaborating Artists</label>-->
        <!--                        <input type="text" class="form-control" id="collaborating-artists">-->
        <!--                    </div>-->
        <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
        <!--                </fieldset>-->
        <!--            </form>-->
        <!--        </div>-->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <h2 class="display-6 fw-medium mb-4 mt-3">Song List</h2>
            <div>
                <button type="button" class="btn btn-light bg-light-subtle fw-medium mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    + Create Album
                </button>
                <button type="button" class="btn btn-light bg-light-subtle fw-medium ms-3 mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal1">
                    + Add Music
                </button>
            </div>
        </div>
        <div class="">

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-dark fs-5" id="exampleModalLabel">Create Album</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label text-dark">Album
                                        Title</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                           placeholder="Album Title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput3" class="form-label text-dark">Release
                                        Date</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput3"
                                           placeholder="Release Date">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="formFile" class="form-label text-dark">Album Thumbnail</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput2" class="form-label text-dark">Album ID</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput2"
                                           placeholder="Album ID">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-dark fs-5" id="exampleModalLabel">Add Music</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput4" class="form-label text-dark">Album
                                        Title</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput4"
                                           placeholder="Album Title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput5" class="form-label text-dark">Song
                                        Title</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput5"
                                           placeholder="Song Title">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="formFiles" class="form-label text-dark">Lyrics</label>
                                    <input class="form-control" type="file" id="formFiles">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="exampleFormControlInput6" class="form-label text-dark">Track ID</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput6"
                                           placeholder="Track ID">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput7" class="form-label text-dark">Song
                                        Title</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput7"
                                           placeholder="Song Title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput8" class="form-label text-dark">Collaborating
                                        Artists</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput8"
                                           placeholder="Collaborating Artists">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Create</button>
                        </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get reference to the table and form elements
        var musicTable = document.getElementById("music-table");
        var trackIdInput = document.getElementById("track-id");
        var songTitleInput = document.getElementById("song-title");
        var albumTitleInput = document.getElementById("album-title");
        var releaseDateInput = document.getElementById("release-date");
        var genreInput = document.getElementById("genre");

        // Add event listener to the table rows
        musicTable.addEventListener("click", function (event) {
            var selectedRow = event.target.parentElement;

            // Populate the form fields with data from the selected row
            trackIdInput.value = selectedRow.cells[0].textContent;
            songTitleInput.value = selectedRow.cells[1].textContent;
            albumTitleInput.value = selectedRow.cells[2].textContent;
            releaseDateInput.value = selectedRow.cells[3].textContent;
            genreInput.value = selectedRow.cells[4].textContent;
        });
    });
</script>

</body>
</html>