<?php
class Compra
{
    public $id;
    public $articulo;
    public $fecha;
    public $precio;
    public $usuario;
    
    public function GetArticulo() {
        return $this->articulo;
    }
    public function GetFecha() {
        return $this->fecha;
    }
    public function GetPrecio() {
        return $this->precio;
    }
    public function GetUsuario() {
        return $this->usuario;
    }

    public function SetArticulo($value) {
        $this->articulo = $value;
    }
    public function SetFecha($value) {
        $this->fecha = $value;
    }
    public function SetPrecio($value) {
        $this->precio = $value;
    }
    public function SetUsuario($value) {
        $this->usuario = $value;
    }
    
    public function BorrarCompra() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from compras
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarCompra() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update compras 
            set articulo='$this->articulo',
            fecha='$this->fecha',
            precio='$this->precio',
            usuario=$this->usuario
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarCompra() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into compras (articulo,fecha,precio,usuario)values('$this->articulo','$this->fecha','$this->precio',$this->usuario)");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarCompra() {
        if ($this->id > 0) {
            $this->ModificarCompra();
        } else {
            $this->InsertarCompra();
        }
    }

    public static function TraerCompras() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from compras;");
        $consulta->execute();
        $compras = $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
        return $compras;
    }

    public static function TraerCompra($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from compras where id = '$id'");
        $consulta->execute();
        $compraResultado= $consulta->fetchObject('Compra');
        return $compraResultado;
    }
}