var xhr;
var datos = new Array();
var postAModificar;

window.onload = function(){
    
    cargarDatos();

};




function cargarDatos(){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
           var resp = JSON.parse(this.response); 
           console.log(resp.message);
           refrescarTabla(resp.data);
           datos = resp.data;
        }
    };
    xhr.open("POST","http://localhost:3000/traer",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({"collection":"posts"}));
    
}






