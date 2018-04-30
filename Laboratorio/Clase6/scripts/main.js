
addEventListener('load', asignarManejadores);
var frm;
var request;
var action;
/*
function enviarDatos() {
    var datosFormulario = new FormData(frm);
    for ([key, value] of datosFormulario.entries()) {
        console.log(key + ":" + value);
    }
}
*/
function asignarManejadores () {
    document.getElementById("frm").addEventListener("submit", function(e) {
        e.preventDefault();
        enviarDatos();
    });
}

/*REQUEST GET
function enviarDatos () {
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var data = "nombre=" + encodeURIComponent(nombre) + "&apellido="+encodeURIComponent(apellido);
    request = new XMLHttpRequest();
    request.open('GET', 'main.php', true);
    request.setRequestHeader(data);
    request.onreadystatechange = function(response) {
        if (request.readyState == 4 && request.status == 200){
            console.log(response)
            document.getElementById("contenido").innerHTML = request.responseText;
        }
    }
    request.send();
}*/

/* REQUEST POST
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
}*/


//REQUEST POST
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

function cargarTabla (data) {
    var table = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}\
    td, th {border: 1px solid #dddddd;padding: 8px;}\
    tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Alumnos</h2>\
    <table><tr><th>Legajo</th><th>Nombre</th><th>Foto</th></tr>";
    data.forEach(function(item) {
        table += "<tr><th>" + item + "</th><th>" + item + "</th><th>" + item + "</th></tr>";
    });
    table += "</table>";
}