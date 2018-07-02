"use strict";
$(function () {
    cargarTipos();
    mostrarHeroes();
    $('#cmbFiltro').change(function () {
        filtrarHeroes(Number($(this).val()));
    });
    $("#chkId, #chkName, #chkEdad, #chkPoder").change(mapearCampos);
});
function agregarHeroe() {
    var id = Number($('#txtId').val());
    var tipo = Number($('#selectTipo').val());
    var nuevoHeroe = new Clases.Heroe(id, String($('#txtNombre').val()), Number($('#txtEdad').val()), tipo, String($('#txtPoder').val()));
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    HeroesJSON.push(JSON.parse(nuevoHeroe.toJSON()));
    localStorage.setItem("Heroes", JSON.stringify(HeroesJSON));
    alert("Heroe guardado!!!");
    mostrarHeroes();
    limpiarCampos();
}
function limpiarCampos() {
    $('#txtNombre').val("");
    $('#txtId').val("");
    $('#txtEdad').val("");
    $('#txtPoder').val("");
    $('#selectTipo').val(0);
    $('#txtId').focus();
}
function mostrarHeroes() {
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    var tabla = "<table class='table'><thead><tr><th>Id</th><th>Nombre</th><th>Edad</th><th>Tipo</th><th>Poder</th></tr>";
    for (var i = 0; i < HeroesJSON.length; i++) {
        tabla += "<tr><td>" + HeroesJSON[i].id + "</td><td>" + HeroesJSON[i].nombre + "</td><td>" + HeroesJSON[i].edad + "</td><td>" + Clases.tipoHeroe[HeroesJSON[i].tipo] + "</td><td>" + HeroesJSON[i].poder_principal + "</td></tr>";
    }
    tabla += "</table>";
    $('#divTabla').html(tabla);
}
function cargarTipos() {
    for (var i = 0; i < Object.keys(Clases.tipoHeroe).length / 2; i++) {
        $("#cmbFiltro").append('<option value="' + i + '">' + Clases.tipoHeroe[i] + '</option>');
    }
    for (var i = 0; i < Object.keys(Clases.tipoHeroe).length / 2; i++) {
        $("#selectTipo").append('<option value="' + i + '">' + Clases.tipoHeroe[i] + '</option>');
    }
}
function filtrarHeroes(tipo) {
    var heroesFiltrados;
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    heroesFiltrados = HeroesJSON.filter(function (Heroe) {
        return Clases.tipoHeroe[Heroe.tipo] === Clases.tipoHeroe[tipo];
    });
    mostrarHeroesPorTipo(heroesFiltrados);
}
function cleanStorage() {
    localStorage.clear();
    alert("LocalStorage Limpio");
}
function mostrarHeroesPorTipo(lista) {
    var chkId = $('#chkId')[0].checked;
    var chkName = $('#chkName')[0].checked;
    var chkEdad = $('#chkEdad')[0].checked;
    var chkPoder = $('#chkPoder')[0].checked;
    var tabla = "<table class='table'><thead><tr>";
    if (chkId) {
        tabla += "<th>Id</th>";
    }
    if (chkName) {
        tabla += "<th>Nombre</th>";
    }
    if (chkEdad) {
        tabla += "<th>Edad</th>";
    }
    tabla += "<th>Tipo</th>";
    if (chkPoder) {
        tabla += "<th>Poder</th>";
    }
    tabla += "</tr>";
    if (lista.length == 0) {
        tabla += "<tr><td colspan='4'>No hay mascotas que mostrar</td></tr>";
    }
    else {
        for (var i = 0; i < lista.length; i++) {
            tabla += "<tr><td>" + lista[i].id + "</td><td>" + lista[i].nombre + "</td><td>" + lista[i].edad + "</td><td>" + Clases.tipoHeroe[lista[i].tipo] + "</td><td>" + lista[i].poder_principal + "</td></tr>";
        }
    }
    tabla += "</table>";
    $('#divTabla').html(tabla);
}
function calcularPromedio() {
    var promedio = 0;
    var totalEdades;
    var cantidad;
    var tipo = Number($('#cmbFiltro').val());
    var heroesFiltrados;
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    heroesFiltrados = HeroesJSON.filter(function (Heroe) {
        return Clases.tipoHeroe[Heroe.tipo] === Clases.tipoHeroe[tipo];
    });
    totalEdades = heroesFiltrados.reduce(function (ant, act) {
        return ant += act.edad;
    }, 0);
    cantidad = heroesFiltrados.length;
    if (cantidad != 0) {
        promedio = totalEdades / cantidad;
    }
    $('#txtPromedio').val(promedio);
}
function mapearCampos() {
    var chkId = $('#chkId')[0].checked;
    var chkName = $('#chkName')[0].checked;
    var chkEdad = $('#chkEdad')[0].checked;
    var chkPoder = $('#chkPoder')[0].checked;
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    var tabla = "<table class='table'><thead><tr>";
    if (chkId) {
        tabla += "<th>Id</th>";
    }
    if (chkName) {
        tabla += "<th>Nombre</th>";
    }
    if (chkEdad) {
        tabla += "<th>Edad</th>";
    }
    tabla += "<th>Tipo</th>";
    if (chkPoder) {
        tabla += "<th>Poder</th>";
    }
    tabla += "</tr>";
    for (var i = 0; i < HeroesJSON.length; i++) {
        tabla += "<tr>";
        if (chkId) {
            tabla += "<td>" + HeroesJSON[i].id + "</td>";
        }
        if (chkName) {
            tabla += "<td>" + HeroesJSON[i].nombre + "</td>";
        }
        if (chkEdad) {
            tabla += "<td>" + HeroesJSON[i].edad + "</td>";
        }
        tabla += "<td>" + Clases.tipoHeroe[HeroesJSON[i].tipo] + "</td>";
        if (chkPoder) {
            tabla += "<td>" + HeroesJSON[i].poder_principal + "</td>";
        }
        tabla += "</tr>";
    }
    tabla += "</table>";
    $('#divTabla').html(tabla);
}
function modificar() {
    var id = Number($('#txtId').val());
    var tipo = Number($('#selectTipo').val());
    var nuevoHeroe = new Clases.Heroe(id, String($('#txtNombre').val()), Number($('#txtEdad').val()), tipo, String($('#txtPoder').val()));
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    var indice = -1;
    for (var i = 0; i < HeroesJSON.length; i++) {
        if (HeroesJSON[i].id == id) {
            indice = i;
        }
    }
    if (indice != -1) {
        HeroesJSON[indice] = JSON.parse(nuevoHeroe.toJSON());
    }
    localStorage.setItem("Heroes", JSON.stringify(HeroesJSON));
    alert("Heroe modificado!!!");
    mostrarHeroes();
    limpiarCampos();
}
function eliminar() {
    var id = Number($('#txtId').val());
    var HeroesString = localStorage.getItem("Heroes");
    var HeroesJSON = HeroesString == null ? [] : JSON.parse(HeroesString);
    HeroesJSON = HeroesJSON.filter(function (Heroe) {
        return Heroe.id !== id;
    });
    localStorage.setItem("Heroes", JSON.stringify(HeroesJSON));
    alert("Heroe eliminado!!!");
    mostrarHeroes();
    limpiarCampos();
}
//# sourceMappingURL=app.js.map