function apirest_get(){

    var pagina = "http://localhost:8080/laboratorio_3/Programacion/Clase10/apirest_starter/apirest.php/cd";

    $.ajax({
        type: 'GET',
        url: pagina,
        dataType: "json",
        async: true
    })
    .done(function (objJson) {

        $("#divTabla").html(objJson.Mensaje);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(errorThrown);
    });    

}

function apirest_post(){

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

        $("#divTabla").html(objJson.Mensaje + "<br>" + objJson.v1 + "<br>" + objJson.v2+ "<br>" + objJson.v3);       

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
    });    

}

function apirest_put(){

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
function apirest_delete(id){

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

        $("#divTabla").html(objJson.Mensaje + "<br>" + objJson.v1);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
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
