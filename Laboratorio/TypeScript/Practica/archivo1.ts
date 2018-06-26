//PARA INICIALIZAR TYPESCRIPT -> tsc --init
//PARA EL WATCHER -> tsc -w
//CONFIGURAR CONFIG

// 1 --> array
let vector:number[] = [1,2,3,4];

console.log('------------------1------------------');
for(var a=0;a<vector.length;a++) {
    console.log(vector[a]);
} 

// 2 --> tupla
let tupla:[number, string] = [1, "Ironman"];
console.log('------------------2------------------');
console.log(tupla);

// 3 --> enum
enum Eheroe{
    Xman,
    Avenger
}
console.log('------------------3------------------');
console.log(Eheroe.Avenger);
let nombre:string = Eheroe[Eheroe.Avenger];
console.log(nombre);

// 4 --> funcion
let functionEnviarMision = function(heroe:string):string {
    return heroe + " enviado";
}
console.log('------------------4------------------');
console.log(functionEnviarMision(tupla[1]));

// 5 --> parametros opcionales
let functionEnviarMision3 = function(heroe?:string):string {
    if(heroe) {
        return functionEnviarMision(heroe);
    } else {
        return "Algún heroe se envió";
    }
}
console.log('------------------5------------------');
console.log(functionEnviarMision3());
console.log(functionEnviarMision3("Spiderman"));

// 6 --> parametros por defecto
let functionEnviarMision4 = function(heroe:string="xxx"):string {
    return functionEnviarMision(heroe);
}
console.log('------------------6------------------');
console.log(functionEnviarMision4());
console.log(functionEnviarMision4("Wolverine"));

// 7 --> parametros rest
let functionEnviarMision5 = function(...heroe:string[]):void {
    for(var i=0; i<heroe.length; i++) {
        console.log(heroe[i] + ' enviado?');
    }
}
console.log('------------------7------------------');
console.log(functionEnviarMision5("Antman", "Captain America"));

// 8 --> funcion arrow
let functionEnviarMision6 = (heroe:string="Heroe"):string=>{
    return functionEnviarMision(heroe);
}
console.log('------------------8------------------');
console.log(functionEnviarMision6("Black Panther"));

// 9 --> tipo en objeto
let flash: {
    nombre: string,
    edad: number,
    poderes:string[],
    getNombre:()=>string
} = {
    nombre: "Barry Alen",
    edad: 24,
    poderes: ["Velocidad", "Viaje en el tiempo"],
    getNombre() {
        return "Me llamo " + this.nombre;
    }
}
console.log('------------------9------------------');
console.log(flash);
console.log(flash.getNombre());

// 10 --> tipo en objeto
type Heroe = {
    nombre: string,
    edad: number,
    poderes?:string[], // ES OPCIONAL!
    getNombre:()=>string
}
let WonderWoman:Heroe = {
    nombre: "Gal Gadot",
    edad: 34,
    //poderes: ["Velocidad", "Fuerza"], COMO ^^^^, PUEDO NO PONERLO
    getNombre() {
        return "Me llamo " + this.nombre;
    }
}
console.log('------------------10-----------------');
console.log(WonderWoman);
console.log(WonderWoman.getNombre());

// 11 --> tipo multiples
type Heroe2 = {
    nombre: string,
    edad: number
}

let unHeroe:Heroe|Heroe2;
console.log('------------------11-----------------');
unHeroe = {nombre:"Ironman", edad:45}
console.log(unHeroe.nombre);
unHeroe = {nombre:"Ironman", edad:45, getNombre:function(){return "Me llamo " + this.nombre}}
console.log(unHeroe.getNombre());

// 12 --> interface
interface IHeroe {
    nombre:string,
    poderes?:string[],
    mostrar?:()=>string
}
let BlackWitch:IHeroe = {
    nombre: "Jane"
}
let Ironman:IHeroe = {
    nombre: "Tony",
    poderes: ["Plata"]
}
console.log('------------------12-----------------');
function llamarHeroe(heroe:IHeroe) {
    console.log("Llamando a " + heroe.nombre);
}
llamarHeroe(Ironman);
llamarHeroe(BlackWitch);

// 13 --> Interface en clase
class Avenger implements IHeroe {
    nombre:string="";
}

class Mutant implements IHeroe {
    nombre:string="";
    poderes:string[]=[];
}

let av1:Avenger = new Avenger();
av1.nombre="Superman";
let m1:Mutant = new Mutant();
m1.nombre="Legion";
m1.poderes.push("Telequinesis");
m1.poderes.push("Teletransportacion");
console.log('------------------13-----------------');
console.log(av1);
console.log(m1);

// 14 --> Interface en funciones
interface IfuncDosNumeros {
    (num1:number, num2:number):number;
}
let miFuncion:IfuncDosNumeros;
miFuncion = (num1:number, num2:number)=>num1+num2;
console.log('------------------14-----------------');
console.log(miFuncion(2,5));

// 14 --> Clases
class Avenger2 implements IHeroe {
    nombre:string="un avenger";
    constructor(nombre:string) {
        this.nombre = nombre;
    }
}

console.log('------------------15-----------------');
let av2:Avenger2 = new Avenger2("Hulk");
console.log(av2);

// 16 --> Clases con atributos privados
class Avenger3 {
    private nombre:string="un avenger";
    private _edad:number=0;
    constructor(nombre:string, edad?:number) {
        this.nombre = nombre;
        if (edad) {
            this.edad = edad;
        }
    }
    get edad():number {return this._edad;}
    set edad(edad:number) {this._edad = edad;}
    public mostrar = ()=>this.nombre + " y tiene " + this.edad;
}

console.log('------------------16-----------------');
let av3:Avenger3 = new Avenger3("Batman");
av3.edad = 40;
console.log(av3.mostrar());
let av4:Avenger3 = new Avenger3("Aquaman", 30);
console.log(av4.mostrar());

// 17 --> Clases con atributos privados
class Xmen {
    static nombre_de_clase:string = "Xman";
    static crearXmen() {
        return new Xmen();
    }
    nombre:string="un xman";
}

console.log('------------------17-----------------');
console.log(Xmen.nombre_de_clase);
console.log(Xmen.crearXmen().nombre);

// 18 --> Constructor privado
class Xmen2 {
    private static instancia:Xmen2;
    private _nombre:string="";
    private constructor(nombre:string) {
        this._nombre = nombre;
    }
    static getInstance():Xmen2{
        if(!(this.instancia)){
            this.instancia = new Xmen2("Mi Xman2");
        }
        return this.instancia;
    }
    set nombre(nombre:string) {this._nombre = nombre;}
    get nombre():string {return this._nombre;}
}

console.log('------------------18-----------------');
let xman2:Xmen2 = Xmen2.getInstance();
console.log(xman2.nombre);
xman2.nombre = "Supergirl";
let xman3:Xmen2 = Xmen2.getInstance();
console.log(xman3.nombre);

// 19 --> namespace
namespace Funciones {
    export function f1() {
        console.log('soy la funcion 1');
    }
    export function f2() {
        console.log('soy la funcion 2');
    }
}

console.log('------------------19-----------------');
Funciones.f1();
Funciones.f2();


// 20 --> herencia
class AvengerHeredado extends Avenger2{}
let ah:AvengerHeredado = new AvengerHeredado("heredado");

console.log('------------------20-----------------');
console.log("OBJETO " + ah.nombre);

// 21 --> herencia 2
class AvengerHeredado2 extends Avenger2{
    edad: number=0;
    constructor(nombre:string, edad:number) {
        super(nombre);
        this.edad=edad;
    }
}
let ah2:AvengerHeredado2 = new AvengerHeredado2("heredado2", 44);
console.log('------------------21-----------------');
console.log("OBJETO " + ah2.nombre + " " + ah2.edad);

