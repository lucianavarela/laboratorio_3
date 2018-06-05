function traerTodos(){

    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd";

    $.ajax({
        type: 'GET',
        url: pagina,
        dataType: "json",
        async: true
    })
    .done(function (objJson) {
        html = '<table style="border:1px solid gray">';
        for (i in objJson.Lineas) {
            html += '<tr style="border:1px solid orange">'+
            '<th style="border:1px solid orange; padding:3px">'+objJson.Lineas[i].valorChar+'</th>'+
            '<th style="border:1px solid orange; padding:3px">'+objJson.Lineas[i].valorInt+'</th>'+
            '<th style="border:1px solid orange; padding:3px">'+objJson.Lineas[i].valorDate+'</th>'+
            '<th style="border:1px solid orange; padding:3px"><input type="button" value="Modificar" onclick=modificar('+objJson.Lineas[i].valorInt+')></th>'+
            '<th style="border:1px solid orange; padding:3px"><input type="button" value="Eliminar" onclick=borrar('+objJson.Lineas[i].valorInt+')></th>'+
            '</tr>'
        }
        html += '</table>';
        $("#divTabla").html(html);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(errorThrown);
    });    

}

function agregar(){

    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
            valorChar : $("#valor_char").val(),
            valorDate : $("#valor_date").val(),
            valorInt : $("#valor_int").val()
        },
        async: true
        })
    .done(function (objJson) {
       // location = 'laboratorio_3/Programacion/Clase10/apirest_starter/listado.php';
       console.log("bien ahi");
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("error");
        console.info("textStatus",jqXHR);
        console.info("textStatus",textStatus);
        console.info("textStatus",errorThrown);
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    

}

function modificar(){

    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd";

    $.ajax({
        type: 'PUT',
        url: pagina,
        dataType: "json",
        data: {
            id : $("#id").val(),
            valorChar : $("#valor_char").val(),
            valorDate : $("#valor_date").val(),
            valorInt : $("#valor_int").val()
        },
        async: true
    })
    .done(function (objJson) {

        $("#divTabla").html(objJson.Mensaje + "<br>" + objJson.v1 + "<br>" + objJson.v2 + "<br>" + objJson.v3 + "<br>" + objJson.v4);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    

}
function borrar(id){
    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd";
    $.ajax({
        type: 'DELETE',
        url: pagina,
        dataType: "json",
        data: {
            id : id
        },
        async: true
    })
    .done(function (objJson) {
        location.reload();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(errorThrown);
    });    

}

function apirest_get_uno(id){

    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd/"+id;

    $.ajax({
        type: 'GET',
        url: pagina,
        dataType: "json",
        async: true
    })
    .done(function (objJson) {

        $("#divTabla").html(objJson.Mensaje + "<br>" + objJson.v1);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
}
