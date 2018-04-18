/*addEventListener('load', function() {
});*/

addEventListener('load', asignarManejadores);
var frm;
var request;

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
    request.open('POST', 'pagina.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function(response) {
        if (request.readyState == 4 && request.status == 200){
            document.getElementById("contenido").innerHTML = request.responseText;
        }
    }
    request.send(data);
}