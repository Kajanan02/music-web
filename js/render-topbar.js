const topbar = document.createElement("template");
function myFunction() {
    document.getElementById('slide-bar').setAttribute("class", "sidebar d-block ");
    document.getElementById('layer').setAttribute("class", "modal-layer d-flex opacity-100");
}
function toogleSidebar() {
    document.getElementById('layer').setAttribute("class", "sidebar d-none");
    document.getElementById('slide-bar').setAttribute("class", "sidebar d-none");

    console.log("hello");
}
topbar.innerHTML = `
    <div class="topbar">
<!--        <div class="prev-next-buttons">-->
<!--            <button type="button" class="fa fas fa-chevron-left"></button>-->
<!--            <button type="button" class="fa fas fa-chevron-right"></button>-->
<!--        </div>-->
<div class="modal-layer" id="layer" onclick="toogleSidebar()"></div>

       <nav class="navbar navbar-expand-lg nav-dashboard  shadow">
          <button onclick="myFunction()" class="navbar-toggler p-2 rounded w-auto" style="transform: rotate(180deg)">
            <img src="../assets/slider-icon.svg" alt="menu" class="menu-icon">
        </button>
 <button class="navbar-toggler  p-2 rounded w-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
     
<!--        <button  class=" ms-4" onclick="myFunction()" >Log In</button>-->
         <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul>
                <li>
                    <a href="user-premium.html">Premium</a>
                </li>
                <li>
                    <a href="artist-main.html">For Artists</a>
                </li>
                <li class="divider">|</li>
                <li>
                    <a href="user-signup.html">Sign Up</a>
                </li>
            </ul>
            <div class="text-center mb-3">
            <a type="button" class="nav-btn ms-4" href="user-login.html">Log In</a>
            
            </div>
            </div>
        </div>
    </div>`;

document.body.appendChild(topbar.content);