function exitDislog() {
    var modal = document.getElementById('myModal');
    modal.display = "none";
}

function showDialog(){
    var modal = document.getElementById('myModal');
    modal.display = "block";

    var winWidth = window.innerWidth;
    var winHeight = window.innerHeight;

    modal.style.left = (winWidth/2) - 480/2 + "px";
    modal.style.top = "150px";
}