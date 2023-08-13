const sidebar = document.createElement("template");
sidebar.innerHTML = `
    <div class="sidebar" id="slide-bar">
        <div class="logo">
            <a href="index.php">
                <img src="assets/logos/melomaniac.png" alt="Logo" />
            </a>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="fa fa-fw fa-home"></span>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="user-artists.php">
                        <span class="fa fa-fw fa-users"></span>
                        <span>Artists</span>
                    </a>
                </li>

                <li>
                    <a href="user-albums.php">
                        <span class="fa fa-fw fa-play"></span>
                        <span>Albums</span>
                    </a>
                </li>

                <li>
                    <a href="user-songs.php">
                        <span class="fa fa-fw fa-headphones"></span>
                        <span>Songs</span>
                    </a>
                </li>

                <li>
                    <a href="user-playlists.php">
                        <span class="fa fa-fw fa-music"></span>
                        <span>Playlists</span>
                    </a>
                </li>

                <li>
                    <a href="user-settings.php">
                        <span class="fa fa-fw fa-cogs"></span>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="policies">
            <ul>
                <li>
                    <a href="#">Cookies</a>
                </li>
                <li>
                    <a href="#">Privacy</a>
                </li>
            </ul>
        </div>
    </div>`;
    
document.body.appendChild(sidebar.content);