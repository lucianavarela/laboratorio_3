//PARA INICIALIZAR TYPESCRIPT -> tsc --init
//PARA EL WATCHER -> tsc -w

// --> array
let vector:number[] = [1,2,3,4];

for(var a=0;a<vector.length;a++) {
    console.log(vector[a]);
}

// --> tupla
let tupla:[number, string] = [1, "Ironman"];
console.log(tupla);

// --> enum
enum Eheroe{
    Xman,
    Avenger
}
console.log(Eheroe.Avenger);
let nombre:string = Eheroe[Eheroe.Avenger];
console.log(nombre);

// --> funcion
let functionEnviarMision = function(heroe:string):string {
    return heroe + " enviado";
}
console.log(functionEnviarMision(tupla[1]));

// --> parametros opcionales
let functionEnviarMision3 = function(heroe?:string):string {
    if(heroe) {
        return functionEnviarMision(heroe);
    } else {
        return "Algún heroe se envió";
    }
}
console.log(functionEnviarMision3());
console.log(functionEnviarMision3("Spiderman"));