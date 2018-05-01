window.addEventListener('load', asignarEventos);

function asignarEventos(){

    var frm = this.document.getElementById("frmLogin");

    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        enviarFormulario();
    }, false);

}
    var peticion;   

    function obtenerDatos() {
        var txtNombre = document.getElementById('nombre');
        var txtClave = document.getElementById('clave');

        var cad =  "nombre=" + encodeURIComponent(txtNombre.value)+ "&clave=" + encodeURIComponent(txtClave.value);
       
        return cad;
    }
   
    function enviarFormulario() {

        peticion = new XMLHttpRequest();
        peticion.onreadystatechange = procesarRespuesta;
        peticion.open('POST', 'servidor.php', true);
        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        peticion.send(obtenerDatos());

    }

    function procesarRespuesta() {

        var contenido = document.getElementById('contenido');

        if (peticion.readyState == 4 && peticion.status == 200) {
            contenido.innerHTML = peticion.responseText;
        }

    }

