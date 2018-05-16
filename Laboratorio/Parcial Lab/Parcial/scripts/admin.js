var articulos = new Array();
var postAModificar = null;

window.onload = function(){
    cargarArticulos();
}

function cargarArticulos(){
    document.getElementById('loader').className='';
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('loader').className='is-hidden';
            articulos = JSON.parse(this.responseText)['data'];
            cargarTablas();
        }
    };
    xhr.open("GET","http://localhost:3000/traer?collection=posts",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send();
}

function cargarTablas(){
    posts_content = ''
    if (window.location.href.indexOf('admin') == -1) {
        html_content = '';
    } else {
        document.getElementById('titulo').value = '';
        document.getElementById('articulo').value = '';
        document.getElementById('mas').value = '';
        html_content = '<table><thead><th style="width:1rem">ID</th><th style="width:15rem">Titulo</th><th style="width:40rem">Articulo</th><th style="width:10rem"></th><th style="width:10rem"></th></thead></tbody>';
    }
    if (articulos && articulos.length > 0) {
        for (i in articulos) {
            if (articulos[i].active) {
                if (window.location.href.indexOf('admin') == -1) {
                    html_content += '<article><h2 id='+articulos[i].id+'>'+articulos[i].titulo+'</h2><img src="img/imagen_1.jpg" alt=""><p>'+articulos[i].articulo+'</p></article>'
                } else {
                    html_content += '<tr><th>'+articulos[i].id+'</th><th>'+articulos[i].titulo+'</th><th>'+articulos[i].articulo+'</th><th><input type=button value="Modificar" onclick=modificarArticulo('+articulos[i].id+')></th><th><input type=button value="Borrar" onclick=borrarArticulo('+articulos[i].id+')></th></tr>'
                }
                posts_content += '<li><a href="#'+articulos[i].id+'">'+articulos[i].titulo+'</a></li>';
            }
        }
    }
    if (window.location.href.indexOf('admin') == -1) {
        document.getElementsByClassName('contenido')[0].getElementsByTagName('main')[0].innerHTML = html_content;
    } else {
        html_content += '</tbody></table>';
        document.getElementById('tablaArticulos').innerHTML = html_content;
    }
    document.getElementsByClassName('sidebar')[0].getElementsByTagName('ul')[0].innerHTML = posts_content;
}

function enviarAlta(data){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        cargarArticulos();
    };
    xhr.open("POST","http://localhost:3000/agregar",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
}

function guardarArticulo() {
    if (postAModificar == null) {
        var data = {
            'titulo' : document.getElementById('titulo').value,
            'articulo' : document.getElementById('articulo').value,
            'mas' : document.getElementById('mas').value,
            'collection' : "posts"
        }
        enviarAlta(data);
    } else {
        var data = {
            "titulo" : document.getElementById('titulo').value,
            "articulo" : document.getElementById('articulo').value,
            "mas" : document.getElementById('mas').value,
            "collection" : "posts",
            "id" : postAModificar.id,
            "active" : postAModificar.active,
            "created_dttm" : postAModificar.created_dttm
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            postAModificar = null;
            cargarArticulos();
        };
        xhr.open("POST","http://localhost:3000/modificar",true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(data));
    }
}

function modificarArticulo(id){
    if (articulos && articulos.length > 0) {
        for (i in articulos) {
            if (articulos[i].id == id) {
                document.getElementById('titulo').value = articulos[i].titulo;
                document.getElementById('articulo').value = articulos[i].articulo;
                document.getElementById('mas').value = articulos[i].mas;
                postAModificar = articulos[i];
            }
        }
    }
}

function borrarArticulo(id){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        cargarArticulos();
    };
    xhr.open("POST","http://localhost:3000/eliminar",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({"collection":"posts","id": id}));
}