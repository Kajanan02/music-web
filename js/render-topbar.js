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
<div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-dark">Playlist Name</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                   placeholder="Playlist Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput3" class="form-label text-dark">Song</label>
                            <input type="email" class="form-control" id="exampleFormControlInput3"
                                   placeholder="Song">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
                    <a href="user-signup.html"  data-bs-toggle="modal" data-bs-target="#exampleModal">Create playlist</a>
                </li>
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
            <a type="button" class="nav-btn ms-4" href="user-login.php">Log In</a>
            
            </div>
            </div>
        </div>
    </div></div>`;

document.body.appendChild(topbar.content);