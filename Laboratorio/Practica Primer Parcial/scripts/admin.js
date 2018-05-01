var xhr;
var datos = new Array();
var postAModificar = null;

window.onload = function(){
    cargarDatos();
};

function getPost (id) {
    if (datos.length > 0) {
        for (i in datos) {
            if (datos[i].id == id) {
                return i;
            }
        }
    }
}

function cargarDatos(){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
           var resp = JSON.parse(this.response);
           datos = resp.data;
           refrescarTabla(resp.data);
        }
    };
    xhr.open("POST","http://localhost:3000/traer",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({"collection":"posts"}));
}

function refrescarTabla(data) {
    var url = window.location.href;
    var table_content = '';
    if (url.indexOf('admin') == -1) {
        for (i in data) {
            if (data[i].active) {
                table_content += "<article><h2>"+data[i].titulo+"</h2><img src='img/imagen_1.jpg' alt='Imagen'><p>"+data[i].articulo+
                "</p><input type=button href='#' class='boton' value='LEER MÁS'/></article>";
            }
        }
        document.getElementById('lista_articulos').innerHTML = table_content;
    } else {
        for (i in data) {
            if (data[i].active) {
                table_content += "<tr><th>"+data[i].id+"</th><th>"+data[i].created_dttm+"</th><th>"+data[i].titulo+"</th><th>"+
                data[i].articulo+"</th><th><input type='button' value='Modificar' onclick='modificarArticulo("+data[i].id+
                ")'></th><th><input type='button' value='Eliminar' onclick='borrarArticulo("+data[i].id+")'></th></tr>";
            }
        }
        document.getElementById('tblPosts').getElementsByTagName('tbody')[0].innerHTML = table_content;
    }
}

function modificarArticulo(id){
    postAModificar = id;
    var i = getPost(id);
    document.getElementById('titulo').value = datos[i].titulo;
    document.getElementById('articulo').value = datos[i].articulo;
}

function borrarArticulo(id){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
           cargarDatos();
        }
    };
    xhr.open("POST","http://localhost:3000/eliminar",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({"collection":"posts","id": id}));
}

function guardarPost() {
    if (postAModificar === null && document.getElementById('titulo').value != '' && document.getElementById('articulo').value != '') {
        document.getElementById('loading').style.display = 'block';
        data = {
            "titulo": document.getElementById('titulo').value,
            "articulo": document.getElementById('articulo').value,
            "mas": "#",
            "collection": "posts"
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('titulo').value = '';
                document.getElementById('articulo').value = '';
                var resp = JSON.parse(this.response);
                datos = resp.data;
                refrescarTabla(resp.data);
            }
        };
        xhr.open("POST","http://localhost:3000/agregar",true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(data));
    } else if (postAModificar != null) {
        document.getElementById('loading').style.display = 'block';
        var i = getPost(postAModificar);
        data = {
            "titulo": document.getElementById('titulo').value,
            "articulo": document.getElementById('articulo').value,
            "mas": datos[i].mas,
            "collection": "posts",
            "id": postAModificar,
            "active" : datos[i].active,
            "created_dttm" : datos[i].created_dttm
        }
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('titulo').value = '';
                document.getElementById('articulo').value = '';
                postAModificar = null;
                cargarDatos();
            }
        };
        xhr.open("POST","http://localhost:3000/modificar",true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(data));
    }
}