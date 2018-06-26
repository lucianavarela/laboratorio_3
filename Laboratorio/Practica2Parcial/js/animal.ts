namespace Clases{

    export abstract class Animal{
        id: number=0;
        nombre:string="";
        edad: number=0;
        patas: number=0;
        tipo:tipoMascota=tipoMascota.Perro;
        public toJSON():string{
            let json: string = `{"id":"${this.id}", "nombre":"${this.nombre}", "edad":${this.edad},"patas":${this.patas}, "tipo":${this.tipo}}`;
            return json;
        }
        constructor(id:number, nombre:string, edad:number, patas:number, tipo:tipoMascota) {
            this.id = id;
            this.nombre = nombre;
            this.edad = edad;
            this.patas = patas;
            this.tipo = tipo;
        }
    }

}