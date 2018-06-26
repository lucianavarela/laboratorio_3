"use strict";
var Clases;
(function (Clases) {
    var Personaje = /** @class */ (function () {
        function Personaje(nombre, edad) {
            this.nombre = "";
            this.edad = 0;
            this.nombre = nombre;
            this.edad = edad;
        }
        Personaje.prototype.toJSON = function () {
            var json = "{\"nombre\":\"" + this.nombre + "\", \"edad\":" + this.edad + "}";
            return json;
        };
        return Personaje;
    }());
    Clases.Personaje = Personaje;
})(Clases || (Clases = {}));
//# sourceMappingURL=personaje.js.map