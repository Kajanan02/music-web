const topbar = document.createElement("template");
topbar.innerHTML = `
    <div class="topbar">
        <div class="prev-next-buttons">
            <button type="button" class="fa fas fa-chevron-left"></button>
            <button type="button" class="fa fas fa-chevron-right"></button>
        </div>

        <div class="navbar">
            <ul>
                <li>
                    <a href="user-premium.html">Premium</a>
                </li>
                <li>
                    <a href="#">Support</a>
                </li>
                <li>
                    <a href="artist-main.html">For Artists</a>
                </li>
                <li>
                    <a href="#">Download</a>
                </li>
                <li class="divider">|</li>
                <li>
                    <a href="user-signup.html">Sign Up</a>
                </li>
            </ul>
            <a type="button" class="nav-btn" href="user-login.html">Log In</a>
        </div>
    </div>`;

document.body.appendChild(topbar.content);