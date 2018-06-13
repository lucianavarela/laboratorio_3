"use strict";
//PARA INICIALIZAR TYPESCRIPT -> tsc --init
//PARA EL WATCHER -> tsc -w
// 1 --> array
var vector = [1, 2, 3, 4];
console.log('------------------1------------------');
for (var a = 0; a < vector.length; a++) {
    console.log(vector[a]);
}
// 2 --> tupla
var tupla = [1, "Ironman"];
console.log('------------------2------------------');
console.log(tupla);
// 3 --> enum
var Eheroe;
(function (Eheroe) {
    Eheroe[Eheroe["Xman"] = 0] = "Xman";
    Eheroe[Eheroe["Avenger"] = 1] = "Avenger";
})(Eheroe || (Eheroe = {}));
console.log('------------------3------------------');
console.log(Eheroe.Avenger);
var nombre = Eheroe[Eheroe.Avenger];
console.log(nombre);
// 4 --> funcion
var functionEnviarMision = function (heroe) {
    return heroe + " enviado";
};
console.log('------------------4------------------');
console.log(functionEnviarMision(tupla[1]));
// 5 --> parametros opcionales
var functionEnviarMision3 = function (heroe) {
    if (heroe) {
        return functionEnviarMision(heroe);
    }
    else {
        return "Algún heroe se envió";
    }
};
console.log('------------------5------------------');
console.log(functionEnviarMision3());
console.log(functionEnviarMision3("Spiderman"));
// 6 --> parametros por defecto
var functionEnviarMision4 = function (heroe) {
    if (heroe === void 0) { heroe = "xxx"; }
    return functionEnviarMision(heroe);
};
console.log('------------------6------------------');
console.log(functionEnviarMision4());
console.log(functionEnviarMision4("Wolverine"));
// 7 --> parametros rest
var functionEnviarMision5 = function () {
    var heroe = [];
    for (var _i = 0; _i < arguments.length; _i++) {
        heroe[_i] = arguments[_i];
    }
    for (var i = 0; i < heroe.length; i++) {
        console.log(heroe[i] + ' enviado?');
    }
};
console.log('------------------7------------------');
console.log(functionEnviarMision5("Antman", "Captain America"));
// 8 --> funcion arrow
var functionEnviarMision6 = function (heroe) {
    if (heroe === void 0) { heroe = "Heroe"; }
    return functionEnviarMision(heroe);
};
console.log('------------------8------------------');
console.log(functionEnviarMision6("Black Panther"));
// 9 --> tipo en objeto
var flash = {
    nombre: "Barry Alen",
    edad: 24,
    poderes: ["Velocidad", "Viaje en el tiempo"],
    getNombre: function () {
        return "Me llamo " + this.nombre;
    }
};
console.log('------------------9------------------');
console.log(flash);
console.log(flash.getNombre());
var WonderWoman = {
    nombre: "Gal Gadot",
    edad: 34,
    //poderes: ["Velocidad", "Fuerza"], COMO ^^^^, PUEDO NO PONERLO
    getNombre: function () {
        return "Me llamo " + this.nombre;
    }
};
console.log('------------------10-----------------');
console.log(WonderWoman);
console.log(WonderWoman.getNombre());
var unHeroe;
console.log('------------------11-----------------');
unHeroe = { nombre: "Ironman", edad: 45 };
console.log(unHeroe.nombre);
unHeroe = { nombre: "Ironman", edad: 45, getNombre: function () { return "Me llamo " + this.nombre; } };
console.log(unHeroe.getNombre());
var BlackWitch = {
    nombre: "Jane"
};
var Ironman = {
    nombre: "Tony",
    poderes: ["Plata"]
};
console.log('------------------12-----------------');
function llamarHeroe(heroe) {
    console.log("Llamando a " + heroe.nombre);
}
llamarHeroe(Ironman);
llamarHeroe(BlackWitch);
// 13 --> Interface en clase
var Avenger = /** @class */ (function () {
    function Avenger() {
        this.nombre = "";
    }
    return Avenger;
}());
var Mutant = /** @class */ (function () {
    function Mutant() {
        this.nombre = "";
        this.poderes = [];
    }
    return Mutant;
}());
var av1 = new Avenger();
av1.nombre = "Superman";
var m1 = new Mutant();
m1.nombre = "Legion";
m1.poderes.push("Telequinesis");
m1.poderes.push("Teletransportacion");
console.log('------------------13-----------------');
console.log(av1);
console.log(m1);
//# sourceMappingURL=app.js.map