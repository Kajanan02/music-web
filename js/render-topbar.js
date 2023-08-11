function myFunction() {
    document.getElementById('slide-bar').setAttribute("class", "sidebar d-block ");
    document.getElementById('layer').setAttribute("class", "modal-layer d-flex opacity-100");
}
function toogleSidebar() {
    document.getElementById('layer').setAttribute("class", "sidebar d-none");
    document.getElementById('slide-bar').setAttribute("class", "sidebar d-none");
}