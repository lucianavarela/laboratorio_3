var req;

function traerDatos() {

    req = new XMLHttpRequest();
    req.open('GET', 'servidor.php', true);

    req.onreadystatechange = function () {
        console.log(req.readyState);
        if (req.readyState == 4) {

            if (req.status == 200) {

                var data = JSON.parse(req.responseText);

                cargarTabla(data);
            }
            else{
                alert(req.statusText);
            }
        }
    };

    req.send();
    document.getElementById("contenido").innerHTML = '<img src="images/39.gif">';
}

function cargarTabla(data) {

    var tabla = "<table><thead><tr><th>Id</th><th>Nombre</th><th>Email</th><th>Genero</th></tr></thead><tbody>";

    for (var i = 0; i < data.length; i++) {
        tabla += "<tr><td>" + data[i].id + "</td><td>" + data[i].first_name + "</td><td>" + data[i].email + "</td><td>" + data[i].gender + "</td></tr>";
    }
    tabla += "</tbody></table>";

    document.getElementById("contenido").innerHTML = tabla;
    
}

