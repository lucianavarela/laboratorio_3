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
var miFuncion;
miFuncion = function (num1, num2) { return num1 + num2; };
console.log('------------------14-----------------');
console.log(miFuncion(2, 5));
// 14 --> Clases
var Avenger2 = /** @class */ (function () {
    function Avenger2(nombre) {
        this.nombre = "un avenger";
        this.nombre = nombre;
    }
    return Avenger2;
}());
console.log('------------------15-----------------');
var av2 = new Avenger2("Hulk");
console.log(av2);
// 16 --> Clases con atributos privados
var Avenger3 = /** @class */ (function () {
    function Avenger3(nombre, edad) {
        var _this = this;
        this.nombre = "un avenger";
        this._edad = 0;
        this.mostrar = function () { return _this.nombre + " y tiene " + _this.edad; };
        this.nombre = nombre;
        if (edad) {
            this.edad = edad;
        }
    }
    Object.defineProperty(Avenger3.prototype, "edad", {
        get: function () { return this._edad; },
        set: function (edad) { this._edad = edad; },
        enumerable: true,
        configurable: true
    });
    return Avenger3;
}());
console.log('------------------16-----------------');
var av3 = new Avenger3("Batman");
av3.edad = 40;
console.log(av3.mostrar());
var av4 = new Avenger3("Aquaman", 30);
console.log(av4.mostrar());
// 17 --> Clases con atributos privados
var Xmen = /** @class */ (function () {
    function Xmen() {
        this.nombre = "un xman";
    }
    Xmen.crearXmen = function () {
        return new Xmen();
    };
    Xmen.nombre_de_clase = "Xman";
    return Xmen;
}());
console.log('------------------17-----------------');
console.log(Xmen.nombre_de_clase);
console.log(Xmen.crearXmen().nombre);
// 18 --> Constructor privado
var Xmen2 = /** @class */ (function () {
    function Xmen2(nombre) {
        this._nombre = "";
        this._nombre = nombre;
    }
    Xmen2.getInstance = function () {
        if (!(this.instancia)) {
            this.instancia = new Xmen2("Mi Xman2");
        }
        return this.instancia;
    };
    Object.defineProperty(Xmen2.prototype, "nombre", {
        get: function () { return this._nombre; },
        set: function (nombre) { this._nombre = nombre; },
        enumerable: true,
        configurable: true
    });
    return Xmen2;
}());
console.log('------------------18-----------------');
var xman2 = Xmen2.getInstance();
console.log(xman2.nombre);
xman2.nombre = "Supergirl";
var xman3 = Xmen2.getInstance();
console.log(xman3.nombre);
//# sourceMappingURL=app.js.map