//realizar codigo de la clase "Heroe". el metodo toJSON es parte de la clase y es provisto en el starter
namespace Clases{
    export class Heroe extends Clases.Personaje {
        id:number = 0;
        tipo:Clases.tipoHeroe = Clases.tipoHeroe.Avenger;
        poder_principal:string="";

        public constructor(id:number, nombre:string, edad:number, tipo:Clases.tipoHeroe, poder_principal:string) {
            super(nombre, edad);
            this.id = id;
            this.tipo = tipo;
            this.poder_principal = poder_principal;
        }

        public toJSON():string{
            let cad:string = super.toJSON().replace('}', '');          
            let json:string = cad + `, "id":${this.id}, "tipo":${this.tipo.toString()}, "poder_principal":"${this.poder_principal}"}`;
            return json;
        }

    }
}