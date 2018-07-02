<?php
class Clase
{
    public $id;
    public $param1;
    public $param2;
    
    public function GetParam1() {
        return $this->param1;
    }
    public function GetParam2() {
        return $this->param2;
    }

    public function SetParam1($value) {
        $this->param1 = $value;
    }
    public function SetParam2($value) {
        $this->param2 = $value;
    }
    
    public function __construct(){}

    public function BorrarClase() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from clases
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarClase() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update clases 
            set param1='$this->param1',
            param2='$this->param2'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarClase() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into clases (param1,param2)values('$this->param1','$this->param2')");
        $consulta->execute();
        return $nuevoParam1;
    }

    public function GuardarClase() {
        if ($this->id > 0) {
            $this->ModificarClase();
        } else {
            $this->InsertarClase();
        }
    }

    public static function TraerClases() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from clases;");
        $consulta->execute();
        $clases = $consulta->fetchAll(PDO::FETCH_CLASS, "Clase");
        return $clases;
    }

    public static function TraerClase($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from clases where param1 = '$id'");
        $consulta->execute();
        $claseResultado= $consulta->fetchObject('Clase');
        return $claseResultado;
    }

    public function toString() {
        return "\nClase #$this->param1 -> ".$this->GetParam2();
    }
}