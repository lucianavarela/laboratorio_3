"use strict";
var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var Clases;
(function (Clases) {
    var Animal = /** @class */ (function () {
        function Animal(id, nombre, edad, patas, tipo) {
            this.id = 0;
            this.nombre = "";
            this.edad = 0;
            this.patas = 0;
            this.tipo = Clases.tipoMascota.Perro;
            this.id = id;
            this.nombre = nombre;
            this.edad = edad;
            this.patas = patas;
            this.tipo = tipo;
        }
        Animal.prototype.toJSON = function () {
            var json = "{\"id\":\"" + this.id + "\", \"nombre\":\"" + this.nombre + "\", \"edad\":" + this.edad + ",\"patas\":" + this.patas + ", \"tipo\":" + this.tipo + "}";
            return json;
        };
        return Animal;
    }());
    Clases.Animal = Animal;
})(Clases || (Clases = {}));
var Clases;
(function (Clases) {
    var Mascota = /** @class */ (function (_super) {
        __extends(Mascota, _super);
        function Mascota(id, nombre, edad, patas, tipo) {
            return _super.call(this, id, nombre, edad, patas, tipo) || this;
        }
        return Mascota;
    }(Clases.Animal));
    Clases.Mascota = Mascota;
})(Clases || (Clases = {}));
///<reference path="mascota.ts"/>
$(function () {
    cargarTipos();
    mostrarMascotas();
    $('#cmbFiltro').change(function () {
        filtrarMascotas(this.value);
    });
    $('#chkId').change(mapearCampos);
    $('#chkName').change(mapearCampos);
    $('#chkEdad').change(mapearCampos);
    $('#chkPatas').change(mapearCampos);
    mapearCampos();
});
function agregarMascota() {
    var tipo = Number($('#selectTipo').val());
    var nuevaMascota = new Clases.Mascota(Number($('#txtId').val()), String($('#txtNombre').val()), Number($('#txtEdad').val()), Number($('#txtPatas').val()), tipo);
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    MascotasJSON.push(JSON.parse(nuevaMascota.toJSON()));
    localStorage.setItem("Mascotas", JSON.stringify(MascotasJSON));
    mostrarMascotas();
    limpiarCampos();
}
function modificarMascota() {
    var id = Number($('#txtId').val());
    var tipo = Number($('#selectTipo').val());
    var nuevaMascota = new Clases.Mascota(Number($('#txtId').val()), String($('#txtNombre').val()), Number($('#txtEdad').val()), Number($('#txtPatas').val()), tipo);
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    var indice = -1;
    for (var i = 0; i < MascotasJSON.length; i++) {
        if (MascotasJSON[i].id == id) {
            indice = i;
            break;
        }
    }
    if (indice != -1) {
        MascotasJSON[indice] = JSON.parse(nuevaMascota.toJSON());
        localStorage.setItem("Mascotas", JSON.stringify(MascotasJSON));
        mostrarMascotas();
    }
    limpiarCampos();
}
function eliminarMascota() {
    var id = Number($('#txtId').val());
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    MascotasJSON = MascotasJSON.filter(function (mascota) {
        return mascota.id != id;
    });
    localStorage.setItem("Mascotas", JSON.stringify(MascotasJSON));
    mostrarMascotas();
    limpiarCampos();
}
function limpiarCampos() {
    $('#txtNombre').val("");
    $('#txtId').val("");
    $('#txtEdad').val("");
    $('#txtPatas').val("");
    $('#selectTipo').val(0);
    $('#txtId').focus();
}
function mostrarMascotas() {
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    var tabla = "<table class='table'><thead><tr><th>Id</th><th>Nombre</th><th>Edad</th><th>Tipo</th><th>Patas</th></tr>";
    for (var i = 0; i < MascotasJSON.length; i++) {
        tabla += "<tr><td>" + MascotasJSON[i].id + "</td><td>" + MascotasJSON[i].nombre + "</td><td>" + MascotasJSON[i].edad + "</td><td>" + Clases.tipoMascota[MascotasJSON[i].tipo] + "</td><td>" + MascotasJSON[i].patas + "</td></tr>";
    }
    tabla += "</table>";
    $('#divTabla').html(tabla);
}
function cargarTipos() {
    for (var i = 0;; i++) {
        if (Clases.tipoMascota[i]) {
            $("#cmbFiltro, #selectTipo").append('<option value="' + i + '">' + Clases.tipoMascota[i] + '</option>');
        }
        else {
            break;
        }
    }
}
function filtrarMascotas(tipo) {
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    if (tipo != -1) {
        MascotasJSON = MascotasJSON.filter(function (mascota) {
            return Clases.tipoMascota[mascota.tipo] === Clases.tipoMascota[tipo];
        });
    }
    mostrarMascotasPorTipo(MascotasJSON);
}
function cleanStorage() {
    localStorage.clear();
    alert("LocalStorage Limpio");
}
function mostrarMascotasPorTipo(lista) {
    var tabla = "<table class='table'><thead><tr><th>Id</th><th>Nombre</th><th>Edad</th><th>Tipo</th><th>Patas</th></tr>";
    if (lista.length == 0) {
        tabla += "<tr><td colspan='4'>No hay mascotas que mostrar</td></tr>";
    }
    else {
        for (var i = 0; i < lista.length; i++) {
            tabla += "<tr><td>" + lista[i].id + "</td><td>" + lista[i].nombre + "</td><td>" + lista[i].edad + "</td><td>" + Clases.tipoMascota[lista[i].tipo] + "</td><td>" + lista[i].patas + "</td></tr>";
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
    var mascotasFiltradas;
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    if (tipo != -1) {
        MascotasJSON = MascotasJSON.filter(function (mascota) {
            return Clases.tipoMascota[mascota.tipo] === Clases.tipoMascota[tipo];
        });
    }
    totalEdades = MascotasJSON.reduce(function (anterior, actual) {
        return anterior += actual.edad;
    }, 0);
    cantidad = MascotasJSON.length;
    if (cantidad != 0) {
        promedio = totalEdades / cantidad;
    }
    $('#txtPromedio').val(promedio.toFixed(2));
}
function mapearCampos() {
    var chkId = $('#chkId')[0].checked;
    var chkName = $('#chkName')[0].checked;
    var chkEdad = $('#chkEdad')[0].checked;
    var chkPatas = $('#chkPatas')[0].checked;
    var MascotasString = localStorage.getItem("Mascotas");
    var MascotasJSON = MascotasString == null ? [] : JSON.parse(MascotasString);
    var tabla = "<table class='table'><thead><tr>";
    if (chkId)
        tabla += "<th>Id</th>";
    if (chkName)
        tabla += "<th>Nombre</th>";
    if (chkEdad)
        tabla += "<th>Edad</th>";
    tabla += "<th>Tipo</th>";
    if (chkPatas)
        tabla += "<th>Patas</th>";
    tabla += "</tr>";
    for (var i = 0; i < MascotasJSON.length; i++) {
        tabla += "<tr>";
        if (chkId)
            tabla += "<td>" + MascotasJSON[i].id + "</td>";
        if (chkName)
            tabla += "<td>" + MascotasJSON[i].nombre + "</td>";
        if (chkEdad)
            tabla += "<td>" + MascotasJSON[i].edad + "</td>";
        tabla += "<td>" + Clases.tipoMascota[MascotasJSON[i].tipo] + "</td>";
        if (chkPatas)
            tabla += "<td>" + MascotasJSON[i].patas + "</td>";
        tabla += "</tr>";
    }
    tabla += "</table>";
    $('#divTabla').html(tabla);
}
var Clases;
(function (Clases) {
    var tipoMascota;
    (function (tipoMascota) {
        tipoMascota[tipoMascota["Perro"] = 0] = "Perro";
        tipoMascota[tipoMascota["Gato"] = 1] = "Gato";
        tipoMascota[tipoMascota["Reptil"] = 2] = "Reptil";
        tipoMascota[tipoMascota["Roedor"] = 3] = "Roedor";
        tipoMascota[tipoMascota["Ave"] = 4] = "Ave";
        tipoMascota[tipoMascota["Pez"] = 5] = "Pez";
    })(tipoMascota = Clases.tipoMascota || (Clases.tipoMascota = {}));
})(Clases || (Clases = {}));
//# sourceMappingURL=main.js.map