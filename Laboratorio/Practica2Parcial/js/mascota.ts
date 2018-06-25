namespace Clases{

    export class Mascota extends Animal{
        constructor(id:number, nombre:string, edad:number, patas:number, tipo:tipoMascota) {
            super(id, nombre, edad, patas, tipo);
        }
    }
}