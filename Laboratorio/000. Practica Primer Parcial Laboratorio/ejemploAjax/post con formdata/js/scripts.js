addEventListener('load', agregarManejadores);

var frmAlta;
var req;
var action;

function agregarManejadores() {
    frmAlta = document.getElementById('frmAlta');
    action = frmAlta.getAttribute('action');
    frmAlta.addEventListener('submit', function (e) {
        e.preventDefault();
        enviarDatos();
    });
}

function enviarDatos() {
    var datosFormulario = new FormData(frmAlta);
    for ([key, value] of datosFormulario.entries()) {
        console.log(key + ": " + value);
    }

    req = new XMLHttpRequest();
    req.open('POST', action, true);
    req.onreadystatechange = procesarRespuesta;
    req.setRequestHeader('X-Requested-With', 'XMLHTTPRequest');
    req.send(datosFormulario);

}


function procesarRespuesta(){
    if(req.readyState == 4 && req.status == 200){          
        
        var obj = JSON.parse(req.responseText);

        document.getElementById('contenido').innerHTML = "Nombre: " + obj.nombre + "<br>Apellido: " + obj.apellido + "<br>Email: " + obj.email;
    }
}


