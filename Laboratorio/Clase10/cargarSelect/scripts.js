//Unique retorna el array sin repetidos

Array.prototype.unique=function(a){
    return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
  });

$(function(){

    cargarPaises();       

    $("#paises").change(function(){
        cargarCiudades(this.value);   
    });

})

function cargarPaises(){
  
}

function cargarCiudades(pais){
  

}
