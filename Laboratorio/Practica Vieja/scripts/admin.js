addEventListener('load', asignarManejadores);
var frm;
var request;
var action;

function asignarManejadores () {
    document.getElementById("frm").addEventListener("submit", function(e) {
        e.preventDefault();
        enviarDatos();
    });
}

function enviarDatos () {
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var data = "nombre=" + encodeURIComponent(nombre) + "&apellido="+encodeURIComponent(apellido);
    request = new XMLHttpRequest();
    request.open('POST', 'main.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function(response) {
        if (request.readyState == 4 && request.status == 200){
            console.log(response)
            document.getElementById("contenido").innerHTML = request.responseText;
        }
    }
    request.send(data);
}