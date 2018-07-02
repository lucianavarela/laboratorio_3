<?php
class Venta
{
    public $id;
    public $usuario;
    public $bici;
    
    public function GetUsuario() {
        return $this->usuario;
    }
    public function GetBici() {
        return $this->bici;
    }

    public function SetUsuario($value) {
        $this->usuario = $value;
    }
    public function SetBici($value) {
        $this->bici = $value;
    }
    
    public function BorrarVenta() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ventas
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarVenta() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update ventas 
            set usuario='$this->usuario',
            bici='$this->bici'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarVenta() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ventas (usuario,bici)values('$this->usuario','$this->bici')");
        $consulta->execute();
        return $nuevoUsuario;
    }

    public function GuardarVenta() {
        if ($this->id > 0) {
            $this->ModificarVenta();
        } else {
            $this->InsertarVenta();
        }
    }

    public static function TraerVentas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas;");
        $consulta->execute();
        $ventas = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
        return $ventas;
    }

    public static function TraerVenta($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas where id = '$id'");
        $consulta->execute();
        $ventaResultado= $consulta->fetchObject('Venta');
        return $ventaResultado;
    }

    public function toString() {
        return "\nVenta #$this->usuario -> ".$this->GetBici();
    }
}