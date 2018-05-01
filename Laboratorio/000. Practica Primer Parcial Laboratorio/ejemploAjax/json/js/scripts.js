addEventListener('load', asignarManejadores);

function asignarManejadores(){
    var form = document.getElementById("frm");
    form.addEventListener('submit', function(e){
        e.preventDefault();
        enviarDatos();
    });

    var req;

    function enviarDatos(){
       // alert("Hola");
       var datos ="servidor.php?nombre=" + document.getElementById('nombre').value;
       
        req = new XMLHttpRequest();

        req.open('GET', datos, true);

        req.onreadystatechange = procesarRespuesta;
        req.send();      

    }


    function procesarRespuesta(){
        if(req.readyState == 4 && req.status == 200){
            var info = JSON.parse(req.responseText);
            document.getElementById('datos').innerHTML = "Nombre= " + info.nombre + "<br>Apellido= " + info.apellido + "<br>Edad= " + info.edad; 
        }
    }

}

