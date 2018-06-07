<?php
class Mesa
{
    private $id;
    private $param1;
    private $param2;
    private $param3;
    
    public function GetParam1() {
        return $this->param1;
    }
    public function GetParam2() {
        return $this->param2;
    }
    public function GetParam3() {
        return $this->param3;
    }

    public function SetParam1($value) {
        $this->param1 = $value;
    }
    public function SetParam2($value) {
        $this->param2 = $value;
    }
    public function SetParam3($value) {
        $this->param3 = $value;
    }
    
    public function BorrarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from mesas
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update mesas 
            set param1='$this->param1',
            param2='$this->param2',
            param3='$this->param3'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesas (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarMesa() {
        if ($this->id > 0) {
            $this->ModificarMesa();
        } else {
            $this->InsertarMesa();
        }
    }

    public static function TraerMesas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from mesas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Mesa");
    }

    public static function TraerMesa($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from mesas where id = $id");
        $consulta->execute();
        $mesaResultado= $consulta->fetchObject('Mesa');
        return $mesaResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}