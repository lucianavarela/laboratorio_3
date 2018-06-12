"use strict";
//PARA INICIALIZAR TYPESCRIPT -> tsc --init
//PARA EL WATCHER -> tsc -w
// --> array
var vector = [1, 2, 3, 4];
for (var a = 0; a < vector.length; a++) {
    console.log(vector[a]);
}
// --> tupla
var tupla = [1, "Ironman"];
console.log(tupla);
// --> enum
var Eheroe;
(function (Eheroe) {
    Eheroe[Eheroe["Xman"] = 0] = "Xman";
    Eheroe[Eheroe["Avenger"] = 1] = "Avenger";
})(Eheroe || (Eheroe = {}));
console.log(Eheroe.Avenger);
var nombre = Eheroe[Eheroe.Avenger];
console.log(nombre);
// --> funcion
var functionEnviarMision = function (heroe) {
    return heroe + " enviado";
};
console.log(functionEnviarMision(tupla[1]));
// --> parametros opcionales
var functionEnviarMision3 = function (heroe) {
    if (heroe) {
        return functionEnviarMision(heroe);
    }
    else {
        return "Algún heroe se envió";
    }
};
console.log(functionEnviarMision3());
console.log(functionEnviarMision3("Spiderman"));
//# sourceMappingURL=app.js.map